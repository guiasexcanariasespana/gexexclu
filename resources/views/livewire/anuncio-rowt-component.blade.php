<div>
    <button class=" btn btn-sm @if($anuncio->verificacion == 'Si') btn-success @else btn-secondary @endif "
        wire:click='verifico_si'>O</button>
    <button class="btn btn-sm @if($anuncio->verificacion == 'Rechazado') btn-danger @else btn-secondary @endif "
        wire:click='verifico_rechazo'>x</button>
</div>
