<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Halo {{ $user->name }}</h1>
    <h1>Products</h1>

    <form action="{{ route('add-hero') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="foto"><br>

        <button type="submit">Submit</button>
    </form>

    <table border="1">
        <tr>
            <th>Foto</th>
            <th>Aksi</th>
        </tr>
        <br>
        @foreach ($heroes as $hero)
            <tr>
                <td>
                    <img src="{{ asset('storage/foto/' . $hero->nama) }}" alt="Foto">
                </td>
                <td>
                    <a href="{{ url('admin/edit-hero/' . $hero->id) }}">Ubah</a>
                    <a href="{{ url('admin/delete-hero/' . $hero->id) }}">Hapus</a>
                </td>
            </tr>
        @endforeach
    </table>
</body>

</html>
