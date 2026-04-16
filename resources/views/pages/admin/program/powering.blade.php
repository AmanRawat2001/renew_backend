<x-layouts::app :title="__('Powering Education')">
    <div class="flex h-full w-full flex-1 flex-col gap-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-semibold text-neutral-900 dark:text-neutral-50">{{ __('Powering Education') }}</h1>
                <p class="text-sm text-neutral-600 dark:text-neutral-400 mt-1">{{ __('Manage all program content') }}</p>
            </div>
        </div>

        <!-- Sliders Section -->
        <div class="space-y-4">
            <div>
                <h2 class="text-2xl font-bold text-neutral-900 dark:text-neutral-50">{{ __('Sliders') }}</h2>
            </div>
            @if ($sliders->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    @foreach ($sliders as $slider)
                        <div class="group rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-800 overflow-hidden hover:shadow-lg transition-all">
                            <!-- Image -->
                            <div class="relative h-48 overflow-hidden bg-gray-100 dark:bg-gray-900">
                                @if ($slider->image)
                                    <img src="{{ asset('uploads/' . $slider->image) }}" alt="{{ $slider->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-400">
                                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-black/40"></div>
                                <!-- Badge -->
                                <div class="absolute top-3 right-3 inline-block px-3 py-1 rounded-full text-xs font-semibold 
                                    {{ $slider->is_active ? 'bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300' : 'bg-gray-100 dark:bg-gray-900/30 text-gray-700 dark:text-gray-300' }}">
                                    {{ $slider->is_active ? __('Active') : __('Inactive') }}
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-4">
                                <!-- Title -->
                                <h3 class="text-base font-semibold text-neutral-900 dark:text-neutral-50 line-clamp-2">
                                    {!! $slider->title !!}
                                </h3>

                                <!-- Sequence -->
                                <p class="mt-3 text-xs text-neutral-500 dark:text-neutral-400">
                                    {{ __('Sequence') }}: <span class="font-semibold">{{ $slider->sequence }}</span>
                                </p>

                                <!-- Actions -->
                                <div class="mt-4 flex items-center gap-2 pt-4 border-t border-neutral-200 dark:border-neutral-700">
                                    <a href="{{ route('admin.main_sliders.edit', $slider) }}" class="flex-1 inline-flex items-center justify-center gap-1 px-3 py-2 text-sm text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300 border border-blue-200 dark:border-blue-900 rounded hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        {{ __('Edit') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-800 p-12 text-center">
                    <p class="text-neutral-600 dark:text-neutral-400">{{ __('No sliders yet') }}</p>
                </div>
            @endif
        </div>

        <!-- Mission Slides Section -->
        <div class="space-y-4">
            <div>
                <h2 class="text-2xl font-bold text-neutral-900 dark:text-neutral-50">{{ __('Mission Slides') }}</h2>
            </div>
            @if ($missionSlides->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                    @foreach ($missionSlides as $slide)
                        <div class="group rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-800 overflow-hidden hover:shadow-lg transition-all">
                            <!-- Image -->
                            <div class="relative h-48 overflow-hidden bg-gray-100 dark:bg-gray-900">
                                <img src="{{ asset('uploads/' . $slide->image) }}" alt="{{ $slide->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
                                <div class="absolute inset-0 bg-black/40"></div>
                                <!-- Badge -->
                                <div class="absolute top-3 right-3 inline-block px-3 py-1 rounded-full text-xs font-semibold 
                                    {{ $slide->is_active ? 'bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300' : 'bg-gray-100 dark:bg-gray-900/30 text-gray-700 dark:text-gray-300' }}">
                                    {{ $slide->is_active ? __('Active') : __('Inactive') }}
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-4">
                                <!-- Title -->
                                <h3 class="text-base font-semibold text-neutral-900 dark:text-neutral-50 line-clamp-2">
                                    {!! Str::limit(strip_tags($slide->title), 50) !!}
                                </h3>

                                <!-- Sequence -->
                                <p class="mt-3 text-xs text-neutral-500 dark:text-neutral-400">
                                    {{ __('Sequence') }}: <span class="font-semibold">{{ $slide->sequence }}</span>
                                </p>

                                <!-- Actions -->
                                <div class="mt-4 flex items-center gap-2 pt-4 border-t border-neutral-200 dark:border-neutral-700">
                                    <a href="{{ route('admin.other_mission_sliders.edit', $slide) }}" class="flex-1 inline-flex items-center justify-center gap-1 px-3 py-2 text-sm text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300 border border-blue-200 dark:border-blue-900 rounded hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        {{ __('Edit') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-800 p-12 text-center">
                    <p class="text-neutral-600 dark:text-neutral-400">{{ __('No mission slides yet') }}</p>
                </div>
            @endif
        </div>

        <!-- Impact Stories Section -->
        <div class="space-y-4">
            <div>
                <h2 class="text-2xl font-bold text-neutral-900 dark:text-neutral-50">{{ __('Impact Stories') }}</h2>
            </div>
            @if ($impactStories->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($impactStories as $story)
                        <div class="group rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-800 overflow-hidden hover:shadow-lg transition-all">
                            <!-- Image -->
                            <div class="relative h-48 overflow-hidden bg-gray-100 dark:bg-gray-900">
                                @if ($story->image)
                                    <img src="{{ asset('uploads/' . $story->image) }}" alt="{{ $story->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-400">
                                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-black/40"></div>
                                <!-- Badge -->
                                <div class="absolute top-3 right-3 inline-block px-3 py-1 rounded-full text-xs font-semibold 
                                    {{ $story->status ? 'bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300' : 'bg-gray-100 dark:bg-gray-900/30 text-gray-700 dark:text-gray-300' }}">
                                    {{ $story->status ? __('Active') : __('Inactive') }}
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-4">
                                <!-- Title -->
                                <h3 class="text-base font-semibold text-neutral-900 dark:text-neutral-50 line-clamp-3">
                                    {{ $story->name }}<br>
                                    {{ $story->designation }}<br>
                                    {{ $story->location }}
                                </h3>
                                <p class="mt-1 text-sm text-neutral-500 dark:text-neutral-400">
                                    {{ Str::limit(strip_tags($story->description), 100) }}
                                </p>

                                <!-- Sequence -->
                                <p class="mt-3 text-xs text-neutral-500 dark:text-neutral-400">
                                    {{ __('Sequence') }}: <span class="font-semibold">{{ $story->sort_order  }}</span>
                                </p>

                                <!-- Actions -->
                                <div class="mt-4 flex items-center gap-2 pt-4 border-t border-neutral-200 dark:border-neutral-700">
                                    <a href="{{ route('admin.impact_stories.edit', $story) }}" class="flex-1 inline-flex items-center justify-center gap-1 px-3 py-2 text-sm text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300 border border-blue-200 dark:border-blue-900 rounded hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        {{ __('Edit') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-800 p-12 text-center">
                    <p class="text-neutral-600 dark:text-neutral-400">{{ __('No impact stories yet') }}</p>
                </div>
            @endif
        </div>

        <!-- Impact Story Sections Section -->
        <div class="space-y-4">
            <div>
                <h2 class="text-2xl font-bold text-neutral-900 dark:text-neutral-50">{{ __('Impact Story Sections') }}</h2>
            </div>
            <div
                class="rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-800 overflow-hidden">
                @if ($impactStorySections->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr
                                    class="border-b border-neutral-200 dark:border-neutral-700 bg-neutral-50 dark:bg-zinc-900">
                                    <th
                                        class="px-4 py-3 text-left font-semibold text-neutral-900 dark:text-neutral-50">
                                        {{ __('Title') }}</th>
                                    <th
                                        class="px-4 py-3 text-left font-semibold text-neutral-900 dark:text-neutral-50">
                                        {{ __('Sequence') }}</th>
                                        <th
                                        class="px-4 py-3 text-left font-semibold text-neutral-900 dark:text-neutral-50">
                                        {{ __('External Link') }}</th>
                                        
                                    <th
                                        class="px-4 py-3 text-right font-semibold text-neutral-900 dark:text-neutral-50">
                                        {{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($impactStorySections as $section)
                                    <tr
                                        class="border-b border-neutral-200 dark:border-neutral-700 hover:bg-neutral-50 dark:hover:bg-zinc-700/50">
                                        <td class="px-4 py-3 text-neutral-900 dark:text-neutral-50 max-w-xs truncate">
                                            {!! Str::limit(strip_tags($section->title), 50) !!}</td>
                                        <td class="px-4 py-3 text-neutral-600 dark:text-neutral-400 max-w-xs truncate">
                                            {{ $section->sort_order }}</td>
                                            <td class="px-4 py-3 text-neutral-600 dark:text-neutral-400 max-w-xs truncate">
                                            {{ $section->external_url }}</td>
                                        <td class="px-4 py-3 text-right"><a
                                                href="{{ route('admin.impact_story_sections.edit', $section) }}"
                                                class="text-blue-600 dark:text-blue-400 hover:underline text-xs">{{ __('Edit') }}</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="p-8 text-center text-neutral-600 dark:text-neutral-400">
                        {{ __('No impact story sections yet') }}</div>
                @endif
            </div>
        </div>

        <!-- Impact Cards Section -->
        <div class="space-y-4">
            <div>
                <h2 class="text-2xl font-bold text-neutral-900 dark:text-neutral-50">{{ __('Impact Cards') }}</h2>
            </div>
            <div
                class="rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-800 overflow-hidden">
                @if ($impacts->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr
                                    class="border-b border-neutral-200 dark:border-neutral-700 bg-neutral-50 dark:bg-zinc-900">
                                    <th class="px-4 py-3 text-left font-semibold text-neutral-900 dark:text-neutral-50">
                                        {{ __('Metric') }}</th>
                                    <th class="px-4 py-3 text-left font-semibold text-neutral-900 dark:text-neutral-50">
                                        {{ __('Title') }}</th>
                                    <th class="px-4 py-3 text-left font-semibold text-neutral-900 dark:text-neutral-50">
                                        {{ __('Sequence') }}</th>
                                    <th class="px-4 py-3 text-left font-semibold text-neutral-900 dark:text-neutral-50">
                                        {{ __('Arrow') }}</th>
                                    <th class="px-4 py-3 text-left font-semibold text-neutral-900 dark:text-neutral-50">
                                        {{ __('Status') }}</th>
                                    <th
                                        class="px-4 py-3 text-right font-semibold text-neutral-900 dark:text-neutral-50">
                                        {{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($impacts as $impact)
                                    <tr
                                        class="border-b border-neutral-200 dark:border-neutral-700 hover:bg-neutral-50 dark:hover:bg-zinc-700/50">
                                        <td class="px-4 py-3 font-semibold text-neutral-900 dark:text-neutral-50">
                                            {{ $impact->metric_number }}</td>
                                        <td class="px-4 py-3 text-neutral-900 dark:text-neutral-50 max-w-xs truncate">
                                            {!! Str::limit(strip_tags($impact->title), 40) !!}</td>
                                        <td class="px-4 py-3 text-neutral-600 dark:text-neutral-400">
                                            {{ $impact->sequence }}</td>
                                        <td class="px-4 py-3">{{ $impact->down_arrow ? '⬇️' : '—' }}</td>
                                        <td class="px-4 py-3">{{ $impact->is_active ? '✓' : '—' }}</td>
                                        <td class="px-4 py-3 text-right"><a
                                                href="{{ route('admin.other_impacts.edit', $impact) }}"
                                                class="text-blue-600 dark:text-blue-400 hover:underline text-xs">{{ __('Edit') }}</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="p-8 text-center text-neutral-600 dark:text-neutral-400">{{ __('No impact cards yet') }}
                    </div>
                @endif
            </div>
        </div>

        <!-- Content Sections Section -->
        <div class="space-y-4">
            <div>
                <h2 class="text-2xl font-bold text-neutral-900 dark:text-neutral-50">{{ __('Content Sections') }}</h2>
            </div>
            <div
                class="rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-800 overflow-hidden">
                @if ($contentSections->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr
                                    class="border-b border-neutral-200 dark:border-neutral-700 bg-neutral-50 dark:bg-zinc-900">
                                    <th
                                        class="px-4 py-3 text-left font-semibold text-neutral-900 dark:text-neutral-50">
                                        {{ __('Title') }}</th>
                                    <th
                                        class="px-4 py-3 text-left font-semibold text-neutral-900 dark:text-neutral-50">
                                        {{ __('Subtitle') }}</th>
                                    <th
                                        class="px-4 py-3 text-left font-semibold text-neutral-900 dark:text-neutral-50">
                                        {{ __('Section Key') }}</th>
                                    <th
                                        class="px-4 py-3 text-right font-semibold text-neutral-900 dark:text-neutral-50">
                                        {{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contentSections as $section)
                                    <tr
                                        class="border-b border-neutral-200 dark:border-neutral-700 hover:bg-neutral-50 dark:hover:bg-zinc-700/50">
                                        <td class="px-4 py-3 text-neutral-900 dark:text-neutral-50 max-w-xs truncate">
                                            {!! Str::limit(strip_tags($section->title), 50) !!}</td>
                                        <td class="px-4 py-3 text-neutral-600 dark:text-neutral-400 max-w-xs truncate">
                                            {!! Str::limit(strip_tags($section->subtitle), 50) !!}</td>
                                        <td class="px-4 py-3 text-neutral-600 dark:text-neutral-400">
                                            {{ $section->section_key }}</td>
                                        <td class="px-4 py-3 text-right"><a
                                                href="{{ route('admin.other_sections.edit', $section) }}"
                                                class="text-blue-600 dark:text-blue-400 hover:underline text-xs">{{ __('Edit') }}</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="p-8 text-center text-neutral-600 dark:text-neutral-400">
                        {{ __('No content sections yet') }}</div>
                @endif
            </div>
        </div>
    </div>
</x-layouts::app>   