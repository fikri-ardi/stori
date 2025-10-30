<x-layouts.app title="Posts" header="From the blog">
    <div class="text-center mb-14 my-10">
        <h1 class="text-5xl font-semibold mb-4">From the blog</h1>
        <p>Learn how to grow your business with our expert advice.</p>
    </div>
    <div class="flex flex-wrap justify-between space-y-10">
        @foreach ($posts as $post)
        <x-post :$post />
        @endforeach
    </div>
</x-layouts.app>