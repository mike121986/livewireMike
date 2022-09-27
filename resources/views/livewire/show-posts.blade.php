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
        <div class="px-6 py-4">
        <x-jet-input class="w-full" type="text" wire:model="search" placeholder="Escriba algo"/>
        </div>
        <x-table>
        @if ($posts->count())
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th
                            class="cursor-pointer px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500 tracking-wider">
                            ID
                        </th>
                        <th
                            class="cursor-pointer px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">
                            titulo</th>
                        <th
                            class="cursor-pointer px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 text-blue-500 tracking-wider">
                            Contenido</th>
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
                                class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-500 text-sm leading-5">
                                <button
                                    class="py-2 border-blue-500 border text-blue-500 rounded transition duration-300 hover:bg-blue-700 hover:text-white focus:outline-none">View
                                    Details</button>
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
