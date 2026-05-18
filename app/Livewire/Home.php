<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\Tag;
use Livewire\Attributes\Title;
use Livewire\Component;

class Home extends Component
{

    #[Title('Stori')]
    public function render()
    {
        $posts = Post::with(['author.image', 'images', 'claps', 'comments'])
            ->latest()
            ->take(12)
            ->get();

        $popularPosts = Post::with(['author.image'])
            ->withCount(['visitors', 'comments'])
            ->withSum('claps', 'count')
            ->orderByDesc('visitors_count')
            ->latest()
            ->take(5)
            ->get();

        $topics = Tag::withCount('posts')
            ->orderByDesc('posts_count')
            ->take(8)
            ->get();

        $readingList = auth()->check()
            ? auth()->user()
                ->collections()
                ->where('name', 'reading list')
                ->with(['posts' => fn ($query) => $query->with(['author.image'])->latest('posts.created_at')->take(5)])
                ->first()
            : null;

        return view('livewire.home', compact('posts', 'popularPosts', 'topics', 'readingList'));
    }
}
