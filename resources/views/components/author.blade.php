@props(['author'])

<div class="flex items-center space-x-3">
    <a href="{{ route('users.show', $author) }}" class="w-10 h-10 rounded-full overflow-hidden hover:opacity-50 transition-all">
        <img src="{{ $author->image->url }}" alt="Foto penulis">
    </a>
    <a href="{{ route('users.show', $author) }}" class="flex text-sm text-gray-300 hover:underline transition-all">
        <div class="text-white">{{ $author->name }}</div>
    </a>
</div>