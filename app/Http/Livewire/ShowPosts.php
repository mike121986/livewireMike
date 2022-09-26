<?php

namespace App\Http\Livewire;

use Livewire\Component;
/* para rescatar todos los elementos de una base de datos primero debemos mandar al modelo */
use App\Models\Post;

class ShowPosts extends Component
{
   //public $name;

    /**
     * cuando se envian algo debemos capturarlo aqui con una propiedad 
     * esta propiedad debe ser PUBLICA, DEBE LLAMARSE IGUAL EJEMPLO(['title'=>'este es el tituloq que vamos a capturar])
    *
    *public $title;
 */
    // public function mount($name){
       /* si quisieramos mandar otro nombre aqui lo capturamos 
        supongfamos que queremos mandar el nombre de "TITULO"
        SERIA CON LA PROPIEDAD E IGUALARAL
        $this->titulo = $title;
        
        $this->title = $title;*/

         ////////////////////////////////////////////////////////////////////////////
         
        
        //para recuperar del metodo GET
        //$this->name = $name;
    //}

    /**
     * esta clase mantiene siempre esta verificando 
     * que halla algun cambio en los datos que se estan enviando
     * y que trae del servidor
     */
    public function render()
    {
        /* rescatamos todos lo que tiene el objeto post */
        $posts = Post::all();
        /* se lo nmandamos con un compact */
        return view('livewire.show-posts',compact('posts'));
    }
}
