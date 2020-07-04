<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\Meja;
use App\Logs;
use App\Pesanan;

class MejaController extends Controller
{
    public function index()
    {
        $meja = Meja::all();
        return view('meja.index', ['jquery' => "meja.jquery", "meja" => $meja]);
    }

    public function create()
    {
        return view('meja.create', ["jquery" => "meja.jquery"]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255|unique:meja',
            'kapasitas' => 'required|integer'
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(), 400);
        }

        $meja = new Meja;
        $meja->nama = $request->nama;
        $meja->kapasitas = $request->kapasitas;
        $meja->status = 'kosong';
        $meja->save();

        $logs = new Logs;
        $logs->user_id = Auth::id();
        $logs->desc = "User ".Auth::user()->name." Tambah Meja ".$request->nama." | ".$request->kapasitas;
        $logs->save();

        return response()->json("OK", 200);
    }

    public function show(Request $request)
    {
        $meja = Meja::find($request->id);

        return response()->json($meja);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'kapasitas' => 'required|integer'
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(), 400);
        }

        $meja = Meja::find($request->id);
        $meja->nama = $request->nama;
        $meja->kapasitas = $request->kapasitas;
        $meja->save();

        $logs = new Logs;
        $logs->user_id = Auth::id();
        $logs->desc = "User ".Auth::user()->name." Ubah Meja $request->id | ".$request->nama." | ".$request->kapasitas;
        $logs->save();

        return response()->json("OK", 200);
    }

    public function destroy(Request $request)
    {
        $count = Pesanan::where("meja_id", $request->id)->count();
        if($count > 0)
        {
            return response()->json("Meja Sudah Digunakan Tidak Bisa Hapus", 200);
        }

        $meja = Meja::find($request->id);
        $logs = new Logs;
        $logs->user_id = Auth::id();
        $logs->desc = "User ".Auth::user()->name." Hapus Meja $request->id | ".$meja->nama." | ".$meja->kapasitas;
        $logs->save();
        $meja->delete();

        return response()->json("OK", 200);
    }
}
