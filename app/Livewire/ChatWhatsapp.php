<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\message;
use Livewire\Attributes\On;

class ChatWhatsapp extends Component
{
    public $chats = [];
    public $mensajes = [];
    public $telefono = "";

    public function mount()
    {
        $this->loadMessages();
    }

    #[On('refreshChatData')]
    public function loadMessages()
    {
        $celulares = message::distinct()->where('tipo', 'recibido')->pluck('celular');

        foreach ($celulares as $celular) {
            $chats = message::where('celular', $celular)->first();
            $this->chats[$celular] = $chats;
        }

        $this->mensajes = message::all();
    }

    public function setTelefono($telefono){
        $this->telefono = $telefono;
    }

    public function render()
    {
        $chats = $this->chats;
        $mensajes = $this->mensajes;

        return view('livewire.chat-whatsapp', compact('chats', 'mensajes'));
    }


}

