<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Item;
use App\Pajak;

class AllController extends Controller
{
    public function index()
    {
        $data = Item::with('pajak')->get()->map(function ($item) {
            $item->pajak->map(function ($pajak) { 
            $pajak->rate = ($pajak->rate /100*100)."%";
                return $pajak;
            });

            echo $item;
            // return $item;

            return response()->json([
                'status_code' => 200,
                'data' => $item,
            ], 200);
        });
    }
}
