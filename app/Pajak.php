<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pajak extends Model
{
    protected $table = 'pajak';

    protected $guarded = ['id'];

    protected $visible = ['id', 'nama', 'rate'];

    public function item()
    {
        return $this->belongsToMany('App\Item', 'item_pajak')->withTimestamps();
    }
}
