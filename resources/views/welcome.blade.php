<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Movie.in</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @vite('resources/css/app.css')
</head>

<body>
    <?php
    $data = file_get_contents('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json');
    print_r($data);
    ?>
    <main class="w-full min-h-screen bg-custom-linear items-center flex flex-col justify-center" style="">
        {{-- <h1>Movie.in</h1> --}}
        <p>Best Movie Website!</p>
        <form onsubmit="test(event)" class="flex rounded-full overflow-hidden">
            <input type="search" name="" id="">
            <input type="submit" value="Cari" class="bg-black p-1 cursor-pointer text-white " />
            <span>
    </main>
    <main class="bg-[#1F1414] w-full min-h-screen flex flex-col">
        <div class="flex gap-5 text-yellow-500 self-center font-semibold">
            <p class="text-black bg-yellow-500 rounded-full p-2 font-bold">For You</p>
            <p>Category</p>
            <p>Top Rated</p>
        </div>
        <div class="w-40">
            <img src="https://www.themoviedb.org/assets/2/v4/logos/v2/blue_square_2-d537fb228cf3ded904ef09b136fe3fec72548ebc1fea3fbbd1ad9e36364db38b.svg"
                class="" alt="">
            <span class="flex justify-between text-white ">
                <h2 class="text-xl">Judul Film</h2>
                <span class="flex gap-2">
                    <p>4.5</p>
                    |
                    <p>5jt</p>
                </span>
            </span>
        </div>
    </main>
    <script>
        function test(event){
            event.preventDefault();
            fetch('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json').then(res=>console.log(res))
        }
    </script>
</body>

</html>