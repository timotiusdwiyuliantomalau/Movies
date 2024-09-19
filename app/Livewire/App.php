<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class App extends Component
{
    public $genres;
    public $data;
    public $page;
    public function __construct()
    {
    }
    public function recommendedData(){
        $data=[];
        for($i=1;$i<=4;$i++){
            array_push($data,$this->dataPage("https://api.themoviedb.org/3/movie/popular?languange=en-US&page=$i"));
        }
        return $data;
    }

    public function dataPage($urlAPI){
        $client=new \GuzzleHttp\Client();
        $response=$client->request("GET",$urlAPI,[
            'headers'=>[
                'Authorization'=>'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIxZGUzNzM4Y2M2MGNlMjBjMDc3Y2FiNWI3ZDc1MGI5MSIsIm5iZiI6MTcyNjA2NjU3MS4yOTQ0NDksInN1YiI6IjY2ZGJmMTE4MzM0MjExNGYyMWVjNGRmMCIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.NvpH6GCNYQDsnbm1ZkwFfmKtS1qW504s1sJUXJ_eEh8',
                'Accept'=>'application/json',
            ]
            ]);
        $data=json_decode($response->getBody())->{'results'};
        return $data;
    }

    #[On("page")]
    public function changePage($page){
        if($page=='recommended'){
            $this->data=$this->recommendedData();
        }
        if($page=='top_rated'){
            $this->data=$this->dataPage("https://api.themoviedb.org/3/movie/top_rated?languange=en-US&page=1");
        }
    }

    public function render()
    {
        return view('livewire.app');
    }
}
