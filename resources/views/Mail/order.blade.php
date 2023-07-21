<div>
	Terima kasih telah mempercayakan order dikami.<br><br>
    
    <table border="1">
        <tr>
            <th>Nama</th>
            <th>Produk</th>
            <th>Price</th>
            <th>qty</th>
            <th>total</th>
            <th>status</th>
        </tr>
        <tr>
            <td>{{ $cart->user->name }}</td>
            <td>{{ $cart->product->name }}</td>
            <td>{{ $cart->product->price }}</td>
            <td>{{ $cart->qty }}</td>
            <td>{{ $cart->total }}</td>
            <td>{{ $cart->status }}</td>
        </tr>
        <tr>
            <td colspan="4">Silahkan Order Kembali</td>
        </tr>
    </table>

	<p>Terima kasih.</p>
	<p>Salam</p>
	<p>Rizky Moto Shop</p>
</div>
