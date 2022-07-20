<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Item;
use App\Pajak;
use App\Item_pajak;
use DB;

class AllController extends Controller
{
    public function index()
    {
        $data = Item::with('pajak')->get()->map(function ($item) {
            $item->pajak->map(function ($pajak) { 
            $pajak->rate = ($pajak->rate /100*100)."%";
                return $pajak;
            });

            return $item;
        });

        return response()->json([
            'status_code' => 200,
            'data' => $data,
        ], 200);

        // $list = DB::table('item')

        //           ->select("item.id", "item.nama" ,DB::raw("(GROUP_CONCAT(Item_pajak.pajak_id SEPARATOR ', ')) as pajak_id"))

        //           ->leftjoin("dynamic_forms_mapping", "dynamic_forms_mapping.form_id","=","dynamic_forms.id")

        //           ->leftjoin("categories", "dynamic_forms_mapping.category_id","=","categories.id")

        //           ->groupBy('dynamic_forms.id')

        //           ->get();
        // $data = DB::table('item')->with('pajaks')->get();
        // die($data);
    }
}
