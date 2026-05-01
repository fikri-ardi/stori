<?php

namespace App\Livewire\Tags;

use App\Models\Tag;
use Livewire\Component;
use Livewire\Attributes\Url;

class AllTags extends Component
{
    public $keywords = '';

    public function search()
    {
        if ($this->keywords == '') {
            return;
        };
        $this->redirectRoute('search', ['keywords' => $this->keywords], navigate: true);
    }

    public function render()
    {

        return view(
            'livewire.tags.all-tags',
            [
                'tags' => Tag::all(),
            ]
        );
    }
}
