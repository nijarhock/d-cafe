@extends('layout.header')

@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Data Genre</h3>
            </div>
            <div class="card-body">
                <table id="table-data" class="table table-bordered table-striped">
                    <thead> 
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th></th>
                        </tr>

                    </thead>
                    <tbody>
                        @foreach($user as $data)
                        <tr>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->email }}</td>
                            <td>{{ $data->role }}</td>
                            <td>
                                <button type="button" class="btn btn-xl btn-info show" data-id="{{ $data->id }}"><i class="fa fa-search"></i></button>
                                <button type="button" class="btn btn-xl btn-warning edit" data-id="{{ $data->id }}"><i class="fas fa-edit"></i></button>
                                @if(Auth::user()->role == "admin")
                                <button type="button" class="btn btn-xl btn-danger hapus" data-id="{{ $data->id }}"><i class="fa fa-trash"></i></button>
                                @endif
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
        <h5 class="modal-title" id="exampleModalLabel">Detail User</h5>
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
        <h5 class="modal-title" id="exampleModalLabel">Edit Users</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form id="formMovie">
            <div class="modal-body">
                <div class="form-group">
                    <label for="inputKode">Nama</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter nama">
                </div>
                <div class="form-group">
                    <label for="inputKode">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email">
                </div>
                <div class="form-group">
                    <label for="inputKode">Role</label>
                    <select class="form-control" name="role" id="role">
                        @if(Auth::user()->role == "admin")
                        <option value="admin">Admin</option>
                        <option value="kasir">Kasir</option>
                        <option value="waiter">Waiter</option>
                        @else
                        <option value="{{ Auth::user()->role }}">{{ ucfirst(Auth::user()->role) }}</option>
                        @endif
                    </select>
                </div>
                <div class="form-group">
                    <label for="inputKode">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Enter Password">
                </div>
                <div class="form-group">
                    <label for="inputKode">Password Confirmation</label>
                    <input type="password" class="form-control" name="password_confirmation" placeholder="Enter Password Confirmation">
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