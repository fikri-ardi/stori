<?php

namespace App\Livewire\Comments;

use App\Models\Comment;
use App\Models\Post;
use Livewire\Component;
use Livewire\Attributes\Validate;

class EditComments extends Component
{
    public Comment $comment;
    public Post $post;

    public $parentId;

    #[Validate('required|min:3')]
    public $body;

    public function mount()
    {
        $this->body = $this->comment->body;
    }

    public function update(Comment $comment)
    {
        $this->validate();
        $comment->update([
            'user_id' => auth()->id(),
            'parent_id' => $this->parentId,
            'body' => $this->body,
        ]);
        $this->dispatch('comment-updated');
    }

    public function render()
    {
        return view('livewire.comments.edit-comments');
    }
}
