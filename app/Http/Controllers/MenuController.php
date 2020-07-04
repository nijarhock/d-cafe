<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use File;
use App\Menu;
use App\MenuKategori;
use App\MenuGambar;
use App\Logs;
use App\PesananDetail;

class MenuController extends Controller
{
    public function index()
    {
        $menu = Menu::all();
        $kategori = MenuKategori::all();
        return view('menu.index', ['jquery' => "menu.jquery", "menu" => $menu, "kategori" => $kategori]);
    }

    public function create()
    {
        $kategori = MenuKategori::all();
        return view('menu.create', ["jquery" => "menu.jquery", "kategori" => $kategori]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'kode' => 'required|string|max:255|unique:menu',
            'ket' => 'string|max:255',
            'stok_min' => 'integer|min:0',
            'stok' => 'integer|min:0',
            'harga' => 'integer|min:0',
            'status' => 'string|max:255',
            'file' => 'required|file|mimes:png,jpg,gif,jpeg|max:2048'
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(), 400);
        }

        $menu = new Menu;
        $menu->menu_kategori_id = $request->menu_kategori_id;
        $menu->nama = $request->nama;
        $menu->kode = $request->kode;
        $menu->ket = $request->ket;
        $menu->stok_min = $request->stok_min;
        $menu->stok = $request->stok;
        $menu->harga = $request->harga;
        $menu->status = $request->status;
        $menu->save();
        $id = $menu->id;

        $logs = new Logs;
        $logs->user_id = Auth::id();
        $logs->desc = "User ".Auth::user()->name." Tambah Menu $request->nama | $request->kode | $request->ket | $request->stok_min | $request->stok | $request->harga | $request->status";
        $logs->save();

        if($files = $request->file('file'))
        {
            $destinationPath = 'images/menu/'.$id; // upload path
            if(!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $files->move($destinationPath, $files->getClientOriginalName());
        
            $gambar = new MenuGambar;
            $gambar->menu_id = $id;
            $gambar->nama = $files->getClientOriginalName();
            $gambar->url = url('/')."/".$destinationPath."/".$files->getClientOriginalName();
            $gambar->save();
        }

        return response()->json("OK", 200);
    }

    public function show(Request $request)
    {
        $menu = Menu::find($request->id);
        $menu->harga_format = number_format($menu->harga);
        $menu->nama_kategori = $menu->kategori->nama;
        $menu->url_gambar = $menu->gambar->url;

        return response()->json($menu);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'kode' => 'required|string|max:255',
            'ket' => 'string|max:255',
            'stok_min' => 'integer|min:0',
            'stok' => 'integer|min:0',
            'harga' => 'integer|min:0',
            'status' => 'string|max:255',
            'file' => 'file|mimes:png,jpg,gif,jpeg|max:2048'
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(), 400);
        }

        $menu = Menu::find($request->id);
        $menu->menu_kategori_id = $request->menu_kategori_id;
        $menu->nama = $request->nama;
        $menu->kode = $request->kode;
        $menu->ket = $request->ket;
        $menu->stok_min = $request->stok_min;
        $menu->stok = $request->stok;
        $menu->harga = $request->harga;
        $menu->status = $request->status;
        $menu->save();
        $id = $request->id;

        $logs = new Logs;
        $logs->user_id = Auth::id();
        $logs->desc = "User ".Auth::user()->name." Ubah Menu $request->id | $request->nama | $request->kode | $request->ket | $request->stok_min | $request->stok | $request->harga | $request->status";
        $logs->save();

        if($files = $request->file('file'))
        {
            // delete old picture
            File::delete('images/menu/'.$id."/".$menu->gambar->nama);

            $destinationPath = 'images/menu/'.$id; // upload path
            if(!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $files->move($destinationPath, $files->getClientOriginalName());
        
            $gambar = MenuGambar::find($menu->gambar->id);
            $gambar->menu_id = $id;
            $gambar->nama = $files->getClientOriginalName();
            $gambar->url = url('/')."/".$destinationPath."/".$files->getClientOriginalName();
            $gambar->save();
        }

        return response()->json("OK", 200);
    }

    public function destroy(Request $request)
    {
        $count = PesananDetail::where("menu_id", $request->id)->count();
        if($count > 0)
        {
            return response()->json("Menu Sudah Digunakan Tidak Bisa Hapus", 200);
        }

        $menu = Menu::find($request->id);
        $logs = new Logs;
        $logs->user_id = Auth::id();
        $logs->desc = "User ".Auth::user()->name." Hapus Menu $request->id | $menu->nama | $menu->kode | $menu->ket | $menu->stok_min | $menu->stok | $menu->harga | $menu->status";
        $logs->save();
        $gambar = MenuGambar::find($menu->gambar->id);
        $gambar->delete();
        // delete old picture
        File::delete('images/menu/'.$request->id."/".$menu->gambar->nama);

        $menu->delete();

        return response()->json("OK", 200);
    }

    public function cari(Request $request)
    {
        $menu = Menu::where('status', 'ready')
                    ->where(function ($query) use ($request) {
                        $query->where("kode", "like", "%".$request->term."%")
                              ->orWhere("nama", "like", "%".$request->term."%")
                              ->orWhere("ket", "like", "%".$request->term."%");
                    })
                    ->get();
        $arr = array();
        foreach($menu as $data)
        {
            $arr[] = array(
                "label"     => $data->id,
                "kode"      => $data->kode,
                "nama"      => $data->nama,
                "ket"       => $data->ket,
                "url_gambar"=> $data->gambar->url
            );
        }

        return response()->json($arr, 200);
    }

    public function listMenu()
    {
        $menu = Menu::where("status", "ready")->get();

        return response()->json(compact('menu'));
    }
}
