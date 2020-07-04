@extends('layout.header')

@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Data Kategori Konsumen</h3>
            </div>
            <div class="card-body">
                <table id="table-data" class="table table-bordered table-striped">
                    <thead> 
                        <tr>
                            <th>Kategori</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Telepon</th>
                            <th></th>
                        </tr>

                    </thead>
                    <tbody>
                        @foreach($konsumen as $data)
                        <tr>
                            <td>{{ $data->kategori->nama }}</td>
                            <td>{{ $data->nama }}</td>
                            <td>{{ $data->alamat }}</td>
                            <td>{{ $data->telepon }}</td>
                            <td>
                                <button type="button" class="btn btn-xl btn-info show" data-id="{{ $data->id }}"><i class="fa fa-search"></i></button>
                                <button type="button" class="btn btn-xl btn-warning edit" data-id="{{ $data->id }}"><i class="fas fa-edit"></i></button>
                                <button type="button" class="btn btn-xl btn-danger hapus" data-id="{{ $data->id }}"><i class="fa fa-trash"></i></button>
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
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail Jenis Bayar</h5>
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

<!-- Modal -->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Jenis Bayar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form id="formMovie">
            <div class="modal-body">
              <div class="form-group">
                  <label for="inputKode">Kategori</label>
                  <select class="form-control" name="konsumen_kategori_id" id="konsumen_kategori_id">
                      @foreach($kategori as $data)
                      <option value="{{ $data->id }}">{{ $data->nama }} | Diskon : {{ $data->diskon }}%</option>    
                      @endforeach
                  </select>
              </div>
              <div class="form-group">
                    <label for="inputKode">Nama</label>
                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Enter Nama">
                </div>
                <div class="form-group">
                    <label for="inputKode">Alamat</label>
                    <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Enter Alamat">
                </div>
                <div class="form-group">
                    <label for="inputKode">Telepon</label>
                    <input type="text" class="form-control" name="telepon" id="telepon" placeholder="Enter Alamat">
                </div>
            </div>
            <div class="modal-footer">
                @csrf
                <input type="hidden" id="id" name="id">
                <button type="button" id="btnEdit" class="btn btn-success">Edit</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
  </div>
</div>
@stop