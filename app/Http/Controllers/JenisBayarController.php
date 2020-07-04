<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\JenisBayar;
use App\Pembayaran;
use App\Logs;

class JenisBayarController extends Controller
{
    public function index()
    {
        $jenis_byr = JenisBayar::all();
        return view('jenis_byr.index', ['jquery' => "jenis_byr.jquery", "jenis_byr" => $jenis_byr]);
    }

    public function create()
    {
        return view('jenis_byr.create', ["jquery" => "jenis_byr.jquery"]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255|unique:jenis_byr'
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(), 400);
        }

        $jenis_byr = new JenisBayar;
        $jenis_byr->nama = $request->nama;
        $jenis_byr->save();

        $logs = new Logs;
        $logs->user_id = Auth::id();
        $logs->desc = "User ".Auth::user()->name." Tambah Jenis Bayar ".$request->get('name');
        $logs->save();

        return response()->json("OK", 200);
    }

    public function show(Request $request)
    {
        $jenis_byr = JenisBayar::find($request->id);

        return response()->json($jenis_byr);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255'
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(), 400);
        }

        $jenis_byr = JenisBayar::find($request->id);
        $jenis_byr->nama = $request->nama;
        $jenis_byr->save();

        $logs = new Logs;
        $logs->user_id = Auth::id();
        $logs->desc = "User ".Auth::user()->name." Ubah Jenis Bayar ".$request->id." | ".$request->get('name');
        $logs->save();

        return response()->json("OK", 200);
    }

    public function destroy(Request $request)
    {
        $count = Pembayaran::where("jenis_byr_id", $request->id)->count();
        if($count > 0)
        {
            return response()->json("Pembayaran Sudah Digunakan Tidak Bisa Hapus", 200);
        }
        $jenis_byr = JenisBayar::find($request->id);
        $logs = new Logs;
        $logs->user_id = Auth::id();
        $logs->desc = "User ".Auth::user()->name." Hapus Jenis Bayar ".$request->id." | ".$jenis_byr->name;
        $logs->save();
        $jenis_byr->delete();

        return response()->json("OK", 200);
    }
}
