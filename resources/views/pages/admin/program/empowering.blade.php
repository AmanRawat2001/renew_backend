<x-layouts::app :title="__('Empowering Lives')">
    <div class="flex h-full w-full flex-1 flex-col gap-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-semibold text-neutral-900 dark:text-neutral-50">{{ __('Empowering Lives') }}</h1>
                <p class="text-sm text-neutral-600 dark:text-neutral-400 mt-1">{{ __('Manage all program content') }}</p>
            </div>
        </div>

        <!-- Sliders Section -->
        <div class="space-y-4">
            <div>
                <h2 class="text-2xl font-bold text-neutral-900 dark:text-neutral-50">{{ __('Sliders') }}</h2>
            </div>
            <div
                class="rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-800 overflow-hidden">
                @if ($sliders->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr
                                    class="border-b border-neutral-200 dark:border-neutral-700 bg-neutral-50 dark:bg-zinc-900">
                                    <th class="px-4 py-3 text-left font-semibold text-neutral-900 dark:text-neutral-50">
                                        {{ __('Title') }}</th>
                                    <th class="px-4 py-3 text-left font-semibold text-neutral-900 dark:text-neutral-50">
                                        {{ __('Image') }}</th>
                                    <th class="px-4 py-3 text-left font-semibold text-neutral-900 dark:text-neutral-50">
                                        {{ __('Sequence') }}</th>
                                    <th class="px-4 py-3 text-left font-semibold text-neutral-900 dark:text-neutral-50">
                                        {{ __('Status') }}</th>
                                    <th
                                        class="px-4 py-3 text-right font-semibold text-neutral-900 dark:text-neutral-50">
                                        {{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sliders as $slider)
                                    <tr
                                        class="border-b border-neutral-200 dark:border-neutral-700 hover:bg-neutral-50 dark:hover:bg-zinc-700/50">
                                        <td class="px-4 py-3 text-neutral-900 dark:text-neutral-50 max-w-xs truncate">
                                            {!!$slider->title !!}</td>
                                        <td class="px-4 py-3">
                                            @if ($slider->image)
                                                <img src="{{ $slider->image ? asset('storage/' . $slider->image) : asset('images/default.png') }}"
                                                    alt="{{ $slider->title }}" class="h-10 object-cover rounded" />
                                            @else
                                                <span class="text-neutral-400">—</span>
                                            @endif
                                        <td class="px-4 py-3 text-neutral-600 dark:text-neutral-400">
                                            {{ $slider->sequence }}</td>
                                        <td class="px-4 py-3">{{ $slider->is_active ? '✓' : '—' }}</td>
                                        <td class="px-4 py-3 text-right"><a
                                                href="{{ route('admin.main_sliders.edit', $slider) }}"
                                                class="text-blue-600 dark:text-blue-400 hover:underline text-xs">{{ __('Edit') }}</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="p-8 text-center text-neutral-600 dark:text-neutral-400">{{ __('No sliders yet') }}
                    </div>
                @endif
            </div>
        </div>

        <!-- Mission Slides Section -->
        <div class="space-y-4">
            <div>
                <h2 class="text-2xl font-bold text-neutral-900 dark:text-neutral-50">{{ __('Mission Slides') }}</h2>
            </div>
            <div
                class="rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-800 overflow-hidden">
                @if ($missionSlides->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr
                                    class="border-b border-neutral-200 dark:border-neutral-700 bg-neutral-50 dark:bg-zinc-900">
                                    <th class="px-4 py-3 text-left font-semibold text-neutral-900 dark:text-neutral-50">
                                        {{ __('Title') }}</th>
                                    <th class="px-4 py-3 text-left font-semibold text-neutral-900 dark:text-neutral-50">
                                        {{ __('Image') }}</th>
                                    <th class="px-4 py-3 text-left font-semibold text-neutral-900 dark:text-neutral-50">
                                        {{ __('Sequence') }}</th>
                                    <th class="px-4 py-3 text-left font-semibold text-neutral-900 dark:text-neutral-50">
                                        {{ __('Status') }}</th>
                                    <th
                                        class="px-4 py-3 text-right font-semibold text-neutral-900 dark:text-neutral-50">
                                        {{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($missionSlides as $slide)
                                    <tr
                                        class="border-b border-neutral-200 dark:border-neutral-700 hover:bg-neutral-50 dark:hover:bg-zinc-700/50">
                                        <td class="px-4 py-3 text-neutral-900 dark:text-neutral-50 max-w-xs truncate">
                                            {!! Str::limit(strip_tags($slide->title), 50) !!}</td>
                                        <td class="px-4 py-3 text-neutral-600 dark:text-neutral-400">
                                            <img src="{{ $slide->image ? asset('storage/' . $slide->image) : asset('images/default.png') }}" alt="{!! Str::limit(strip_tags($slide->title), 50) !!}" class="h-15 object-cover rounded" />
                                        </td>
                                        <td class="px-4 py-3 text-neutral-600 dark:text-neutral-400">
                                            {{ $slide->sequence }}</td>
                                        <td class="px-4 py-3">{{ $slide->is_active ? '✓' : '—' }}</td>
                                        <td class="px-4 py-3 text-right"><a
                                                href="{{ route('admin.other_mission_sliders.edit', $slide) }}"
                                                class="text-blue-600 dark:text-blue-400 hover:underline text-xs">{{ __('Edit') }}</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="p-8 text-center text-neutral-600 dark:text-neutral-400">
                        {{ __('No mission slides yet') }}</div>
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

        <!-- Feature Cards Section -->
        <div class="space-y-4">
            <div>
                <h2 class="text-2xl font-bold text-neutral-900 dark:text-neutral-50">{{ __('Feature Cards') }}</h2>
            </div>
            <div
                class="rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-800 overflow-hidden">
                @if ($featureCards->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr
                                    class="border-b border-neutral-200 dark:border-neutral-700 bg-neutral-50 dark:bg-zinc-900">
                                    <th
                                        class="px-4 py-3 text-left font-semibold text-neutral-900 dark:text-neutral-50">
                                        {{ __('Icon') }}</th>
                                    <th
                                        class="px-4 py-3 text-left font-semibold text-neutral-900 dark:text-neutral-50">
                                        {{ __('Title') }}</th>
                                    <th
                                        class="px-4 py-3 text-left font-semibold text-neutral-900 dark:text-neutral-50">
                                        {{ __('Sequence') }}</th>
                                    <th
                                        class="px-4 py-3 text-right font-semibold text-neutral-900 dark:text-neutral-50">
                                        {{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($featureCards as $card)
                                    <tr
                                        class="border-b border-neutral-200 dark:border-neutral-700 hover:bg-neutral-50 dark:hover:bg-zinc-700/50">
                                        <td class="px-4 py-3">
                                            @if ($card->image)
                                                <img src="{{ asset('storage/' . $card->image) }}" class="h-8 w-8" />
                                            @else
                                                <span class="text-neutral-400">—</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 text-neutral-900 dark:text-neutral-50 max-w-xs truncate">
                                            {!! $card->title !!}</td>
                                        <td class="px-4 py-3 text-neutral-600 dark:text-neutral-400">
                                            {{ $card->sequence }}</td>
                                        <td class="px-4 py-3 text-right"><a
                                                href="{{ route('admin.other_feature_cards.edit', $card) }}"
                                                class="text-blue-600 dark:text-blue-400 hover:underline text-xs">{{ __('Edit') }}</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="p-8 text-center text-neutral-600 dark:text-neutral-400">
                        {{ __('No feature cards yet') }}</div>
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