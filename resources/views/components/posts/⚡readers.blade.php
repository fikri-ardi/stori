<?php

use App\Models\Post;
use App\Models\Visitor;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component
{
    public Post $post;

    #[Computed]
    public function readersCount(): int
    {
        return $this->post->visitors()->count();
    }

    #[Computed]
    public function readers(): Collection
    {
        return $this->post->visitors()
            ->with(['user.image'])
            ->latest()
            ->take(30)
            ->get();
    }

    public function deviceIcon(Visitor $visitor): string
    {
        return match ($this->deviceType($visitor)) {
            'mobile' => 'ph-device-mobile',
            'tablet' => 'ph-device-tablet',
            default => 'ph-desktop',
        };
    }

    public function deviceLabel(Visitor $visitor): string
    {
        return ucfirst($this->deviceType($visitor));
    }

    public function sourceHost(Visitor $visitor): string
    {
        if (! $visitor->referer) {
            return 'Direct visit';
        }

        return parse_url($visitor->referer, PHP_URL_HOST) ?: 'Direct visit';
    }

    private function deviceType(Visitor $visitor): string
    {
        $agent = strtolower((string) $visitor->user_agent);

        if (str_contains($agent, 'mobile')) {
            return 'mobile';
        }

        if (str_contains($agent, 'tablet')) {
            return 'tablet';
        }

        return 'desktop';
    }
};
?>

<div x-data="{ readersModal: false }">
    {{-- Trigger button --}}
    <button
        type="button"
        @click="readersModal = true; modalBackdrop = true"
        class="flex cursor-pointer items-center space-x-2 transition-all hover:text-white active:scale-95">
        <i class="ph-light ph-eye text-[1.40rem]"></i>
        <span>{{ 
            $post->visitors->count() >= 1000
            ? Number::abbreviate($post->visitors()->count(), precision: 1)
            : $post->visitors()->count()       
        }}</span>
    </button>

    {{-- Readers modal --}}
    <template x-teleport="body">
        <div
            x-show="readersModal"
            @click.self="readersModal = false; modalBackdrop = false"
            @keydown.escape.window="readersModal = false; modalBackdrop = false"
            role="dialog"
            aria-modal="true"
            aria-labelledby="readers-modal-title"
            class="fixed inset-0 z-[60] flex px-4 py-6 sm:px-6">
            <div
                x-show="readersModal"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 translate-y-3 scale-[0.98]"
                x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                x-transition:leave="transition ease-in duration-100"
                x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                x-transition:leave-end="opacity-0 translate-y-3 scale-[0.98]"
                class="m-auto w-full max-w-sm overflow-hidden rounded-2xl border border-white/[0.1] bg-black/80 text-gray-200 shadow-[0_24px_80px_rgba(0,0,0,0.45),inset_0_1px_0_rgba(255,255,255,0.08)] backdrop-blur-2xl">
                <div class="border-b border-white/[0.08] px-5 py-4">
                    <div class="flex items-center justify-between gap-4">
                        <div class="min-w-0">
                            <h2 id="readers-modal-title" class="text-base font-semibold tracking-normal text-white">
                                Readers
                            </h2>
                            <p class="mt-0.5 text-xs text-gray-500">{{ number_format($this->readersCount) }} {{ str('visitor')->plural($this->readersCount) }}</p>
                        </div>

                        <button
                            type="button"
                            @click="readersModal = false; modalBackdrop = false"
                            class="grid size-8 shrink-0 cursor-pointer place-items-center rounded-full text-gray-500 transition hover:bg-white/[0.06] hover:text-white active:scale-95"
                            aria-label="Close readers modal">
                            <i class="ph-light ph-x text-lg"></i>
                        </button>
                    </div>
                </div>

                <div class="px-5 py-3">
                    @if ($this->readers->isNotEmpty())
                        <div class="max-h-[56vh] divide-y divide-white/[0.06] overflow-y-auto no-scrollbar">
                            @foreach ($this->readers as $visitor)
                                <div class="group flex items-center gap-3 py-3 transition hover:bg-white/[0.025]">
                                    @if ($visitor->user)
                                        <a wire:navigate href="{{ route('users.show', $visitor->user) }}" class="size-9 shrink-0 overflow-hidden rounded-full bg-white text-gray-900 transition group-hover:opacity-90">
                                            @if ($visitor->user->image != null)
                                                <img src="{{ $visitor->user->image->url }}" alt="" class="h-full w-full object-cover" />
                                            @else
                                                <div class="flex size-full text-xs font-semibold uppercase">
                                                    <span class="m-auto">{{ $visitor->user->initials() }}</span>
                                                </div>
                                            @endif
                                        </a>
                                    @else
                                        <div class="grid size-9 shrink-0 place-items-center rounded-full border border-white/[0.08] bg-white/[0.04] text-gray-500 transition group-hover:text-gray-300">
                                            <i class="ph-light ph-user-circle text-xl"></i>
                                        </div>
                                    @endif

                                    <div class="min-w-0 flex-1">
                                        @if ($visitor->user)
                                            <a wire:navigate href="{{ route('users.show', $visitor->user) }}" class="block truncate text-sm font-medium text-gray-100 transition hover:text-white hover:underline">
                                                {{ ucwords($visitor->user->name) }}
                                            </a>
                                            <p class="mt-0.5 truncate text-xs text-gray-600">{{ '@' . $visitor->user->username }}</p>
                                        @else
                                            <p class="truncate text-sm font-medium text-gray-100">Guest reader</p>
                                            <p class="mt-0.5 truncate text-xs text-gray-600">{{ $this->sourceHost($visitor) }}</p>
                                        @endif
                                    </div>

                                    <div class="shrink-0 text-right text-xs text-gray-600">
                                        <div class="inline-flex items-center justify-end gap-1 text-gray-500">
                                            <i class="ph-light {{ $this->deviceIcon($visitor) }} text-sm"></i>
                                            <span>{{ $this->deviceLabel($visitor) }}</span>
                                        </div>
                                        <p class="mt-1">{{ $visitor->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        @if ($this->readersCount > $this->readers->count())
                            <p class="border-t border-white/[0.06] py-3 text-center text-xs text-gray-600">
                                Showing latest {{ number_format($this->readers->count()) }} readers
                            </p>
                        @endif
                    @else
                        <div class="py-9 text-center">
                            <i class="ph-light ph-eye-slash text-2xl text-gray-600"></i>
                            <p class="mt-3 text-sm font-medium text-gray-300">No readers yet</p>
                            <p class="mt-1 text-xs text-gray-600">Readers will appear here.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </template>
</div>
