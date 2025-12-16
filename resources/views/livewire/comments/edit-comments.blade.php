<form 
wire:submit="update({{ $comment->id }})" 
class="absolute left-0 top-0 w-full text-right"
@click.outside="editComment = false"
x-show="editComment"
>
    <textarea 
        wire:ignore 
        wire:model.blur="body" 
        placeholder="What do you think?" 
        rows="5" 
        x-data x-on:input="
        $el.style.height = 'auto';
        $el.style.height = $el.scrollHeight + 'px';" 
        class="w-full block bg-gray-800 rounded-3xl px-5 py-3 resize-none text-sm">
    </textarea>

    @error('body')
    <div class="absolute text-sm underline font-semibold text-left pl-5">{{ $message }}</div>
    @enderror

<button 
    type="submit" 
    class="bg-gray-200 text-gray-800 rounded-full px-4 py-2 text-xs font-semibold cursor-pointer mt-2">
        Update
    </button>
</form>