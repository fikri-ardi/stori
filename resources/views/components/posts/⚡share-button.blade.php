<?php

use Livewire\Component;

new class extends Component
{
    public $post;
    public $shareMessage = '';

    public function mount(){
        $this->shareMessage = $this->post->title .' by '. $this->post->author->name .' '. url()->current();
    }
};
?>

<div x-data="{
    sharePostModal: false,
    copyLink(message) {
        navigator.clipboard.writeText(window.location.href);
        this.$dispatch('notif', {message: message});
        this.sharePostModal = false;
    }
}" 
class="relative">

    {{-- Post collection button --}}
    <a 
    @click="sharePostModal = true"
    class="cursor-pointer">
        <i class="ph-light ph-export text-2xl"></i>
    </a>

    {{-- user collection modal --}}
    <div 
    x-show="sharePostModal" 
    @mousedown.outside="sharePostModal = false"
    x-transition 
    class="absolute min-w-64 bg-black/90 backdrop-blur-lg rounded-2xl top-full mt-2 left-1/2 -translate-x-1/2">

        {{-- Share Post Modal --}}
        <div class="p-6 flex flex-col space-y-5 text-sm text-gray-300">
            <button 
            @click="copyLink('Link copied')"
            class="flex items-center space-x-3 hover:text-white cursor-pointer">
                <i class="ph-light ph-link text-xl"></i>
                <div>Copy link</div>
            </button>

            <a href="https://wa.me/?text={{ $shareMessage }}"
            target="_blank"
            class="flex items-center space-x-3 hover:text-white">
                <i class="ph-light ph-whatsapp-logo text-xl"></i>
                <div>Share on Whatsapp</div>
            </a>

            <a
            @click="copyLink('Link copied. Paste it on Instagram.')" 
            href="https://instagram.com" target="_blank" class="flex items-center space-x-3 hover:text-white">
                <i class="ph-light ph-instagram-logo text-xl"></i>
                <div>Share on Instagram</div>
            </a>

            <a href="https://www.threads.net/intent/post?text={{ $shareMessage }}" target="_blank" class="flex items-center space-x-3 hover:text-white">
                <i class="ph-light ph-threads-logo text-xl"></i>
                <div>Share on Threads</div>
            </a>

            <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank" class="flex items-center space-x-3 hover:text-white">
                <i class="ph-light ph-facebook-logo text-xl"></i>
                <div>Share on Facebook</div>
            </a>
        </div>
    </div>
</div>