<?php

namespace App\Livewire;

use App\Models\Tag;
use Livewire\Component;
use Livewire\Attributes\Url;

class Search extends Component
{
    #[Url(except: '')]
    public $keywords = '';

    public function render()
    {
        if ($this->keywords == '') {
            $this->redirectRoute('tags.index', navigate: true);
        };

        $tags = Tag::where('name', 'like', '%' . $this->keywords . '%')->get();

        return view('livewire.search', compact('tags'));
    }
}
