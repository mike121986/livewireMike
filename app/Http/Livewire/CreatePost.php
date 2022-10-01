<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class CreatePost extends Component
{
    /* este atributo maneja el abrir y cerrar el modal de crear post */
    public $open = true;

    public $title,$content;

    protected $rules=[
        'title' => 'required|max:100',
        'content' => 'required|min:10'
    ];

/* 
este metodo nos ayuda a que sea una validacion en tiempo real,
del lado de la vista es necesario que no este en .defer (o que no de renderize al momento de esta escribiendo)
    public function updated($propertyName){
        $this->validateOnly($propertyName);
        
    } */
    public function save(){

        $this->validate();

        Post::create([
            'title'=>$this->title,
            'content' => $this->content
        ]);
        $this->reset(['open','title','content']);
        /* emitimos un evento */
        $this->emitto('show-post','render');
        $this->emit('alert','El post se creo Corerrectamente');
    }
    public function render()
    {
        return view('livewire.create-post');
    }
}
