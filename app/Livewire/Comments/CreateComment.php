<?php

namespace App\Livewire\Comments;

use App\Models\Post;
use Livewire\Component;
use Livewire\Attributes\Validate;

class CreateComment extends Component
{
    #[Validate('required|min:3')]
    public $body;

    public $parentId;

    public Post $post;

    public function create()
    {
        $this->validate();
        $this->post->comments()->create([
            'user_id' => auth()->id(),
            'parent_id' => $this->parentId,
            'body' => $this->body,
        ]);
        $this->body = '';
        $this->dispatch('comment-created');
    }

    public function render()
    {
        return view('livewire.comments.create-comment');
    }
}
