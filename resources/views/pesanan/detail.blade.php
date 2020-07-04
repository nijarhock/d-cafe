<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th></th>
                <th>Kode Menu</th>
                <th>Nama</th>
                <th>Qty</th>
                <th>harga</th>
                <th>Total</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($detail as $data)
                <tr>
                    <td><img src="{{ $data->menu->gambar->url }}" width="100" height="100"></td>
                    <td>{{ $data->menu->kode }}</td>
                    <td>{{ $data->menu->nama }}</td>
                    <td><input type="text" id="qty" name="qty" class="form-control" value="{{ $data->qty }}" data-id="{{ $data->id }}"></td>
                    <td>{{ number_format($data->harga) }}</td>
                    <td>{{ number_format($data->total_harga) }}</td>
                    <td>
                        <button type="button" id="btnDeleteDtl" data-id="{{ $data->id }}" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="4"></td>
                <td>Subtotal</td>
                <td>{{ number_format($master->total_harga) }}</td>
            <tr>
            <tr>
                <td colspan="4"></td>
                <td>Diskon (%)</td>
                <td>{{ $master->diskon }}</td>
            <tr>
            <tr>
                <td colspan="4"></td>
                <td>PPN (%)</td>
                <td>{{ $master->diskon }}</td>
            <tr>
            <tr>
                <td colspan="4"></td>
                <td>Grand Total</td>
                <td>{{ number_format($master->grand_total) }}</td>
            <tr>
            <tr>
                <td colspan="4">
                    <button type="button" class="btn btn-warning btn-block" id="print_dapur">Print Dapur</button>
                </td> 
                <td colspan="3">
                    <button type="button" class="btn btn-danger btn-block" id="tutup">Kembali</button>
                </td>
            </tr>
            @if(Auth::user()->role != "waiter")
            <tr>
                <td colspan="3">Pembayaran</td>
                <td colspan="2">
                    <select name="jenis_byr_id" class="form-control" id="jenis_byr_id">
                        @foreach($jenis_byr as $row)
                        <option value="{{ $row->id }}">{{ $row->nama }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input type="text" class="form-control" id="nilai_bayar" name="nilai_bayar" value="{{ $master->grand_total }}">
                </td>
                <td>
                    <button type="button" class="btn btn-sm btn-success" id="simpanBayar">Bayar</button>
                </td>
            <tr>
            @endif
        </tbody>
    </table>
</div>