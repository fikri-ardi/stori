<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

new class extends Component
{
    use WithFileUploads;

    public string $name = '';

    public ?string $username = '';

    public ?string $bio = '';

    public $photo = null;

    public ?string $currentPhotoUrl = null;

    public function mount(): void
    {
        abort_unless(Auth::check(), 403);

        $user = Auth::user();

        $this->name = $user->name;
        $this->username = $user->username;
        $this->bio = $user->bio;
        $this->currentPhotoUrl = $user->image?->url;
    }

    public function save(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => [
                'nullable',
                'string',
                'min:3',
                'max:32',
                'regex:/^(?!.*\.\.)(?!\.)(?!.*\.$)[a-z0-9._-]+$/',
                Rule::unique(User::class, 'username')->ignore($user->id),
            ],
            'bio' => ['nullable', 'string', 'max:160'],
            'photo' => ['nullable', 'image', 'max:2048'],
        ]);

        $user->name = $validated['name'];
        $user->username = filled($validated['username']) ? (string) str($validated['username'])->lower() : null;
        $user->bio = $validated['bio'];
        $user->save();

        if ($this->photo instanceof TemporaryUploadedFile) {
            $path = $this->photo->store('images/users', 'public');
            $url = Storage::disk('public')->url($path);

            if ($user->image) {
                $this->deleteProfilePhoto($user->image->url);
                $user->image()->update(['url' => $url]);
            } else {
                $user->image()->create(['url' => $url]);
            }

            $this->currentPhotoUrl = $url;
            $this->photo = null;
        }

        $this->dispatch('notif', message: 'Profile updated successfully.');
        $this->dispatch('account-updated');
    }

    private function deleteProfilePhoto(?string $url): void
    {
        if (! $url) {
            return;
        }

        $urlPath = parse_url($url, PHP_URL_PATH) ?: $url;

        if (! str($urlPath)->contains('/storage/')) {
            return;
        }

        $path = str($urlPath)->after('/storage/')->toString();

        if ($path) {
            Storage::disk('public')->delete($path);
        }
    }
};
?>

<div class="mx-auto flex min-h-[calc(100vh-9rem)] w-full max-w-3xl items-start justify-center">
    <section class="w-full">
        <div class="mb-6">
            <a wire:navigate href="{{ route('users.show', auth()->user()) }}" class="mb-5 inline-flex items-center gap-2 text-sm text-gray-400 transition hover:text-white">
                <i class="ph-light ph-arrow-left text-lg"></i>
                <span>Back to profile</span>
            </a>

            <h1 class="text-2xl font-semibold tracking-normal text-white sm:text-3xl">Edit profile</h1>
            <p class="mt-2 max-w-xl text-sm leading-6 text-gray-400">Update the profile details people see on your public page.</p>
        </div>

        <form wire:submit="save" class="rounded-3xl border border-white/10 bg-white/[0.03] p-4 backdrop-blur-xl sm:p-6">
            <div class="grid gap-7 lg:grid-cols-[13rem_1fr]">
                <aside class="lg:border-r lg:border-white/10 lg:pr-6">
                    <div class="flex flex-col items-start gap-4 sm:flex-row sm:items-center lg:flex-col lg:items-start">
                        <div class="relative size-24 shrink-0 overflow-hidden rounded-full border border-black/20 bg-white text-gray-950 shadow-lg shadow-black/20 sm:size-28">
                            @if ($photo instanceof TemporaryUploadedFile)
                                <img src="{{ $photo->temporaryUrl() }}" alt="Profile preview" class="size-full object-cover">
                            @elseif ($currentPhotoUrl)
                                <img src="{{ $currentPhotoUrl }}" alt="Profile photo" class="size-full object-cover">
                            @else
                                <div class="grid size-full place-items-center text-4xl font-semibold uppercase">
                                    {{ auth()->user()->initials() }}
                                </div>
                            @endif

                            <div wire:loading wire:target="photo" class="absolute inset-0 grid place-items-center bg-black/50 text-white">
                                <i class="ph-light ph-spinner-gap animate-spin text-3xl"></i>
                            </div>
                        </div>

                        <div class="min-w-0">
                            <label for="photo" class="inline-flex cursor-pointer items-center gap-2 rounded-full border border-white/10 px-4 py-2 text-sm font-medium text-gray-200 transition hover:bg-white/10 hover:text-white">
                                <i class="ph-light ph-camera text-lg"></i>
                                <span>Change photo</span>
                            </label>
                            <input id="photo" type="file" wire:model="photo" accept="image/*" class="sr-only">
                            <p class="mt-3 text-xs leading-5 text-gray-500">JPG, PNG, or WebP. Max 2MB.</p>
                            @error('photo')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </aside>

                <div class="space-y-6">
                    <div>
                        <label for="name" class="mb-2 block text-sm font-medium text-gray-300">Name</label>
                        <input
                            id="name"
                            type="text"
                            wire:model.blur="name"
                            autocomplete="name"
                            class="h-12 w-full rounded-2xl border border-white/10 bg-gray-950/45 px-4 text-sm text-white outline-none transition placeholder:text-gray-600 focus:border-white/25 focus:bg-gray-950/70"
                            placeholder="Your name"
                        >
                        @error('name')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="username" class="mb-2 block text-sm font-medium text-gray-300">Username</label>
                        <div class="flex h-12 overflow-hidden rounded-2xl border border-white/10 bg-gray-950/45 text-sm transition focus-within:border-white/25 focus-within:bg-gray-950/70">
                            <span class="grid place-items-center border-r border-white/10 px-4 text-gray-500">@</span>
                            <input
                                id="username"
                                type="text"
                                wire:model.blur="username"
                                autocomplete="username"
                                class="min-w-0 flex-1 bg-transparent px-4 text-white outline-none placeholder:text-gray-600"
                                placeholder="username"
                            >
                        </div>
                        @error('username')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <div class="mb-2 flex items-center justify-between gap-3">
                            <label for="bio" class="text-sm font-medium text-gray-300">Bio</label>
                            <span class="text-xs text-gray-600">{{ strlen($bio ?? '') }}/160</span>
                        </div>
                        <textarea
                            id="bio"
                            wire:model.live.debounce.300ms="bio"
                            rows="4"
                            maxlength="160"
                            class="min-h-32 w-full resize-none rounded-2xl border border-white/10 bg-gray-950/45 px-4 py-3 text-sm leading-6 text-white outline-none transition placeholder:text-gray-600 focus:border-white/25 focus:bg-gray-950/70"
                            placeholder="Tell people what you are about"
                        ></textarea>
                        @error('bio')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-col-reverse gap-3 border-t border-white/10 pt-6 sm:flex-row sm:items-center sm:justify-between">
                        <div class="grid grid-cols-2 gap-3 sm:flex sm:items-center sm:justify-end">
                            <a wire:navigate href="{{ route('users.show', auth()->user()) }}" class="inline-flex items-center justify-center rounded-full px-4 py-2 text-sm font-medium text-gray-400 transition hover:bg-white/10 hover:text-white">
                                Cancel
                            </a>
                            <button type="submit" class="inline-flex cursor-pointer items-center justify-center gap-1 rounded-full bg-white px-4 py-2 text-sm font-semibold text-gray-950 transition disabled:cursor-not-allowed disabled:opacity-60" wire:loading.attr="disabled" wire:target="save,photo">
                                <i class="ph-light ph-floppy-disk text-lg"></i>
                                <span wire:loading.remove wire:target="save">Save</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
</div>
