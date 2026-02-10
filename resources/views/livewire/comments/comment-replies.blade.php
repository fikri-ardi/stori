<div 
x-show="commentReplies == {{ $comment->id }}"
class="flex flex-col space-y-7 w-full mt-8">
    @foreach ($comments as $comment)
    <div wire:key="comment-replies-{{ $comment->id }}" x-data="{options: false, deleteModal: false, editComment: false, replyComment: false}"
        @comment-updated="editComment = false" class="relative flex flex-col space-y-4 pb-2 w-full">

        {{-- Comment Author --}}
        <div :class="editComment ? 'opacity-0' : ''" class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <a wire:navigate href="{{ route('users.show', $comment->author) }}"
                    class="size-10 text-sm rounded-full overflow-hidden flex items-center justify-center">
                    @if ($comment->author->image)
                    <img src="{{ $comment->author->image->url }}" alt="Author Photo"
                        class="w-full h-full object-cover hover:opacity-50 transition-all">
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
            <div wire:key="three-dots-button{{ $comment->id }}" x-on:click.outside="options = false" wire:ignore.self
                class="relative flex flex-col items-center cursor-pointer">

                <i x-on:click="options = 'comment{{ $comment->id }}'" class="ph-light ph-dots-three text-2xl"></i>

                {{-- Comments options --}}
                <div x-show="options == 'comment{{ $comment->id }}'" x-transition
                    class="flex flex-col absolute top-5 bg-gray-200 text-gray-800 text-sm whitespace-nowrap rounded-2xl">

                    @cannot('view', $comment)
                    <button class="px-4 py-3 cursor-pointer">Report response</button>
                    @endcannot

                    @can('delete', $comment)
                    <button @click="editComment = true, options = false" class="px-4 py-3 cursor-pointer">
                        Edit response
                    </button>

                    {{-- Delete options --}}
                    <button x-on:click="deleteModal = true" class="px-4 py-3 cursor-pointer">
                        Delete response
                    </button>
                    @endcan
                </div>

                {{-- Delete comment modal --}}
                <div x-show="deleteModal" class="fixed flex left-0 top-0 right-0 bottom-0 bg-white/95 z-50">
                    <div x-on:click.outside="deleteModal = false" class="text-gray-800 m-auto text-center flex flex-col space-y-2">
                        <div class="text-2xl">Delete</div>
                        <p class="text-xs leading-relaxed">
                            Deleted responses are gone forever.<br>
                            Are you sure?
                        </p>
                        <div x-on:click="deleteModal = false, options = false" class="flex items-center mt-5 text-sm space-x-1 ">
                            <button class="px-3 py-2 bg-white rounded-full text-gray-800 cursor-pointer">Cancel</button>
                            <button wire:click="delete({{ $comment->id }})" class="px-3 py-2 bg-red-400 rounded-full text-white cursor-pointer">Delete
                                Response</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Comment Body --}}
        <div :class="editComment ? 'opacity-0' : ''">
            <p class="text-sm leading-8">{{ $comment->body }}</p>
        </div>

        {{-- Comment Action button --}}
        <div wire:key="{{ $comment->id }}" :class="editComment ? 'opacity-0' : ''" class="flex items-center text-sm space-x-6 text-gray-400">
            {{-- Claps --}}
            <livewire:posts.clap-button :item="$comment" :key="$comment->id.time()" />

            @if ($comment->replies->count() > 0)
            {{-- Show comment's replies --}}
            <button class="flex items-center space-x-1 cursor-pointer hover:text-white">
                <i class="ph-light ph-chat-teardrop-dots text-2xl"></i>
                <span>{{ $comment->replies->count() }} reply</span>
            </button>
            @endif

            {{-- Reply comment button --}}
            <buttton 
            @auth
            @click="replyComment = true"
            @else
            @click="$dispatch('open-login-modal')"
            @endauth
            class="underline text-gray-200 cursor-pointer">
                Reply
                </buttt>
        </div>

        {{-- Edit comments form --}}
        <livewire:comments.edit-comments :$comment wire:key="edit-comment-{{ $comment->id }}" />

        {{-- Reply comment --}}
        <livewire:comments.reply-comments :$post :comment="$comment" :key="'parent-comment-'.$comment->id.time()" />
    </div>
    @endforeach
</div>