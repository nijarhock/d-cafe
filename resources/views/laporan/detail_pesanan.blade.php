<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Kode Pesanan</th>
                <th>Nama Konsumen</th>
                <th>Nama Waiter</th>
                <th>Nama Meja</th>
                <th>Total Harga</th>
                <th>Diskon %</th>
                <th>PPN %</th>
                <th>Grand Total</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @php
            $grand_total_harga = 0;
                $grand_grand_total = 0;
                $grand_diskon = 0;
                $grand_ppn = 0;
            @endphp
            @foreach($pesanan as $data)
                @php
                $grand_total_harga += $data->total_harga;
                $grand_grand_total += $data->grand_total;
                $grand_diskon += $data->total_harga*$data->diskon/100;
                $grand_ppn += ($data->total_harga - ($data->total_harga*$data->diskon/100)) * $data->ppn / 100;
                @endphp
                <tr>
                    <td>{{ date("d-m-Y", strtotime($data->created_at)) }}
                    <td>{{ $data->kode }}
                    <td>{{ $data->konsumen->nama }}</td>
                    <td>{{ $data->user->name }}</td>
                    <td>{{ $data->meja->nama }}</td>
                    <td>{{ number_format($data->total_harga) }}</td>
                    <td>{{ $data->diskon }}% ({{ number_format($data->total_harga*$data->diskon/100) }})</td>
                    <td>{{ $data->ppn }}% ({{ number_format(($data->total_harga - ($data->total_harga*$data->diskon/100)) * $data->ppn / 100) }})</td>
                    <td>{{ number_format($data->grand_total) }}</td>
                    <td>{{ $data->status }}</td>
                </tr>
            @endforeach 
            <tr>
                <th colspan="5">Total</th>
                <th>{{ number_format($grand_total_harga) }}</th>
                <th>{{ number_format($grand_diskon) }}</th>
                <th>{{ number_format($grand_ppn) }}</th>
                <th>{{ number_format($grand_grand_total) }}</th>
                <th></th>
            </tr>
        </tbody>
    </table>
</div>