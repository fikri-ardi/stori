@props(['tags'])

<div class="flex items-center space-x-2 overflow-x-scroll whitespace-nowrap no-scrollbar">
    <a wire:navigate href="{{ route('tags.index') }}" 
    class="py-2 pl-2 pr-4 text-sm rounded-full border border-white/10 bg-white/[0.045] text-gray-300 transition hover:border-white/20 hover:bg-white/[0.075] hover:text-white flex items-center space-x-2 mr-6 fill-gray-200{{ request()->url() == route('tags.index') ? ' border-white/35 bg-white/[0.1] text-white fill-white' : '' }}">
        <i class="{{ request()->url() == route('tags.index') ? 'ph-fill' : 'ph-light' }} ph-compass text-2xl"></i>
        <span>Explore topics</span>
    </a>
    
    @foreach ($tags->take(15) as $tag)
    <a wire:navigate wire:key="{{ $tag->id }}" href="{{ route('tags.show', $tag->slug) }}"
        class="py-2.5 px-4 text-sm rounded-full border border-white/10 bg-white/[0.045] text-gray-300 transition hover:border-white/20 hover:bg-white/[0.075] hover:text-white{{ request()->url() == route('tags.show', $tag->slug) ? ' border-white/35 bg-white/[0.1] text-white' : '' }}">
        {{ ucwords($tag->name) }}
    </a>
    @endforeach
</div>
