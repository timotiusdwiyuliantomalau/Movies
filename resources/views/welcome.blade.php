<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<?php
    if(isset($_GET['search'])){
        $response = file_get_contents("http://www.omdbapi.com/?apikey=7d314f71&s=".$_GET['search']);
        $res=json_decode($response)->{'Search'};
    };
     $client=new GuzzleHttp\Client();
    $response=$client->request('GET',"https://api.themoviedb.org/3/movie/popular?languange=en-US&page=2",[
    'headers'=>['Authorization'=>'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIxZGUzNzM4Y2M2MGNlMjBjMDc3Y2FiNWI3ZDc1MGI5MSIsIm5iZiI6MTcyNTk3ODgwNS4wMTg5MjQsInN1YiI6IjY2ZGJmMTE4MzM0MjExNGYyMWVjNGRmMCIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.O0gkL1wMUOhXvNgmagmbezz46MIlnPcaAzqode7QaBg','accept'=>'application/json']
    ]);
    $foryou1=json_decode($response->getBody())->{'results'};
    $response=$client->request('GET',"https://api.themoviedb.org/3/movie/popular?languange=en-US&page=1",[
        'headers'=>['Authorization'=>'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIxZGUzNzM4Y2M2MGNlMjBjMDc3Y2FiNWI3ZDc1MGI5MSIsIm5iZiI6MTcyNTk3ODgwNS4wMTg5MjQsInN1YiI6IjY2ZGJmMTE4MzM0MjExNGYyMWVjNGRmMCIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.O0gkL1wMUOhXvNgmagmbezz46MIlnPcaAzqode7QaBg ','accept'=>'application/json']
]);
    $foryou=json_decode($response->getBody())->{'results'};
    foreach ($foryou1 as $fy1 ) {
        array_push($foryou,$fy1);
    }
    ?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Movie.in</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @vite('resources/css/app.css')
</head>

<body>

    <main class="w-full min-h-screen bg-custom-linear items-center flex flex-col justify-center" style="">
        <h1 class="text-2xl">Movie.in</h1>
        <p>Best Movie Website!</p>
        {{-- <form class="flex rounded-full overflow-hidden"> --}}
            <input type="search" class="pl-3" class="" placeholder="Search for a movie.." name="search" id="">
            <input type="submit" value="Cari" class="bg-black p-1 cursor-pointer text-white " />
            <span>
    </main>
    {{-- <main class="bg-[#1F1414] w-full min-h-screen flex flex-col">
        <div class="flex gap-5 text-yellow-500 self-center font-semibold">
            <p class="text-black bg-yellow-500 rounded-full p-2 font-bold">For You</p>
            <p>Category</p>
            <p>Top Rated</p>
        </div>
        <div class="flex gap-5 flex-wrap">
            @foreach ($foryou as $item)
            <span class="flex flex-col">
                <img class="w-72" src={{ "https://image.tmdb.org/t/p/original/".$item->{'poster_path'} }} alt="">
                <span class="flex justify-between text-white ">
                    <h1 class="text-xl font-semibold">{{ $item->{'title'} }}</h1>
                    <p>{{ $item->{'release_date'} }}</p>
                    <p>{{ $item->{'vote_average'} }}</p>
                </span>
            </span>
            @endforeach

        </div>
        <div class="flex gap-5 flex-wrap">
            @if(isset($res))
            @foreach ($res as $item)
            <div class="w-40">
                <img src={{ $item->{'Poster'} }}
                class="" alt="">
                <span class="flex justify-between text-white ">
                    <h2 class="text-xl">{{ $item->{'Title'} }}</h2>
                    <p>{{ $item->{'Year'} }}</p>
                </span>
            </div>
            @endforeach
            @endif
        </div>
    </main> --}}
    <script>
    </script>
</body>

</html>