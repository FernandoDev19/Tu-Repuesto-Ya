<?php

namespace App\Livewire;

use Livewire\Component;


class CreateProvider extends Component
{

    public function render()
    {
        return view('livewire.create-provider');
    }
    public function store(){
        $this->dispatch('render');
    }
}
