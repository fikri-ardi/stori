<div>
    <div class="text-center mb-14 my-10">
        <h1 class="text-5xl font-semibold mb-4">From the blog</h1>
        <p>Learn how to grow your business with our expert advice.</p>
    </div>
    <div class="mx-auto flex max-w-4xl flex-col">
        @foreach ($posts as $post)
        <x-post wire:key="{{ $post->id }}" :$post />
        @endforeach
    </div>
</div>
