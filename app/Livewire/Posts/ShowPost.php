<?php

namespace App\Livewire\Posts;

use App\Models\Post;
use Livewire\Attributes\On;
use Livewire\Component;

class ShowPost extends Component
{
    public Post $post;
    public $userClaps;

    public function mount()
    {
        $this->userClaps = $this->post
            ->claps()
            ->where('user_id', auth()->id())
            ->sum('count');
    }

    #[On('claps')]
    public function refreshUserClaps()
    {
        $this->userClaps = $this->post
            ->claps()
            ->where('user_id', auth()->id())
            ->sum('count');
    }

    public function clap()
    {
        if (auth()->check()) {
            if ($this->post->claps()->where('user_id', auth()->id())->sum('count') < 50) {
                if ($this->post->claps()->where('user_id', auth()->id())->exists()) {
                    $this->post->claps()->where('user_id', auth()->id())->increment('count', rand(1, 2));
                } else {
                    $this->post->claps()->create([
                        'user_id' => auth()->id(),
                        'count' => rand(1, 2),
                    ]);
                }
            }
        }

        $this->dispatch('claps');
    }

    public function render()
    {
        return view('livewire.posts.show-post');
    }
}
