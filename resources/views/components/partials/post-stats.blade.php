<div class="flex items-center justify-between py-4 text-sm text-gray-500">
    {{-- Left --}}
    <div class="flex items-center space-x-7">
        {{-- Claps --}}
        <livewire:posts.clap-button :item="$post" wire:key="{{ now() }}" />

        {{-- Comments --}}
        <a href="#comments" class="flex items-center space-x-2 cursor-pointer">
            <i class="ph-light ph-chat-teardrop-dots text-2xl"></i>
            <span>{{ number_format($post->comments->count()) }}</span>
        </a>
    </div>

    {{-- Right --}}
    <div class="flex items-center space-x-7">
        {{-- Bookmark --}}
        <button type="button" class="cursor-pointer">
            <i class="ph-light ph-bookmark-simple text-2xl"></i>
        </button>

        {{-- Share --}}
        <button type="button" class="cursor-pointer">
            <i class="ph-light ph-export text-2xl"></i>
        </button>

        {{-- More Options --}}
        <button type="button" class="cursor-pointer">
            <i class="ph-light ph-dots-three text-2xl"></i>
        </button>
    </div>
</div>