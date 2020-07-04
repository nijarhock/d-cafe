@extends('layout.header')

@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Isi Data Genre</h3>
            </div>
            <div class="card-body">
                <form id="formMovie">
                    <div class="form-group">
                        <label for="inputKode">Nama</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter nama">
                    </div>
                    <div class="form-group">
                        <label for="inputKode">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Enter Email">
                    </div>
                    <div class="form-group">
                        <label for="inputKode">Role</label>
                        <select class="form-control" name="role" id="role">
                            @if(Auth::user()->role == "admin")
                            <option value="admin">Admin</option>
                            <option value="kasir">Kasir</option>
                            <option value="waiter">Waiter</option>
                            @else
                            <option value="{{ Auth::user()->role }}">{{ Auth::user()->role }}</option>
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