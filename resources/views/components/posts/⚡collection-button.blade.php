<?php

use App\Models\Post;
use Livewire\Component;
use App\Models\Collection;
use Livewire\Attributes\On;

new class extends Component
{
    public $postId;
    public $isCollected;

    public function mount(Post $post){
        $this->postId = $post->id;
        
        if (auth()->check()) {
        $this->isCollected = auth()->user()
        ->collections()
        ->whereHas('posts', fn ($q) =>
        $q->where('posts.id', $this->postId)
        )
        ->exists();
        }
    }

    #[On('collection-updated')]
    public function refreshUserCollection(){
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
            }
            $this->dispatch('collection-updated');
        }else{
            $this->dispatch('open-login-modal');
        }
    }

    public function toggleCollection($collectionId)
    {
        $collection = Collection::find($collectionId);
        if ($collection->posts->contains($this->postId)) {
            $collection->posts()->detach($this->postId);
            $this->dispatch('collection-updated');
            } else {
            $collection->posts()->syncWithoutDetaching($this->postId);
            $this->dispatch('collection-updated');
        }
    }
};
?>

<div 
x-data="{openUserCollectionModal: false, openCreateCollectionModal: true}" 
class="relative">

    {{-- Post collection button --}}
    <button 
        @auth
        @click="openUserCollectionModal = true"
        @endauth
        wire:click="addToCollection" type="button" class="cursor-pointer">
        <i class="{{ $isCollected ? 'ph-fill' : 'ph-light' }} ph-bookmark-simple text-[1.40rem]"></i>
    </button>

    {{-- user collection modal --}}
    <div 
    wire:key="user-collection-modal-{{ $this->getId() }}"
    x-show="openUserCollectionModal"
    @mousedown.outside="openUserCollectionModal = false" 
    x-transition
    class="absolute min-w-60 bg-black/90 backdrop-blur-lg rounded-2xl top-full mt-2 left-1/2 -translate-x-1/2 z-50">
    
        {{-- User Collection List --}}
        @if (auth()->user() && auth()->user()->collections()->exists())
        <div class="p-6 flex flex-col space-y-4 text-sm">
            @foreach (auth()->user()->collections->sortDesc() as $collection)
                <div 
                class="flex items-center space-x-3 text-white">

                    <input
                    wire:key="collection-list-{{ $collection->id.now() }}" 
                    type="checkbox" name="collection" id="{{ $collection->id }}"
                    wire:click="toggleCollection({{ $collection->id }})"
                    {{ $collection->posts->contains($postId) ? 'checked' : '' }}
                    class="w-4 h-4 text-indigo-400 bg-gray-800 border-gray-600 rounded focus:ring-indigo-500 cursor-pointer">

                    <label for="{{ $collection->id }}">{{ ucwords($collection->name) }}</label>
                </div>
            @endforeach
        </div>
        @endif
        
        <div 
        x-data="{ 
            openCreateCollectionModal: false,
            closeModal(){
                this.openCreateCollectionModal = false
                this.modalBackdrop = false
            },
            showModal(){
                this.openCreateCollectionModal = true
                this.modalBackdrop = true
            }
         }"
        @click="showModal()"
        class="flex items-center text-base space-x-2 text-white py-5 px-7 border-t border-gray-900 cursor-pointer">
            <div class="text-indigo-400">Create new collection</div>
            <livewire:posts.create-collection :$postId />
        </div>
    </div>
</div>