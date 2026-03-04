<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

<div x-data="{
    message: '',
    showToast($event){
       $refs.toast.classList.remove('animate-slide-down','animate-slide-up' );
        void $refs.toast.offsetWidth;
        this.message = $event.detail.message;
        $refs.toast.classList.add('animate-slide-down', 'opacity-100');
    },
    hideToast($event){
        $refs.toast.classList.remove('animate-slide-down');
        void $refs.toast.offsetWidth;
        $refs.toast.classList.add('animate-slide-up');
    },
}" 
@notif.window="showToast($event)"
class="z-50 relative top-full left-0 w-full flex justify-center">
    <div 
    x-ref="toast"
    style="z-index: 9999;"
        class="fixed -translate-y-full opacity-0 bg-black/50 text-gray-300 rounded-full backdrop-blur-lg shadow-lg py-3 px-4 flex items-center justify-center space-x-32 transition-all ease-in-out">
        <div class="flex items-center space-x-2">
            <span class="ph-light ph-link text-xl"></span>
            <span class="text-sm" x-text="message"></span>
        </div>
        <button @click="hideToast()" class="ph-light ph-x text-xl cursor-pointer"></button>
    </div>
</div>