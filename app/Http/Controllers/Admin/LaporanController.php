<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SuratUsulan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $piutang = SuratUsulan::with('user', 'jenisPiutang', 'usulanKnkpl', 'balasanKnkpl', 'keputusan', 'beritaAcara')->get();
        $data = DB::table('surat_usulans')
            ->leftJoin('users', 'users.id', 'surat_usulans.users_id')
            ->leftJoin('jenis_piutangs', 'jenis_piutangs.id', 'surat_usulans.id_jenis')
            ->leftJoin('surat_usulan_knkpls', 'surat_usulan_knkpls.id', 'surat_usulans.id')
            ->leftJoin('surat_balasan_knkpls', 'surat_balasan_knkpls.id', 'surat_usulans.id')
            ->leftJoin('keputusan_gubernurs', 'keputusan_gubernurs.id', 'surat_usulans.id')
            ->leftJoin('berita_acaras', 'berita_acaras.id', 'surat_usulans.id')
            ->leftJoin('pembayarans', 'pembayarans.id', 'surat_usulans.id')
            ->join('file_sts', 'surat_usulans.id', '=', 'file_sts.usulans_id')
            ->join('file__ppps', 'surat_usulans.id', '=', 'file__ppps.usulans_id')
            ->join('file__dls', 'surat_usulans.id', '=', 'file__dls.usulans_id')
            ->select(
                'surat_usulans.*',
                'jenis_piutangs.jenis',
                'surat_usulan_knkpls.*',
                'surat_balasan_knkpls.*',
                'keputusan_gubernurs.*',
                'berita_acaras.judul',
                'pembayarans.*',
                DB::raw('COUNT(file_sts.id) as count_sts'),
                DB::raw('COUNT(file__ppps.id) as count_st'),
                DB::raw('COUNT(file__dls.id) as count_dl'),
            )
            ->groupBy('surat_usulans.id')
            ->get();
        // dd($data);
        return view('admin.laporan', compact('data'));
    }

    public function export()
    {
        $spreddshet = new Spreadsheet();
        $sheet = $spreddshet->getActiveSheet();

        $headerData = [
            ['Nama', 'Usulan Ke BPKD', '', '', 'Rincian Piutang', '', '', 'Usulan KNKPL', '', 'Balasan KNKPL', '', 'Pembayaran', '', 'Keputusan Gubernur', '', 'Status'],
            ['', 'Jenis', 'Tanggal', 'Nomor', 'Pokok', 'Denda', 'Total', 'Tanggal', 'Nomor', 'Tanggal', 'Nomor', 'Tanggal', 'Nilai', 'Tanggal', 'Nomor', ''],
        ];

        $rowIndex = 1;
        foreach ($headerData as $rowData) {
            $colIndex = 1;
            foreach ($rowData as $cellData) {
                $sheet->setCellValueByColumnAndRow($colIndex, $rowIndex, $cellData);
                $sheet->getStyleByColumnAndRow($colIndex, $rowIndex)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $colIndex++;
            }
            $rowIndex++;
        }

        $sheet->mergeCells('A1:A2');
        $sheet->mergeCells('B1:D1');
        $sheet->mergeCells('E1:G1');
        $sheet->mergeCells('H1:I1');
        $sheet->mergeCells('J1:K1');
        $sheet->mergeCells('L1:M1');
        $sheet->mergeCells('N1:O1');
        $sheet->mergeCells('P1:P2');

        $headerStyle = $sheet->getStyle('A1:P1');
        $headerStyle = $sheet->getStyle('A1:P1');
        $headerStyle->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $headerStyle->getFont()->setSize(12);
        $headerFont = $headerStyle->getFont();
        $headerFont->setBold(true);

        $headerStyle2 = $sheet->getStyle('B2:P2');
        $headerFont2 = $headerStyle2->getFont();
        $headerFont2->setBold(true);

        $data = DB::table('surat_usulans')
            ->leftJoin('users', 'users.id', 'surat_usulans.users_id')
            ->leftJoin('jenis_piutangs', 'jenis_piutangs.id', 'surat_usulans.id_jenis')
            ->leftJoin('surat_usulan_knkpls', 'surat_usulan_knkpls.id', 'surat_usulans.id')
            ->leftJoin('surat_balasan_knkpls', 'surat_balasan_knkpls.id', 'surat_usulans.id')
            ->leftJoin('keputusan_gubernurs', 'keputusan_gubernurs.id', 'surat_usulans.id')
            ->leftJoin('berita_acaras', 'berita_acaras.id', 'surat_usulans.id')
            ->leftJoin('pembayarans', 'pembayarans.id', 'surat_usulans.id')
            ->select('surat_usulans.*', 'jenis_piutangs.jenis', 'surat_usulan_knkpls.*', 'surat_balasan_knkpls.*', 'keputusan_gubernurs.*', 'berita_acaras.judul', 'pembayarans.*')
            ->get();
        $row = 3;
        foreach ($data as $value) {
            if ($value->docs_balasan != null) {
                $denda = 50000;
                $dueDate = Carbon::parse($value->tgl_surat);
                $now = Carbon::now();
                $year = $now->diffInYears($dueDate);
                $total_denda = $year * $denda;

                $sheet->setCellValue('A' . $row, $value->nama_peminjam);
                $sheet->setCellValue('B' . $row, $value->jenis);
                $sheet->setCellValue('C' . $row, Carbon::parse($value->tgl_surat)->translatedFormat('d-F-Y'));
                $sheet->setCellValue('D' . $row, $value->no_skrd);
                $sheet->setCellValue('E' . $row, number_format($value->nilai_rincian));
                $sheet->setCellValue('F' . $row, '');
                $sheet->setCellValue('G' . $row, number_format($value->total_rincian + $total_denda));
                $sheet->setCellValue('H' . $row, Carbon::parse($value->tgl_knkpl)->translatedFormat('d-F-Y'));
                $sheet->setCellValue('I' . $row, $value->nomor_knkpl);
                $sheet->setCellValue('J' . $row, Carbon::parse($value->tgl_balasan)->translatedFormat('d-F-Y'));
                $sheet->setCellValue('K' . $row, $value->nomor_balasan);
                if ($value->tgl_bayar != null) {
                    $sheet->setCellValue('L' . $row, Carbon::parse($value->tgl_bayar)->translatedFormat('d-F-Y'));
                } else {
                    $sheet->setCellValue('L' . $row, '');
                }
                $sheet->setCellValue('M' . $row, number_format($value->nominal_bayar));
                $sheet->setCellValue('N' . $row, Carbon::parse($value->tgl_keputusan)->translatedFormat('d-F-Y'));
                $sheet->setCellValue('O' . $row, $value->nomor_keputusan);
                if ($value->docs_balasan != null) {
                    $sheet->setCellValue('P' . $row, 'Terpenuhi');
                } else {
                    $sheet->setCellValue('P' . $row, 'Tidak Terpenuhi');
                }

                $sheet->getColumnDimension('A')->setWidth(25);
                $sheet->getColumnDimension('B')->setWidth(20);
                $sheet->getColumnDimension('C')->setWidth(18);
                $sheet->getColumnDimension('D')->setWidth(20);
                $sheet->getColumnDimension('E')->setWidth(18);
                $sheet->getColumnDimension('F')->setWidth(18);
                $sheet->getColumnDimension('G')->setWidth(18);
                $sheet->getColumnDimension('H')->setWidth(18);
                $sheet->getColumnDimension('I')->setWidth(20);
                $sheet->getColumnDimension('J')->setWidth(20);
                $sheet->getColumnDimension('K')->setWidth(22);
                $sheet->getColumnDimension('L')->setWidth(18);
                $sheet->getColumnDimension('M')->setWidth(18);
                $sheet->getColumnDimension('N')->setWidth(25);
                $sheet->getColumnDimension('O')->setWidth(25);
                $sheet->getColumnDimension('P')->setWidth(15);
                $sheet->getRowDimension($row)->setRowHeight(20);
                $row++;
            }
        }

        $dataStyle = $sheet->getStyle('A2:P' . ($row - 1));
        $dataStyle->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $lastRow = $sheet->getHighestRow();
        $lastColumn = $sheet->getHighestColumn();
        $range = 'A1:' . $lastColumn . $lastRow;
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ];
        $sheet->getStyle($range)->applyFromArray($styleArray);


        $writer = new Xlsx($spreddshet);
        $writer->save('rincian-piutang.xlsx');
        return response()->download('rincian-piutang.xlsx')->deleteFileAfterSend();
    }

    public function cetak()
    {
        $piutang = SuratUsulan::with('user', 'jenisPiutang', 'usulanKnkpl', 'balasanKnkpl', 'keputusan', 'beritaAcara')->get();
        $data = DB::table('surat_usulans')
            ->leftJoin('users', 'users.id', 'surat_usulans.users_id')
            ->leftJoin('jenis_piutangs', 'jenis_piutangs.id', 'surat_usulans.id_jenis')
            ->leftJoin('surat_usulan_knkpls', 'surat_usulan_knkpls.id', 'surat_usulans.id')
            ->leftJoin('surat_balasan_knkpls', 'surat_balasan_knkpls.id', 'surat_usulans.id')
            ->leftJoin('keputusan_gubernurs', 'keputusan_gubernurs.id', 'surat_usulans.id')
            ->leftJoin('berita_acaras', 'berita_acaras.id', 'surat_usulans.id')
            ->leftJoin('pembayarans', 'pembayarans.id', 'surat_usulans.id')
            ->select('surat_usulans.*', 'jenis_piutangs.jenis', 'surat_usulan_knkpls.*', 'surat_balasan_knkpls.*', 'keputusan_gubernurs.*', 'berita_acaras.judul', 'pembayarans.*')
            ->get();
        return view('admin.cetak', compact('data'));
    }
}
