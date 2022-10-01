<div>
    {{-- metodo magico "$set('nombre de atributo a cmabiar','el valor a cambiar')" --}}
    <x-jet-danger-button wire:click="$set('open',true)">
        crear nuevo Post
    </x-jet-danger-button>

    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            Crear nuevo Post
        </x-slot>
        <x-slot name="content">
            <div class="mb-a">
                <x-jet-label value="Titulo del Post"/>   
                {{-- wire:model.defer no ayuda a no renderizar la vista por cada cosa que escribamos --}} 
                <x-jet-input type="text" class="w-full" wire:model.defer='title'/>
            </div>
            <x-jet-input-error for="title"/>
            <div class="mb-4">    
                <x-jet-label value="Contenido del Post"/>
                <textarea name="" id="" class="form-control w-full " wire:model.defer='content' rows="6"></textarea>
            </div>
            <x-jet-input-error for="content"/>
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open',false)">Cancelar</x-jet-secondary-button>
            <x-jet-danger-button wire:click="save"  wire:loading.attr="disabld" wire:tarjet="save" class="disabled:opacity-25">Crear Post</x-jet-danger-button>
            {{-- <span wire:loading wire:tarjet="save">Cargando...</span> --}}
        </x-slot>
    </x-jet-dialog-modal>
</div>
