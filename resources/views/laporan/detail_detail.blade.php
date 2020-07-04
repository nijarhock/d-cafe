<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Kode Pesanan</th>
                <th>Nama Konsumen</th>
                <th>Nama Waiter</th>
                <th>Nama Meja</th>
                <th>Nama Menu</th>
                <th>Qty</th>
                <th>Harga</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            @php
                $grand_qty = 0;
                $grand_harga = 0;
                $grand_total_harga = 0;
            @endphp
            @foreach($pesanan as $data)
                @php
                $grand_qty += $data->qty;
                $grand_harga += $data->harga;
                $grand_total_harga += $data->total_harga;
                @endphp
                <tr>
                    <td>{{ date("d-m-Y", strtotime($data->created_at)) }}
                    <td>{{ $data->pesanan->kode }}
                    <td>{{ $data->pesanan->konsumen->nama }}</td>
                    <td>{{ $data->pesanan->user->name }}</td>
                    <td>{{ $data->pesanan->meja->nama }}</td>
                    <td>{{ $data->menu->nama }}</td>
                    <td>{{ $data->qty }}</td>
                    <td>{{ number_format($data->harga) }}</td>
                    <td>{{ number_format($data->total_harga) }}</td>
                </tr>
            @endforeach 
            <tr>
                <th colspan="6">Total</th>
                <th>{{ number_format($grand_qty) }}</th>
                <th>{{ number_format($grand_harga) }}</th>
                <th>{{ number_format($grand_total_harga) }}</th>
            </tr>
        </tbody>
    </table>
</div>