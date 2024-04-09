<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Category;
use App\Models\Keyword;

class KeyWords extends Component
{
    public $openAlertSuccess = false, $openAlertError = false;
    public $categoryId;
    public $edit = false;

    public function mount($categoryId){
        $this->categoryId = $categoryId;
    }

    #[On('create-keyword')]
    public function create($keyword){
        $keywords = new Keyword;

        $keywords->palabra_clave = $keyword;

        $keywords->save();
    }

    public function render()
    {
        $category = Category::with('keyword')->get();
        $id = $this->categoryId;
        $key_words = Keyword::where('id_categoria', $id)->get();

        return view('livewire.key-words', compact('id', 'category', 'key_words'));
    }

    public function delete($id){
        $keyword = Keyword::find($id);

        $keyword->delete();

    }

    public function edit(){
        $this->edit = true;
    }
}
