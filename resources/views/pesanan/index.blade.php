@extends('layout.header')

@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Isi Data</h3>
                    </div>
                    <div class="card-body">
                        <div id="detail"></div>
                        <form id="formMovie">
                            <div class="form-group">
                                <label for="inputKode">Kode Pesanan</label>
                                <input type="text" class="form-control" name="kode" id="kode" placeholder="Enter Kode" value="{{ $kode }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="inputKode">Konsumen</label>
                                <select class="form-control" name="konsumen_id" id="konsumen_id">
                                    <option value="">--- Pilih Konsumen ---</option>
                                    @foreach($konsumen as $data)
                                        <option value="{{ $data->id }}" data-diskon="{{ $data->kategori->diskon }}">{{ $data->nama }} - {{ $data->alamat }} - {{ $data->telepon }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputKode">Meja</label>
                                <select class="form-control" name="meja_id" id="meja_id">
                                    @foreach($meja as $data)
                                        <option value="{{ $data->id }}">{{ $data->nama }} | kapasitas : {{ $data->kapasitas }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputKode">Diskon (%)</label>
                                <input type="text" class="form-control" name="diskon" id="diskon" placeholder="Enter Diskon">
                            </div>
                            <div class="form-group">
                                <label for="inputKode">PPN (%)</label>
                                <input type="text" class="form-control" name="ppn" id="ppn" placeholder="Enter PPN">
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
            <div class="col-md-7">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Pilih Menu</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-barcode"></i></span>
                                </div>
                                <input type="text" class="form-control" id="menu_id" placeholder="Input Kode Menu">
                                
                            </div><p class="text-grey">Tekan Enter Untuk Insert Data</p>
                            <!-- /.input group -->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <div class="card card-primary card-tabs">
                            <div class="card-header p-0 pt-1">
                                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                    @foreach($kategori as $key => $data)
                                    <li class="nav-item">
                                        <a class="nav-link @if($key == 0) active @endif" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-{{ $data->id }}" role="tab" aria-controls="custom-tabs-one-{{ $data->id }}" aria-selected="true">{{ $data->nama }}</a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-one-tabContent">
                                    @foreach($kategori as $key => $data)
                                    <div class="tab-pane fade @if($key == 0) show active @endif" id="custom-tabs-one-{{ $data->id }}" role="tabpanel" aria-labelledby="custom-tabs-one-{{ $data->id }}-tab">
                                        <ul class="mailbox-attachments d-flex align-items-stretch clearfix">
                                            @foreach($data->menu as $menu)
                                            @if($menu->status == "ready")
                                            <li>
                                                <span class="mailbox-attachment-icon has-img"><img width="198" height="148" src="{{ $menu->gambar->url }}" alt="{{ $menu->gambar->nama }}"></span>

                                                <div class="mailbox-attachment-info">
                                                    <a href="#" class="mailbox-attachment-name"> {{ $menu->nama }}</a>
                                                        <span class="mailbox-attachment-size clearfix mt-1">
                                                        <span>Rp. {{ number_format($menu->harga) }}</span>
                                                        <a href="#" class="btn btn-default btn-sm float-right add-menu" data-id="{{ $menu->id }}"><i class="fas fa-shopping-cart"></i></a>
                                                        </span>
                                                </div>
                                            </li>
                                            @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop