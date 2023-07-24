<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Cetak Laporan</title>
  <link href="{{asset('')}}vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="{{asset('')}}vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="{{asset('')}}css/ruang-admin.min.css" rel="stylesheet">
  <style>
    @media print {
      @page {
        size: landscape
      }

      ;

      th {
        color: black
      }
    }
  </style>
</head>

<body id="page-top" onload="window.print()">
  <div class="text mt-5">
    <h3 class="text-center mb-5 mt-5">Cetak Rincian Piutang</h3>
    <table class="table table-bordered table-hover dt-responsive nowrap" id="laporan" style="width: 100%">
      <thead class="text-center">
        <tr>
          <th rowspan="2" class="bg-warning text-white">Nama</th>
          <th colspan="3" class="bg-warning text-white">Usulan Ke BPKD</th>
          <th colspan="3" class="bg-info text-white">Rincian Piutang</th>
          <th colspan="2" class="bg-success text-white">Usulan PUPN </th>
          <th colspan="2" class="bg-success text-white">Balasan PUPN</th>
          <th colspan="2" class="bg-success text-white">Pembayaran</th>
          <th colspan="2" class="bg-success text-white">Keputusan</th>
        </tr>
        <tr>
          <th class="bg-warning text-white">Jenis</th>
          <th class="bg-warning text-white">Tanggal</th>
          <th class="bg-warning text-white">Nomor</th>
          <th class="bg-info text-white">Pokok</th>
          <th class="bg-info text-white">Denda</th>
          <th class="bg-info text-white">Total</th>
          <th class="bg-success text-white">Tanggal</th>
          <th class="bg-success text-white">Nomor</th>
          <th class="bg-success text-white">Tanggal</th>
          <th class="bg-success text-white">Nomor</th>
          <th class="bg-danger text-white">Tanggal</th>
          <th class="bg-danger text-white">Nilai</th>
          <th class="bg-primary text-white">Tanggal</th>
          <th class="bg-primary text-white">Nomor</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $item)
            @if ($item->docs_balasan != null)
                @php
                    $dueDate = \Carbon\Carbon::parse($item->tgl_surat);
                    $currDate = \Carbon\Carbon::now();

                    $year = $currDate->diffInYears($dueDate);
                    $denda = 50000;
                    $total_denda = $year * $denda;
                @endphp
                <tr>
                    <td>{{$item->nama_peminjam}}</td>
                    <td>{{$item->jenis}}</td>
                    <td>{{\Carbon\Carbon::parse($item->tgl_surat)->translatedFormat('d-F-Y')}}</td>
                    <td>{{$item->no_skrd}}</td>
                    <td>{{number_format($item->nilai_rincian, 0,'','.')}}</td>
                    <td>-</td>
                    <td>{{number_format($item->total_rincian + $total_denda, 0,'','.')}}</td>
                    <td>{{\Carbon\Carbon::parse($item->tgl_knkpl)->translatedFormat('d-F-Y')}}</td>
                    <td>{{$item->nomor_knkpl}}</td>
                    <td>{{\Carbon\Carbon::parse($item->tgl_balasan)->translatedFormat('d-F-Y')}}</td>
                    <td>{{$item->nomor_balasan}}</td>
                    <td>{{\Carbon\Carbon::parse($item->tgl_bayar)->translatedFormat('d-F-Y')}}</td>
                    <td>{{number_format($item->nominal_bayar, 0,'','.')}}</td>
                    <td>{{\Carbon\Carbon::parse($item->tgl_keputusan)->translatedFormat('d-F-Y')}}</td>
                    <td>{{$item->nomor_keputusan}}</td>
                </tr>
            @endif
        @endforeach
      </tbody>
    </table>
  </div>
  <script src="{{asset('')}}vendor/jquery/jquery.min.js"></script>
  <script src="{{asset('')}}vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="{{asset('')}}js/ruang-admin.min.js"></script>
</body>

</html>
