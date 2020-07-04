@extends('layout.header')

@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Laporan Stok Minimum</h3>
            </div>
            <div class="card-body">
            <table id="table-data" class="table table-bordered table-striped">
                    <thead> 
                        <tr>
                            <th>Kategori</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Keterangan</th>
                            <th>Stok Minimal</th>
                            <th>Stok</th>
                            <th>Harga</th>
                            <th>Status</th>
                        </tr>

                    </thead>
                    <tbody>
                        @foreach($menu as $data)
                        <tr>
                            <td>{{ $data->kategori->nama }}</td>
                            <td>{{ $data->kode }}</td>
                            <td>{{ $data->nama }}</td>
                            <td>{{ $data->ket }}</td>
                            <td>{{ $data->stok_min }}</td>
                            <td>{{ $data->stok }}</td>
                            <td>{{ number_format($data->harga) }}</td>
                            <td><small class="badge badge-success">{{ $data->status }}</small></td>
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@stop