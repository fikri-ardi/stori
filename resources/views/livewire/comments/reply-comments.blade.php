<form wire:submit="replyTo({{ $parent->id }})" 
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
        $el.style.height = $el.scrollHeight + 'px';" class="w-full block bg-gray-800 rounded-3xl px-5 py-3 resize-none text-sm">
    </textarea>

    @error('body')
    <div class="absolute text-sm underline font-semibold text-left pl-5">{{ $message }}</div>
    @enderror

    <button 
    @click="replyComment = false"
    type="button" 
    class="text-gray-200 bg-gray-800 rounded-full px-4 py-2 text-xs font-semibold cursor-pointer mt-2">
        Cancle
    </button>

    <button 
    @comment-replied.window="replyComment = false"
    type="submit" 
    class="bg-gray-200 text-gray-800 rounded-full px-4 py-2 text-xs font-semibold cursor-pointer mt-2">
        Respond
    </button>
</form>