<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
/* clase que nos ayus a subir fotos al servido */
use Livewire\WithFileUploads;

class CreatePost extends Component
{
    use WithFileUploads;

    /* este atributo maneja el abrir y cerrar el modal de crear post */
    public $open = false;

    public $title,$content,$image,$identificador;

    public function mount(){
        $this->identificador = rand();
    }

    protected $rules=[
        'title' => 'required|max:100',
        'content' => 'required|min:10',
        'image' => 'required|image|max:2048'
    ];

/* 
este metodo nos ayuda a que sea una validacion en tiempo real,
del lado de la vista es necesario que no este en .defer (o que no de renderize al momento de esta escribiendo)
    public function updated($propertyName){
        $this->validateOnly($propertyName);
        
    } */
    public function save(){
        try {
            $this->validate();
            $image = $this->image->store('public/posts');
    
            Post::create([
                'title'=>$this->title,
                'content' => $this->content,
                'image' =>  $image
            ]);
    
            /* resetear los campos del modal */
            $this->reset(['open','title','content','image']);
            $this->identificador = rand();
            /* emitimos un evento */
            $this->emitto('show-posts','render');
            $this->emit('alert','El post se creo Corerrectamente');
        } catch (\Throwable $th) {
            throw $th;
           /*  echo "excepcion capturado :".$th->getMessage(); */
        }
    }

    public function render()
    {
        return view('livewire.create-post');
    }
}
