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
        $data = Item::with('pajak')->get();

        return response()->json([
            'status_code' => 200,
            'data' => $data,
        ], 200);
    }
}
