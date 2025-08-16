<div>
    @if ($showDiv)
        <a class="btn btn-secondary btn-sm ml-4" wire:click.prevent="$toggle('showDiv')">
            No</a>
        <a class="btn btn-danger btn-sm ml-4" wire:click.prevent="destroy({{$anuncio->id}})">
            Si</a>
    @else
        <a class="btn btn-danger btn-sm ml-4" wire:click.prevent="$toggle('showDiv')">
            Eliminar</a>
    @endif
</div>
