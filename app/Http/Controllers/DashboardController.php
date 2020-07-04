<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pesanan;
use App\PesananDetail;
use App\Konsumen;

class DashboardController extends Controller
{
    public function index()
    {
        $pesanan_today = Pesanan::whereDate("created_at", date("Y-m-d"))->count();
        $omzet_today = Pesanan::whereDate("created_at", date("Y-m-d"))->sum('grand_total');
        $menu_today = PesananDetail::whereDate("created_at", date("Y-m-d"))->count();
        $konsumen_today = Konsumen::whereDate("created_at", date("Y-m-d"))->count();
        return view('dashboard.index', [
                                    "pesanan_today" => $pesanan_today,
                                    "menu_today" => $menu_today,
                                    "omzet_today" => $omzet_today,
                                    "konsumen_today" => $konsumen_today
                                    ]);
    }
}
