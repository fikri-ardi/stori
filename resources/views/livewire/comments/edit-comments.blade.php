<form 
wire:submit="update({{ $comment->id }})" 
class="absolute left-0 top-0 w-full text-right z-50"
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
        class="w-full block rounded-3xl border border-white/10 bg-[#07090d]/95 px-5 py-3 resize-none text-sm text-gray-200 placeholder:text-gray-600 outline-none shadow-2xl shadow-black/30 backdrop-blur-xl transition focus:border-white/20 focus:bg-white/[0.065]">
    </textarea>

    @error('body')
    <div class="absolute text-sm underline font-semibold text-left pl-5">{{ $message }}</div>
    @enderror

<button 
    type="submit" 
    class="bg-white text-gray-950 rounded-full px-4 py-2 text-xs font-semibold cursor-pointer mt-2 transition hover:bg-gray-200">
        Update
    </button>
</form>
