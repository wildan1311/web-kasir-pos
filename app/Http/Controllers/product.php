<?php

namespace App\Http\Controllers;

use App\Models\product as ModelsProduct;
use Illuminate\Http\Request;

class product extends Controller
{
    function index(){
        return view('add-product');
    }

    function store(Request $request){
        $request->validate([
            'namaProduct' => 'required',
            'stokProduct'=>'required',
            'hargaJualProduct' => 'required',
            'hargaBeliProduct' => 'required',
            // 'kategoriProduct' => 'required',
        ]);

        $product = new ModelsProduct();
        $product->nama_product = $request->namaProduct;
        $product->harga_beli = $request->hargaBeliProduct;
        $product->harga_jual = $request->hargaJualProduct;
        $product->stok = $request->stokProduct;
        $product->kategori = $request->kategoriProduct;

        $product->save();
        return redirect('/');
    }
    
    function edit($id){
        $product = \App\Models\product::find($id);
        return view('edit', [
            "product"=>$product,
        ]);
    }
    function update($id, Request $request){
        $request->validate([
            'namaProduct' => 'required',
            'stokProduct'=>'required',
            'hargaJualProduct' => 'required',
            'hargaBeliProduct' => 'required',
            // 'kategoriProduct' => 'required',
        ]);
        
        $product = ModelsProduct::find($id);
        $product->nama_product = $request->namaProduct;
        $product->harga_beli = $request->hargaBeliProduct;
        $product->harga_jual = $request->hargaJualProduct;
        $product->stok = $request->stokProduct;
        $product->kategori = $request->kategoriProduct;

        $product->save();
        return redirect('/');
    }
    
    function show($id){
        $product = ModelsProduct::find($id);
        return response()->json($product);
    }
}
