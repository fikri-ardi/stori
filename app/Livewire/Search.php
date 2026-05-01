<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Livewire\Attributes\Url;
use Livewire\Component;

class Search extends Component
{
    #[Url(except: '')]
    public $keywords = '';

    public function render()
    {
        if ($this->keywords == '') {
            return view('livewire.search', [
                'tags' => collect(),
                'users' => collect(),
                'posts' => collect(),
            ]);
        };

        $tags = Tag::where('name', 'like', '%' . $this->keywords . '%')->get();

        $users = User::where('name', 'like', '%' . $this->keywords . '%')
            ->orWhere('username', 'like', "%$this->keywords%")
            ->orWhere('bio', 'like', "%$this->keywords%")
            ->get();

        $posts = Post::where('title', 'like', '%' . $this->keywords . '%')
            ->orWhere('body', 'like', "%$this->keywords%")
            ->limit(9)
            ->get();

        return view('livewire.search', compact('tags', 'users', 'posts'));
    }
}
