<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\Konsumen;
use App\KonsumenKategori;
use App\Logs;
use App\Pesanan;

class KonsumenController extends Controller
{
    public function index()
    {
        $konsumen = Konsumen::all();
        $kategori = KonsumenKategori::all();
        return view('konsumen.index', ['jquery' => "konsumen.jquery", "konsumen" => $konsumen, "kategori" => $kategori]);
    }

    public function create()
    {
        $kategori = KonsumenKategori::all();
        return view('konsumen.create', ["jquery" => "konsumen.jquery", "kategori" => $kategori]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'telepon' => 'required|string|max:255|unique:konsumen',
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(), 400);
        }

        $konsumen = new Konsumen;
        $konsumen->konsumen_kategori_id = $request->konsumen_kategori_id;
        $konsumen->nama = $request->nama;
        $konsumen->alamat = $request->alamat;
        $konsumen->telepon = $request->telepon;
        $konsumen->save();

        $logs = new Logs;
        $logs->user_id = Auth::id();
        $logs->desc = "User ".Auth::user()->name." Tambah Konsumen ".$request->nama." | ".$request->alamat." | ".$request->telepon;
        $logs->save();

        return response()->json("OK", 200);
    }

    public function show(Request $request)
    {
        $konsumen = Konsumen::find($request->id);
        $konsumen->kategori_name = $konsumen->kategori->nama;
        return response()->json($konsumen);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'telepon' => 'required|string|max:255',
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(), 400);
        }

        $konsumen = Konsumen::find($request->id);
        $konsumen->konsumen_kategori_id = $request->konsumen_kategori_id;
        $konsumen->nama = $request->nama;
        $konsumen->alamat = $request->alamat;
        $konsumen->telepon = $request->telepon;
        $konsumen->save();

        $logs = new Logs;
        $logs->user_id = Auth::id();
        $logs->desc = "User ".Auth::user()->name." Ubah Konsumen $request->id | ".$request->nama." | ".$request->alamat." | ".$request->telepon;
        $logs->save();

        return response()->json("OK", 200);
    }

    public function destroy(Request $request)
    {
        $count = Pesanan::where("konsumen_id", $request->id)->count();
        if($count > 0)
        {
            return response()->json("Konsumen Sudah Digunakan Tidak Bisa Hapus", 200);
        }

        $konsumen = Konsumen::find($request->id);
        $logs = new Logs;
        $logs->user_id = Auth::id();
        $logs->desc = "User ".Auth::user()->name." Ubah Konsumen $request->id | ".$konsumen->nama." | ".$konsumen->alamat." | ".$konsumen->telepon;
        $logs->save();
        $konsumen->delete();

        return response()->json("OK", 200);
    }
}
