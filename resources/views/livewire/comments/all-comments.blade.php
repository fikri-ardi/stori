<div class="flex flex-col space-y-7 w-full mt-8">
    @foreach ($comments as $comment)
    <div 
        wire:key="{{ $comment->id }}"
        x-data="{options: false, deleteModal: false, editComment: false, replyComment: false, commentReplies: false}"
        @comment-updated="editComment = false" 
        @comment-replied="commentReplies = {{ $comment->id }}"
        class="relative flex flex-col space-y-4 border-b border-white/10 pb-2 w-full"
        >
        
        {{-- Comment Author --}}
        <div
            :class="editComment ? 'opacity-0' : ''"
            class="flex items-center justify-between">
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
            <div 
                wire:key="three-dots-button{{ $comment->id }}"
                x-on:click.outside="options = false"
                wire:ignore.self
                class="relative flex flex-col items-center cursor-pointer">

                <i x-on:click="options = 'comment{{ $comment->id }}'" class="ph-light ph-dots-three text-2xl"></i>

                {{-- Comments options --}}
                <div x-show="options == 'comment{{ $comment->id }}'" 
                    x-transition
                    class="flex flex-col absolute top-5 z-50 rounded-2xl border border-white/10 bg-[#07090d]/95 py-1 text-sm text-gray-300 shadow-2xl shadow-black/30 backdrop-blur-xl whitespace-nowrap">

                    @cannot('view', $comment)
                    <button class="px-4 py-3 cursor-pointer transition hover:bg-white/[0.06] hover:text-white">Report response</button>
                    @endcannot

                    @can('delete', $comment)
                    <button 
                        @click="editComment = true, options = false" 
                        class="px-4 py-3 cursor-pointer transition hover:bg-white/[0.06] hover:text-white">
                        Edit response
                        </button>

                    {{-- Delete options --}}
                    <button   
                        x-on:click="deleteModal = true"
                        class="px-4 py-3 cursor-pointer text-red-300 transition hover:bg-red-400/10 hover:text-red-200">
                        Delete response
                    </button>
                    @endcan
                </div>

                {{-- Delete comment modal --}}
                <div x-show="deleteModal" class="fixed flex left-0 top-0 right-0 bottom-0 bg-black/60 backdrop-blur-md z-50">
                    <div x-on:click.outside="deleteModal = false" class="m-auto flex flex-col space-y-2 rounded-2xl border border-white/10 bg-[#07090d]/95 px-6 py-5 text-center text-gray-200 shadow-2xl shadow-black/40">
                        <div class="text-2xl">Delete</div>
                        <p class="text-xs leading-relaxed text-gray-400">
                            Deleted responses are gone forever.<br>
                            Are you sure?
                        </p>
                        <div x-on:click="deleteModal = false, options = false" class="flex items-center mt-5 text-sm space-x-1 ">
                            <button class="px-3 py-2 rounded-full text-gray-300 transition hover:bg-white/[0.07] hover:text-white cursor-pointer">Cancel</button>
                            <button wire:click="delete({{ $comment->id }})" class="px-3 py-2 bg-red-400 rounded-full text-neutral-950 font-semibold cursor-pointer transition hover:bg-red-300">Delete Response</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Comment Body --}}
        <div 
            :class="editComment ? 'opacity-0' : ''"
            >
            <p class="text-sm leading-8">{{ $comment->body }}</p>
        </div>

        {{-- Comment Action button --}}
        <div 
            wire:key="{{ $comment->id }}" 
            :class="editComment ? 'opacity-0' : ''"
            class="flex items-center text-sm space-x-6 text-gray-400">
            {{-- Claps --}}
            <livewire:posts.clap-button :item="$comment" :key="$comment->id.time()" />
                
            @if ($comment->replies->count() > 0)
                {{-- Show comment's replies --}}
                <button 
                @click="if(commentReplies == {{ $comment->id }}) { commentReplies = false } else { commentReplies = {{ $comment->id }} }"
                class="flex items-center space-x-1 cursor-pointer hover:text-white">
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
 
        @if ($comment->replies->count() > 0)
        <div class="ml-3 pl-5 border-l-4 border-white/10">
            <livewire:comments.comment-replies :$post :$comment :comments="$comment->replies->sortDesc()" :key="'comment-replies-'.$comment->id.time()" />
        </div>
        @endif
    </div>
    @endforeach
</div>
