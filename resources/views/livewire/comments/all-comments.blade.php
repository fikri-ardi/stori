<div class="flex flex-col space-y-7 w-full" id="comments">
    @foreach ($comments as $comment)
    <div wire:key="{{ $comment->id }}" class="flex flex-col space-y-4 border-b border-gray-800 pb-6 w-full">
        {{-- Comment Author --}}
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <a wire:navigate href="{{ route('users.show', $comment->author) }}"
                    class="size-10 text-sm rounded-full overflow-hidden flex items-center justify-center">
                    @if ($comment->author->image)
                    <img src="{{ $comment->author->image->url }}" alt="Author Photo" class="w-full h-full object-cover hover:opacity-50 transition-all">
                    @else
                    <div class="relative text-gray-900 bg-white size-10 flex rounded-full font-semibold uppercase text-lg">
                        <span class="m-auto">{{ $comment->author->initials() }}</span>
                    </div>
                    @endif
                </a>
            
                <div class="text-sm text-gray-300 flex flex-col">
                    <a wire:navigate href="{{ route('users.show', $comment->author) }}" class="text-white hover:underline transition-all">{{
                        $comment->author->name }}</a>
                    <div>{{ $comment->created_at->format('M d') }}</div>
                </div>
            </div>

            {{-- Comments three dots button --}}
            <div x-data="{options: false, deleteModal: false}" x-on:click.outside="options = false" class="relative flex flex-col items-center cursor-pointer">
                <i x-on:click="options = 'comment{{ $comment->id }}'" class="ph-light ph-dots-three text-2xl"></i>

                {{-- Comments options --}}
                <div x-show="options == 'comment{{ $comment->id }}'" x-transition class="flex flex-col absolute top-5 bg-gray-200 text-gray-800 text-xs whitespace-nowrap rounded-2xl">
                    <button class="px-4 py-3 cursor-pointer">Edit response</button>
                    <button  
                    x-on:click="deleteModal = true"
                    class="px-4 py-3 cursor-pointer">Delete response</button>
                </div>

                {{-- Delete comment modal --}}
                <div x-show="deleteModal" class="fixed flex left-0 top-0 right-0 bottom-0 bg-white/95 z-50">
                    <div x-on:click.outside="deleteModal = false" class="text-gray-800 m-auto text-center flex flex-col space-y-2">
                        <div class="text-2xl">Delete</div>
                        <p class="text-xs leading-relaxed">
                            Deleted responses are gone forever.<br>
                            Are you sure
                        </p>
                        <div class="flex items-center mt-5 text-sm space-x-1">
                            <button x-on:click="deleteModal = false" class="px-3 py-2 bg-white rounded-full text-gray-800 cursor-pointer">Cancel</button>
                            <button wire:click="delete({{ $comment->id }})" class="px-3 py-2 bg-red-400 rounded-full text-white cursor-pointer">Delete Response</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Comment Body --}}
        <div>
            <p class="text-sm leading-8">{{ $comment->body }}</p>
        </div>

        {{-- Action button --}}
        <div class="flex items-center text-sm space-x-4 text-gray-400">
            {{-- Claps --}}
            <div class="flex items-center space-x-2">
                <i class="ph-light ph-hands-clapping text-xl"></i>
                <span>{{ number_format($comment->claps->sum('count')) }}</span>
            </div>

            {{-- Reply --}}
            <a href="#" class="underline text-gray-200">Reply</a>
        </div>
    </div>
    @endforeach
</div>