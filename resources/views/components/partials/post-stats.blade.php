<div class="flex items-center justify-between py-4 text-sm text-gray-500">
    <div class="flex items-center space-x-7">
        {{-- Claps --}}
        <button x-data="{userClaps: $wire.entangle('userClaps')}" x-on:post-clapped.window="
                $refs.popup.classList.remove('animate-fadein');
                void $refs.popup.offsetWidth;
                $refs.popup.classList.add('animate-fadein');
                " class="relative flex items-center space-x-2 cursor-pointer">

            {{-- User's Claps Popups --}}
            <div wire:ignore x-ref="popup" class="absolute flex bottom-full bg-white size-8 rounded-full font-semibold text-black opacity-0">
                <span x-text="'+'+userClaps" class="m-auto"></span>
            </div>

            {{-- Clap Button --}}
            <i wire:click="clap"
                class="{{ $post->claps()->where('user_id', auth()->id())->exists() ? 'ph-fill' : 'ph-light' }} ph-hands-clapping text-2xl hover:text-white transition-all active:scale-110"></i>
            <span>{{ number_format($post->claps->sum('count')) }}</span>
        </button>
        {{-- Comments --}}
        <a href="#comments" class="flex items-center space-x-2 cursor-pointer">
            <i class="ph-light ph-chat-teardrop-dots text-2xl"></i>
            <span>{{ number_format($post->comments->count()) }}</span>
        </a>
    </div>

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