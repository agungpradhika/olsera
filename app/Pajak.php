<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pajak extends Model
{
    protected $table = 'pajak';

    protected $guarded = [];

    protected $visible = ['id', 'nama', 'rate'];

    public function item()
    {
        return $this->belongsTo('App\Item');
    }
}
