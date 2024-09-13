<?php
    if(isset($_GET['search'])){
        $response = file_get_contents("http://www.omdbapi.com/?apikey=7d314f71&s=".$_GET['search']);
        $res=json_decode($response)->{'Search'};
    };
     $client=new GuzzleHttp\Client();
    $response=$client->request('GET',"https://api.themoviedb.org/3/movie/popular?languange=en-US&page=2",[
    'headers'=>['Authorization'=>'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIxZGUzNzM4Y2M2MGNlMjBjMDc3Y2FiNWI3ZDc1MGI5MSIsIm5iZiI6MTcyNTk3ODgwNS4wMTg5MjQsInN1YiI6IjY2ZGJmMTE4MzM0MjExNGYyMWVjNGRmMCIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.O0gkL1wMUOhXvNgmagmbezz46MIlnPcaAzqode7QaBg','Accept'=>'application/json']
    ]);
    $foryou1=json_decode($response->getBody())->{'results'};
    $response=$client->request('GET',"https://api.themoviedb.org/3/movie/popular?languange=en-US&page=1",[
        'headers'=>['Authorization'=>'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIxZGUzNzM4Y2M2MGNlMjBjMDc3Y2FiNWI3ZDc1MGI5MSIsIm5iZiI6MTcyNTk3ODgwNS4wMTg5MjQsInN1YiI6IjY2ZGJmMTE4MzM0MjExNGYyMWVjNGRmMCIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.O0gkL1wMUOhXvNgmagmbezz46MIlnPcaAzqode7QaBg ','Accept'=>'application/json']
]);
    $foryou=json_decode($response->getBody())->{'results'};
    foreach ($foryou1 as $fy1 ) {
        array_push($foryou,$fy1);
    }
    $top_rated=$client->request("GET","https://api.themoviedb.org/3/movie/top_rated?languange=en-US&page=1",[
        'headers'=>['Authorization'=>'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIxZGUzNzM4Y2M2MGNlMjBjMDc3Y2FiNWI3ZDc1MGI5MSIsIm5iZiI6MTcyNjA2NjU3MS4yOTQ0NDksInN1YiI6IjY2ZGJmMTE4MzM0MjExNGYyMWVjNGRmMCIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.NvpH6GCNYQDsnbm1ZkwFfmKtS1qW504s1sJUXJ_eEh8','Accept'=>'application/json']
]);
    $top_rated=json_decode($top_rated->getBody())->{'results'};
    dump($top_rated);
    ?>