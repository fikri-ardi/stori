@props(['author'])

<div {{ $attributes->merge(['class' => 'flex items-center space-x-3']) }}>
    <a wire:navigate href="{{ route('users.show', $author) }}" class="w-10 h-10 rounded-full overflow-hidden hover:opacity-50 transition-all">
        {{-- <img src="{{ $author->image->url }}" alt="Foto penulis"> --}}
        @if ($author->image != null)
        <img src="{{ $author->image->url }}" alt="" class="" />
        @else
        <div class="relative text-gray-900 bg-white size-full flex rounded-full font-semibold uppercase text-xl">
            <span class="m-auto">{{ $author->initials() }}</span>
        </div>
        @endif
    </a>
    <a wire:navigate href="{{ route('users.show', $author) }}" class="flex text-sm text-gray-300 hover:underline transition-all">
        <div class="text-white">{{ ucwords($author->name) }}</div>
    </a>
</div>