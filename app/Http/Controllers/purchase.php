<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\transaction;
use App\Models\transactionDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class purchase extends Controller
{
    public function transactionDetail($id, $idt, Request $request){
        $item_id = json_decode($id);
        $item_qty = json_decode($request->qty);

        for($i=0; $i<sizeof($item_id); $i++){
            DB::table('transaksidetail')
                ->insert([
                    'id_transaksi'=>$idt,
                    'id_product' => $item_id[$i],
                    'jumlah' => $item_qty[$i],
                ]);
        }
        $this->UpdateStock($item_id, $item_qty);

        return response("Berhasil");
    }
    public function transaction($id, Request $request){
        $request->validate([
            'pembeli' => 'required',
        ]);

        $transaksi = new transaction();
        $transaksi->pembeli = $request->pembeli;

        $transaksi->save();
        $this->transactionDetail($id, $transaksi->id, $request);
    }

    public function UpdateStock($item_id, $item_qty){
        for($i=0; $i<sizeof($item_id); $i++){
            $product = product::find($item_id[$i]);
            $product->decrement('stok', $item_qty[$i]);
        }
    }
}
