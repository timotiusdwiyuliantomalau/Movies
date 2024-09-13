<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FetchAPIController extends Controller
{

    public function for_you()
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', "https://api.themoviedb.org/3/movie/popular?languange=en-US&page=2", [
            'headers' => ['Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIxZGUzNzM4Y2M2MGNlMjBjMDc3Y2FiNWI3ZDc1MGI5MSIsIm5iZiI6MTcyNTk3ODgwNS4wMTg5MjQsInN1YiI6IjY2ZGJmMTE4MzM0MjExNGYyMWVjNGRmMCIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.O0gkL1wMUOhXvNgmagmbezz46MIlnPcaAzqode7QaBg', 'Accept' => 'application/json']
        ]);
        $foryou1 = json_decode($response->getBody())->{'results'};
        $data = json_decode($response->getBody())->{'results'};
        foreach ($foryou1 as $fy1) {
            array_push($data, $fy1);
        }
        return view('welcome')->with('data', $data);
    }
    public function top_rated() {
        $client = new \GuzzleHttp\Client();
        $data=$client->request("GET","https://api.themoviedb.org/3/movie/top_rated?languange=en-US&page=1",[
            'headers'=>['Authorization'=>'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIxZGUzNzM4Y2M2MGNlMjBjMDc3Y2FiNWI3ZDc1MGI5MSIsIm5iZiI6MTcyNjA2NjU3MS4yOTQ0NDksInN1YiI6IjY2ZGJmMTE4MzM0MjExNGYyMWVjNGRmMCIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.NvpH6GCNYQDsnbm1ZkwFfmKtS1qW504s1sJUXJ_eEh8','Accept'=>'application/json']
    ]);
        $data = json_decode($data->getBody())->{'results'};
        return view('welcome')->with('data', $data);
    }
}
