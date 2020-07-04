@extends('layout.header')

@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Isi Data Menu</h3>
            </div>
            <div class="card-body">
                <form id="formMovie" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputFile">Gambar</label>
                        
                        <div class='preview'>
                            <img id="img" width="100" height="100">
                        </div>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="file" name="file">
                                <label class="custom-file-label" for="file">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputKode">Kategori</label>
                        <select class="form-control" name="menu_kategori_id">
                            @foreach($kategori as $data)
                            <option value="{{ $data->id }}">{{ $data->nama }}</option>    
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputKode">Kode</label>
                        <input type="text" class="form-control" name="kode" placeholder="Enter Kode">
                    </div>
                    <div class="form-group">
                        <label for="inputKode">Nama</label>
                        <input type="text" class="form-control" name="nama" placeholder="Enter nama">
                    </div>
                    <div class="form-group">
                        <label for="inputKode">Keterangan</label>
                        <textarea class="form-control" name="ket" placeholder="Enter Keterangan"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="inputKode">Stok Minimal</label>
                        <input type="text" class="form-control" name="stok_min" placeholder="Enter Stok Minimal">
                        <p class="text-grey">Stok Minimal Untuk Muncul di Notifikasi Stok Yang Akan Habis</p>
                    </div>
                    <div class="form-group">
                        <label for="inputKode">Stok</label>
                        <input type="text" class="form-control" name="stok" placeholder="Enter Stok">
                    </div>
                    <div class="form-group">
                        <label for="inputKode">Harga</label>
                        <input type="text" class="form-control" name="harga" placeholder="Enter Harga">
                    </div>
                    <div class="form-group">
                        <label for="inputKode">Status</label>
                        <select class="form-control" name="status">
                            <option value="ready">Ready</option>
                            <option value="belum">Belum</option>
                        </select>
                    </div>
                    <div class="form-group">
                        @csrf
                        <label for="inputKode"></label>
                        <button type="submit" class="btn btn-success" id="btnSave">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@stop