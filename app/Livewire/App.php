<?php

namespace App\Livewire;

use Livewire\Component;

class App extends Component
{
    public function actionFetch(){
       dump("hello");
    }
    public function render()
    {
        return view('livewire.app');
    }
}
