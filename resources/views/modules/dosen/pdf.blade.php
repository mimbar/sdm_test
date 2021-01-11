<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dosen</title>
</head>

<style>
    * {
        font-size: 12px;
    }
</style>

<body>
    <table border="1" style="border-collapse: collapse">
        <thead style="background-color: #d3d3d3">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Username</th>
                <th>NIDN</th>
                <th>NIP</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @php
            $no = 0;
            @endphp
            @forelse ($dosen as $item)
            {{-- {{ dd($item) }} --}}
            <tr>
                <td>{{ $no + 1 }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->username }}</td>
                <td>{{ $item->nidn }}</td>
                <td>{{ $item->nip }}</td>
                <td>{{ $item->tempat_lahir }}</td>
                <td>{{ $item->tanggal_lahir }}</td>
                <td>{{ $item->email }}</td>
            </tr>
            @php
            $no++;
            @endphp

            @empty
            <tr style="color: red;text-align: center">
                <td colspan="8">Data tidak ada</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
