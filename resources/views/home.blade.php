<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <h1>Halo {{ $user->name }}</h1>
    @if ($hero)
        <img src="{{ asset('storage/foto/' . $hero->nama) }}" alt="Foto">
    @endif


    <table border="1">
        <tr>
            <th>Nama</th>
            <th>Foto</th>
            <th>Harga</th>
            <th>Detail</th>
            <th>Aksi</th>
        </tr>
        @foreach ($products as $product)
            <tr>
                <td>{{ $product->nama }}</td>
                <td>
                    <img src="{{ asset('storage/foto/' . $product->foto) }}" alt="Foto">
                </td>
                <td>{{ $product->harga }}</td>
                <td>
                    <a href="{{ url('admin/edit-product/' . $product->id) }}">Ubah</a>
                    <a href="{{ url('admin/delete-product/' . $product->id) }}">Hapus</a>
                </td>
            </tr>
        @endforeach
    </table>
</body>

</html>
