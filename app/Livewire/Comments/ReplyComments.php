<?php

namespace App\Livewire\Comments;

use App\Models\Post;
use App\Models\Comment;
use Livewire\Component;
use Livewire\Attributes\Validate;

class ReplyComments extends Component
{
    public Post $post;
    public $comment;

    #[Validate('required|min:3')]
    public $body;

    public function authCheck()
    {
        if (!auth()->check()) {
            return $this->redirect(route('login'), navigate: true);
        }
    }

    public function replyTo(Comment $comment)
    {
        $this->validate();
        $comment->replies()->create([
            'user_id' => auth()->id(),
            'post_id' => $this->post->id,
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
