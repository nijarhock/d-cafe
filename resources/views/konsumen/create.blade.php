@extends('layout.header')

@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Isi Data Konsumen</h3>
            </div>
            <div class="card-body">
                <form id="formMovie">
                    <div class="form-group">
                        <label for="inputKode">Kategori</label>
                        <select class="form-control" name="konsumen_kategori_id">
                            @foreach($kategori as $data)
                            <option value="{{ $data->id }}">{{ $data->nama }} | Diskon : {{ $data->diskon }}%</option>    
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputKode">Nama</label>
                        <input type="text" class="form-control" name="nama" placeholder="Enter nama">
                    </div>
                    <div class="form-group">
                        <label for="inputKode">Alamat</label>
                        <input type="text" class="form-control" name="alamat" placeholder="Enter Alamat">
                    </div>
                    <div class="form-group">
                        <label for="inputKode">Telepon</label>
                        <input type="text" class="form-control" name="telepon" placeholder="Enter Telepon">
                    </div>
                    <div class="form-group">
                        @csrf
                        <label for="inputKode"></label>
                        <button type="button" class="btn btn-success" id="btnSave">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@stop