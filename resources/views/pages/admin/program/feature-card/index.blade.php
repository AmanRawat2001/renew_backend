<x-layouts::app :title="__('Feature Cards')">
    <div class="flex h-full w-full flex-1 flex-col gap-4">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-semibold text-neutral-900 dark:text-neutral-50">{{ __('Feature Cards') }}</h1>
                <p class="text-sm text-neutral-600 dark:text-neutral-400 mt-1">{{ __('Manage your feature cards') }}</p>
            </div>
            <a href="{{ route('admin.other_feature_cards.create') }}" wire:navigate class="inline-flex items-center gap-2 px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                {{ __('Add Card') }}
            </a>
        </div>

        <!-- Grid -->
        <div class="grid auto-rows-max gap-6 md:grid-cols-2 lg:grid-cols-3">
            @if ($cards->count())
                @foreach ($cards as $card)
                    <div class="group rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-800 overflow-hidden hover:shadow-lg transition-shadow">
                        <!-- Image -->
                        <div class="relative h-48 overflow-hidden bg-neutral-100 dark:bg-zinc-700">
                            <img src="{{ asset('storage/' . $card->image) }}" alt="{{ $card->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            <div class="absolute inset-0 bg-black/40"></div>
                            <!-- Overlay text -->
                            <div class="absolute inset-0 flex flex-col justify-end p-4">
                                <h3 class="text-lg font-semibold text-white mb-1">{!!  $card->title !!}</h3>
                                <p class="text-sm text-neutral-100 line-clamp-2">{{ strip_tags($card->description) }}</p>
                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="p-4 border-t border-neutral-200 dark:border-neutral-700">
                            <div class="flex items-center justify-between gap-2">
                                <div class="flex items-center gap-2 text-xs text-neutral-600 dark:text-neutral-400">
                                    <span>Order: <strong>{{ $card->sequence }}</strong></span>
                                    @if ($card->is_active)
                                        <span class="px-2 py-1 bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 rounded text-xs font-medium">Active</span>
                                    @else
                                        <span class="px-2 py-1 bg-gray-100 dark:bg-gray-900 text-gray-700 dark:text-gray-300 rounded text-xs font-medium">Inactive</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="mt-3 flex items-center gap-2">
                                <a href="{{ route('admin.other_feature_cards.edit', $card) }}" wire:navigate class="flex-1 inline-flex items-center justify-center gap-1 px-3 py-2 text-sm text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300 border border-blue-200 dark:border-blue-900 rounded hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Edit
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-800 p-12 text-center col-span-full">
                    <p class="text-neutral-600 dark:text-neutral-400 mb-4">{{ __('No feature cards found.') }}</p>
                    <a href="{{ route('admin.other_feature_cards.create') }}" wire:navigate class="inline-flex items-center gap-2 px-4 py-2 text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300">
                        {{ __('Create one now') }}
                    </a>
                </div>
            @endif
        </div>

        <!-- Pagination -->
        @if ($cards->hasPages())
            <div class="mt-6">
                {{ $cards->links() }}
            </div>
        @endif
    </div>
</x-layouts::app>
