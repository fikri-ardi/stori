<?php

namespace App\Livewire\Comments;

use App\Models\Post;
use App\Models\Comment;
use Livewire\Component;
use Livewire\Attributes\On;

class CommentReplies extends Component
{
    public Post $post;
    public $comment;
    public $comments;

    #[On(['comment-created', 'comment-deleted', 'comment-updated', 'comment-replied'])]
    public function refreshComments()
    {
        $this->comments = $this->comment->replies->sortDesc();
    }

    public function delete(Comment $comment)
    {
        $comment->delete();
        $this->dispatch('comment-deleted');
    }

    public function render()
    {
        return view('livewire.comments.comment-replies');
    }
}
