@extends('layout.header')

@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Data Pesanan Proses </h3>
            </div>
            <div class="card-body">
                <table id="table-data" class="table table-bordered table-striped">
                    <thead> 
                        <tr>
                            <th>Kode</th>
                            <th>Konsumen</th>
                            <th>Waiter</th>
                            <th>Meja</th>
                            <th>Grand Total</th>
                            <th></th>
                        </tr>

                    </thead>
                    <tbody>
                        @foreach($pesanan as $data)
                        <tr>
                            <td>{{ $data->kode }}</td>
                            <td>{{ $data->konsumen->nama }}</td>
                            <td>{{ $data->user->name }}</td>
                            <td>{{ $data->meja->nama }}</td>
                            <td>{{ number_format($data->grand_total) }}</td>
                            <td>
                                <button type="button" class="btn btn-xl btn-info show" data-id="{{ $data->id }}"><i class="fa fa-search"></i></button>
                                <button type="button" class="btn btn-xl btn-danger batal" data-id="{{ $data->id }}">Batal</i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail Pesanan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <table id="table-detail" class="table table-bordered table-striped"> 
                
            </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@stop