<?php

use App\Models\Post;
use Livewire\Attributes\Validate;
use Livewire\Component;

new class extends Component
{
    #[Validate('required')]
    public $name;

    public $postId;

    public function create()
    {
        $this->validate();
        $collection = auth()->user()->collections()->create([
            'name' => $this->name,
        ]);
        Post::find($this->postId)->collections()->attach($collection->id);
        $this->name = '';
        $this->dispatch('collection-created');
    }
};
?>

<div>
    <template x-teleport="body">
        <div
        x-show="openCreateCollectionModal"
        x-transition
        @mousedown.outside="closeModal()"
        @collection-created.window="closeModal()"
        class="fixed left-1/2 top-1/2 -translate-1/2 w-5/12 bg-black/70 z-[999] text-gray-200 p-10 rounded-4xl"
        >
            <h1 class="text-3xl font-bold">Create New Collection</h1>
            <form wire:submit="create" class="mt-10">
                <div>
                    <input 
                    wire:model.live="name"
                    type="text" name="collection" id="collection" placeholder="Give it a name"
                    class="px-5 py-2 rounded-full bg-white/5 w-full focus:outline-none focus:ring focus:ring-white/15">
                    <x-partials.input-error field="name" />
                </div>

                <div class="flex items-center space-x-3 mt-5">
                    <button
                    type="button"
                    @mousedown="openCreateCollectionModal = false, modalBackdrop = false"
                     class="mt-5 px-3 py-2 text-sm rounded-full border border-white/20 hover:bg-white/10 transition cursor-pointer">
                        Cancle
                    </button>
                    
                    <button type="submit" class="mt-5 px-3 py-2 text-sm bg-indigo-500 rounded-full hover:bg-indigo-500 transition cursor-pointer">
                        Create
                    </button>
                </div>
            </form>
        </div>
    </template>
</div>