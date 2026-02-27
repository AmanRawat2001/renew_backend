<x-layouts::app :title="__('Edit Content Section')">
    <div class="flex h-full w-full flex-1 flex-col gap-4">

        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-semibold text-neutral-900 dark:text-neutral-50">
                    {{ __('Edit Content Section') }}
                </h1>
                <p class="text-sm text-neutral-600 dark:text-neutral-400 mt-1">
                    {{ __('Update section details') }}
                </p>
            </div>

            <a href="{{ route('admin.other_sections.index') }}" wire:navigate
                class="inline-flex items-center gap-2 px-4 py-2 text-neutral-600 dark:text-neutral-400 hover:text-neutral-900 dark:hover:text-neutral-50 transition-colors">

                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>

                {{ __('Back') }}
            </a>
        </div>


        <div class="rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-800">
            <form action="{{ route('admin.other_sections.update', $other_section) }}" method="POST" class="p-8">
                @csrf
                @method('PUT')

                <div class="space-y-8">

                    <!-- Section Key -->
                    <div>
                        <label class="block text-sm font-semibold text-neutral-900 dark:text-neutral-50 mb-2">
                            {{ __('Section Key') }}
                        </label>

                        <input type="text" disabled value="{{ $other_section->section_key }}"
                            class="w-full px-4 py-2 rounded-lg border border-neutral-200 dark:border-neutral-700 bg-zinc-100 dark:bg-zinc-900" />
                    </div>


                    <!-- Title -->
                    <div>
                        <label class="block text-sm font-semibold text-neutral-900 dark:text-neutral-50 mb-2">
                            {{ __('Title') }}
                        </label>

                        <div wire:ignore>
                            <div id="quillTitleEditor" class="border rounded-lg" style="height:120px"></div>
                        </div>

                        <input type="hidden" id="title" name="title"
                            value="{{ old('title', $other_section->title) }}">
                    </div>


                    <!-- Subtitle -->
                    <div>
                        <label class="block text-sm font-semibold text-neutral-900 dark:text-neutral-50 mb-2">
                            {{ __('Subtitle') }}
                        </label>

                        <div wire:ignore>
                            <div id="quillSubtitleEditor" class="border rounded-lg" style="height:120px"></div>
                        </div>

                        <input type="hidden" id="subtitle" name="subtitle"
                            value="{{ old('subtitle', $other_section->subtitle) }}">
                    </div>


                    <!-- Description -->
                    <div>
                        <label class="block text-sm font-semibold text-neutral-900 dark:text-neutral-50 mb-2">
                            {{ __('Description') }}
                        </label>

                        <div wire:ignore>
                            <div id="quillDescriptionEditor" class="border rounded-lg" style="height:250px"></div>
                        </div>

                        <input type="hidden" id="description" name="description"
                            value="{{ old('description', $other_section->description) }}">
                    </div>

                    <!-- Page -->
                    <div>
                        <label for="page"
                            class="block text-sm font-semibold text-neutral-900 dark:text-neutral-50 mb-2">
                            {{ __('Page') }} <span class="text-red-500">*</span>
                        </label>
                        <select id="page" name="page" disabled
                            class="w-full px-4 py-2 rounded-lg border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-900 text-neutral-900 dark:text-neutral-50 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('page') border-red-500 @enderror"
                            required>
                            <option value="">{{ __('Select a page') }}</option>
                            @foreach (App\Enums\SitePage::cases() as $pageCase)
                                <option value="{{ $pageCase->value }}"
                                    {{ old('page', $other_section->page->value) === $pageCase->value ? 'selected' : '' }}>
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

                </div>


                <div class="mt-8 flex gap-3 pt-8 border-t">
                    <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">
                        Update Section
                    </button>

                    <a href="{{ route('admin.other_sections.index') }}" wire:navigate
                        class="px-6 py-2 text-neutral-600">
                        Cancel
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
                    placeholder: 'Enter title'
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
                    placeholder: 'Enter subtitle'
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
                    placeholder: 'Enter description'
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
