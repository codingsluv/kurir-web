<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\Delivery;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DelivieryController extends Controller
{
     /**
     * Menampilkan daftar pengantaran yang ditugaskan ke driver.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Pengantaran',
            'activeOrder' => 'active',
            'orders' => Order::where('driver_id', Auth::id())
                ->where('status', 'Menunggu')
                ->with('delivery') // Eager load data delivery jika ada
                ->get(),
        ];

        return view('driver.deliveries.index', $data);
    }

    /**
     * Menampilkan detail pengantaran untuk diisi oleh driver.
     *
     * @param  int  $orderId
     * @return \Illuminate\Http\Response
     */
    public function show($orderId)
    {
        $data = [
            'title' => 'Pengantaran',
            'activeOrder' => 'active',
            'order' => Order::with('orderDetails')->findOrFail($orderId), //ambil order detail
        ];

        return view('driver.deliveries.show', $data);
    }

    /**
     * Memproses data pengantaran yang diisi oleh driver.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $orderId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $orderId)
    {
        $request->validate([
            'total_ongkir' => 'required|numeric|min:0',
            'jenis_pembayaran' => 'required|in:cash,transfer',
            'bukti_transfer' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'harga.*' => 'required|numeric|min:0', // Validasi harga pesanan
            'pesanan.*' => 'required|string', // Validasi nama pesanan
        ]);

        DB::beginTransaction();
        try {
            $order = Order::findOrFail($orderId);

            // Pastikan driver yang mengupdate adalah driver yang benar, dan status order masih "Menunggu"
            if ($order->driver_id != Auth::id() || $order->status != 'Menunggu') {
                abort(403, 'Anda tidak memiliki akses ke order ini.');
            }

            // Simpan data pengantaran atau buat yang baru jika belum ada
            $delivery = Delivery::updateOrCreate(
                ['order_id' => $orderId], // Cari berdasarkan order_id
                [
                    'total_ongkir' => $request->total_ongkir,
                    'jenis_pembayaran' => $request->jenis_pembayaran,
                    'status_pengantaran' => 'Selesai', // Set status pengantaran menjadi 'Selesai'
                ]
            );

            // Upload bukti transfer jika ada
            if ($request->hasFile('bukti_transfer')) {
                $file = $request->file('bukti_transfer');
                $fileName = 'bukti_transfer_' . $orderId . '_' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('public/bukti_transfer', $fileName);
                $delivery->bukti_transfer = $fileName;
                $delivery->save();
            }

            // Update harga di order detail
             foreach ($request->harga as $key => $harga) {
                $orderDetail = OrderDetail::where('order_id', $order->id)->get();
                if($orderDetail){
                     $orderDetail[$key]->harga = $harga;
                     $orderDetail[$key]->save();
                }
               
            }

            // Ubah status order menjadi 'Selesai'
            $order->status = 'Selesai';
            $order->save();

            DB::commit(); // Commit transaksi jika sukses
            // Redirect ke halaman index dengan pesan sukses
            return redirect()->route('order.index')->with('success', 'Pengantaran berhasil diselesaikan.');
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback transaksi jika terjadi kesalahan
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }

    public function history()
    {
        $data = [
            'title' => 'Riwayat Pengantaran',
            'activeHistory'=> 'active',
            'deliveries' => Order::where('status', 'Selesai') // Ambil order dengan status 'Selesai'
                ->with('driver') // Eager load data driver
                ->get(),
        ];

        return view('admin.deliveries.history', $data);
    }
}
