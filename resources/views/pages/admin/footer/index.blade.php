<x-layouts::app :title="__('Footers')">
    <div class="flex h-full w-full flex-1 flex-col gap-4">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-semibold text-neutral-900 dark:text-neutral-50">{{ __('Manage Footer') }}</h1>
                <p class="text-sm text-neutral-600 dark:text-neutral-400 mt-1">{{ __('Create and manage your footer content') }}</p>
            </div>
            <a href="{{ route('admin.footers.create') }}" wire:navigate class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                {{ __('Add Footer Item') }}
            </a>
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="rounded-lg bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 p-4">
                <p class="text-sm font-medium text-green-800 dark:text-green-200">{{ session('success') }}</p>
            </div>
        @endif

        <!-- Footers Table -->
        <div class="rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-800 overflow-hidden">
            @if ($footers->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-neutral-200 dark:border-neutral-700 bg-neutral-50 dark:bg-zinc-900">
                                <th class="px-6 py-4 text-left text-sm font-semibold text-neutral-900 dark:text-neutral-50">{{ __('Key') }}</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-neutral-900 dark:text-neutral-50">{{ __('Title') }}</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-neutral-900 dark:text-neutral-50">{{ __('Image') }}</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-neutral-900 dark:text-neutral-50">{{ __('Sequence') }}</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-neutral-900 dark:text-neutral-50">{{ __('Status') }}</th>
                                <th class="px-6 py-4 text-right text-sm font-semibold text-neutral-900 dark:text-neutral-50">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($footers as $footer)
                                <tr class="border-b border-neutral-200 dark:border-neutral-700 hover:bg-neutral-50 dark:hover:bg-zinc-700/50 transition-colors">
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300">
                                            {{ $footer->key }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="text-sm font-medium text-neutral-900 dark:text-neutral-50">{{ $footer->title }}</p>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($footer->image)
                                            <img src="{{ asset('storage/' . $footer->image) }}" alt="{{ $footer->title }}" class="h-12 w-20 object-cover rounded" />
                                        @else
                                            <span class="text-xs text-neutral-600 dark:text-neutral-400">{{ __('No image') }}</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-sm font-medium text-neutral-900 dark:text-neutral-50">{{ $footer->sequence }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($footer->is_active)
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300">
                                                {{ __('Active') }}
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-neutral-100 dark:bg-neutral-900/30 text-neutral-700 dark:text-neutral-300">
                                                {{ __('Inactive') }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex justify-end gap-2">
                                            <a href="{{ route('admin.footers.edit', $footer) }}" wire:navigate class="inline-flex items-center gap-1 text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                <span class="text-sm font-medium">{{ __('Edit') }}</span>
                                            </a>
                                            <form action="{{ route('admin.footers.destroy', $footer) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure?') }}');" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center gap-1 text-red-600 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300 transition-colors">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                    <span class="text-sm font-medium">{{ __('Delete') }}</span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="px-6 py-4 border-t border-neutral-200 dark:border-neutral-700">
                    {{ $footers->links() }}
                </div>
            @else
                <div class="flex flex-col items-center justify-center gap-2 px-6 py-12">
                    <svg class="w-12 h-12 text-neutral-400 dark:text-neutral-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <p class="text-sm font-medium text-neutral-600 dark:text-neutral-400">{{ __('No footer items yet') }}</p>
                    <a href="{{ route('admin.footers.create') }}" wire:navigate class="text-sm text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300">
                        {{ __('Create one now') }}
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-layouts::app>
