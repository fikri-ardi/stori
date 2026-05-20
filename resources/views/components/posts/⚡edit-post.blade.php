<?php

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

new class extends Component
{
    use WithFileUploads;

    public Post $post;

    #[Validate('required|string|max:255')]
    public $title;

    #[Validate('required|string')]
    public $body;

    #[Validate('nullable|image|max:2048')]
    public $imageUpload;

    public $existingImages;

    public function mount(Post $post)
    {
        $this->post = $post;

        $this->fill(
            $post->only('title', 'body', 'excerpt', 'user_id')
        );

        $this->existingImages = $post->images;
    }

    public function updatedImageUpload()
    {
        $this->authorize('update', $this->post);

        $validatedImages = $this->validateOnly('imageUpload');

        if (! $this->imageUpload instanceof TemporaryUploadedFile) {
            return;
        }

        $oldImages = $this->post->images()->get();

        if ($oldImages->isNotEmpty()) {
            $this->post->images()->delete();
            Storage::delete($oldImages->pluck('url')->all());
        }

        $this->post->images()->create([
            'url' => $this->imageUpload->store(path: 'images/posts'),
        ]);

        $this->post->refresh();
        $this->existingImages = $this->post->images;
        $this->dispatch('post-is', message: "updated");
    }

    public function updating()
    {
        $this->dispatch('post-is', message: 'updating');
    }

    public function save($name, $value)
    {
        $this->authorize('update', $this->post);
        
        if (in_array($name, ['imageUpload', 'existingImages'], true)) {
            return;
        }
        
        $this->post->update([
            $name => $value,
            'excerpt' => str()->limit(strip_tags(Str::markdown($this->body)), 100, '...'),
        ]);

        $this->dispatch('post-is', message: "updated");
    }
    
    public function updated($name, $value)
    {
        $this->save($name, $value);
    }
};
?>

<div
    x-data="{
        resize($el) {
            $el.style.height = 'auto';
            $el.style.height = $el.scrollHeight + 'px';
        },
        uploading: false,
        progress: 0,
        uploadError: '',
        publishPostModal: false,
    }"
    class="px-48 mt-5 mb-96">

    <form
        wire:submit="prevent.default"
        @publish.window="publishPostModal = true, modalBackdrop = true"
        x-on:livewire-upload-start="uploading = true; progress = 0; uploadError = ''"
        x-on:livewire-upload-finish="uploading = false"
        x-on:livewire-upload-cancel="uploading = false"
        x-on:livewire-upload-error="uploading = false; uploadError = 'Something went wrong during the upload.'"
        x-on:livewire-upload-progress="progress = $event.detail.progress"
    >

        {{-- Banner --}}
        <div class="relative flex items-center border border-dashed border-gray-500 mb-4 h-96 w-full rounded-4xl">
            @if ($imageUpload instanceof TemporaryUploadedFile)
                @if (in_array(strtolower($imageUpload->getClientOriginalExtension()), ['png', 'jpg', 'jpeg', 'webp', 'gif'], true))
                <img src="{{ $imageUpload->temporaryUrl() }}" class="img-fluid rounded-4xl w-full h-96 object-cover object-center absolute">
                @endif
            @elseif ($existingImages?->first())
            <img src="{{ config('app.url') . '/' . $existingImages->first()->url }}" class="block img-fluid rounded-lg w-full h-full object-cover object-center absolute">
            @endif

            <label for="images" class="absolute w-full text-center text-gray-300 text-sm">
                <span class="px-3 py-2 bg-black/60 rounded-xl backdrop-blur-2xl">Add a preview image</span>
            </label>

            <input
                type="file"
                id="images"
                wire:model="imageUpload"
                accept="image/png,image/jpeg,image/webp,image/gif"
                class="focus:outline-none border-l border-gray-700 pl-4 opacity-0 size-full cursor-pointer bg-red-500"
            >

            @error('imageUpload')
            <div x-transition class="absolute top-full left-1/2 -translate-x-1/2 text-sm px-3 py-2 bg-black/50 rounded-b-lg text-nowrap">{{ $message }}</div>
            @enderror
        </div>


        <div x-show="uploading">
            <progress max="100" x-bind:value="progress"></progress>
            <div x-text="progress"></div>
        </div>

        {{-- Title --}}
        <div class="flex">
            <label for="title" class="mr-4 text-gray-500 text-sm">Title</label>
            <textarea wire:ignore type="text" id="title" wire:model.live.debounce.1000ms="title" placeholder="Title" rows="1"
                x-init="
                $watch('title', () => $nextTick(() => resize($el)));
                $nextTick(() => resize($el));
                "
                @input="resize($el)"
                class="text-4xl font-semibold focus:outline-none w-full resize-none border-l border-gray-700 pl-4 leading-12">
            </textarea>
        </div>
        <x-partials.input-error field="title" class="ml-16" />

        {{-- Body --}}
        <div class="ml-16 mt-4">
            <x-form.input.editor wire:model.live.debounce.1000ms="body" />
            <x-partials.input-error field="body" />
        </div>
    </form>

    <livewire:posts.publish-modal :key="$post->id.time()" :$post :$title :excerpt="str()->limit(strip_tags($this->body), 100, '...')" :$existingImages />
</div>
