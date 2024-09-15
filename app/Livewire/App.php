<?php

namespace App\Livewire;

use Livewire\Component;

class App extends Component
{
    public $action_page=null;
    public $url;
    public function getCurrentUrl(){
        return request()->url();
    }
    public function __construct()
{
    $this->url = $this->getCurrentUrl();
}
    // public static string $url=;
    public function forYouPage(){
        $client = new \GuzzleHttp\Client();
        $for_you1 = $client->request('GET', "https://api.themoviedb.org/3/movie/popular?languange=en-US&page=1", [
            'headers' => ['Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIxZGUzNzM4Y2M2MGNlMjBjMDc3Y2FiNWI3ZDc1MGI5MSIsIm5iZiI6MTcyNTk3ODgwNS4wMTg5MjQsInN1YiI6IjY2ZGJmMTE4MzM0MjExNGYyMWVjNGRmMCIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.O0gkL1wMUOhXvNgmagmbezz46MIlnPcaAzqode7QaBg', 'Accept' => 'application/json']
        ]);
        $data = json_decode($for_you1->getBody())->{'results'};
        $for_you2 = $client->request('GET', "https://api.themoviedb.org/3/movie/popular?languange=en-US&page=2", [
            'headers' => ['Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIxZGUzNzM4Y2M2MGNlMjBjMDc3Y2FiNWI3ZDc1MGI5MSIsIm5iZiI6MTcyNTk3ODgwNS4wMTg5MjQsInN1YiI6IjY2ZGJmMTE4MzM0MjExNGYyMWVjNGRmMCIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.O0gkL1wMUOhXvNgmagmbezz46MIlnPcaAzqode7QaBg', 'Accept' => 'application/json']
        ]);
        $for_you2 = json_decode($for_you2->getBody())->{'results'};
        foreach ($for_you2 as $fy2) {
            array_push($data, $fy2);
        }
        $this->url="http://127.0.0.1:8000";
        $this->action_page=$data;
    }
    public function topRatedPage(){
        $client = new \GuzzleHttp\Client();
        $data=$client->request("GET","https://api.themoviedb.org/3/movie/top_rated?languange=en-US&page=1",[
            'headers'=>['Authorization'=>'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIxZGUzNzM4Y2M2MGNlMjBjMDc3Y2FiNWI3ZDc1MGI5MSIsIm5iZiI6MTcyNjA2NjU3MS4yOTQ0NDksInN1YiI6IjY2ZGJmMTE4MzM0MjExNGYyMWVjNGRmMCIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.NvpH6GCNYQDsnbm1ZkwFfmKtS1qW504s1sJUXJ_eEh8','Accept'=>'application/json']
    ]);
        $data = json_decode($data->getBody())->{'results'};
        $this->action_page=$data;
        $this->url="http://127.0.0.1:8000/top_rated";
    }
    
    public function render()
    {
        return view('livewire.app',["url"=>$this->url]);
    }
}
