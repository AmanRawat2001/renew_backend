<x-layouts::app :title="__('Edit Impact Card')">
    <div class="flex h-full w-full flex-1 flex-col gap-4">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-semibold text-neutral-900 dark:text-neutral-50">{{ __('Edit Impact Card') }}</h1>
                <p class="text-sm text-neutral-600 dark:text-neutral-400 mt-1">{{ $other_impact->title }}</p>
            </div>
            <a href="{{ route('admin.other_impacts.index') }}" wire:navigate class="inline-flex items-center gap-2 px-4 py-2 text-neutral-600 dark:text-neutral-400 hover:text-neutral-900 dark:hover:text-neutral-50 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                {{ __('Back') }}
            </a>
        </div>

        <!-- Form -->
        <div class="rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-800">
            <form action="{{ route('admin.other_impacts.update', $other_impact) }}" method="POST" class="p-8">
                @csrf
                @method('PUT')

                <div class="space-y-8">
                    <!-- Metric Number Field -->
                    <div>
                        <label for="metric_number" class="block text-sm font-semibold text-neutral-900 dark:text-neutral-50 mb-2">
                            {{ __('Metric Number') }} <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            id="metric_number"
                            name="metric_number"
                            class="w-full px-4 py-2 rounded-lg border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-900 text-neutral-900 dark:text-neutral-50 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('metric_number') border-red-500 @enderror"
                            placeholder="{{ __('e.g., 275+, 800+, 40') }}"
                            value="{{ old('metric_number', $other_impact->metric_number) }}"
                            required
                        />
                        @error('metric_number')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Title Field -->
                    <div>
                        <label for="titleEditor" class="block text-sm font-semibold text-neutral-900 dark:text-neutral-50 mb-2">
                            {{ __('Title') }} <span class="text-red-500">*</span>
                        </label>
                        <div wire:ignore>
                            <div id="titleEditor"
                                class="w-full rounded-lg border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-900 @error('title') border-red-500 @enderror"
                                style="height: 100px;"></div>
                        </div>
                        <input type="hidden" id="title" name="title" value="{{ old('title', $other_impact->title) }}"
                            required />
                        @error('title')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description Field -->
                    <div>
                        <label for="descriptionEditor" class="block text-sm font-semibold text-neutral-900 dark:text-neutral-50 mb-2">
                            {{ __('Description') }} <span class="text-red-500">*</span>
                        </label>
                        <div wire:ignore>
                            <div id="descriptionEditor"
                                class="w-full rounded-lg border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-900 @error('description') border-red-500 @enderror"
                                style="height: 250px;"></div>
                        </div>
                        <input type="hidden" id="description" name="description" value="{{ old('description', $other_impact->description) }}">
                        @error('description')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-neutral-600 dark:text-neutral-400">
                            {{ __('Rich HTML editor for detailed content') }}</p>
                    </div>

                    <!-- Sequence Field -->
                    <div>
                        <label for="sequence" class="block text-sm font-semibold text-neutral-900 dark:text-neutral-50 mb-2">
                            {{ __('Order/Sequence') }} <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="number"
                            id="sequence"
                            name="sequence"
                            min="0"
                            class="w-full px-4 py-2 rounded-lg border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-900 text-neutral-900 dark:text-neutral-50 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('sequence') border-red-500 @enderror"
                            placeholder="{{ __('0') }}"
                            value="{{ old('sequence', $other_impact->sequence) }}"
                            required
                        />
                        @error('sequence')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-neutral-600 dark:text-neutral-400">{{ __('Lower numbers appear first') }}</p>
                    </div>

                    <!-- Active Status -->
                    <div class="flex items-center gap-3">
                        <input
                            type="checkbox"
                            id="is_active"
                            name="is_active"
                            value="1"
                            {{ old('is_active', $other_impact->is_active) ? 'checked' : '' }}
                            class="w-4 h-4 rounded border-neutral-300 text-blue-600 focus:ring-blue-500"
                        />
                        <label for="is_active" class="text-sm font-medium text-neutral-900 dark:text-neutral-50">
                            {{ __('Active') }}
                        </label>
                    </div>
                </div>

                <!-- Actions -->
                <div class="mt-8 flex items-center gap-3 pt-8 border-t border-neutral-200 dark:border-neutral-700">
                    <button
                        type="submit"
                        class="inline-flex items-center gap-2 px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        {{ __('Update Impact Card') }}
                    </button>
                    <a href="{{ route('admin.other_impacts.index') }}" wire:navigate class="inline-flex items-center gap-2 px-6 py-2 text-neutral-600 dark:text-neutral-400 hover:text-neutral-900 dark:hover:text-neutral-50 transition-colors">
                        {{ __('Cancel') }}
                    </a>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener("livewire:navigated", initTitleEditor)
            document.addEventListener("livewire:navigated", initDescriptionEditor)
            document.addEventListener("DOMContentLoaded", initTitleEditor)
            document.addEventListener("DOMContentLoaded", initDescriptionEditor)

            function initTitleEditor() {
                const editor = document.getElementById('titleEditor')
                const titleInput = document.getElementById('title')

                if (!editor || editor.classList.contains("ql-container")) return

                const quillTitle = new Quill('#titleEditor', {
                    theme: 'snow',
                    modules: {
                        toolbar: [
                            [{ header: [1, 2, 3, false] }],
                            ['bold', 'italic', 'underline'],
                            [{ list: 'ordered' }, { list: 'bullet' }],
                            [{ color: [] }, { background: [] }],
                            ['link'],
                            ['clean']
                        ]
                    },
                    placeholder: '{{ __('Enter card title') }}'
                })

                if (titleInput.value) {
                    quillTitle.root.innerHTML = titleInput.value
                }

                // Sync content on every text change
                quillTitle.on('text-change', function() {
                    titleInput.value = quillTitle.root.innerHTML
                })
            }

            function initDescriptionEditor() {
                const editor = document.getElementById('descriptionEditor')
                const descriptionInput = document.getElementById('description')

                if (!editor || editor.classList.contains("ql-container")) return

                const quillDescription = new Quill('#descriptionEditor', {
                    theme: 'snow',
                    modules: {
                        toolbar: [
                            [{ header: [1, 2, 3, false] }],
                            ['bold', 'italic', 'underline'],
                            [{ list: 'ordered' }, { list: 'bullet' }],
                            [{ color: [] }, { background: [] }],
                            ['link'],
                            ['clean']
                        ]
                    },
                    placeholder: '{{ __('Enter detailed description') }}'
                })

                if (descriptionInput.value) {
                    quillDescription.root.innerHTML = descriptionInput.value
                }

                // Sync content on every text change
                quillDescription.on('text-change', function() {
                    descriptionInput.value = quillDescription.root.innerHTML
                })
            }
        </script>
    @endpush
</x-layouts::app>
