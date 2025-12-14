<div class="w-full">
    {{-- Comment Author --}}
    <div class="flex items-center space-x-3">
        <a wire:navigate href="{{ route('users.show', auth()->user()) }}"
            class="w-10 h-10 text-sm rounded-full overflow-hidden flex items-center justify-center">
            @if (auth()->user()->image)
            <img src="{{ auth()->user()->image->url }}" alt="Author Photo" class="w-full h-full object-cover hover:opacity-50 transition-all">
            @else
            <div class="relative z-50 text-gray-900 bg-white size-10 flex rounded-full font-semibold uppercase text-lg">
                <span class="m-auto">{{ auth()->user()->initials() }}</span>
            </div>
            @endif
        </a>

        <div class="text-sm text-gray-300 flex flex-col">
            <a wire:navigate href="{{ route('users.show', auth()->user()) }}" class="text-white hover:underline transition-all">{{
                auth()->user()->name }}</a>
        </div>
    </div>

    {{-- Form --}}
    <form wire:submit="create" class="text-right">
        <textarea wire:ignore type="text" wire:model.blur="body" placeholder="What do you think?" rows="1" 
        x-data x-on:input="
            $el.style.height = 'auto';
            $el.style.height = $el.scrollHeight + 'px';" 
            class="w-full block bg-gray-800 rounded-3xl px-5 py-3 mt-3 resize-none text-sm">
        </textarea>
        @error('body')
        <div class="text-sm underline font-semibold text-left mt-3">{{ $message }}</div>
        @enderror

        <button type="submit" class="bg-gray-200 text-gray-800 rounded-full px-4 py-2 text-xs font-semibold cursor-pointer mt-2">
            Respond
        </button>
    </form>
</div>
