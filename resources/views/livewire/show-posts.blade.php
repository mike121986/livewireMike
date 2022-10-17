<div wire:init = "loadPost">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    {{-- siempre debe de estar encerrado en u ndiv padre --}}
    {{-- aqui mostramos la pripiedad del componente 
    {{$name}} --}}
    {{-- imprimimos todo lo de la base de datos --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        {{-- <input type="text" wire:model="search"> --}}
        <div class="px-6 py-4 flex item-center">
            <div class="flex items-center">
                <span>Mostrar</span>
                <select wire:model="cant" class="mx-2 form-control" >
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
                <span>Entradas</span>
            </div>
        <x-jet-input class="flex-1 mx-4" type="text" wire:model="search" placeholder="Escriba algo"/>
        @livewire('create-post')
        </div>
        <x-table>
        @if (count($posts))
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th
                            class="w-24 cursor-pointer px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider "
                            wire:click="order('id')">
                            Id
                            {{-- sort --}}
                            @if ($sort == 'id')
                                @if ($direction == 'asc')
                                    <i class="fa-solid fa-arrow-up-z-a float-right mt-1 fa-xs"></i>
                                @else
                                    <i class="fa-solid fa-arrow-down-a-z float-right mt- fa-xs1"></i>
                                @endif
                            @else
                                <i class="fa-solid fa-up-down float-right fa-xs"></i>
                            @endif
                        </th>
                        <th scope="col"
                            class="cursor-pointer px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider"
                            wire:click="order('title')">
                            titulo
                            {{-- sort --}}
                            @if ($sort == 'title')
                                @if ($direction == 'asc')
                                <i class="fa-solid fa-arrow-up-z-a float-right mt-1"></i>
                                @else
                                <i class="fa-solid fa-arrow-down-a-z float-right mt-1"></i>
                                    
                                @endif
                            @else
                            <i class="fa-solid fa-up-down float-right"></i>
                            @endif
                        </th>
                        <th
                            class="cursor-pointer px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider"
                            wire:click="order('content')">
                            Contenido
                            {{-- sort --}}
                            @if ($sort == 'content')
                                @if ($direction == 'asc')
                                    <i class="fa-solid fa-arrow-up-z-a float-right mt-1"></i>
                                @else
                                    <i class="fa-solid fa-arrow-down-a-z float-right mt-1"></i>
                                @endif
                            @else
                                <i class="fa-solid fa-up-down float-right"></i>
                            @endif
                        </th>
                        <th
                            class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">

                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach ($posts as $item)
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                <div class="flex items-center">
                                    <div>
                                        <div class="text-sm leading-5 text-gray-800">{{$item->id}}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                <div class="text-sm leading-5 text-blue-900">{{$item->title}}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">
                                {!! $item->content !!}
                            </td>
                            <td
                                class="px-6 py-4 whitespace-no-wrap  border-b border-gray-500 text-sm leading-5 flex">
                                {{-- <button
                                    class="py-2 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-blue-700 hover:text-white focus:outline-none">View
                                    Details</button> 
                                    @livewire('edit-post', ['post' => $post], key($post->id))--}}
                                    <a class="btn btn-green" wire:click="edit({{$item}})"><i class="fas fa-edit"></i></a>
                                    <a class="btn btn-red " wire:click="$emit('deletePost',{{$item->id}})"><i class="fas fa-trash"></i></a>
                                    
                            </td>
                        </tr>
                    @endforeach
                    </tr>
                </tbody>
            </table>
            @if ($posts->hasPages())
                <div class="px-6 py-3">
                    {{$posts->links()}}
                </div>            
            @endif
        @else
            <div class="px-6 py-4">
                No existe Ningun registroMotel Pegas
            </div>
        @endif
        </x-table>
    </div>


    <x-jet-dialog-modal wire:model="open_edit">
        <x-slot name="title">
            Editar el post {{$post->title}}
        </x-slot>  
        <x-slot name="content">
            <div wire:loading wire:tarjet="image" class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Cargando imagen</strong>
                <span class="block sm:inline">Espere hasta que la imagen halla cargando!!...</span>                
              </div>
            @if ($image)
                <img class="mb-4" src="{{$image->temporaryUrl()}}" alt=""> 
            @else
           {{--  {{$post->image}} --}}
           <img src="{{Storage::url($post->image)}}" alt="">   
              @if (!$existe)
              <img src="{{$post->image}}" alt="">       
              @endif
                        
                        

            @endif
            <div class="mb-4">
                <x-jet-label value="Titulo del post"/>
                <x-jet-input wire:model="post.title" type="text" class="w-full"/>
            </div>
            <div class="mb-4">
                <x-jet-label value="Contenido del post"/>
                <textarea wire:model="post.content" rows="6" class="form-control w-full"></textarea>
            </div>
            <div class="mb-4">
                <input type="file" wire:model='image' id="{{$identificador}}">
                <x-jet-input-error for="image"/>
            </div>
        </x-slot>  
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open_edit',false)">
                Cancelar
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click="update" wire:loading.attr="disbled" class="disabled:opacity-25">
                Actualizar
            </x-jet-danger-button>
        </x-slot>  
    </x-jet-dialog-modal>

    @push('js')
        <script src="sweetalert2.all.min.js"></script>
        <script>
            /* evento que de escucha solo cuando sea presionado el boton de eliminar */
            Livewire.on('deletePost',postId => {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        /* emitir componenete para que lo escucho mi componenete */
                        Livewire.emitTo('show-posts','delete',postId)
                        Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                        )
                    }
                    })
            })
        </script>
    @endpush
</div>
