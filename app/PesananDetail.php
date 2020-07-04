<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PesananDetail extends Model
{
    protected $table = 'pesanan_detail';

    public function menu()
    {
        return $this->belongsTo('App\Menu', 'menu_id', 'id');
    }

    public function pesanan()
    {
        return $this->belongsTo('App\Pesanan', 'pesanan_id');
    }
}
