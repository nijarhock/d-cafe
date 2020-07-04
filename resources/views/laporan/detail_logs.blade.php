<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Nama</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $data)
                <tr>
                    <td>{{ date("d-m-Y", strtotime($data->created_at)) }}
                    <td>{{ $data->user->name }}
                    <td>{{ $data->desc }}</td>
                </tr>
            @endforeach 
        </tbody>
    </table>
</div>