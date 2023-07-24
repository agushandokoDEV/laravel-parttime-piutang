@extends('layouts.app')
 
@section('title') Surat Permohonan @endsection

@push('css')
    
@endpush

@section('content')
    <div class="card mb-3">
        <div class="card-header">
            <b>Dokumen Yang Harus Di Serahkan</b>
        </div>
        <div class="card-body">
            <form action="{{url('/admin/usulan/'.$data->id.'/save_update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Nama</label>
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
                                <option value="{{$data->id_jenis}}">{{$data->jenisPiutang->jenis}}</option>
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
                    <label for="">Fotocopy KTP/Identitas Perusahaan/Identitas Lainnya</label>
                    <input type="file" name="docs_ID" class="form-control @error('docs_ID') is-invalid @enderror">
                    @error('docs_ID')
                     <div class="invalid-feedback">
                        {{$message}}
                     </div>
                    @enderror
                </div>
                <div class="my-3">
                    <button type="submit" class="btn btn-primary float-right">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
