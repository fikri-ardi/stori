<?php
    $wireModel = $attributes->wire('model');
    $model = $wireModel->value();
    $modifiers = $wireModel->modifiers();
    dd($modifiers);
    $isLive = $wireModel->hasModifier('live');
    $debounceIndex = $modifiers->search('debounce');
    $debounceMs = null;

    if ($debounceIndex !== false) {
        $duration = $modifiers->get($debounceIndex + 1);

        if ($duration && str($duration)->endsWith('ms')) {
            $debounceMs = (int) str($duration)->before('ms')->toString();
        }
    }
?>

<div x-data="setupEditor({
        content: $wire.entangle('{{ $model }}'),
        model: '{{ $model }}',
        live: @js($isLive),
        debounce: @js($debounceMs),
    })" 
    x-init="() => init($refs.editor)" 
    wire:ignore 
    {{ $attributes->whereDoesntStartWith('wire:model') }}>

    {{-- Editor menu --}}
   <div class="flex w-full border-b divide-x  dark:bg-slate-900 divide-slate-700 border-slate-700 rounded-t-md">
        <button type="button" class="flex justify-center p-2 transition dark:hover:bg-slate-700 w-14 rounded-tl-md" @click="toggleBold();">
            <i class="ph-light ph-text-b"></i>
        </button>

        <button type="button" class="flex justify-center p-2 transition dark:hover:bg-slate-700 w-14 dark:bg-slate-900" @click="toggleItalic()">
            <i class="ph-light ph-text-italic"></i>
        </button>

        <button type="button" class="flex justify-center p-2 transition dark:hover:bg-slate-700 w-14 dark:bg-slate-900" @click="toggleH2()">
            <i class="ph-light ph-text-h-one"></i>
        </button>

        <button type="button" class="flex justify-center p-2 transition dark:hover:bg-slate-700 w-14 dark:bg-slate-900" @click="toggleH3()">
            <i class="ph-light ph-text-h-two"></i>
        </button>

        <button type="button" class="flex justify-center p-2 transition dark:hover:bg-slate-700 w-14 dark:bg-slate-900" @click="toggleH4()">
            <i class="ph-light ph-text-h-three"></i>
        </button>

        <button type="button" class="flex justify-center p-2 transition dark:hover:bg-slate-700 w-14 dark:bg-slate-900" @click="toggleOrderedList()">
            <i class="ph-light ph-list-numbers"></i>
        </button>

        <button type="button" class="flex justify-center p-2 transition dark:hover:bg-slate-700 w-14 dark:bg-slate-900" @click="toggleBulletList()">
            <i class="ph-light ph-list"></i>
        </button>
    </div>

    {{-- Editor content --}}
    <div class="border-gray-300 shadow-sm rounded-b-md dark:border-gray-700 dark:bg-slate-900 dark:text-gray-300" 
        x-ref="editor">
    </div>
</div>
