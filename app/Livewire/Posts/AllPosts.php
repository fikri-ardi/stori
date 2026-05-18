<?php

namespace App\Livewire\Posts;

use App\Models\Post;
use Livewire\Component;
use Livewire\Attributes\Title;

class AllPosts extends Component
{
    #[Title('Posts - Stori')]
    public function render()
    {

        return view('livewire.posts.all-posts', [
            'posts' => Post::paginate(20),
        ]);
    }
}
