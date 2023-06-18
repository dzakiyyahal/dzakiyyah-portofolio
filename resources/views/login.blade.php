<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="w-screen h-screen flex justify-center items-center">
        <div class="w-1/3 text-center space-y-10">
            <h1 class="text-7xl font-extrabold text-black">LOGO</h1>
            <h1 class="text-4xl font-extrabold text-gray-600">MASUK KE AKUN ANDA</h1>
            <form method="POST" action="{{ url('/login') }}" class="space-y-5">
                @csrf
                <input type="email" class="w-full border rounded-md px-3 py-4 border-black" placeholder="Email"
                    name="email">
                <input type="password" class="w-full border rounded-md px-3 py-4 border-black" placeholder="Password"
                    name="password">

                <button type="submit"
                    class="bg-customBlue rounded-md text-white py-3 text-xl w-full font-bold">MASUK</button>
            </form>
        </div>
    </div>
</body>

</html>
