@extends('layouts.app')

@section('title') Dokumen yang diserahkan {{Auth::user()->name}}  @endsection

@push('css')

@endpush

@section('content')
<div class="card mb-3">
    <div class="card-header">
        <b>Fotocopy KTP/Identitas Perusahaan/Identitas Lainnya</b>
    </div>
    <div class="card-body">
        <form action="{{url('/nasabah/surat-usulan/step5')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ app('request')->input('id') }}" />
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Nama Penanggung Utang</label>
                        <input type="text" value="{{$data->nama_peminjam}}" class="form-control @error('nama_peminjam') is-invalid @enderror" name="nama_peminjam">
                        @error('nama_peminjam')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Jenis Piutang</label>
                        <select name="id_jenis" class="form-control @error('id_jenis') is-invalid @enderror">
                            <option value=""></option>
                            @foreach ($jenis as $item)
                            <option value="{{$item->id}}">{{$item->jenis}}</option>
                            @endforeach
                        </select>
                        @error('id_jenis')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="">Nomor Identitas</label>
                <input type="number" name="no_identitas" class="form-control @error('no_identitas') is-invalid @enderror">
                @error('no_identitas')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for=""></label>
                <br>
                {{-- <button type="button" class="btn btn-success btn-sm plus"><i class="fas fa-plus"></i></button> --}}
                <table style="width: 100%;" id="table">
                    <tr>
                        <th>
                            <input type="file" name="docs_ID[]" accept="application/pdf" multiple class="form-control @error('docs_ID') is-invalid @enderror my-2" style="width: 100%;">
                            @error('docs_ID')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </th>
                    </tr>
                </table>
            </div>
            <div class="my-3">
                <a href="{{url('/nasabah/surat-usulan/step4=')}}{{ app('request')->input('id') }}" type="submit" id="back" class="btn btn-secondary float-start"><i class="fas fa-arrow-left"></i> Back</a>
                <button type="submit" class="btn btn-primary float-right">Simpan <i class="fas fa-check"></i></button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            let baris = 1;
            $(document).on('click', '.plus', function(e) {
                e.preventDefault();
                baris = baris + 1;
                let html = '<tr id="baris' + baris + '">';
                html += `<th>
                                <button type="button" data-row="baris` + baris + `" class="btn btn-danger btn-sm minus"><i class="fas fa-minus"></i></button>
                                <input type="file" name="docs_ID[]" multiple class="form-control @error('docs_ST') is-invalid @enderror my-2" style="width: 100%;">
                            </th>`;
                html += '</tr>';
                $('#table').append(html);
            });

            $(document).on('click', '.minus', function(e) {
                let rows = $(this).data('row');
                $('#' + rows).remove();
            });
        });
    </script>
@endpush
