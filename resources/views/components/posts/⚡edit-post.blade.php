<?php

use App\Models\Post;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

new class extends Component
{
    public Post $post;

    #[Validate('required|string|max:255')]
    public $title;

    #[Validate('required|string')]
    public $body;
    
    public function mount(Post $post)
    {
        $this->post = $post;
        $this->title = $post->title;
        $this->body = $post->body;
    }
    
    public function updated($name, $value)
    {
        $this->post->update([
        $name => $value,
        ]);
    }
    
};
?>

<div 
    x-data="{ 
        resize($el) { 
            $el.style.height = 'auto'; 
            $el.style.height = $el.scrollHeight + 'px'; 
        }
    }"
    class="px-44 mt-5">
    <form wire:submit="create">
        {{-- Post title --}}
        <div class="flex">
            <label for="title" class="mr-4 text-gray-500 text-sm">Title</label>
            <textarea wire:ignore type="text" id="title" wire:model.live.debounce.500ms="title" placeholder="Title" rows="1"
                x-init="
                // Gunakan $watch untuk memantau saat 'body' terisi data dari Livewire
                $watch('title', () => $nextTick(() => resize($el)));
                // Jalankan sekali saat init setelah Alpine siap
                $nextTick(() => resize($el));
                "
                @input="resize($el)"
                class="text-4xl font-semibold focus:outline-none w-full resize-none border-l border-gray-700 pl-4">
            </textarea>
        </div>
        <div 
        class="flex mt-4">
            <textarea wire:ignore type="text" id="body" wire:model.live.debounce.500ms="body" placeholder="Tell your story..." rows="1"
                x-init="
                // Gunakan $watch untuk memantau saat 'body' terisi data dari Livewire
                $watch('body', () => $nextTick(() => resize($el)));
                // Jalankan sekali saat init setelah Alpine siap
                $nextTick(() => resize($el));
                "
                @input="resize($el)"
                class="focus:outline-none w-full block resize-none ml-16 text-lg">
            </textarea>
        </div>
    </form>
</div>