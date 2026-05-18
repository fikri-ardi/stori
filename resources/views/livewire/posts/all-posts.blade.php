<div>
    <div class="text-center mb-14 my-10">
    </div>
    <div class="mx-auto flex max-w-4xl flex-col">
        @foreach ($posts as $post)
        <x-post wire:key="{{ $post->id }}" :$post />
        @endforeach
    </div>
</div>
