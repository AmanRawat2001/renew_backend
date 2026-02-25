<x-layouts::app :title="__('Details Sections')">
    <div class="flex h-full w-full flex-1 flex-col gap-4">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-semibold text-neutral-900 dark:text-neutral-50">{{ __('Details Sections') }}</h1>
                <p class="text-sm text-neutral-600 dark:text-neutral-400 mt-1">{{ __('Manage your website Details Sections') }}</p>
            </div>
            <a href="{{ route('admin.sections.create') }}" wire:navigate class="inline-flex items-center gap-2 px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                {{ __('Add Section') }}
            </a>
        </div>

        <!-- Table -->
        <div class="rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-800 overflow-hidden">
            @if ($sections->count())
                <table class="w-full">
                    <thead class="bg-neutral-50 dark:bg-zinc-700 border-b border-neutral-200 dark:border-neutral-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-neutral-900 dark:text-neutral-50">{{ __('Section Key') }}</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-neutral-900 dark:text-neutral-50">{{ __('Title') }}</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-neutral-900 dark:text-neutral-50">{{ __('Subtitle') }}</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-neutral-900 dark:text-neutral-50">{{ __('Created') }}</th>
                            <th class="px-6 py-3 text-right text-sm font-semibold text-neutral-900 dark:text-neutral-50">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                        @foreach ($sections as $section)
                            <tr class="hover:bg-neutral-50 dark:hover:bg-zinc-700 transition-colors">
                                <td class="px-6 py-4 text-sm text-neutral-900 dark:text-neutral-50 font-medium">{!! $section->section_key !!}</td>
                                <td class="px-6 py-4 text-sm text-neutral-600 dark:text-neutral-400">{!! $section->title !!}</td>
                                <td class="px-6 py-4 text-sm text-neutral-600 dark:text-neutral-400">{!! $section->subtitle ?? '-' !!}</td>
                                <td class="px-6 py-4 text-sm text-neutral-600 dark:text-neutral-400">{{ $section->created_at->format('M d, Y') }}</td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.sections.edit', $section) }}" wire:navigate class="inline-flex items-center gap-1 px-3 py-1 text-sm text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            {{ __('Edit') }}
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="p-8 text-center">
                    <p class="text-neutral-600 dark:text-neutral-400">{{ __('No Details Sections found. ') }}</p>
                    <a href="{{ route('admin.sections.create') }}" wire:navigate class="mt-4 inline-flex items-center gap-2 px-4 py-2 text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300">
                        {{ __('Create one now') }}
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-layouts::app>
