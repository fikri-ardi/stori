<?php

use App\Models\Post;
use Livewire\Component;
use App\Models\Collection;

new class extends Component
{
    public $postId;
    public $isCollected;

    protected $listeners = ['collection-updated' => '$refresh'];

    public function mount(Post $post){
        $this->postId = $post->id;

        $this->isCollected();;
    }

    public function isCollected(){
        if (auth()->check()) {
        $this->isCollected = auth()->user()
        ->collections()
        ->whereHas('posts', fn ($q) =>
        $q->where('posts.id', $this->postId)
        )
        ->exists();
        }
    }
    
    public function addToCollection()
    {
        if (auth()->check()) {
           if ($this->isCollected == false) {
            $readingListCollection = auth()->user()->collections()
            ->where('name', 'reading list')
            ->first();
            
            if (! $readingListCollection) {
            $readingListCollection = auth()->user()->collections()
            ->create(['name' => 'reading list']);
            }
            
            $readingListCollection->posts()->syncWithoutDetaching($this->postId);
            $this->isCollected();
           }
        }else{
            $this->dispatch('open-login-modal');
        }
    }

    public function toggleCollection($collectionId)
    {
        $collection = Collection::find($collectionId);
        if ($collection->posts->contains($this->postId)) {
            $collection->posts()->detach($this->postId);
            $this->isCollected();
            } else {
            $collection->posts()->syncWithoutDetaching($this->postId);
            $this->isCollected();
        }
    }
};
?>

<div 
x-data="{openPostCollectionModal: false}"
class="relative">
    {{-- Post collection button --}}
    <button 
    @auth
    @click="openPostCollectionModal = true"
    @endauth
    wire:click="addToCollection" type="button" class="cursor-pointer">
    <i class="{{ $isCollected ? 'ph-fill' : 'ph-light' }} ph-bookmark-simple text-2xl"></i>
    </button>

    {{-- Post collection modal --}}
    <div 
    x-show="openPostCollectionModal"
    x-transition
    @click.outside="openPostCollectionModal = false"
    class="absolute w-75 bg-black/90 backdrop-blur-lg rounded-2xl top-full mt-2 left-1/2 -translate-x-1/2">

    <div class="p-7 flex flex-col space-y-4">
        @foreach (auth()->user()->collections->sortDesc() as $collection)
            <div wire:key="collection-list-{{ now() }}" class="flex items-center text-base space-x-2 text-white">
                <input type="checkbox" name="collection" id="{{ $collection->id }}"
                {{ $collection->posts->contains($postId) ? 'checked' : '' }}
                wire:click="toggleCollection({{ $collection->id }})"
                class="w-4 h-4 text-indigo-400 bg-gray-800 border-gray-600 rounded focus:ring-indigo-500 cursor-pointer">
                <label for="{{ $collection->id }}">{{ ucwords($collection->name) }}</label>
            </div>
        @endforeach
    </div>
    
    <div class="flex items-center text-base space-x-2 text-white px-7 py-5 border-t border-gray-900 cursor-pointer">
        <div class="text-indigo-400">Create new collection</div>
    </div>
    </div>
</div>