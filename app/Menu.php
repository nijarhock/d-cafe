<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = "menu";

    public function kategori()
    {
        return $this->belongsTo('App\MenuKategori', 'menu_kategori_id', 'id');
    }

    public function gambar()
    {
        return $this->hasOne('App\MenuGambar', 'menu_id');
    }
}
