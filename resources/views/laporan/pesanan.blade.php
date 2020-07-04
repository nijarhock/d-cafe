@extends('layout.header')

@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Laporan Pesanan / Tanggal</h3>
            </div>
            <div class="card-body">
                <form id="formLaporan">
                    <div class="form-group">
                        <label for="inputKode">Dari</label>
                        <!-- <input type="text" class="form-control tgl" name="dari" id="dari" placeholder="Enter Dari"> -->
                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" name="dari" id="dari" data-target="#reservationdate"/>
                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>  
                    </div>
                    <div class="form-group">
                        <label for="inputKode">Sampai</label>
                        <!-- <input type="text" class="form-control tgl" name="nama" id="sampai" placeholder="Enter Sampai"> -->
                        <div class="input-group date" id="reservationdate1" data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input" name="sampai" id="sampai" data-target="#reservationdate1"/>
                            <div class="input-group-append" data-target="#reservationdate1" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        @csrf
                        <label for="inputKode"></label>
                        <button type="button" class="btn btn-success" id="btnCariPesanan">Cari</button>
                    </div>
                </form>

                <div id="detail"></div>
            </div>
        </div>
    </div>
</section>
@stop