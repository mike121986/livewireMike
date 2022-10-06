<?php

namespace App\Http\Livewire;

use App\Models\Post;
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

        $this->identificador = rand();
    }

    public function save(){
        // validamos
        $this->validate();
        $this->post->save();
        // reseteamos el modal
        $this->reset(['open']);
        // emitimos el renderizado
        $this->emitto('show-posts','render');
        // emitimos una alerta
        $this->emit('alert','El post se actualizo Corerrectamente');
    }

    public function render()
    {
        return view('livewire.edit-post');
    }
}
