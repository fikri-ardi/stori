<?php

use App\Models\Post;
use App\Models\Tag;
use Livewire\Component;

new class extends Component
{
    public Post $post;
    
    public $tagName;
    public $tags;
    public $suggestions;

    public function updated($name, $value)
    {
        if ($name === 'tagName' && $this->tagName != '') {
            $this->suggestions = Tag::where('name', 'like', "%{$this->tagName}%")
                ->limit(5)
                ->get(['id', 'name']);
        }
    }

    public function removeTag($tagId)
    {
        $tag = Tag::find($tagId);

        if ($tag && $this->post->tags->contains($tag->id)) {
            $this->post->tags()->detach($tag);
            $this->post->refresh();
            $this->tags = $this->post->tags;
        }
    }
    
    public function addTag($selectedTagId)
    {
        $tag = Tag::find($selectedTagId);

        if ($tag && ! $this->post->tags->contains($tag->id) && $this->post->tags()->count() < 5) {
            $this->post->tags()->attach($tag);
            $this->post->refresh();
            $this->tags = $this->post->tags;
            $this->tagName = '';
            $this->suggestions = null;
        }
    }
};
?>

<div class="flex flex-col space-y-2">
    <div>Tags</div>
    <label for="tags" class="text-sm text-gray-400">Add up to five topics to help readers find your story.</label>
    <div class="relative flex gap-3 items-center p-3 rounded-xl bg-white/5 w-full text-sm flex-wrap">
        {{-- Selected tag --}}
        @if ($post->tags)
        <div class="flex items-center gap-2 flex-wrap">
            @foreach ($post->tags as $tag)
            <span 
                wire:key="{{ $tag->id }}"
                class="inline-flex items-center space-x-2 bg-black/50 rounded-full pl-4 pr-3 py-1.5 text-sm text-nowrap">
                <span>{{ $tag->name }}</span>
                <button wire:click="removeTag({{ $tag->id }})" class="flex items-center text-gray-400 hover:text-gray-200 cursor-pointer">
                    <i class="ph-light ph-x"></i>
                </button>
            </span>
            @endforeach
        </div>
        @endif

        {{-- Tag input --}}
        <input type="text" wire:model.live.debounce.500ms="tagName" class="w-auto focus:outline-none" placeholder="Add a tags">

        {{-- Tag suggestions --}}
        @if ($suggestions !== null && $suggestions->isNotEmpty())
        <div 
            x-show="$wire.tagName != ''"
            class="absolute z-50 top-full left-0 w-1/2 mt-1 bg-black/5 backdrop-blur-lg border border-white/5 rounded-xl p-3">
            <div class="text-gray-400">
                @foreach ($suggestions ?? [] as $suggestion)
                <div
                    wire:key="{{ $suggestion->id }}"
                    wire:click="addTag({{ $suggestion->id }})"
                    class="p-1 hover:text-white cursor-pointer">{{ $suggestion->name }}
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>