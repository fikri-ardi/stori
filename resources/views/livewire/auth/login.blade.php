<div class="relative isolate w-full">
    <div class="fixed inset-0 -z-10 overflow-hidden bg-neutral-950">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_50%_0%,rgba(255,255,255,0.055),transparent_24rem),radial-gradient(circle_at_72%_18%,rgba(45,212,191,0.055),transparent_18rem),linear-gradient(180deg,rgba(10,10,10,0),rgba(10,10,10,0.72))]"></div>
        <div class="absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-white/15 to-transparent"></div>
    </div>

    <section class="overflow-hidden rounded-2xl border border-white/[0.12] bg-white/[0.07] shadow-[0_24px_90px_rgba(0,0,0,0.5),inset_0_1px_0_rgba(255,255,255,0.12)] backdrop-blur-2xl">
        <div class="border-b border-white/10 px-5 py-5 sm:px-6">
            <div class="flex items-center justify-between gap-4">
                <div>
                    <p class="text-xs font-medium uppercase tracking-[0.24em] text-teal-200/80">Stori</p>
                    <h1 class="mt-2 text-2xl font-semibold tracking-normal text-white">Welcome back</h1>
                </div>
            </div>

            <p class="mt-3 text-sm leading-6 text-gray-400">Login untuk lanjut membaca, menulis, dan menyimpan Stori.</p>
        </div>

        <div class="px-5 py-5 sm:px-6 sm:py-6">
            <x-auth-session-status class="mb-4 rounded-2xl border border-emerald-400/20 bg-emerald-400/10 px-4 py-3 text-center text-sm text-emerald-200" :status="session('status')" />

            <form method="POST" wire:submit="login" class="space-y-5">
                <div class="space-y-2">
                    <label for="email" class="text-sm font-medium text-gray-200">Email</label>
                    <div class="group flex h-12 items-center gap-3 rounded-2xl border border-white/10 bg-neutral-950/45 px-4 text-gray-300 shadow-[inset_0_1px_0_rgba(255,255,255,0.08)] transition focus-within:border-teal-200/50 focus-within:bg-neutral-950/65 focus-within:ring-2 focus-within:ring-teal-200/10">
                        <i class="ph-light ph-envelope-simple shrink-0 text-xl text-gray-500 transition group-focus-within:text-teal-200"></i>
                        <input
                            id="email"
                            wire:model="email"
                            type="email"
                            required
                            autofocus
                            autocomplete="email"
                            placeholder="email@example.com"
                            class="min-w-0 flex-1 bg-transparent text-sm text-white outline-none placeholder:text-gray-600"
                        />
                    </div>
                    @error('email')
                        <p class="text-sm text-red-300">{{ $message }}</p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <div class="flex items-center justify-between gap-3">
                        <label for="password" class="text-sm font-medium text-gray-200">Password</label>
                        @if (Route::has('password.request'))
                            <a class="text-sm font-medium text-gray-400 transition hover:text-white" href="{{ route('password.request') }}" wire:navigate>
                                Forgot?
                            </a>
                        @endif
                    </div>

                    <div class="group flex h-12 items-center gap-3 rounded-2xl border border-white/10 bg-neutral-950/45 px-4 text-gray-300 shadow-[inset_0_1px_0_rgba(255,255,255,0.08)] transition focus-within:border-teal-200/50 focus-within:bg-neutral-950/65 focus-within:ring-2 focus-within:ring-teal-200/10">
                        <i class="ph-light ph-lock-key shrink-0 text-xl text-gray-500 transition group-focus-within:text-teal-200"></i>
                        <input
                            id="password"
                            wire:model="password"
                            type="password"
                            required
                            autocomplete="current-password"
                            placeholder="Password"
                            class="min-w-0 flex-1 bg-transparent text-sm text-white outline-none placeholder:text-gray-600"
                        />
                    </div>
                    @error('password')
                        <p class="text-sm text-red-300">{{ $message }}</p>
                    @enderror
                </div>

                <label class="flex cursor-pointer items-center justify-between gap-4 rounded-2xl border border-white/10 bg-white/[0.04] px-4 py-3 text-sm text-gray-300 transition hover:bg-white/[0.07]">
                    <span class="flex items-center gap-3">
                        <span class="grid size-8 place-items-center rounded-xl bg-white/10 text-gray-400">
                            <i class="ph-light ph-clock-counter-clockwise text-lg"></i>
                        </span>
                        Remember me
                    </span>
                    <input
                        wire:model="remember"
                        type="checkbox"
                        class="size-4 rounded border-white/20 bg-neutral-950 text-white accent-white"
                    />
                </label>

                <button
                    type="submit"
                    class="group flex h-12 w-full items-center justify-center gap-2 rounded-2xl bg-white px-4 text-sm font-semibold text-neutral-950 shadow-xl shadow-black/25 transition hover:-translate-y-0.5 hover:bg-teal-100 focus:outline-none focus:ring-2 focus:ring-white/30 active:translate-y-0"
                >
                    <span wire:loading.remove wire:target="login">Log in</span>
                    <span wire:loading wire:target="login">Checking...</span>
                    <i wire:loading.remove wire:target="login" class="ph-light ph-arrow-right text-xl transition group-hover:translate-x-0.5"></i>
                    <i wire:loading wire:target="login" class="ph-light ph-spinner-gap text-xl animate-spin"></i>
                </button>
            </form>

            @if (Route::has('register'))
                <div class="mt-5 text-center text-sm text-gray-400">
                    <span>Belum punya akun?</span>
                    <a class="font-medium text-white underline-offset-4 transition hover:text-teal-100 hover:underline" href="{{ route('register') }}" wire:navigate>
                        Sign up
                    </a>
                </div>
            @endif
        </div>
    </section>
</div>
