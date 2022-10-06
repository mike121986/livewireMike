<div>
    <a class="btn btn-green" wire:click="$set('open',true)"><i class="fas fa-edit"></i></a>

    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            Editar el post {{$post->title}}
        </x-slot>  
        <x-slot name="content">
            <div class="mb-4">
                <x-jet-label value="Titulo del post"/>
                <x-jet-input wire:model="post.title" type="text" class="w-full"/>
            </div>
            <div class="mb-4">
                <x-jet-label value="Contenido del post"/>
                <textarea wire:model="post.content" rows="6" class="form-control w-full"></textarea>
            </div>
        </x-slot>  
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open',false)">
                Cancelar
            </x-jet-secondary-button>
            <x-jet-danger-button wire:click="save" wire:loading.attr="disbled" class="disabled:opacity-25">
                Actualizar
            </x-jet-danger-button>
        </x-slot>  
    </x-jet-dialog-modal>
</div>
