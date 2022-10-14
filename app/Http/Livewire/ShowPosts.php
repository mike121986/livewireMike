<?php

namespace App\Http\Livewire;

use App\Models\Post;
/* para rescatar todos los elementos de una base de datos primero debemos mandar al modelo */
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
/* clase que nos ayus a subir fotos al servido */
use Livewire\WithFileUploads;
/* esta clase nos ayuda a hacer la paginacion sin necesidad de recargar la pagina */
use Livewire\WithPagination;

class ShowPosts extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $post, $image,$identificador,$existe;
    public $search = '';
    public $sort = 'id' ;
    public $direction = 'desc';

    /* propiedad para mostrar la cantidad que items que queremos mostrar en la paginacion la incializamos en 10 itms */
    public $cant = '10';

    /* propiedad para hacer el efecto que se carga la pagina  */
    public $readyToLoad = false;

    /* incializamos una propiedad con el valor de false ya que este sera par abrir el modal  */
    public $open_edit = false;

    /* hacemos un query string (este es para enviar la cantidad de items por la url) */
    protected $queryString = ["cant" => ['except' => '10'],
                              "search" => ['except' => ''],
                              "sort" => ['except' => 'id'],
                              "direction" => ['except' => 'desc']
                            ];
    /* emitimos una escucha por el componente createPost(para que una vez que inserte el dato se actualize la tabla) 
        ponemos un metodo protected con la la palabra reservada "$listeners" delante de este enrte corchetes, el nombre de 
        emisor y este apunta al metodo que se va a ejecutar en esta clase
    */
    protected $listeners=['render'=>'render','delete'=>'delete'];
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

    /* peopiedades para mopstrar los datos en el modal */
    protected $rules=[
        'post.title' => 'required',
        'post.content' => 'required'
    ];

    public function mount(){
        
        /* inicalizamos el identificador con un numero aleatorio */
        $this->identificador = rand();
        $this->post = new Post();
    }
    /* vamos a resetar la propiedad search para hacer la busqueda desde cuarquier paginacion */
    public function updatingSearch(){
        $this->resetPage();
    }
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
        if($this->readyToLoad){
            $posts = Post::where('title','like','%'.$this->search.'%')
                       ->orwhere('content','like','%'.$this->search.'%')
                       ->orderBy($this->sort,$this->direction)
                       //->get(); // este metodo nos trae todo
                       ->paginate($this->cant); // este metodo nos trae los datos paginados
        }else{
            $posts = [];
        }
       /*   */
        /* se lo nmandamos con un compact */
        return view('livewire.show-posts',compact('posts'));
    }

    public function loadPost(){
        $this->readyToLoad = true;
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

    public function edit(Post $post){
        $this->post = $post;
        $this->existe = Storage::disk('public')->exists(Storage::url($this->post->image));
        $this->open_edit = true;
    }

    public function update(){
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
         $this->reset(['open_edit','image']);
 
         $this->identificador = rand();
         // emitimos el renderizado o actuazliar datos 
        /*por este momento no tenemos que renderizar nada ya que como esta dentro de la misma clase no es necesario
          $this->emitto('show-posts','render'); */
         // emitimos una alerta
         $this->emit('alert','El post se actualizo Corerrectamente');
    }

    public function delete(POST $post){
        $post->delete();
    }
}
