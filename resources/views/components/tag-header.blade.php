@props(['tags'])

<div class="flex items-center space-x-2 overflow-x-scroll whitespace-nowrap no-scrollbar">
    <a wire:navigate href="{{ route('tags.index') }}" 
    class="py-2 pl-2 pr-4 text-sm rounded-full bg-gray-800 flex items-center space-x-2 mr-6 fill-gray-200{{ request()->url() == route('tags.index') ? ' border border-gray-200 fill-gray-800' : '' }}">
        <i class="{{ request()->url() == route('tags.index') ? 'ph-fill' : 'ph-light' }} ph-compass text-2xl"></i>
        <span>Explore topics</span>
    </a>
    
    @foreach ($tags->take(15) as $tag)
    <a wire:navigate wire:key="{{ $tag->id }}" href="{{ route('tags.show', $tag->slug) }}"
        class="py-2.5 px-4 text-sm rounded-full bg-gray-800{{ request()->url() == route('tags.show', $tag->slug) ? ' border border-gray-200' : '' }}">
        {{ ucwords($tag->name) }}
    </a>
    @endforeach
</div>