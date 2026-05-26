@props(['users'])

<div class="flex items-center -space-x-2">
    @foreach ($users as $user)
        <a 
            wire:navigate
            href="{{ route('users.show', $user->username) }}" 
            class="size-6 hover:opacity-80 transition cursor-pointer">
            @if ($user->image)
            <img src="{{ $user->image->url }}"
                class="relative z-[{{ $user->id }}] size-full object-cover rounded-full border-2 border-[#050608]" />
            @else
            <div class="relative z-[{{ $user->id }}] text-gray-900 bg-white size-full flex rounded-full font-semibold uppercase">
                <span class="m-auto">{{ $user->initials() }}</span>
            </div>
            @endif
        </a>
    @endforeach
</div>