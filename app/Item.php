<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'item';

    protected $guarded = [];

    protected $visible = ['id', 'nama', 'pajak'];

    public function pajak()
    {
        return $this->hasMany('App\Pajak');
    }
}
