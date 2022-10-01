<?php

namespace App\Http\Livewire;

use Livewire\Component;
/* para rescatar todos los elementos de una base de datos primero debemos mandar al modelo */
use App\Models\Post;

class ShowPosts extends Component
{
    public $search ;

    public $sort = 'id' ;
    public $direction = 'desc';

    /* emitimos una escucha por el componente createPost(para que una vez que inserte el dato se actualize la tabla) 
        ponemos un metodo protected con la la palabra reservada "$listeners" delante de este enrte corchetes, el nombre de 
        emisor y este apunta al metodo que se va a ejecutar en esta clase
    */
    protected $listeners=['render'=>'render'];
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
        /* rescatamos todos lo que tiene el objeto post
        $posts = Post::all(); */
        /* filtramos por el titulo */
        $posts = Post::where('title','like','%'.$this->search.'%')
                       ->orwhere('content','like','%'.$this->search.'%')
                       ->orderBy($this->sort,$this->direction)
                       ->get();
        /* se lo nmandamos con un compact */
        return view('livewire.show-posts',compact('posts'));
    }

    /**
     * este metodo es para cachar los datos cuando se de click en los titulos
     */
    public function order($sort){
        if ( $this->sort==$sort) {

            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            }else{
                $this->direction = 'desc';
            }
        } else {
            # code...
            $this->sort=$sort;
            $this->direction == 'asc';
        }
        
    }
}
