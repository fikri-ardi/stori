<?php

use App\Models\Post;
use Livewire\Attributes\Validate;
use Livewire\Component;

new class extends Component
{
    public Post $post;

    public $title;
    
    public $body;

    public $slug;

    public $excerpt;

    public $existingImages;
    
    public $name;

    public function update()
    {
        $this->authorize('update', $this->post);

       if (!$this->post->title || !$this->post->body) {
            $dispatch('notif', ['message' => 'Please fill in the required fields.']);
            return;
        }
        
        $this->post->update([
                'slug' => str()->slug($this->title).'-'.$this->post->id,
                'is_published' => true,
            ]
        );

        $this->redirectRoute('posts.show', $this->post, navigate: true);
    }
};
?>

<div 
    x-show="publishPostModal"
    class="fixed flex inset-0 z-50">

    <div
        x-show="publishPostModal"
        x-transition
        @mousedown.outside="modalBackdrop = false, publishPostModal = false" 
        class="relative m-auto w-4/5 h-6/7 bg-black/90 rounded-4xl p-10">

        <h3 class="text-xl mb-7">Story Preview</h3>

        {{-- Back button --}}
        <button 
            @click="publishPostModal = false, modalBackdrop = false" 
            class="absolute top-0 right-0 text-white hover:text-gray-300 bg-white/5 px-3 py-1.5 rounded-2xl flex items-center space-x-1 text-sm cursor-pointer m-4">

            <i class="ph-light ph-arrow-left"></i>
            <span>Back</span>
        </button>

        <div class="flex justify-between space-x-20">
            <div class="w-full">
                {{-- Banner preview --}}
                @if ($existingImages?->first())
                <img src="{{ config('app.url').$existingImages->first()->url }}" class="img-fluid rounded-3xl w-full h-56 object-cover object-center">
                @else
                <div class="flex items-center justify-content-center w-full h-56 bg-white/5 rounded-3xl">
                    <div class="text-sm p-20 leading-relaxed text-gray-400">Include a high-quality image in your story to make it more inviting to readers.</div>
                </div>
                @endif

                {{-- Title preview --}}
                <h1 class="font-semibold my-5">{{ $title }}</h1>
                {{-- Excerpt preview --}}
                <p class="text-gray-400">{{ $excerpt }}</p>
            </div>
            <div class="w-full flex flex-col space-y-14">
                {{-- Tags --}}
                <div class="flex flex-col space-y-2">
                    <div>Tags</div>
                    <label for="tags" class="text-sm text-gray-400">Add up to five topics to help readers find your story.</label>
                    <input type="text" 
                        wire:model.debounce.500ms="name"
                        class="p-3 rounded-xl bg-white/5 w-full focus:outline-none"
                    >
                </div>

                {{-- Publication --}}
                <div class="flex flex-col space-y-2">
                    <div>Publication</div>
                    <label for="publication" class="text-sm text-gray-400">Select when you want to publish your story.</label>
                </div>

                {{-- Notif to subscribers --}}
                <div class="flex flex-col space-y-2">
                    <div class="flex items-center w-fit space-x-2">
                        <input type="checkbox" class="size-4" checked>
                        <label class="text-nowrap">Notify Subscribers</label>
                    </div>
                    <div class="text-sm text-gray-400">Check this box to notify your subscribers about your new story.</div>
                </div>

                {{-- Publish button --}}
                <div class="flex items-center space-x-3 text-xs">
                    <button 
                        wire:click="update"
                        class="px-5 py-2 cursor-pointer bg-white text-black rounded-full font-semibold">Publish</button>
                    <button class="underline cursor-pointer">Schedule for later</button>
                </div>
            </div>
        </div>
    </div>
</div>