<x-layouts::app :title="__('Impact Cards')">
    <div class="flex h-full w-full flex-1 flex-col gap-4">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-semibold text-neutral-900 dark:text-neutral-50">{{ __('Impact Cards') }}</h1>
                <p class="text-sm text-neutral-600 dark:text-neutral-400 mt-1">{{ __('Manage impact metrics and statistics') }}</p>
            </div>
            <a href="{{ route('admin.impacts.create') }}" wire:navigate class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                {{ __('Add Impact Card') }}
            </a>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="rounded-lg bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-900 p-4 text-green-800 dark:text-green-200">
                {{ session('success') }}
            </div>
        @endif

        <!-- Grid Layout -->
        @if($impacts->count())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($impacts as $impact)
                    <div class="rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-800 overflow-hidden hover:shadow-lg transition-all">
                        <!-- Card Content -->
                        <div class="p-6">
                            <!-- Badge -->
                            <div class="flex items-center justify-between">
                                <div class="inline-block px-3 py-1 rounded-full text-xs font-semibold 
                                    {{ $impact->is_active ? 'bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300' : 'bg-gray-100 dark:bg-gray-900/30 text-gray-700 dark:text-gray-300' }}">
                                    {{ $impact->is_active ? __('Active') : __('Inactive') }}
                                </div>
                                @if($impact->down_arrow)
                                    <div class="inline-flex items-center px-2 py-1 rounded text-xs font-semibold bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            <!-- Metric -->
                            <div class="mt-4">
                                <div class="text-4xl font-bold text-green-600 dark:text-green-400">
                                    {{ $impact->metric_number }}
                                </div>
                            </div>

                            <!-- Title -->
                            <h3 class="mt-4 text-lg font-semibold text-neutral-900 dark:text-neutral-50">
                                {!! $impact->title !!}
                            </h3>

                            <!-- Description -->
                            <p class="mt-2 text-sm text-neutral-600 dark:text-neutral-400 line-clamp-2">
                                {!! $impact->description !!}
                            </p>

                            <!-- Sequence -->
                            <p class="mt-4 text-xs text-neutral-500 dark:text-neutral-400">
                                Sequence: <span class="font-semibold">{{ $impact->sequence }}</span>
                            </p>

                            <!-- Actions -->
                            <div class="mt-4 flex items-center gap-2 pt-4 border-t border-neutral-200 dark:border-neutral-700">
                                <a href="{{ route('admin.impacts.edit', $impact) }}" wire:navigate class="flex-1 inline-flex items-center justify-center gap-1 px-3 py-2 text-sm text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300 border border-blue-200 dark:border-blue-900 rounded hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-colors">
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

            <!-- Pagination -->
            <div class="mt-6">
                {{ $impacts->links() }}
            </div>
        @else
            <div class="rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-800 p-12 text-center">
                <svg class="mx-auto h-12 w-12 text-neutral-400 dark:text-neutral-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <p class="mt-4 text-neutral-600 dark:text-neutral-400">{{ __('No impact cards yet. Create one to get started!') }}</p>
                <a href="{{ route('admin.impacts.create') }}" wire:navigate class="inline-flex items-center gap-2 mt-6 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    {{ __('Create Impact Card') }}
                </a>
            </div>
        @endif
    </div>
</x-layouts::app>
