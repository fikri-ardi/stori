<?php

use App\Models\Post;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

new class extends Component
{
    #[Validate('required|string|min:3')]
    public $title = '';

    #[Validate('required|string|min:3')]
    public $body = '';
    
    public $slug = '';

    public $postCreated = false;

    public function updated($property)
    {
        $this->validateOnly($property);

        if (!$this->postCreated && ($this->title || $this->body)) {
        $this->postCreated = true;
        
        $post = auth()->user()->posts()->create([
        'title' => $this->title,
        'body' => $this->body,
        'slug' => time(),
        ]);
        
        return $this->redirectRoute('posts.edit', $post, navigate: true);
        }
    }
};
?>

<div class="px-44 mt-5">
    <form wire:submit="create">
        {{-- Post title --}}
        <div>
            <div class="flex">
                <label for="title" class="mr-4 text-gray-500 text-sm">Title</label>
                <textarea type="text" id="title" wire:model.live.debounce.500ms="title" placeholder="Title" autofocus rows="1" class="text-4xl font-semibold focus:outline-none w-full resize-none border-l border-gray-700 pl-4"
                x-data x-on:input="
                $el.style.height = 'auto';
                $el.style.height = $el.scrollHeight + 'px';"></textarea>
            </div>
        </div>
        <div class="flex mt-4 bg-red-500">
            <textarea wire:ignore type="text" id="body" wire:model.live.debounce.500ms="body" placeholder="Tell your story..." autofocus rows="1" class="focus:outline-none w-full resize-none ml-16 text-lg" 
            x-data x-on:input="
            $el.style.height = 'auto';
            $el.style.height = $el.scrollHeight + 'px';"></textarea>
        </div>
    </form>
</div>