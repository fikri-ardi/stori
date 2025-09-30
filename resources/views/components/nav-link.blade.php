<a aria-current="{{ request()->url() == $attributes->get('href') ? 'page' : 'false' }}"
    {{ $attributes
        ->class([
            'block rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white',  
            'bg-gray-950/50 text-white' => request()->url() == $attributes->get('href'),
            ])
    }}>
    {{ $slot }}
</a>