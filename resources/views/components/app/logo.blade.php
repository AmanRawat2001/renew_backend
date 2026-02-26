@props([
    'sidebar' => false,
])

@if($sidebar)
    <flux:sidebar.brand name="ReNew Foundation" {{ $attributes }}>
        <x-slot name="logo" class="flex aspect-square size-8 items-center justify-center rounded-md">
            <img src="/images/renew-foundation-logo.png" alt="ReNew Foundation" class="size-full object-contain" />
        </x-slot>
    </flux:sidebar.brand>
@else
    <flux:brand name="ReNew Foundation" {{ $attributes }}>
        <x-slot name="logo" class="flex aspect-square size-8 items-center justify-center rounded-md">
            <img src="/images/renew-foundation-logo.png" alt="ReNew Foundation" class="size-full object-contain" />
        </x-slot>
    </flux:brand>
@endif
