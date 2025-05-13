<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use App\Models\Product; // Import model Product
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
    public function index()
    {
        $data = array(
            "title" => "Data Pesanan",
            "activePesanan" => "active",
            "pesanans" => Pesanan::all(),
        );
        return view("admin.pesanan.index", $data);
    }

    public function create()
    {
        $data = array(
            "title" => "Tambah Pesanan",
            "activePesanan" => "active",
            "products" => Product::all(), // Mengambil semua produk untuk ditampilkan di form
        );
        return view("admin.pesanan.create", $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            "nama_pemesan" => "required",
            "no_telp" => "required",
            "alamat" => "required",
            "status_pemesanan" => "required",
            "produk" => "required|array", // Validasi bahwa produk adalah array
            "produk.*.id" => "required|exists:products,id", // Validasi ID produk
            "produk.*.jumlah" => "required|integer|min:1", // Validasi jumlah produk
            "total_harga" => "required|numeric|min:0",
        ]);

        $pesanan = new Pesanan();
        $pesanan->nama_pemesan = $request->nama_pemesan;
        $pesanan->no_telp = $request->no_telp;
        $pesanan->alamat = $request->alamat;
        $pesanan->status_pemesanan = $request->status_pemesanan;
        $pesanan->total_harga = $request->total_harga;
        $pesanan->save(); // Simpan dulu pesanan untuk mendapatkan ID

        $totalHarga = 0;
        $produkYangDipesan = [];
        foreach ($request->produk as $produkData) {
            $produkId = $produkData['id'];
            $jumlah = $produkData['jumlah'];
            $hargaSatuan = Product::find($produkId)->harga; //ambil dari database
            $produkYangDipesan[$produkId] = [
                'jumlah' => $jumlah,
                'harga_satuan' => $hargaSatuan,
            ];
            $totalHarga += $jumlah * $hargaSatuan;
        }

        $pesanan->produk()->attach($produkYangDipesan); // Gunakan attach untuk menyimpan relasi ke tabel pivot
        $pesanan->total_harga = $totalHarga; //hitung total harga
        $pesanan->save(); //simpan total harga

        return redirect()->route("pesanan")->with("success", "Pesanan berhasil ditambahkan dengan detail produk");
    }

    public function edit($id)
    {
        $data = array(
            "title" => "Edit Pesanan",
            "activePesanan" => "active",
            "pesanans" => Pesanan::with('produk')->find($id), // Eager load produk untuk menampilkan detailnya
            "products" => Product::all(), // Kirimkan juga daftar semua produk
        );
        return view("admin.pesanan.edit", $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "nama_pemesan" => "required",
            "no_telp" => "required",
            "alamat" => "required",
            "status_pemesanan" => "required",
            "produk" => "required|array", // Produk harus selalu ada saat update
            "produk.*.id" => "required|exists:products,id",
            "produk.*.jumlah" => "required|integer|min:1",
            "total_harga" => "required|numeric|min:0",
        ]);

        $pesanan = Pesanan::find($id);
        $pesanan->nama_pemesan = $request->nama_pemesan;
        $pesanan->no_telp = $request->no_telp;
        $pesanan->alamat = $request->alamat;
        $pesanan->status_pemesanan = $request->status_pemesanan;
        $pesanan->total_harga = $request->total_harga;
        $pesanan->save();

        $totalHarga = 0;
        $produkYangDipesan = [];
         foreach ($request->produk as $produkData) {
            $produkId = $produkData['id'];
            $jumlah = $produkData['jumlah'];
            $hargaSatuan = Product::find($produkId)->harga;
            $produkYangDipesan[$produkId] = [
                'jumlah' => $jumlah,
                'harga_satuan' => $hargaSatuan,
            ];
            $totalHarga += $jumlah * $hargaSatuan;
        }
        $pesanan->produk()->sync($produkYangDipesan);
        $pesanan->total_harga = $totalHarga;
        $pesanan->save();

        return redirect()->route("pesanan")->with("success", "Pesanan berhasil diubah");
    }

    public function destroy($id)
    {
        $pesanan = Pesanan::find($id);
        $pesanan->delete();
        return redirect()->route("pesanan")->with("success", "Pesanan berhasil dihapus");
    }
}
