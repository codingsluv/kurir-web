<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $data = array(
            "title" => "Data Product",
            "activeProduct" => "active",
            "products" => Product::orderBy("id","desc")->paginate(10),
        );
        return view("admin.product.index", $data);
    }

    public function create()
    {
        $data = array(
            "title" => "Tambah Product",    
            "activeProduct" => "active",
        );
        return view("admin.product.create", $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            "nama_product" => "required",
            "harga" => "required",
            "kategori" => "required",
            "deskripsi" => "required",
        ]);

        $product = new Product();
        $product->nama_product = $request->nama_product;
        $product->harga = $request->harga;
        $product->kategori = $request->kategori;
        $product->deskripsi = $request->deskripsi;

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('gambar'), $fileName);
            $product->gambar = $fileName;
        }

        $product->save();

        return redirect()->route("product")->with("success", "Product berhasil ditambahkan");
    }

    public function edit($id)
    {
        $data = array(
            "title" => "Edit Product",
            "activeProduct" => "active",
        );
        $data["product"] = Product::find($id);
        return view("admin.product.edit", $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "nama_product" => "required",
            "harga" => "required",
            "kategori" => "required",
            "deskripsi" => "required",
        ]);

        $product = Product::find($id);
        $product->nama_product = $request->nama_product;
        $product->harga = $request->harga;
        $product->kategori = $request->kategori;
        $product->deskripsi = $request->deskripsi;
        $product->save();

        return redirect()->route("product")->with("success", "Product berhasil diubah");
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route("product")->with("success", "Product berhasil dihapus");
    }
    
    
    
}
