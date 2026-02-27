<x-layouts::app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-semibold text-neutral-900 dark:text-neutral-50">{{ __('Dashboard') }}</h1>
                <p class="text-sm text-neutral-600 dark:text-neutral-400 mt-1">{{ __('Manage all your content') }}</p>
            </div>
        </div>

        <!-- Sliders Section -->
        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-bold text-neutral-900 dark:text-neutral-50">{{ __('Sliders') }}</h2>
                <a href="{{ route('admin.sliders.create') }}" wire:navigate class="inline-flex items-center gap-2 px-3 py-1 text-sm bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    {{ __('Add') }}
                </a>
            </div>
            <div class="rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-800 overflow-hidden">
                @if ($sliders->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="border-b border-neutral-200 dark:border-neutral-700 bg-neutral-50 dark:bg-zinc-900">
                                    <th class="px-4 py-3 text-left font-semibold text-neutral-900 dark:text-neutral-50">{{ __('Title') }}</th>
                                    <th class="px-4 py-3 text-left font-semibold text-neutral-900 dark:text-neutral-50">{{ __('Sequence') }}</th>
                                    <th class="px-4 py-3 text-left font-semibold text-neutral-900 dark:text-neutral-50">{{ __('Status') }}</th>
                                    <th class="px-4 py-3 text-right font-semibold text-neutral-900 dark:text-neutral-50">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sliders as $slider)
                                    <tr class="border-b border-neutral-200 dark:border-neutral-700 hover:bg-neutral-50 dark:hover:bg-zinc-700/50">
                                        <td class="px-4 py-3 text-neutral-900 dark:text-neutral-50 max-w-xs truncate">{!! Str::limit(strip_tags($slider->title), 50) !!}</td>
                                        <td class="px-4 py-3 text-neutral-600 dark:text-neutral-400">{{ $slider->sequence }}</td>
                                        <td class="px-4 py-3">{{ $slider->is_active ? '✓' : '—' }}</td>
                                        <td class="px-4 py-3 text-right"><a href="{{ route('admin.sliders.edit', $slider) }}" class="text-blue-600 dark:text-blue-400 hover:underline text-xs">{{ __('Edit') }}</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="p-8 text-center text-neutral-600 dark:text-neutral-400">{{ __('No sliders yet') }}</div>
                @endif
            </div>
        </div>

        <!-- Mission Slides Section -->
        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-bold text-neutral-900 dark:text-neutral-50">{{ __('Mission Slides') }}</h2>
                <a href="{{ route('admin.mission_sliders.create') }}" wire:navigate class="inline-flex items-center gap-2 px-3 py-1 text-sm bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    {{ __('Add') }}
                </a>
            </div>
            <div class="rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-800 overflow-hidden">
                @if ($missionSlides->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="border-b border-neutral-200 dark:border-neutral-700 bg-neutral-50 dark:bg-zinc-900">
                                    <th class="px-4 py-3 text-left font-semibold text-neutral-900 dark:text-neutral-50">{{ __('Title') }}</th>
                                    <th class="px-4 py-3 text-left font-semibold text-neutral-900 dark:text-neutral-50">{{ __('Author') }}</th>
                                    <th class="px-4 py-3 text-left font-semibold text-neutral-900 dark:text-neutral-50">{{ __('Sequence') }}</th>
                                    <th class="px-4 py-3 text-left font-semibold text-neutral-900 dark:text-neutral-50">{{ __('Status') }}</th>
                                    <th class="px-4 py-3 text-right font-semibold text-neutral-900 dark:text-neutral-50">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($missionSlides as $slide)
                                    <tr class="border-b border-neutral-200 dark:border-neutral-700 hover:bg-neutral-50 dark:hover:bg-zinc-700/50">
                                        <td class="px-4 py-3 text-neutral-900 dark:text-neutral-50 max-w-xs truncate">{!! Str::limit(strip_tags($slide->title), 50) !!}</td>
                                        <td class="px-4 py-3 text-neutral-600 dark:text-neutral-400">{{ $slide->author_name ?? '—' }}</td>
                                        <td class="px-4 py-3 text-neutral-600 dark:text-neutral-400">{{ $slide->sequence }}</td>
                                        <td class="px-4 py-3">{{ $slide->is_active ? '✓' : '—' }}</td>
                                        <td class="px-4 py-3 text-right"><a href="{{ route('admin.mission_sliders.edit', $slide) }}" class="text-blue-600 dark:text-blue-400 hover:underline text-xs">{{ __('Edit') }}</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="p-8 text-center text-neutral-600 dark:text-neutral-400">{{ __('No mission slides yet') }}</div>
                @endif
            </div>
        </div>

        <!-- Impact Cards Section -->
        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-bold text-neutral-900 dark:text-neutral-50">{{ __('Impact Cards') }}</h2>
                <a href="{{ route('admin.impacts.create') }}" wire:navigate class="inline-flex items-center gap-2 px-3 py-1 text-sm bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    {{ __('Add') }}
                </a>
            </div>
            <div class="rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-800 overflow-hidden">
                @if ($impacts->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="border-b border-neutral-200 dark:border-neutral-700 bg-neutral-50 dark:bg-zinc-900">
                                    <th class="px-4 py-3 text-left font-semibold text-neutral-900 dark:text-neutral-50">{{ __('Metric') }}</th>
                                    <th class="px-4 py-3 text-left font-semibold text-neutral-900 dark:text-neutral-50">{{ __('Title') }}</th>
                                    <th class="px-4 py-3 text-left font-semibold text-neutral-900 dark:text-neutral-50">{{ __('Sequence') }}</th>
                                    <th class="px-4 py-3 text-left font-semibold text-neutral-900 dark:text-neutral-50">{{ __('Arrow') }}</th>
                                    <th class="px-4 py-3 text-left font-semibold text-neutral-900 dark:text-neutral-50">{{ __('Status') }}</th>
                                    <th class="px-4 py-3 text-right font-semibold text-neutral-900 dark:text-neutral-50">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($impacts as $impact)
                                    <tr class="border-b border-neutral-200 dark:border-neutral-700 hover:bg-neutral-50 dark:hover:bg-zinc-700/50">
                                        <td class="px-4 py-3 font-semibold text-neutral-900 dark:text-neutral-50">{{ $impact->metric_number }}</td>
                                        <td class="px-4 py-3 text-neutral-900 dark:text-neutral-50 max-w-xs truncate">{!! Str::limit(strip_tags($impact->title), 40) !!}</td>
                                        <td class="px-4 py-3 text-neutral-600 dark:text-neutral-400">{{ $impact->sequence }}</td>
                                        <td class="px-4 py-3">{{ $impact->down_arrow ? '⬇️' : '—' }}</td>
                                        <td class="px-4 py-3">{{ $impact->is_active ? '✓' : '—' }}</td>
                                        <td class="px-4 py-3 text-right"><a href="{{ route('admin.impacts.edit', $impact) }}" class="text-blue-600 dark:text-blue-400 hover:underline text-xs">{{ __('Edit') }}</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="p-8 text-center text-neutral-600 dark:text-neutral-400">{{ __('No impact cards yet') }}</div>
                @endif
            </div>
        </div>

        <!-- Feature Cards Section -->
        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-bold text-neutral-900 dark:text-neutral-50">{{ __('Feature Cards') }}</h2>
                <a href="{{ route('admin.feature-cards.create') }}" wire:navigate class="inline-flex items-center gap-2 px-3 py-1 text-sm bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    {{ __('Add') }}
                </a>
            </div>
            <div class="rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-800 overflow-hidden">
                @if ($featureCards->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="border-b border-neutral-200 dark:border-neutral-700 bg-neutral-50 dark:bg-zinc-900">
                                    <th class="px-4 py-3 text-left font-semibold text-neutral-900 dark:text-neutral-50">{{ __('Icon') }}</th>
                                    <th class="px-4 py-3 text-left font-semibold text-neutral-900 dark:text-neutral-50">{{ __('Title') }}</th>
                                    <th class="px-4 py-3 text-left font-semibold text-neutral-900 dark:text-neutral-50">{{ __('Sequence') }}</th>
                                    <th class="px-4 py-3 text-right font-semibold text-neutral-900 dark:text-neutral-50">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($featureCards as $card)
                                    <tr class="border-b border-neutral-200 dark:border-neutral-700 hover:bg-neutral-50 dark:hover:bg-zinc-700/50">
                                        <td class="px-4 py-3">
                                            @if ($card->icon)
                                                <img src="{{ asset('storage/' . $card->icon) }}" alt="{{ $card->title }}" class="h-8 w-8" />
                                            @else
                                                <span class="text-neutral-400">—</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 text-neutral-900 dark:text-neutral-50 max-w-xs truncate">{{ $card->title }}</td>
                                        <td class="px-4 py-3 text-neutral-600 dark:text-neutral-400">{{ $card->sequence }}</td>
                                        <td class="px-4 py-3 text-right"><a href="{{ route('admin.feature-cards.edit', $card) }}" class="text-blue-600 dark:text-blue-400 hover:underline text-xs">{{ __('Edit') }}</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="p-8 text-center text-neutral-600 dark:text-neutral-400">{{ __('No feature cards yet') }}</div>
                @endif
            </div>
        </div>

        <!-- Content Sections Section -->
        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-bold text-neutral-900 dark:text-neutral-50">{{ __('Content Sections') }}</h2>
                <a href="{{ route('admin.sections.create') }}" wire:navigate class="inline-flex items-center gap-2 px-3 py-1 text-sm bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    {{ __('Add') }}
                </a>
            </div>
            <div class="rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-800 overflow-hidden">
                @if ($contentSections->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="border-b border-neutral-200 dark:border-neutral-700 bg-neutral-50 dark:bg-zinc-900">
                                    <th class="px-4 py-3 text-left font-semibold text-neutral-900 dark:text-neutral-50">{{ __('Title') }}</th>
                                    <th class="px-4 py-3 text-left font-semibold text-neutral-900 dark:text-neutral-50">{{ __('Subtitle') }}</th>
                                    <th class="px-4 py-3 text-left font-semibold text-neutral-900 dark:text-neutral-50">{{ __('Section Key') }}</th>
                                    <th class="px-4 py-3 text-right font-semibold text-neutral-900 dark:text-neutral-50">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contentSections as $section)
                                    <tr class="border-b border-neutral-200 dark:border-neutral-700 hover:bg-neutral-50 dark:hover:bg-zinc-700/50">
                                        <td class="px-4 py-3 text-neutral-900 dark:text-neutral-50 max-w-xs truncate">{!! Str::limit(strip_tags($section->title), 50) !!}</td>
                                        <td class="px-4 py-3 text-neutral-600 dark:text-neutral-400 max-w-xs truncate">{!! Str::limit(strip_tags($section->subtitle), 50) !!}</td>
                                        <td class="px-4 py-3 text-neutral-600 dark:text-neutral-400">{{ $section->section_key }}</td>
                                        <td class="px-4 py-3 text-right"><a href="{{ route('admin.sections.edit', $section) }}" class="text-blue-600 dark:text-blue-400 hover:underline text-xs">{{ __('Edit') }}</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="p-8 text-center text-neutral-600 dark:text-neutral-400">{{ __('No content sections yet') }}</div>
                @endif
            </div>
        </div>
    </div>
</x-layouts::app>
