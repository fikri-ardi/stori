<?php

namespace App\Livewire\Comments;

use App\Models\Post;
use App\Models\Comment;
use Livewire\Component;
use Livewire\Attributes\On;

class AllComments extends Component
{
    public Post $post;
    public $comments;

    public function mount()
    {
        $this->comments = $this->post->comments->sortDesc();
    }

    #[On(['comment-created', 'comment-deleted', 'comment-updated'])]
    public function refreshComments()
    {
        $this->comments = $this->post->comments->sortDesc();
    }

    public function delete(Comment $comment)
    {
        $comment->delete();
        $this->dispatch('comment-deleted');
    }

    public function render()
    {
        return view('livewire.comments.all-comments');
    }
}
