@extends('layout.header')

@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Isi Data Kategori</h3>
            </div>
            <div class="card-body">
                <form id="formMovie">
                    <div class="form-group">
                        <label for="inputKode">Nama</label>
                        <input type="text" class="form-control" name="nama" placeholder="Enter nama">
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