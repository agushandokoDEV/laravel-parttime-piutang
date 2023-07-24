<?php

namespace App\Http\Controllers\Nasabah;

use App\Http\Controllers\Controller;
use App\Models\SuratUsulan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{

    public function index()
    {
        $piutang = SuratUsulan::with('user', 'jenisPiutang', 'usulanKnkpl', 'balasanKnkpl', 'keputusan', 'beritaAcara')->get();
        $data = DB::table('surat_usulan_knkpls')
            ->join('surat_usulans', 'surat_usulans.id', '=', 'surat_usulan_knkpls.usulans_id')
            ->leftJoin('jenis_piutangs', 'jenis_piutangs.id', 'surat_usulans.id_jenis')
            ->leftJoin('berita_acaras', 'berita_acaras.usulans_id', 'surat_usulans.id')
            ->leftJoin('surat_balasan_knkpls', 'surat_balasan_knkpls.usulans_id', 'surat_usulans.id')
            ->leftJoin('keputusan_gubernurs', 'keputusan_gubernurs.usulans_id', 'surat_usulans.id')
            ->leftJoin('pembayarans', 'pembayarans.usulans_id', 'surat_usulans.id')
            ->leftJoin('file_sts', 'surat_usulans.id', '=', 'file_sts.usulans_id')
            ->leftJoin('file__ppps', 'surat_usulans.id', '=', 'file__ppps.usulans_id')
            ->leftJoin('file__dls', 'surat_usulans.id', '=', 'file__dls.usulans_id')
            ->groupBy('surat_usulans.id', 'jenis_piutangs.jenis', 'surat_usulan_knkpls.id', 'surat_balasan_knkpls.id', 'keputusan_gubernurs.id', 'berita_acaras.judul', 'pembayarans.id')
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
            ->whereIn('surat_usulans.status', ['proses', 'validate'])
            ->where('surat_usulans.users_id',Auth::user()->id)
            ->get();
        // dd($data);
        return view('nasabah.laporan', compact('data'));
    }
    public function indexBACKUP()
    {
        $data=DB::table('surat_usulan_knkpls')
            ->join('surat_usulans', 'surat_usulans.id', '=', 'surat_usulan_knkpls.usulans_id')
            ->leftJoin('jenis_piutangs', 'jenis_piutangs.id', 'surat_usulans.id_jenis')
            ->leftJoin('berita_acaras', 'berita_acaras.usulans_id', 'surat_usulans.id')
            ->leftJoin('surat_balasan_knkpls', 'surat_balasan_knkpls.usulans_id', 'surat_usulans.id')
            ->leftJoin('keputusan_gubernurs', 'keputusan_gubernurs.usulans_id', 'surat_usulans.id')
            ->leftJoin('pembayarans', 'pembayarans.usulans_id', 'surat_usulans.id')
            ->leftJoin('file_sts', 'surat_usulans.id', '=', 'file_sts.usulans_id')
            ->leftJoin('file__ppps', 'surat_usulans.id', '=', 'file__ppps.usulans_id')
            ->leftJoin('file__dls', 'surat_usulans.id', '=', 'file__dls.usulans_id')
            ->groupBy('surat_usulans.id', 'jenis_piutangs.jenis', 'surat_usulan_knkpls.id', 'surat_balasan_knkpls.id', 'keputusan_gubernurs.id', 'berita_acaras.judul', 'pembayarans.id')
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
            ->whereIn('surat_usulans.status', ['proses','validate'])
            ->get();
        // dd($data);
        return view('nasabah.laporan', compact('data'));
    }

    public function export()
    {
        $spreddshet = new Spreadsheet();
        $sheet = $spreddshet->getActiveSheet();

        $headerData = [
            ['Nama', 'Usulan Ke BPKD', '', '', 'Rincian Piutang', '', '', 'Usulan PUPN', '', '', 'Balasan PUPN','', '', 'Pembayaran', '', 'Keputusan Gubernur', '', 'Status'],
            ['', 'Jenis', 'Tanggal', 'Nomor', 'Pokok', 'Denda', 'Total', 'Tanggal', 'Perihal', 'Nomor', 'Tanggal', 'Perihal', 'Nomor', 'Tanggal', 'Nilai', 'Tanggal', 'Nomor', ''],
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
        $sheet->mergeCells('H1:J1');
        $sheet->mergeCells('K1:M1');
        $sheet->mergeCells('N1:O1');
        $sheet->mergeCells('P1:Q1');
        $sheet->mergeCells('R1:R2');

        $headerStyle = $sheet->getStyle('A1:R1');
        $headerStyle = $sheet->getStyle('A1:R1');
        $headerStyle->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $headerStyle->getFont()->setSize(12);
        $headerFont = $headerStyle->getFont();
        $headerFont->setBold(true);

        $headerStyle2 = $sheet->getStyle('B2:R2');
        $headerFont2 = $headerStyle2->getFont();
        $headerFont2->setBold(true);

        $data = DB::table('surat_usulan_knkpls')
            ->join('surat_usulans', 'surat_usulans.id', '=', 'surat_usulan_knkpls.usulans_id')
            ->leftJoin('jenis_piutangs', 'jenis_piutangs.id', 'surat_usulans.id_jenis')
            ->leftJoin('berita_acaras', 'berita_acaras.usulans_id', 'surat_usulans.id')
            ->leftJoin('surat_balasan_knkpls', 'surat_balasan_knkpls.usulans_id', 'surat_usulans.id')
            ->leftJoin('keputusan_gubernurs', 'keputusan_gubernurs.usulans_id', 'surat_usulans.id')
            ->leftJoin('pembayarans', 'pembayarans.usulans_id', 'surat_usulans.id')
            ->leftJoin('file_sts', 'surat_usulans.id', '=', 'file_sts.usulans_id')
            ->leftJoin('file__ppps', 'surat_usulans.id', '=', 'file__ppps.usulans_id')
            ->leftJoin('file__dls', 'surat_usulans.id', '=', 'file__dls.usulans_id')
            ->groupBy('surat_usulans.id', 'jenis_piutangs.jenis', 'surat_usulan_knkpls.id', 'surat_balasan_knkpls.id', 'keputusan_gubernurs.id', 'berita_acaras.judul', 'pembayarans.id')
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
            ->whereIn('surat_usulans.status', ['proses', 'validate'])
            ->get();

        $row = 3;
        // dd($data);
        foreach ($data as $value) {
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
            $sheet->setCellValue('F' . $row, number_format($value->denda));
            $sheet->setCellValue('G' . $row, number_format($value->total_rincian));
            $sheet->setCellValue('H' . $row, $value->tgl_knkpl != null?Carbon::parse($value->tgl_knkpl)->translatedFormat('d-F-Y'):'');
            $sheet->setCellValue('I' . $row, $value->rincian_usulan_knkpl);
            $sheet->setCellValue('J' . $row, $value->nomor_knkpl);
            $sheet->setCellValue('K' . $row, $value->tgl_balasan != null?Carbon::parse($value->tgl_balasan)->translatedFormat('d-F-Y'):'');
            $sheet->setCellValue('L' . $row, $value->rincian_balasan);
            $sheet->setCellValue('M' . $row, $value->nomor_balasan);
            if ($value->tgl_bayar != null) {
                $sheet->setCellValue('N' . $row, Carbon::parse($value->tgl_bayar)->translatedFormat('d-F-Y'));
            } else {
                $sheet->setCellValue('N' . $row, '');
            }
            $sheet->setCellValue('O' . $row, number_format($value->nominal_bayar));
            $sheet->setCellValue('P' . $row, $value->tgl_keputusan != null?Carbon::parse($value->tgl_keputusan)->translatedFormat('d-F-Y'):'');
            $sheet->setCellValue('Q' . $row, $value->nomor_keputusan);
            if ($value->docs_balasan != null) {
                $sheet->setCellValue('R' . $row, 'Terpenuhi');
            } else {
                $sheet->setCellValue('R' . $row, 'Tidak Terpenuhi');
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
            $sheet->getColumnDimension('K')->setWidth(20);
            $sheet->getColumnDimension('L')->setWidth(22);
            $sheet->getColumnDimension('M')->setWidth(18);
            $sheet->getColumnDimension('N')->setWidth(18);
            $sheet->getColumnDimension('O')->setWidth(25);
            $sheet->getColumnDimension('P')->setWidth(25);
            $sheet->getColumnDimension('Q')->setWidth(15);
            $sheet->getColumnDimension('R')->setWidth(15);
            $sheet->getRowDimension($row)->setRowHeight(20);
            $row++;
        }

        $dataStyle = $sheet->getStyle('A2:R' . ($row - 1));
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

    public function exportBACKUP()
    {
        $spreddshet = new Spreadsheet();
        $sheet = $spreddshet->getActiveSheet();

        $headerData = [
            ['Nama', 'Usulan Ke BPKD', '', '', 'Rincian Piutang', '', '', 'Usulan PUPN','', '', 'Balasan PUPN', '', 'Pembayaran', '', 'Keputusan Gubernur', '', 'Status'],
            ['', 'Jenis', 'Tanggal', 'Nomor', 'Pokok', 'Denda', 'Total', 'Tanggal', 'Perihal', 'Nomor', 'Tanggal', 'Nomor', 'Tanggal', 'Nilai', 'Tanggal', 'Nomor', ''],
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
        $sheet->mergeCells('H1:J1');
        $sheet->mergeCells('K1:L1');
        $sheet->mergeCells('M1:N1');
        $sheet->mergeCells('O1:P1');
        $sheet->mergeCells('Q1:Q2');

        $headerStyle = $sheet->getStyle('A1:Q1');
        $headerStyle = $sheet->getStyle('A1:Q1');
        $headerStyle->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $headerStyle->getFont()->setSize(12);
        $headerFont = $headerStyle->getFont();
        $headerFont->setBold(true);

        $headerStyle2 = $sheet->getStyle('B2:Q2');
        $headerFont2 = $headerStyle2->getFont();
        $headerFont2->setBold(true);

        $data = DB::table('surat_usulan_knkpls')
            ->join('surat_usulans', 'surat_usulans.id', '=', 'surat_usulan_knkpls.usulans_id')
            ->leftJoin('jenis_piutangs', 'jenis_piutangs.id', 'surat_usulans.id_jenis')
            ->leftJoin('berita_acaras', 'berita_acaras.usulans_id', 'surat_usulans.id')
            ->leftJoin('surat_balasan_knkpls', 'surat_balasan_knkpls.id', 'surat_usulans.id')
            ->leftJoin('keputusan_gubernurs', 'keputusan_gubernurs.id', 'surat_usulans.id')
            ->leftJoin('pembayarans', 'pembayarans.id', 'surat_usulans.id')
            ->join('file_sts', 'surat_usulans.id', '=', 'file_sts.usulans_id')
            ->leftJoin('file__ppps', 'surat_usulans.id', '=', 'file__ppps.usulans_id')
            ->join('file__dls', 'surat_usulans.id', '=', 'file__dls.usulans_id')
            ->groupBy(
                'surat_usulans.id',
                'jenis_piutangs.jenis',
                'surat_usulan_knkpls.id',
                'surat_balasan_knkpls.id',
                'keputusan_gubernurs.id',
                'berita_acaras.judul',
                'pembayarans.id'
                )
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
            ->whereIn('surat_usulans.status', ['proses','validate'])
            ->get();

        // dd($data);
        $row = 3;
        foreach ($data as $value) {
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
            $sheet->setCellValue('F' . $row, number_format($value->denda));
            $sheet->setCellValue('G' . $row, number_format($value->total_rincian));
            $sheet->setCellValue('H' . $row, Carbon::parse($value->tgl_knkpl)->translatedFormat('d-F-Y'));
            $sheet->setCellValue('I' . $row, $value->rincian_usulan_knkpl);
            $sheet->setCellValue('J' . $row, $value->nomor_knkpl);
            $sheet->setCellValue('K' . $row, Carbon::parse($value->tgl_balasan)->translatedFormat('d-F-Y'));
            $sheet->setCellValue('L' . $row, $value->nomor_balasan);
            if ($value->tgl_bayar != null) {
                $sheet->setCellValue('M' . $row, Carbon::parse($value->tgl_bayar)->translatedFormat('d-F-Y'));
            } else {
                $sheet->setCellValue('M' . $row, '');
            }
            $sheet->setCellValue('N' . $row, number_format($value->nominal_bayar));
            $sheet->setCellValue('O' . $row, Carbon::parse($value->tgl_keputusan)->translatedFormat('d-F-Y'));
            $sheet->setCellValue('P' . $row, $value->nomor_keputusan);
            if ($value->docs_balasan != null) {
                $sheet->setCellValue('Q' . $row, 'Terpenuhi');
            } else {
                $sheet->setCellValue('Q' . $row, 'Tidak Terpenuhi');
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
            $sheet->getColumnDimension('K')->setWidth(20);
            $sheet->getColumnDimension('L')->setWidth(22);
            $sheet->getColumnDimension('M')->setWidth(18);
            $sheet->getColumnDimension('N')->setWidth(18);
            $sheet->getColumnDimension('O')->setWidth(25);
            $sheet->getColumnDimension('P')->setWidth(25);
            $sheet->getColumnDimension('Q')->setWidth(15);
            $sheet->getRowDimension($row)->setRowHeight(20);
            $row++;
        }

        $dataStyle = $sheet->getStyle('A2:Q' . ($row - 1));
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
