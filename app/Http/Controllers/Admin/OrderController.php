<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Order',
            'activeOrder' => 'active',
            'user' => User::where('role', 'driver')->get(),
            'orders' => Order::with('orderDetails')->get(),
        ];

        return view('admin.order.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Create Order',
            'activeOrder' => 'active',
            'user' => User::where('role', 'driver')->get(),
        ];

        return view('admin.order.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pemesan' => 'required',
            'alamat_pengantaran' => 'required',
            'no_hp_pemesan' => 'required',
            'driver_id' => 'nullable|exists:users,id',
            'pesanan.*' => 'required|string',
            'harga.*' => 'required|numeric',
        ]);

        $order = new Order();
        $order->nama_pemesan = $request->nama_pemesan;
        $order->alamat_pengantaran = $request->alamat_pengantaran;
        $order->no_hp_pemesan = $request->no_hp_pemesan;
        $order->driver_id = $request->driver_id;
        $order->status = 'Menunggu'; // HARUS cocok dengan enum: Menunggu / Selesai
        $order->save();

        foreach ($request->pesanan as $key => $pesanan) {
            OrderDetail::create([
                'order_id' => $order->id,
                'pesanan' => $pesanan,
                'harga' => $request->harga[$key],
            ]);
        }

        return redirect()->route('order.index')->with('success', 'Order berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $order = Order::with('orderDetails')->findOrFail($id);

        $data = [
            'title' => 'Edit Order',
            'activeOrder' => 'active',
            'order' => $order,
            'user' => User::where('role', 'driver')->get(),
        ];

        return view('admin.order.edit', $data);
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama_pemesan' => 'required',
            'alamat_pengantaran' => 'required',
            'no_hp_pemesan' => 'required',
            'driver_id' => 'nullable|exists:users,id',
            'pesanan.*' => 'required|string',
            'harga.*' => 'required|numeric',
        ]);
    
        // Ambil data order berdasarkan ID
        $order = Order::findOrFail($id);
    
        // Update data order
        $order->nama_pemesan = $request->nama_pemesan;
        $order->alamat_pengantaran = $request->alamat_pengantaran;
        $order->no_hp_pemesan = $request->no_hp_pemesan;
        $order->driver_id = $request->driver_id;
        $order->save();
    
        // Hapus detail lama dan buat detail baru
        $order->orderDetails()->delete();
    
        foreach ($request->pesanan as $key => $pesanan) {
            OrderDetail::create([
                'order_id' => $order->id,
                'pesanan' => $pesanan,
                'harga' => $request->harga[$key],
            ]);
        }
    
        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('order.index')->with('success', 'Order berhasil diupdate.');
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->route('order.index')->with('success', 'Order berhasil dihapus.');
    }
}
