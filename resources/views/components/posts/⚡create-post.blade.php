<?php

use App\Models\Post;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Traits\HandlesFileUpload;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

new class extends Component
{
    use WithFileUploads;
    use HandlesFileUpload;
    
    public ?Post $post;
    
    #[Validate('required|string|min:3')]
    public $title = '';

    #[Validate('required|string|min:3')]
    public $body = '';
    
    public $slug = '';

    public $images;

    public $excerpt;

    public $postCreated = false;

    public function updated($property)
    {
        $this->validateOnly($property);

        if (!$this->postCreated && ($this->title || $this->body || $this->images)) {
            
        $this->excerpt = str()->limit(strip_tags($this->body), 100, '...');
        $this->slug = time();
        $this->post = auth()->user()->posts()->create(
            $this->all()
        );

       $this->upload('images', 'post', 'images/posts');

        $this->postCreated = true;
        
        return $this->redirectRoute('posts.edit', $this->post, navigate: true);
        }
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
    x-on:livewire-upload-error="console.log('error' + $event.detail.message)"
    class="px-44 mt-5">
    <form wire:submit="create">
        {{-- Banner input --}}
        <div class="relative flex items-center border border-dashed border-gray-500 mb-4 h-96 w-full rounded-4xl">
            @if ($images instanceof TemporaryUploadedFile )
                @if ($images->getClientOriginalExtension() == "png" || "jpg")
                <img src="{{ $images->temporaryUrl() }}" class="img-fluid rounded-4xl w-full h-96 object-cover object-center absolute">
                @endif
            @endif
            <label for="images" class="absolute w-full text-center text-gray-500 text-sm">
                <span class="px-3 py-2 bg-black/50 rounded-xl backdrop-blur-2xl">Add a preview image</span>
            </label>
            <input type="file" id="images" wire:model.live="images" class="focus:outline-none border-l border-gray-700 pl-4 opacity-0 size-full cursor-pointer bg-red-500">
            @error('images')
            <div x-transition class="absolute top-full left-1/2 -translate-x-1/2 text-sm px-3 py-2 bg-black/50 rounded-b-lg text-nowrap">{{ $message }}</div>
            @enderror
        </div>
        
        {{-- Post title --}}
        <div>
            <div class="flex">
                <label for="title" class="mr-4 text-gray-500 text-sm">Title</label>
                <textarea type="text" id="title" wire:model.live.debounce.1000ms="title" placeholder="Title" autofocus rows="1" class="text-4xl font-semibold focus:outline-none w-full resize-none border-l border-gray-700 pl-4"
                x-init="
                // Gunakan $watch untuk memantau saat 'body' terisi data dari Livewire
                $watch('title', () => $nextTick(() => resize($el)));
                // Jalankan sekali saat init setelah Alpine siap
                $nextTick(() => resize($el));
                "
                @input="resize($el)"
                >
            </textarea>
            </div>
        </div>

        {{-- Post body --}}
        <div class="flex mt-4">
            <textarea wire:ignore type="text" id="body" wire:model.live.debounce.1000ms="body" placeholder="Tell your story..." autofocus rows="1" class="focus:outline-none w-full resize-none ml-16 text-lg" 
            x-init="
                // Gunakan $watch untuk memantau saat 'body' terisi data dari Livewire
                $watch('body', () => $nextTick(() => resize($el)));
                // Jalankan sekali saat init setelah Alpine siap
                $nextTick(() => resize($el));
                "
                @input="resize($el)"
            >
        </textarea>
        </div>
    </form>
</div>