<div class="flex items-center justify-between py-3 text-sm text-gray-500">
    {{-- Left --}}
    <div class="flex items-center space-x-7">
        {{-- Views --}}
        <livewire:posts.readers :post="$post" />
        
        {{-- Claps --}}
        <livewire:posts.clap-button :item="$post" wire:key="clap-button-{{ now() }}" />

        {{-- Comments --}}
        <a href="#comments" class="flex items-center space-x-2 cursor-pointer hover:text-white transition-all">
            <i class="ph-light ph-chat-teardrop-dots text-[1.40rem]"></i>
            <span>{{ number_format($post->comments->count()) }}</span>
        </a>
    </div>

    {{-- Right --}}
    <div class="flex items-center space-x-7">
        {{-- Collection --}}
        <livewire:posts.collection-button :post="$post" wire:key="user-collection-button-{{ now() }}" />
        
        {{-- Share --}}
        <livewire:posts.share-button :post="$post" />

        {{-- More Options --}}
        <livewire:posts.options :post="$post" />
    </div>
</div>