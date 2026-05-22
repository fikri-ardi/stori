<?php

namespace App\Livewire\Posts;

use App\Models\Post;
use Livewire\Attributes\On;
use Livewire\Component;

class ShowPost extends Component
{
    public Post $post;
    public $reading_time;

    public function mount()
    {
        $this->reading_time = ceil(str($this->post->body)->wordCount() / 200);
    }

    public function render()
    {
        return view('livewire.posts.show-post');
    }
}
