<x-layouts::app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-semibold text-neutral-900 dark:text-neutral-50">{{ __('Dashboard') }}</h1>
                <p class="text-sm text-neutral-600 dark:text-neutral-400 mt-1">{{ __('Manage your website pages') }}</p>
            </div>
        </div>

        <!-- Pages Grid -->
        <div class="grid auto-rows-min gap-4 md:grid-cols-2 lg:grid-cols-4">
            @foreach ($pages as $page)
                @php
                    $colorMap = [
                        'blue' => ['bg' => 'from-blue-50 dark:from-blue-900/20', 'icon' => 'bg-blue-100 dark:bg-blue-900/30', 'text' => 'text-blue-600 dark:text-blue-400', 'hover' => 'group-hover:text-blue-600 dark:group-hover:text-blue-400', 'border' => 'hover:border-blue-400 dark:hover:border-blue-500'],
                        'green' => ['bg' => 'from-green-50 dark:from-green-900/20', 'icon' => 'bg-green-100 dark:bg-green-900/30', 'text' => 'text-green-600 dark:text-green-400', 'hover' => 'group-hover:text-green-600 dark:group-hover:text-green-400', 'border' => 'hover:border-green-400 dark:hover:border-green-500'],
                        'purple' => ['bg' => 'from-purple-50 dark:from-purple-900/20', 'icon' => 'bg-purple-100 dark:bg-purple-900/30', 'text' => 'text-purple-600 dark:text-purple-400', 'hover' => 'group-hover:text-purple-600 dark:group-hover:text-purple-400', 'border' => 'hover:border-purple-400 dark:hover:border-purple-500'],
                        'orange' => ['bg' => 'from-orange-50 dark:from-orange-900/20', 'icon' => 'bg-orange-100 dark:bg-orange-900/30', 'text' => 'text-orange-600 dark:text-orange-400', 'hover' => 'group-hover:text-orange-600 dark:group-hover:text-orange-400', 'border' => 'hover:border-orange-400 dark:hover:border-orange-500'],
                        'pink' => ['bg' => 'from-pink-50 dark:from-pink-900/20', 'icon' => 'bg-pink-100 dark:bg-pink-900/30', 'text' => 'text-pink-600 dark:text-pink-400', 'hover' => 'group-hover:text-pink-600 dark:group-hover:text-pink-400', 'border' => 'hover:border-pink-400 dark:hover:border-pink-500'],
                        'indigo' => ['bg' => 'from-indigo-50 dark:from-indigo-900/20', 'icon' => 'bg-indigo-100 dark:bg-indigo-900/30', 'text' => 'text-indigo-600 dark:text-indigo-400', 'hover' => 'group-hover:text-indigo-600 dark:group-hover:text-indigo-400', 'border' => 'hover:border-indigo-400 dark:hover:border-indigo-500'],
                        'cyan' => ['bg' => 'from-cyan-50 dark:from-cyan-900/20', 'icon' => 'bg-cyan-100 dark:bg-cyan-900/30', 'text' => 'text-cyan-600 dark:text-cyan-400', 'hover' => 'group-hover:text-cyan-600 dark:group-hover:text-cyan-400', 'border' => 'hover:border-cyan-400 dark:hover:border-cyan-500'],
                        'amber' => ['bg' => 'from-amber-50 dark:from-amber-900/20', 'icon' => 'bg-amber-100 dark:bg-amber-900/30', 'text' => 'text-amber-600 dark:text-amber-400', 'hover' => 'group-hover:text-amber-600 dark:group-hover:text-amber-400', 'border' => 'hover:border-amber-400 dark:hover:border-amber-500'],
                    ];
                    $colors = $colorMap[$page['color']] ?? $colorMap['blue'];
                @endphp
                
                @if ($page['enabled'])
                    <a href="{{ route($page['route']) }}" wire:navigate class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 {{ $colors['border'] }} hover:shadow-lg transition-all cursor-pointer bg-white dark:bg-zinc-800 flex items-center justify-center group">
                        <div class="absolute inset-0 bg-gradient-to-br {{ $colors['bg'] }} opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        <div class="relative flex flex-col items-center gap-3 text-center z-10 px-4">
                            <div class="p-3 rounded-lg {{ $colors['icon'] }}">
                                <svg class="w-8 h-8 {{ $colors['text'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $page['icon'] }}" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-neutral-900 dark:text-neutral-50 {{ $colors['hover'] }} transition-colors">{{ __($page['name']) }}</h3>
                                <p class="text-xs text-neutral-600 dark:text-neutral-400 mt-1">{{ __($page['description']) }}</p>
                            </div>
                        </div>
                    </a>
                @else
                    <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-800 flex items-center justify-center opacity-60 cursor-not-allowed">
                        <div class="absolute inset-0 bg-neutral-50 dark:bg-zinc-700 opacity-50"></div>
                        <div class="relative flex flex-col items-center gap-3 text-center z-10 px-4">
                            <div class="p-3 rounded-lg bg-neutral-100 dark:bg-neutral-700">
                                <svg class="w-8 h-8 text-neutral-400 dark:text-neutral-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $page['icon'] }}" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-sm font-semibold text-neutral-600 dark:text-neutral-400">{{ __($page['name']) }}</h3>
                                <p class="text-xs text-neutral-500 dark:text-neutral-500 mt-1">{{ __($page['description']) }}</p>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</x-layouts::app>
