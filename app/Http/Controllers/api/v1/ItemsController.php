<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Item;
use App\Pajak;
use Illuminate\Support\Facades\Validator;

class ItemsController extends Controller
{
    public function create(Request $request)
    {
        //validate data
        $validator = Validator::make($request->all(), [
            'nama'     => 'required',
        ],
            [
                'nama.required' => 'Masukkan Nama Item !',
            ]
        );
        // jika form nama tidak di isi akan menampilkan false
        if($validator->fails()) {
            return response()->json([
                'status_code' => 401,
                'data' => $validator->errors(),
                'message' => 'Silahkan Isi Form Yang Kosong'
            ], 401);

        } else {

            $nama = $request->input('nama');
            $item = Item::where('nama', '=', $nama)->get();

            if ($item->isNotEmpty())
            { 
                return response()->json([
                    'status_code' => 409,
                    'message' => 'Data yang dimasukan sudah ada!'
                ], 409);
            } else {
                $data = Item::create([
                    'nama'     => $nama,
                ]);

                // jika item terisi dan benar menampilkan true
                if ($data) {
                    return response()->json([
                        'status_code' => 200,
                        'data' => $data,
                        'message' => 'Item Berhasil Disimpan!'
                    ], 200);
                // jika error atau gagal tersimpan
                } else {
                    return response()->json([
                        'status_code' => 401,
                        'data' => $validator->errors(),
                        'message' => 'Silahkan Isi Form Yang Kosong'
                    ], 401);
                }
            }
        }
    }


    public function update(Request $request)
    {
        //validate data
        $validator = Validator::make($request->all(), [
            'nama'     => 'required',
        ],
            [
                'nama.required' => 'Masukkan Nama Item !',
            ]
        );

        if($validator->fails()) {

            return response()->json([
                'status_code' => 401,
                'data' => $validator->errors(),
                'message' => 'Silahkan Isi Form Yang Kosong'
            ], 401);

        } else {

            $data = Item::whereId($request->input('id'))->update([
                'nama'     => $request->input('nama'),
            ]);

            if ($data) {
                return response()->json([
                        'status_code' => 200,
                        'message' => 'Item Berhasil Diupdate!'
                    ], 200);
            } else {
                return response()->json([
                        'status_code' => 401,
                        'message' => 'Item gagal Diupdate!'
                    ], 401);
            }

        }
    }

    public function destroy($id)
    {
        $pajak = Pajak::with('items')->first();
        $data = $pajak->items()->detach($id);
        // dd($data);

        if ($data) {
            return response()->json([
                'status_code' => 200,
                'message' => 'Item Berhasil Dihapus!'
            ], 200);
        } else {
            return response()->json([
                'status_code' => 400,
                'message' => 'Item Gagal Dihapus!'
            ], 400);
        }

    }

}
