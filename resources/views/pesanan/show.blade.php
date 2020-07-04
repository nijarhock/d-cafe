<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Konsumen</th>
                <th>Waiter</th>
                <th>Meja</th>
                <th>Total Harga</th>
                <th>Diskon (%)</th>
                <th>PPN (%)</th>
                <th>Grand Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $pesanan->kode }}</td>
                <td>{{ $pesanan->konsumen->nama }}</td>
                <td>{{ $pesanan->user->name }}</td>
                <td>{{ $pesanan->meja->nama }}</td>
                <td>{{ number_format($pesanan->total_harga) }}</td>
                <td>{{ $pesanan->diskon }}</td>
                <td>{{ $pesanan->ppn }}</td>
                <td>{{ number_format($pesanan->grand_total) }}</td>
            </tr>
            <tr>
                <td></td>
                <td colspan="7">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Menu</th>
                                <th>qty</th>
                                <th>Harga</th>
                                <th>Total Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pesanan->detail as $data)
                            <tr>
                                <td>{{ $data->menu->nama }}</td>
                                <td>{{ $data->qty }}</td>
                                <td>{{ number_format($data->harga) }}</td>
                                <td>{{ number_format($data->total_harga) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </td>
            <tr>
        </tbody>
    </table>
</div>