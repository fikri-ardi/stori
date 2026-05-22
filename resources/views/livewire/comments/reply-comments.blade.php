<form wire:submit="replyTo({{ $comment->id }})" 
    class="w-full text-right"
    x-show="replyComment"
    >

    <textarea 
        wire:ignore 
        wire:model.blur="body" 
        placeholder="What do you think?" 
        rows="5" 
        x-data x-on:input="
        $el.style.height = 'auto';
        $el.style.height = $el.scrollHeight + 'px';" class="w-full block rounded-3xl border border-white/10 bg-white/[0.045] px-5 py-3 resize-none text-sm text-gray-200 placeholder:text-gray-600 outline-none transition focus:border-white/20 focus:bg-white/[0.065]">
    </textarea>

    @error('body')
    <div class="absolute text-sm underline font-semibold text-left pl-5">{{ $message }}</div>
    @enderror

    <button 
    @click="replyComment = false"
    type="button" 
    class="text-gray-300 rounded-full px-4 py-2 text-xs font-semibold cursor-pointer mt-2 transition hover:bg-white/[0.07] hover:text-white">
        Cancle
    </button>

    <button 
    @comment-replied.window="replyComment = false"
    type="submit" 
    class="bg-white text-gray-950 rounded-full px-4 py-2 text-xs font-semibold cursor-pointer mt-2 transition hover:bg-gray-200">
        Respond
    </button>
</form>
