<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Products</h1>

    <form action="{{ url('admin/edit-product/' . $data->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="nama" value="{{ $data->nama }}"><br>
        <input type="number" name="harga" value="{{ $data->harga }}"><br>
        <input type="file" name="foto" value="{{ $data->foto }}"><br>
        <input type="text" name="detail" value="{{ $data->detail }}"><br>

        <button type="submit">Submit</button>
    </form>
</body>

</html>
