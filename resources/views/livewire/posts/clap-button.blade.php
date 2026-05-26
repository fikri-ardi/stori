<div 
    x-data="{
        userClaps: $wire.entangle('userClaps'),
        itemId: {{ $item->id }}
    }" 

    class="relative flex items-center space-x-2 cursor-pointer">

    {{-- User's Claps Popups --}}
    <div 
        wire:ignore 
        x-ref="popup{{ $item->id }}" 
        class="absolute flex bottom-full bg-white size-8 rounded-full font-semibold text-black opacity-0">

        <span x-text="'+'+userClaps" class="m-auto"></span>
    </div>

    {{-- Clap Button --}}
    <i wire:click="clap()"
        @clapped.window="
        if ($event.detail.id == itemId) {
            $refs.popup{{ $item->id }}.classList.remove('animate-fadein');
            void $refs.popup{{ $item->id }}.offsetWidth;
            $refs.popup{{ $item->id }}.classList.add('animate-fadein');
        }
        "
        class="{{ $item->claps()->where('user_id', auth()->id())->exists() ? 'ph-fill' : 'ph-light' }} ph-hands-clapping text-[1.40rem] hover:text-white transition-all active:scale-110"></i>
    <span>{{ number_format($item->claps->sum('count')) }}</span>
</div>