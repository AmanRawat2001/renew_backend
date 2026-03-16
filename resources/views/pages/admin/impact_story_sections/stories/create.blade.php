<x-layouts::app :title="__('Create Impact Story')">
    <div class="flex h-full w-full flex-1 flex-col gap-4">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-semibold text-neutral-900 dark:text-neutral-50">{{ __('Create Impact Story') }}
                </h1>
                <p class="text-sm text-neutral-600 dark:text-neutral-400 mt-1">{{ __('Add a new impact story') }}</p>
            </div>
            <a href="{{ route('admin.impact_stories.index') }}" wire:navigate
                class="inline-flex items-center gap-2 px-4 py-2 text-neutral-600 dark:text-neutral-400 hover:text-neutral-900 dark:hover:text-neutral-50 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                {{ __('Back') }}
            </a>
        </div>

        <!-- Form -->
        <div class="rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-800 p-8">
            <form action="{{ route('admin.impact_stories.store') }}" method="POST" class="space-y-8">
                @csrf

                <!-- Section Field -->
                <div>
                    <label for="section_id"
                        class="block text-sm font-semibold text-neutral-900 dark:text-neutral-50 mb-2">
                        {{ __('Section') }} <span class="text-red-500">*</span>
                    </label>
                    <select id="section_id" name="section_id"
                        class="w-full px-4 py-2 rounded-lg border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-900 text-neutral-900 dark:text-neutral-50 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('section_id') border-red-500 @enderror"
                        required>
                        <option value="">{{ __('Select a section') }}</option>
                        @foreach ($sections as $section)
                            <option value="{{ $section->id }}"
                                @if (old('section_id') == $section->id) selected @elseif($selectedSection == $section->id) selected @endif>
                                {{ $section->title }} ({{ $section->page->label() }})
                            </option>
                        @endforeach
                    </select>
                    @error('section_id')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Name Field -->
                <div>
                    <label for="name"
                        class="block text-sm font-semibold text-neutral-900 dark:text-neutral-50 mb-2">
                        {{ __('Name') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="name" name="name"
                        class="w-full px-4 py-2 rounded-lg border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-900 text-neutral-900 dark:text-neutral-50 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror"
                        placeholder="{{ __('Enter person name') }}" value="{{ old('name') }}" required />
                    @error('name')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Designation Field -->
                <div>
                    <label for="designation"
                        class="block text-sm font-semibold text-neutral-900 dark:text-neutral-50 mb-2">
                        {{ __('Designation') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="designation" name="designation"
                        class="w-full px-4 py-2 rounded-lg border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-900 text-neutral-900 dark:text-neutral-50 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('designation') border-red-500 @enderror"
                        placeholder="{{ __('Enter person designation') }}" value="{{ old('designation') }}"
                        required />
                    @error('designation')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Location Field -->
                <div>
                    <label for="location"
                        class="block text-sm font-semibold text-neutral-900 dark:text-neutral-50 mb-2">
                        {{ __('Location') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="location" name="location"
                        class="w-full px-4 py-2 rounded-lg border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-900 text-neutral-900 dark:text-neutral-50 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('location') border-red-500 @enderror"
                        placeholder="{{ __('Enter location') }}" value="{{ old('location') }}" required />
                    @error('location')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description Field -->
                <div>
                    <label class="block text-sm font-semibold text-neutral-900 dark:text-neutral-50 mb-2">
                        {{ __('Description') }} <span class="text-red-500">*</span>
                    </label>
                    <div wire:ignore>
                        <div id="descriptionEditor"
                            class="w-full rounded-lg border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-900 @error('description') border-red-500 @enderror"
                            style="height: 250px;"></div>
                    </div>
                    <input type="hidden" id="description" name="description" value="{{ old('description') }}" />
                    @error('description')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                    <p id="descriptionError" class="mt-1 text-sm text-red-500" style="display: none;"></p>
                    <p class="mt-1 text-xs text-neutral-600 dark:text-neutral-400">
                        {{ __('Rich HTML editor for detailed content') }}</p>
                </div>

                <!-- Sort Order Field -->
                <div>
                    <label for="sort_order"
                        class="block text-sm font-semibold text-neutral-900 dark:text-neutral-50 mb-2">
                        {{ __('Sort Order') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="number" id="sort_order" name="sort_order" min="0"
                        class="w-full px-4 py-2 rounded-lg border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-900 text-neutral-900 dark:text-neutral-50 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('sort_order') border-red-500 @enderror"
                        placeholder="{{ __('0') }}" value="{{ old('sort_order', 0) }}" required />
                    @error('sort_order')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status Field -->
                <div class="flex items-center gap-3">
                    <input type="checkbox" id="status" name="status" value="1"
                        {{ old('status', true) ? 'checked' : '' }}
                        class="w-4 h-4 rounded border-neutral-300 text-blue-600 focus:ring-blue-500" />
                    <label for="status" class="text-sm font-medium text-neutral-900 dark:text-neutral-50">
                        {{ __('Active') }}
                    </label>
                </div>

                <!-- Actions -->
                <div class="flex items-center gap-3 pt-8 border-t border-neutral-200 dark:border-neutral-700">
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        {{ __('Create Story') }}
                    </button>
                    <a href="{{ route('admin.impact_stories.index') }}" wire:navigate
                        class="inline-flex items-center gap-2 px-6 py-2 text-neutral-600 dark:text-neutral-400 hover:text-neutral-900 dark:hover:text-neutral-50 transition-colors">
                        {{ __('Cancel') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
    @push('styles')
        <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet" />
    @endpush

    @push('scripts')
        <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
        <script>
            let quillDescriptionEditor;

            document.addEventListener('DOMContentLoaded', function() {
                initDescriptionEditor();
            });

            document.addEventListener('livewire:navigated', function() {
                initDescriptionEditor();
            });

            function initDescriptionEditor() {
                const editor = document.getElementById('descriptionEditor');
                if (!editor || editor.classList.contains('ql-container')) return;

                quillDescriptionEditor = new Quill('#descriptionEditor', {
                    theme: 'snow',
                    placeholder: '{{ __('Enter story description') }}',
                    modules: {
                        toolbar: [
                            ['bold', 'italic', 'underline', 'strike'],
                            ['blockquote', 'code-block'],
                            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                            [{ 'header': 1 }, { 'header': 2 }],
                            ['link', 'image'],
                            ['clean']
                        ]
                    }
                });

                const descriptionInput = document.getElementById('description');
                if (descriptionInput.value) {
                    quillDescriptionEditor.root.innerHTML = descriptionInput.value;
                }

                // Sync content on text change
                quillDescriptionEditor.on('text-change', function() {
                    descriptionInput.value = quillDescriptionEditor.root.innerHTML;
                });

                // Form submission validation
                const form = document.querySelector('form');
                if (form) {
                    form.addEventListener('submit', function(e) {
                        const content = quillDescriptionEditor.root.innerHTML;
                        const errorElement = document.getElementById('descriptionError');
                        
                        // Check if content is empty
                        if (!content || content === '<p><br></p>' || content.trim() === '') {
                            e.preventDefault();
                            errorElement.textContent = '{{ __('Description is required') }}';
                            errorElement.style.display = 'block';
                            return false;
                        }
                        
                        descriptionInput.value = content;
                        errorElement.style.display = 'none';
                    });
                }
            }
        </script>
    @endpush
</x-layouts::app>
