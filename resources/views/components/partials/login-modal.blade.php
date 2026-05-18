<div 
x-show="loginModal"
@open-login-modal.window="loginModal = true, modalBackdrop = true"
x-transition
@click.away="loginModal = false, modalBackdrop = false"
class="fixed left-1/2 top-1/2 -translate-1/2 h-[40rem] w-[32rem] rounded-3xl bg-black/90 text-gray-200 p-20 pt-30 z-[9999]">

    {{-- Header --}}
    <div>
        <h3 class="font-semibold text-xl">Welcome!</h3>
        <p class="text-sm text-gray-400 mt-2">Login to Stori to continue your interaction!</p>
    </div>

    {{-- Login with Google or Apple --}}
    <div class="mt-8 text-sm">
        <div class="border border-gray-800 rounded-xl py-3 text-center flex items-center justify-center space-x-1"> 
            <i class="ph-light ph-google-logo text-xl"></i>
            <span>Log in with Google</span>
        </div>
        <div class="border border-gray-800 rounded-xl py-3 text-center flex items-center justify-center space-x-1 mt-3">
            <i class="ph-light ph-apple-logo text-xl"></i>
            <span>Log in with Google</span>
        </div>
    </div>

    {{-- Divider --}}
    <div class="mt-9">
        <div class="border-gray-800"></div>
        <div class="w-fit p-3 -translate-y-1/2 text-center m-auto top-0 left-0 text-xs">OR</div>
    </div>
    
    {{-- Login with E-Mail --}}
    <div class="text-sm">
        <a href="{{ route('login') }}" wire:navigate class="border border-gray-800 rounded-xl py-3 text-center flex items-center justify-center space-x-1">
            <i class="ph-light ph-envelope-simple text-xl"></i>
            <span>Log in with E-Mail</span>
        </a>
    </div>

    {{-- Sign up link --}}
    <p class="text-sm text-center text-gray-400 mt-4">
        Don't have an account?
        <a href="{{ route('register') }}" wire:navigate class="text-indigo-400 underline">Sign up</a>
    </p>
</div>
