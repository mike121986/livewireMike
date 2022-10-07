<div>
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
        <x-jet-input class="flex-1 mr-4" type="text" wire:model="search" placeholder="Escriba algo"/>
        @livewire('create-post')
        </div>
        <x-table>
        @if ($posts->count())
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
                    @foreach ($posts as $post)
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                <div class="flex items-center">
                                    <div>
                                        <div class="text-sm leading-5 text-gray-800">{{$post->id}}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500">
                                <div class="text-sm leading-5 text-blue-900">{{$post->title}}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap border-b text-blue-900 border-gray-500 text-sm leading-5">
                                {{$post->content}}
                            </td>
                            <td
                                class="px-6 py-4 whitespace-no-wrap  border-b border-gray-500 text-sm leading-5">
                                {{-- <button
                                    class="py-2 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-blue-700 hover:text-white focus:outline-none">View
                                    Details</button> 
                                    @livewire('edit-post', ['post' => $post], key($post->id))--}}
                                    <a class="btn btn-green" wire:click="edit({{$post}})"><i class="fas fa-edit"></i></a>
                                    
                            </td>
                        </tr>
                    @endforeach
                    </tr>
                </tbody>
            </table>
        @else
            <div class="px-6 py-4">
                No existe Ningun registro
            </div>
        @endif
        </x-table>

    </div>
</div>
