<?php

namespace App\Livewire\Posts;

use App\Models\Post;
use App\Services\VisitorTracker;
use Livewire\Component;

class ShowPost extends Component
{
    public Post $post;
    public $reading_time;

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->reading_time = ceil(str($this->post->body)->wordCount() / 200);

        app(VisitorTracker::class)->track($this->post);
    }

    public function render()
    {
        return view('livewire.posts.show-post');
    }
}
