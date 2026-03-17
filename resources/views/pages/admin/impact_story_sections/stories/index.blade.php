<x-layouts::app :title="__('Impact Stories')">
    <div class="flex h-full w-full flex-1 flex-col gap-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-semibold text-neutral-900 dark:text-neutral-50">{{ __('Impact Stories') }}</h1>
                <p class="text-sm text-neutral-600 dark:text-neutral-400 mt-1">{{ __('Manage all impact stories') }}</p>
            </div>
            <a href="{{ route('admin.impact_stories.create') }}" wire:navigate
                class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                {{ __('New Story') }}
            </a>
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div
                class="p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-400 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <!-- Stories Table -->
        <div
            class="rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-800 overflow-hidden">
            @if ($stories->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr
                                class="border-b border-neutral-200 dark:border-neutral-700 bg-neutral-50 dark:bg-zinc-900">
                                <th class="px-4 py-3 text-left font-semibold text-neutral-900 dark:text-neutral-50">
                                    {{ __('Name') }}</th>
                                <th class="px-4 py-3 text-left font-semibold text-neutral-900 dark:text-neutral-50">
                                    {{ __('Section') }}</th>
                                <th class="px-4 py-3 text-left font-semibold text-neutral-900 dark:text-neutral-50">
                                    {{ __('Section Page') }}</th>
                                <th class="px-4 py-3 text-left font-semibold text-neutral-900 dark:text-neutral-50">
                                    {{ __('Designation') }}</th>
                                <th class="px-4 py-3 text-left font-semibold text-neutral-900 dark:text-neutral-50">
                                    {{ __('Location') }}</th>
                                <th class="px-4 py-3 text-left font-semibold text-neutral-900 dark:text-neutral-50">
                                    {{ __('Sort Order') }}</th>
                                <th class="px-4 py-3 text-left font-semibold text-neutral-900 dark:text-neutral-50">
                                    {{ __('Status') }}</th>
                                <th class="px-4 py-3 text-right font-semibold text-neutral-900 dark:text-neutral-50">
                                    {{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stories as $story)
                                <tr
                                    class="border-b border-neutral-200 dark:border-neutral-700 hover:bg-neutral-50 dark:hover:bg-zinc-700/50">
                                    <td class="px-4 py-3 text-neutral-900 dark:text-neutral-50 max-w-xs truncate">
                                        {{ $story->name }}</td>
                                    <td class="px-4 py-3 text-neutral-600 dark:text-neutral-400">
                                        {{ $story->section->title ?? '—' }}</td>
                                    <td class="px-6 py-4"><span
                                            class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300">
                                            {{ $story->section->page?->label() }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-neutral-600 dark:text-neutral-400">
                                        {{ $story->designation }}</td>
                                    <td class="px-4 py-3 text-neutral-600 dark:text-neutral-400">{{ $story->location }}
                                    </td>
                                    <td class="px-4 py-3 text-neutral-600 dark:text-neutral-400">
                                        {{ $story->sort_order }}</td>
                                    <td class="px-4 py-3">{{ $story->status ? '✓' : '—' }}</td>
                                    <td class="px-4 py-3 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('admin.impact_stories.edit', $story) }}" wire:navigate
                                                class="inline-flex items-center gap-1 px-3 py-1.5 bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 hover:bg-blue-100 dark:hover:bg-blue-900/50 rounded font-medium text-xs transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                {{ __('Edit') }}
                                            </a>
                                            <form action="{{ route('admin.impact_stories.destroy', $story) }}"
                                                method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="inline-flex items-center gap-1 px-3 py-1.5 bg-red-50 dark:bg-red-900/30 text-red-600 dark:text-red-400 hover:bg-red-100 dark:hover:bg-red-900/50 rounded font-medium text-xs transition-colors"
                                                    onclick="return confirm('{{ __('Are you sure you want to delete this story?') }}')">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                    {{ __('Delete') }}
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="px-4 py-3 border-t border-neutral-200 dark:border-neutral-700">
                    {{ $stories->links() }}
                </div>
            @else
                <div class="p-8 text-center text-neutral-600 dark:text-neutral-400">{{ __('No stories yet') }}</div>
            @endif
        </div>
    </div>
</x-layouts::app>
