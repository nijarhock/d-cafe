@extends('layout.header')

@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Data Menu</h3>
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
                            <th></th>
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
        <h5 class="modal-title" id="exampleModalLabel">Detail Menu</h5>
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
        <h5 class="modal-title" id="exampleModalLabel">Edit Menu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form id="formMenu" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="form-group">
                  <label for="exampleInputFile">Gambar</label>
                  
                  <div class='preview'>

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
                <select class="form-control" name="menu_kategori_id" id="menu_kategori_id">
                    @foreach($kategori as $data)
                    <option value="{{ $data->id }}">{{ $data->nama }}</option>    
                    @endforeach
                </select>
              </div>
              <div class="form-group">
                  <label for="inputKode">Kode</label>
                  <input type="text" class="form-control" name="kode" id="kode" placeholder="Enter Kode" readonly>
              </div>
              <div class="form-group">
                  <label for="inputKode">Nama</label>
                  <input type="text" class="form-control" name="nama" id="nama" placeholder="Enter nama">
              </div>
              <div class="form-group">
                  <label for="inputKode">Keterangan</label>
                  <textarea class="form-control" name="ket" id="ket" placeholder="Enter Keterangan"></textarea>
              </div>
              <div class="form-group">
                  <label for="inputKode">Stok Minimal</label>
                  <input type="text" class="form-control" name="stok_min" id="stok_min" placeholder="Enter Stok Minimal">
                  <p class="text-grey">Stok Minimal Untuk Muncul di Notifikasi Stok Yang Akan Habis</p>
              </div>
              <div class="form-group">
                  <label for="inputKode">Stok</label>
                  <input type="text" class="form-control" name="stok" id="stok" placeholder="Enter Stok">
              </div>
              <div class="form-group">
                  <label for="inputKode">Harga</label>
                  <input type="text" class="form-control" name="harga" id="harga" placeholder="Enter Harga">
              </div>
              <div class="form-group">
                  <label for="inputKode">Status</label>
                  <select class="form-control" name="status" id="status">
                      <option value="ready">Ready</option>
                      <option value="belum">Belum</option>
                  </select>
              </div>
            </div>
            <div class="modal-footer">
                @csrf
                <input type="hidden" id="id" name="id">
                <button type="submit" id="btnEdit" class="btn btn-success">Edit</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
  </div>
</div>
@stop