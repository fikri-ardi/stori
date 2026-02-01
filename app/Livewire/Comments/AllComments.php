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

    #[On(['comment-created', 'comment-deleted', 'comment-updated', 'comment-replied'])]
    public function mount()
    {
        $this->comments = $this->post->comments->where('parent_id', '==', null)->sortDesc();
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
