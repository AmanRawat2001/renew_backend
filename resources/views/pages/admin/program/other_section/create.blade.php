<x-layouts::app :title="__('Create Content Section')">
    <div class="flex h-full w-full flex-1 flex-col gap-4">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-semibold text-neutral-900 dark:text-neutral-50">
                    {{ __('Create Content Section') }}</h1>
                <p class="text-sm text-neutral-600 dark:text-neutral-400 mt-1">
                    {{ __('Add a new content section to your website') }}</p>
            </div>
            <a href="{{ route('admin.other_sections.index') }}" wire:navigate
                class="inline-flex items-center gap-2 px-4 py-2 text-neutral-600 dark:text-neutral-400 hover:text-neutral-900 dark:hover:text-neutral-50 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                {{ __('Back') }}
            </a>
        </div>

        <!-- Form -->
        <div class="rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-800">
            <form action="{{ route('admin.other_sections.store') }}" method="POST" class="p-8">
                @csrf

                <div class="space-y-8">
                    <!-- Section Key Field -->
                    <div>
                        <label for="section_key"
                            class="block text-sm font-semibold text-neutral-900 dark:text-neutral-50 mb-2">
                            {{ __('Section Key') }} <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="section_key" name="section_key"
                            class="w-full px-4 py-2 rounded-lg border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-900 text-neutral-900 dark:text-neutral-50 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('section_key') border-red-500 @enderror"
                            placeholder="{{ __('e.g., hero, about, vision, focus') }}" value="{{ old('section_key') }}"
                            required />
                        @error('section_key')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-neutral-600 dark:text-neutral-400">
                            {{ __('Unique identifier for this section (lowercase)') }}</p>
                    </div>

                    <!-- Title Field with Quill Editor -->
                    <div>
                        <label class="block text-sm font-semibold text-neutral-900 dark:text-neutral-50 mb-2">
                            {{ __('Title') }} <span class="text-red-500">*</span>
                        </label>
                        <div wire:ignore>
                            <div id="quillTitleEditor"
                                class="w-full rounded-lg border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-900 @error('title') border-red-500 @enderror"
                                style="height: 120px;"></div>
                        </div>
                        <input type="hidden" id="title" name="title" value="{{ old('title') }}" required />
                        @error('title')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-neutral-600 dark:text-neutral-400">
                            {{ __('Rich HTML editor for section title') }}</p>
                    </div>

                    <!-- Subtitle Field with Quill Editor -->
                    <div>
                        <label class="block text-sm font-semibold text-neutral-900 dark:text-neutral-50 mb-2">
                            {{ __('Subtitle') }}
                        </label>
                        <div wire:ignore>
                            <div id="quillSubtitleEditor"
                                class="w-full rounded-lg border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-900 @error('subtitle') border-red-500 @enderror"
                                style="height: 120px;"></div>
                        </div>
                        <input type="hidden" id="subtitle" name="subtitle" value="{{ old('subtitle') }}" />
                        @error('subtitle')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-neutral-600 dark:text-neutral-400">
                            {{ __('Rich HTML editor for section subtitle (optional)') }}</p>
                    </div>

                    <!-- Description Field with Quill Editor -->
                    <div>
                        <label class="block text-sm font-semibold text-neutral-900 dark:text-neutral-50 mb-2">
                            {{ __('Description') }} <span class="text-red-500">*</span>
                        </label>
                        <div wire:ignore>
                            <div id="quillDescriptionEditor"
                                class="w-full rounded-lg border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-900 @error('description') border-red-500 @enderror"
                                style="height: 250px;"></div>
                        </div>
                        <input type="hidden" id="description" name="description" value="{{ old('description') }}"
                            required />
                        @error('description')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-neutral-600 dark:text-neutral-400">
                            {{ __('Rich HTML editor for detailed content') }}</p>
                    </div>
                </div>
                <div>
                    <label for="page"
                        class="block text-sm font-semibold text-neutral-900 dark:text-neutral-50 mb-2">
                        {{ __('Page') }} <span class="text-red-500">*</span>
                    </label>
                    <select id="page" name="page"
                        class="w-full px-4 py-2 rounded-lg border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-900 text-neutral-900 dark:text-neutral-50 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('page') border-red-500 @enderror"
                        required>
                        <option value="">{{ __('Select a page') }}</option>
                        @foreach (App\Enums\SitePage::cases() as $pageCase)
                            <option value="{{ $pageCase->value }}"
                                {{ old('page') === $pageCase->value ? 'selected' : '' }}>
                                {{ $pageCase->label() }}
                            </option>
                        @endforeach
                    </select>
                    @error('page')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-xs text-neutral-600 dark:text-neutral-400">
                        {{ __('Choose which page this slider appears on') }}
                    </p>
                </div>

                <!-- Actions -->
                <div class="mt-8 flex items-center gap-3 pt-8 border-t border-neutral-200 dark:border-neutral-700">
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        {{ __('Create Section') }}
                    </button>
                    <a href="{{ route('admin.other_sections.index') }}" wire:navigate
                        class="inline-flex items-center gap-2 px-6 py-2 text-neutral-600 dark:text-neutral-400 hover:text-neutral-900 dark:hover:text-neutral-50 transition-colors">
                        {{ __('Cancel') }}
                    </a>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener("livewire:navigated", initEditors)
            document.addEventListener("DOMContentLoaded", initEditors)

            function initEditors() {
                initQuillTitle()
                initQuillSubtitle()
                initQuillDescription()
            }

            function toolbar() {
                return {
                    theme: 'snow',
                    modules: {
                        toolbar: [
                            [{
                                'header': [1, 2, 3, false]
                            }],
                            ['bold', 'italic', 'underline', 'strike'],
                            ['blockquote', 'code-block'],
                            [{
                                'list': 'ordered'
                            }, {
                                'list': 'bullet'
                            }],
                            [{
                                'color': []
                            }, {
                                'background': []
                            }],
                            [{
                                'align': []
                            }],
                            ['link', 'image'],
                            ['clean']
                        ]
                    }
                }
            }

            function initQuillTitle() {
                let editor = document.querySelector('#quillTitleEditor')
                if (!editor) return
                if (editor.classList.contains("ql-container")) return

                let input = document.getElementById('title')

                window.quillTitle = new Quill('#quillTitleEditor', {
                    ...toolbar(),
                    placeholder: 'Enter section title with formatting...'
                })

                if (input.value) {
                    window.quillTitle.clipboard.dangerouslyPasteHTML(input.value)
                }

                window.quillTitle.on('text-change', () => {
                    input.value = window.quillTitle.root.innerHTML
                })
            }

            function initQuillSubtitle() {
                let editor = document.querySelector('#quillSubtitleEditor')
                if (!editor) return
                if (editor.classList.contains("ql-container")) return

                let input = document.getElementById('subtitle')

                window.quillSubtitle = new Quill('#quillSubtitleEditor', {
                    ...toolbar(),
                    placeholder: 'Enter section subtitle with formatting...'
                })

                if (input.value) {
                    window.quillSubtitle.clipboard.dangerouslyPasteHTML(input.value)
                }

                window.quillSubtitle.on('text-change', () => {
                    input.value = window.quillSubtitle.root.innerHTML
                })
            }

            function initQuillDescription() {
                let editor = document.querySelector('#quillDescriptionEditor')
                if (!editor) return
                if (editor.classList.contains("ql-container")) return

                let input = document.getElementById('description')

                window.quillDescription = new Quill('#quillDescriptionEditor', {
                    ...toolbar(),
                    placeholder: 'Enter section description with formatting...'
                })

                if (input.value) {
                    window.quillDescription.clipboard.dangerouslyPasteHTML(input.value)
                }

                window.quillDescription.on('text-change', () => {
                    input.value = window.quillDescription.root.innerHTML
                })
            }

            // Update all editors on form submit
            document.addEventListener('submit', function(e) {
                if (e.target.tagName === 'FORM') {
                    if (window.quillTitle) document.getElementById('title').value = window.quillTitle.root.innerHTML
                    if (window.quillSubtitle) document.getElementById('subtitle').value = window.quillSubtitle.root
                        .innerHTML
                    if (window.quillDescription) document.getElementById('description').value = window.quillDescription
                        .root.innerHTML
                }
            }, true)
        </script>
    @endpush
</x-layouts::app>
