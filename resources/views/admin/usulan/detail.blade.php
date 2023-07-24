@extends('layouts.app')

@section('title') Dokumen Surat Usulan Yang Terpenuhi & Tidak Terpenuhi @endsection

@push('css')

@endpush

@section('content')
<div class="card mb-3">
    <div class="card-header">
        <b>Dokumen Surat Usulan Yang Terpenuhi & Tidak Terpenuhi</b>
    </div>
    <div class="card-body">
        <div class="table-responsive-lg">
            <table class="table table-bordered table-striped" id="status" style="width: 100%;">
                <thead class="bg-primary text-white">
                    <tr>
                        <th class="text-center">No</th>
                        <th>Daftar Dokumen Yang Di Serahkan</th>
                        <th class="text-center">Terpenuhi</th>
                        <th class="text-center">Tidak Terpenuhi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($data->count() > 0)
                    <tr>
                        <td class="text-center">1</td>
                        <td>Fotocopy KTP / Identitas Perusahaan / Identitas Lainnya</td>
                        <td class="text-center"><input type="checkbox" @if ($data->file_ID->count() != 0)
                            checked
                            @endif></td>
                        <td class="text-center"><input type="checkbox" @if ($data->file_ID->count() == 0)
                            checked
                            @endif></td>
                    </tr>
                    <tr>
                        <td class="text-center">2</td>
                        <td>Surat Permohonan usulan penyerahan pengurusan piutang dari SKPD ke BPKD</td>
                        <td class="text-center"><input type="checkbox" @if ($data->docs_skdp != null)
                            checked
                            @endif></td>
                        <td class="text-center"><input type="checkbox" @if ($data->docs_skdp == null)
                            checked
                            @endif></td>
                    </tr>
                    <tr>
                        <td class="text-center">3</td>
                        <td>Dokumen SKRD/RUPS/Kepgu/STS/PKS/Surat Perjanjian/Surat Perikatan atau Dokumen yang Dipersamakan</td>
                        <td class="text-center"><input type="checkbox" @if ($data->file->count() != 0)
                            checked
                            @endif></td>
                        <td class="text-center"><input type="checkbox" @if ($data->file->count() == 0)
                            checked
                            @endif></td>
                    </tr>
                    <tr>
                        <td class="text-center">4</td>
                        <td>Surat Tagihan / Dokumen yang dipersamakan</td>
                        <td class="text-center"><input type="checkbox" @if (count($data->tagihan) > 0)
                            checked
                            @endif></td>
                        <td class="text-center"><input type="checkbox" @if (count($data->tagihan) == 0)
                            checked
                            @endif></td>
                    </tr>
                    <tr>
                        <td class="text-center">5</td>
                        <td>Dokumen Kriteria lainnya dalam mengusulkan pengurusan penghapusan piutang daerah</td>
                        <td class="text-center"><input type="checkbox" @if (count($data->file_DL) > 0)
                            checked
                            @endif></td>
                        <td class="text-center"><input type="checkbox" @if (count($data->file_DL) == 0)
                            checked
                            @endif></td>
                    </tr>
                    <tr>
                        <td class="text-center">6</td>
                        <td>Dokumen Pendukung Lainnya</td>
                        <td class="text-center"><input type="checkbox" @if ($data->file_kriteria->count() != 0)
                            checked
                            @endif></td>
                        <td class="text-center"><input type="checkbox" @if ($data->file_kriteria->count() == 0)
                            checked
                            @endif></td>
                    </tr>
                    @else
                    <tr>
                        <td class="text-center" colspan="5">Belum Ada Usulan Yang Di Validasi Admin</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card mb-3">
            <div class="card-header">
                <b>Fotocopy KTP / Identitas Perusahaan / Identitas Lainnya </b>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" style="width:100%;" id="srksps">
                        <thead class="bg-secondary text-white">
                            <tr>
                                <th class="text-center">No</th>
                                <th>Dokumen Yang Di Serahkan</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Fotocopy KTP / Identitas Perusahaan / Identitas Lainnya</td>
                                <td class="text-center">
                                    <a href="{{ asset('storage/surat/docs_ID/' . $file_ID->docs_ID) }}" target="__balnk" class="btn btn-info"><i class="fas fa-file"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card mb-3">
            <div class="card-header">
                <b>Surat Permohonan usulan penyerahan pengurusan piutang dari SKPD ke BPKD</b>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" style="width:100%;" id="bpkd">
                        <thead class="bg-secondary text-white">
                            <tr>
                                <th class="text-center">No</th>
                                <th>Dokumen Yang Di Serahkan</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Dokumen Surat ke BPKD dari SKPD</td>
                                <td class="text-center">
                                    <a href="{{asset('storage/surat/skdp/' . $data->docs_skdp)}}" target="__balnk" class="btn btn-info"><i class="fas fa-file"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card mb-3">
            <div class="card-header">
                <b>Dokumen SKRD/RUPS/Kepgu/STS/PKS/Surat Perjanjian/Surat Perikatan atau Dokumen yang Dipersamakan </b>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" style="width:100%;" id="skrd">
                        <thead class="bg-secondary text-white">
                            <tr>
                                <th class="text-center">No</th>
                                <th>Dokumen Yang Di Serahkan</th>
                                {{-- <th class="text-center">Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i=1;
                            @endphp
                            @forelse ($select_STS as $_item_sts)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$_item_sts}}</td>
                                    {{-- <td class="text-center">
                                        <a href="{{asset('storage/surat/STS/' . $data->docs_STS)}}" target="__balnk" class="btn btn-info"><i class="fas fa-file"></i></a>
                                    </td> --}}
                                </tr>
                            @empty
                                {{-- <tr>
                                    <td colspan="3" class="text-center">Belum Mengumpulkan Dokumen SKRD/RUPS/Kepgu/STS/PKS/Surat Perjanjian/Surat Perikatan atau Dokumen yang Dipersamakan</td>
                                </tr> --}}
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <hr/>
                <div>
                    <div class="card-header">
                        <b>Daftar Dokumen </b>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" style="width:100%;" id="skrd">
                        <thead class="bg-secondary text-white">
                            <tr>
                                <th class="text-left" style="width:10%;">No</th>
                                <th>Download</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i=1;
                            @endphp
                            @forelse ($data->doksts as $_item_file_sts)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td class="text-left">
                                        <a href="{{asset('storage/surat/STS/' .$_item_file_sts->docs_STS)}}" target="__balnk" class="btn btn-info"><i class="fas fa-download"></i> {{$_item_file_sts->docs_STS}}</a>
                                    </td>
                                </tr>
                            @empty
                                {{-- <tr>
                                    <td colspan="3" class="text-center">Belum Mengumpulkan Dokumen SKRD/RUPS/Kepgu/STS/PKS/Surat Perjanjian/Surat Perikatan atau Dokumen yang Dipersamakan</td>
                                </tr> --}}
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card mb-3">
            <div class="card-header">
                <b>Surat Tagihan / Dokumen yang dipersamakan</b>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" style="width:100%;" id="usulkan">
                        <thead class="bg-secondary text-white">
                            <tr>
                                <th class="text-left">Nomor Surat</th>
                                <th>Dokumen Yang Di Serahkan</th>
                                <th>Tanggal</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i=1;
                            @endphp
                            @foreach ($data->tagihan as $_item_surat_tagihan)
                                <tr>
                                    <td>{{$_item_surat_tagihan->nomor}}</td>
                                    <td>{{$_item_surat_tagihan->surattagihan->nama}}</td>
                                    <td>{{$_item_surat_tagihan->tgl}}</td>
                                    <td class="text-center">
                                        <a href="{{asset('storage/surat/tagihan/'.$_item_surat_tagihan->dokumen)}}" target="__balnk" class="btn btn-info"><i class="fas fa-file"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card mb-3">
            <div class="card-header">
                <b>Dokumen Kriteria lainnya dalam mengusulkan pengurusan penghapusan piutang daerah</b>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" style="width:100%;" id="usulkan2">
                        <thead class="bg-secondary text-white">
                            <tr>
                                <th class="text-center">No</th>
                                <th>Dokumen Yang Di Serahkan</th>
                                {{-- <th class="text-center">Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i=1;
                            @endphp
                            @forelse ($select_kriteria as $_item_kriteria)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$_item_kriteria}}</td>
                                    {{-- <td class="text-center">
                                        <a href="{{asset('storage/surat/STS/')}}" target="__balnk" class="btn btn-info"><i class="fas fa-file"></i></a>
                                    </td> --}}
                                </tr>
                            @empty
                                {{-- <tr>
                                    <td colspan="3" class="text-center">Belum Mengumpulkan Dokumen SKRD/RUPS/Kepgu/STS/PKS/Surat Perjanjian/Surat Perikatan atau Dokumen yang Dipersamakan</td>
                                </tr> --}}
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <hr/>
                <div>
                    <b>Daftar Dokumen </b>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" style="width:100%;" id="skrd">
                        <thead class="bg-secondary text-white">
                            <tr>
                                <th class="text-left" style="width:10%;">No</th>
                                <th>Download</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i=1;
                            @endphp
                            @foreach ($data->file_kriteria as $_item_file_kriteria)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td class="text-left">
                                        <a href="{{asset('storage/surat/kriteria_lainnya/'.$_item_file_kriteria->file)}}" target="__balnk" class="btn btn-info"><i class="fas fa-download"></i> {{$_item_file_kriteria->file}}</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card mb-3">
            <div class="card-header">
                <b>Dokumen Pendukung Lainnya</b>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" style="width:100%;" id="usulkan2">
                        <thead class="bg-secondary text-white">
                            <tr>
                                <th class="text-center">No</th>
                                <th>Dokumen Yang Di Serahkan</th>
                                {{-- <th class="text-center">Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i=1;
                            @endphp
                            @forelse ($select_DL as $_item_dl)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$_item_dl}}</td>
                                    {{-- <td class="text-center">
                                        <a href="{{asset('storage/surat/STS/')}}" target="__balnk" class="btn btn-info"><i class="fas fa-file"></i></a>
                                    </td> --}}
                                </tr>
                            @empty
                                {{-- <tr>
                                    <td colspan="3" class="text-center">Belum Mengumpulkan Dokumen SKRD/RUPS/Kepgu/STS/PKS/Surat Perjanjian/Surat Perikatan atau Dokumen yang Dipersamakan</td>
                                </tr> --}}
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <hr/>
                <div>
                    <b>Daftar Dokumen </b>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" style="width:100%;" id="skrd">
                        <thead class="bg-secondary text-white">
                            <tr>
                                <th class="text-left" style="width:10%;">No</th>
                                <th>Download</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i=1;
                            @endphp
                            @forelse ($data->file_DL as $_item_file_dl)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td class="text-left">
                                        <a href="{{asset('storage/surat/DL/' .$_item_file_dl->docs_DL)}}" target="__balnk" class="btn btn-info"><i class="fas fa-download"></i> {{$_item_file_dl->docs_DL}}</a>
                                    </td>
                                </tr>
                            @empty
                                {{-- <tr>
                                    <td colspan="3" class="text-center">Belum Mengumpulkan Dokumen SKRD/RUPS/Kepgu/STS/PKS/Surat Perjanjian/Surat Perikatan atau Dokumen yang Dipersamakan</td>
                                </tr> --}}
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="col-md-12" style="margin-bottom: 50px;">
        {{-- @if($data->status_ajuan == null)
        <button type="button" class="btn btn-danger" data-toggle="modal" onclick="btnAction('Tolak')">Tolak Ajuan</button>
        <button type="button" class="btn btn-primary" data-toggle="modal" onclick="btnAction('Setujui')">Setujui Ajuan</button>
        @endif --}}

        @if($data->status_ajuan == 'setuju')
        
        <div class="alert alert-success" role="alert">
          <h5 class="alert-heading">Surat usulan sudah anda setujui!</h5>
          <hr>
          <p class="mb-0">-</p>
        </div>
        <hr/>
        @endif

        @if($data->status_ajuan == 'tolak')
        <div class="alert alert-danger" role="alert">
          <h5 class="alert-heading">Surat usulan sudah anda tolak!</h5>
          <hr>
          <p class="mb-0">{{$data->ket_tolak}}</p>
        </div>
        <hr/>
        @endif

        
        <button type="button" class="btn btn-danger" data-toggle="modal" onclick="btnAction('Tolak')">Tolak Ajuan</button>
        <button type="button" class="btn btn-primary" data-toggle="modal" onclick="btnAction('Setujui')">Setujui Ajuan</button>
    </div>
    
    {{-- <div class="col-md-12">
        <div class="card mb-3">
            <div class="card-header">
                <b>Dokumen Kriteria lainnya</b>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover lainnya" style="width:100%;" id="lainnya">
                        <thead class="bg-secondary text-white">
                            <tr>
                                <th class="text-center" style="width:10%;">No</th>
                                <th>Dokumen Yang Di Serahkan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i=1;
                            @endphp
                            @foreach ($data->file_kriteria as $_item_file_kriteria)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td class="text-left">
                                        <a href="{{asset('storage/surat/kriteria_lainnya/'.$_item_file_kriteria->file)}}" target="__balnk" class="btn btn-info"><i class="fas fa-download"></i> {{$_item_file_kriteria->file}}</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> --}}
</div>


<div class="modal fade"  id="mdl-action" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="mdl-title">-</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <input type="hidden" name="stts_ajuan" id="stts_ajuan" />
       <div class="modal-body xd-none" id="mdl-body-setujui">
        <p>Anda yakin ?</p>
      </div>
      <div class="modal-body xd-none" id="mdl-body-tolak">
        <form>
          {{-- <div class="form-group">
            <label for="recipient-name" class="col-form-label">Recipient:</label>
            <input type="text" class="form-control" id="recipient-name">
          </div> --}}
          <div class="form-group">
            <label for="message-text" class="col-form-label">Keterangan Penolakan :</label>
            <textarea rows="3" class="form-control" id="alasan-tolak"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-submit-ajuan" id="btn-ajuan-batal" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary btn-submit-ajuan" id="btn-ajuan-setujui" onclick="submitAjuan()">Simpan</button>
      </div>
    </div>
  </div>
</div>

@endsection

@push('js')
<script>
    $(document).ready(function() {
        $('#srksps').DataTable();
        $('#bpkd').DataTable();
        $('#skrd').DataTable();
        $("#lainnya").DataTable();
        $('#usulkan').DataTable();
        $('#usulkan2').DataTable();
    });

    function btnAction(title){
        $('#mdl-action').modal('show');
        $('#mdl-title').text(title+' Ajuan');
        if(title === 'Setujui'){
            $('#mdl-body-setujui').removeClass('d-none');
            $('#mdl-body-tolak').addClass('d-none');
            $('#stts_ajuan').val('setuju');
        }else{
            $('#mdl-body-setujui').addClass('d-none');
            $('#mdl-body-tolak').removeClass('d-none');
            $('#stts_ajuan').val('tolak');
        }
    }

    function submitAjuan(){
        $('.btn-submit-ajuan').attr('disabled','disabled');
        $('#btn-ajuan-setujui').text('Mohon tunggu...');

         $.ajax( {
            method:'POST',
            header:{
              'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            url: `/admin/usulan/status-ajuan`,
            data:{
              _token: '{{ csrf_token() }}',
              id:'{{$data->id}}',
              stts_ajuan:$('#stts_ajuan').val(),
              ket:$('#alasan-tolak').val(),
              // dataType: 'json', 
              // contentType:'application/json', 
            }        
        })
        .done(function() {
            $('#mdl-action').modal('hide');
            location.reload();
        })
        .fail(function() {
            //alert('Proses GAGAL')
        })
        .always(function() {
            $('.btn-submit-ajuan').removeAttr('disabled','disabled');
            $('#btn-ajuan-setujui').text('Simpan');
            
        });

        // $.post(`/admin/usulan/status-ajuan`,{
        //     "_token": "{{ csrf_token() }}",
        //     "id":"{{$data->id}}"
        // },function(res){
        //     console.log(res)
        // });
        // $('.btn-submit-ajuan').removeAttr('disabled','disabled');
        // $('#btn-ajuan-setujui').text('Simpan');
    }
</script>
@endpush
