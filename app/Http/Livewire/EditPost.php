<?php

namespace App\Http\Livewire;

use App\Models\Post;
// importamos al facade storage para subir imagenes
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
/* clase que nos ayus a subir fotos al servido */
use Livewire\WithFileUploads;

class EditPost extends Component
{
    use WithFileUploads;
    public $open = false;
    /* definimos porpiedad post */
    public $post,$image,$identificador;


    /* peopiedades para mopstrar los datos en el modal */
    protected $rules=[
        'post.title' => 'required',
        'post.content' => 'required'
    ];


    public function mount(Post $post){
        $this->post = $post;
        /* inicalizamos el identificador con un numero aleatorio */
        $this->identificador = rand();
    }

    public function save(){
        // validamos
        $this->validate();
        /* si hay algo almacenado en la variable imagen del objeto post */
       if($this->image){
        Storage::delete([$this->post->image]);
        /* subimos la nueva imagen */
        $this->post->image = $this->image->store('public/posts');
       }
        $this->post->save();
        // reseteamos el modal
        $this->reset(['open','image']);

        $this->identificador = rand();
        // emitimos el renderizado o actuazliar datos
        $this->emitto('show-posts','render');
        // emitimos una alerta
        $this->emit('alert','El post se actualizo Corerrectamente');
    }

    public function render()
    {
        return view('livewire.edit-post');
    }
}
