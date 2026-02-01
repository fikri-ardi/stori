<?php

namespace App\Livewire\Comments;

use App\Models\Post;
use App\Models\Comment;
use Livewire\Component;
use Livewire\Attributes\Validate;

class ReplyComments extends Component
{
    public Post $post;

    public $parent;

    #[Validate('required|min:3')]
    public $body;

    public function replyTo(Comment $parent)
    {
        $this->validate();
        $this->post->comments()->create([
            'user_id' => auth()->id(),
            'parent_id' => $parent->id,
            'body' => $this->body,
        ]);
        $this->body = '';
        $this->dispatch('comment-replied');
    }

    public function render()
    {
        return view('livewire.comments.reply-comments');
    }
}
