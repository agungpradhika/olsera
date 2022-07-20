<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'item';

    protected $guarded = ['id'];

    protected $visible = ['id', 'nama', 'pajak'];

    public function pajak()
    {
       return $this->belongsToMany('App\Pajak', "item_pajak")->withTimestamps();
    }
}
