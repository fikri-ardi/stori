<?php

namespace App\Livewire\Posts;

use Illuminate\Database\Eloquent\Model;
use Livewire\Component;
use Livewire\Attributes\On;

class ClapButton extends Component
{
    public $item;
    public $userClaps;

    public function mount()
    {
        $this->userClaps = $this->item
            ->claps()
            ->where('user_id', auth()->id())
            ->sum('count');
    }

    #[On('clapped')]
    public function refreshUserClaps()
    {
        $this->userClaps = $this->item
            ->claps()
            ->where('user_id', auth()->id())
            ->sum('count');
    }

    public function clap()
    {
        if (auth()->check()) {
            if ($this->item->claps()->where('user_id', auth()->id())->sum('count') < 50) {
                if ($this->item->claps()->where('user_id', auth()->id())->exists()) {
                    $this->item->claps()->where('user_id', auth()->id())->increment('count', rand(1, 2));
                } else {
                    $this->item->claps()->create([
                        'user_id' => auth()->id(),
                        'count' => rand(1, 2),
                    ]);
                }
            }
            $this->dispatch('clapped', id: $this->item->id);
        } else {
            $this->dispatch('show-login-modal');
        }
    }

    public function render()
    {
        return view('livewire.posts.clap-button');
    }
}
