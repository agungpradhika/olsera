<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pajak;
use App\Item;
use Illuminate\Support\Facades\Validator;

class PajaksController extends Controller
{
    public function create(Request $request)
    {
        //validate data
        $validator = Validator::make($request->all(), [
            'item_id'  => 'required', 
            'nama'     => 'required',
            'rate'     => 'required',
        ],
            [
                'item_id.required' => 'Masukkan Id item !',
                'nama.required' => 'Masukkan Nama Pajak !',
                'rate.required' => 'Masukkan Nilai Pajak !',
            ]
        );

        // jika form tidak di isi akan menampilkan false
        if($validator->fails()) {
            return response()->json([
                'status_code' => 401,
                'data' => $validator->errors(),
                'message' => 'Silahkan Isi Form Yang Kosong'
            ], 401);

        } else {

            $item_id = $request->input('item_id');
            $cekItem = Item::where('id', '=', $item_id)->get();

            if ($cekItem->isNotEmpty())
            {

                $pajak = Pajak::create([
                    'item_id'     => $request->input('item_id'),
                    'nama'        => $request->input('nama'),
                    'rate'        => $request->input('rate'),
                ]);

                $item = Item::find($request->input('item_id'));
                $data = $item->pajaks()->attach($pajak->id);
               
                // jika item terisi dan benar menampilkan true
                if ($item) {
                    return response()->json([
                        'status_code' => 200,
                        'data' => $pajak,
                        'message' => 'Pajak Berhasil Disimpan!'
                    ], 200);
                // jika error atau gagal tersimpan
                } else {
                    return response()->json([
                        'status_code' => 401,
                        'data' => $validator->errors(),
                        'message' => 'Pajak Gagal Disimpan!'
                    ], 401);
                }

            } else {
                return response()->json([
                    'status_code' => 401,
                    'message' => 'Item id yang dimasukan tidak tersedia!'
                ], 401);

            }
        }
    }

    public function update(Request $request)
    {
        //validate data
        $validator = Validator::make($request->all(), [
            'nama'     => 'required',
            'rate'     => 'required',
        ],
            [
                'nama.required' => 'Masukkan Nama Pajak !',
                'rate.required' => 'Masukkan Rate Pajak !',
            ]
        );

        if($validator->fails()) {

            return response()->json([
                'status_code' => 401,
                'data' => $validator->errors(),
                'message' => 'Silahkan Isi Form Yang Kosong'
            ], 401);

        } else {

            // $data = Pajak::whereId($request->input('id'))->update([
            //     'nama'     => $request->input('nama'),
            //     'rate'     => $request->input('rate'),
            // ]);
            $id = $request->input('id');
            $data = Pajak::find($id);
            

            if ($data) {
                return response()->json([
                    'status_code' => 200,
                    'message' => 'Pajak Berhasil Diupdate!'
                ], 200);
            } else {
                return response()->json([
                    'status_code' => 401,
                    'message' => 'Pajak Gagal Diupdate!'
                ], 401);
            }

        }
    }

    public function destroy($id)
    {
        $item = Item::with('pajaks')->first();
        $data = $item->pajaks()->detach($id);

        if ($data) {
            return response()->json([
                'status_code' => 200,
                'message' => 'Pajak Berhasil Dihapus!'
            ], 200);
        } else {
            return response()->json([
                'status_code' => 400,
                'message' => 'Pajak Gagal Dihapus!'
            ], 400);
        }

    }
}
