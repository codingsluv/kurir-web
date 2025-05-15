<!DOCTYPE html>
 <html>
 <head>
     <title>Laporan Order</title>
      <style>
         body {
             font-family: sans-serif;
         }
         table {
             width: 100%;
             border-collapse: collapse;
         }
         th, td {
             border: 1px solid black;
             padding: 8px;
             text-align: left;
         }
         th {
             background-color: #f2f2f2;
         }
     </style>
 </head>
 <body>
     <h1>Laporan Order</h1>
     <table>
         <thead>
             <tr>
                 <th>ID Order</th>
                 <th>Nama Pemesan</th>
                 <th>No HP Pemesan</th>
                 <th>Alamat Pengantaran</th>
                 <th>Status</th>
                 <th>Tanggal Dibuat</th>
             </tr>
         </thead>
         <tbody>
             @foreach ($orders as $order)
                 <tr>
                     <td>{{ $order->id }}</td>
                     <td>{{ $order->nama_pemesan }}</td>
                     <td>{{ $order->no_hp_pemesan }}</td>
                     <td>{{ $order->alamat_pengantaran }}</td>
                     <td>{{ $order->status }}</td>
                      <td>{{ $order->created_at }}</td>
                 </tr>
             @endforeach
         </tbody>
     </table>
 </body>
 </html>