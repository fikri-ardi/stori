<?php

use App\Models\Post;
use Livewire\Component;

new class extends Component
{
    public Post $post;

    public function delete(){
        $this->authorize('delete', $this->post);
        $this->post->delete();
        $this->redirectRoute('home', navigate: true);
    }
    
};
?>

<div
    x-data="{ deletePostModal: false }"
    class="relative">
    {{-- Delete Post Button --}}
    <button
        type="button"
        @click.stop="deletePostModal = true; modalBackdrop = true; typeof Options !== 'undefined' && (Options = false)"
        class="flex cursor-pointer items-center space-x-3 text-red-400 transition hover:text-red-300">
        <i class="ph-light ph-trash text-xl"></i>
        <div>Delete post</div>
    </button>

    {{-- Delete Post Confirmation Modal --}}
    <template x-teleport="body">
        <div
            x-show="deletePostModal"
            @click.self="deletePostModal = false, modalBackdrop = false"
            @keydown.escape.window="deletePostModal = false, modalBackdrop = false"
            role="dialog"
            aria-modal="true"
            aria-labelledby="delete-post-modal-title"
            class="fixed inset-0 z-[60] flex px-4 py-6 sm:px-6">
            <div
                x-show="deletePostModal"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 translate-y-3 scale-[0.98]"
                x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                x-transition:leave="transition ease-in duration-100"
                x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                x-transition:leave-end="opacity-0 translate-y-3 scale-[0.98]"
                class="m-auto w-full max-w-sm overflow-hidden rounded-2xl border border-white/[0.12] bg-black/90 text-gray-200 shadow-[0_24px_80px_rgba(0,0,0,0.5),inset_0_1px_0_rgba(255,255,255,0.1)] backdrop-blur-2xl">
                <div class="px-5 py-5 sm:px-6">
                    <div class="flex items-start gap-3">
                        <div class="grid size-10 shrink-0 place-items-center rounded-2xl border border-red-300/15 bg-red-400/10 text-red-200">
                            <i class="ph-light ph-trash text-xl"></i>
                        </div>

                        <div class="min-w-0">
                            <h2 id="delete-post-modal-title" class="text-lg font-semibold tracking-normal text-white">Delete post?</h2>
                            <p class="mt-2 text-sm leading-6 text-gray-400">
                                Post yang dihapus nggak bisa dibalikin.
                            </p>
                        </div>
                    </div>

                    <div class="mt-6 flex items-center justify-end gap-3">
                        <button
                            type="button"
                            @mousedown="deletePostModal = false, modalBackdrop = false"
                            class="inline-flex h-10 items-center justify-center rounded-full px-4 text-sm font-medium text-gray-400 transition hover:bg-white/[0.07] hover:text-white cursor-pointer">
                            Cancel
                        </button>

                        <button
                            type="button"
                            wire:click="delete"
                            @mousedown="deletePostModal = false, modalBackdrop = false"
                            class="inline-flex h-10 items-center justify-center gap-2 rounded-full bg-red-400 px-4 text-sm font-semibold text-neutral-950 shadow-lg shadow-black/20 transition hover:bg-red-300 cursor-pointer">
                            <i class="ph-light ph-trash text-lg"></i>
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </template>
</div>
