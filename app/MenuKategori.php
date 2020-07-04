<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuKategori extends Model
{
    protected $table = "menu_kategori";

    public function menu()
    {
        return $this->hasMany('App\Menu', 'menu_kategori_id', 'id');
    }
}
