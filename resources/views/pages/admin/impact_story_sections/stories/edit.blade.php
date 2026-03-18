<x-layouts::app :title="__('Edit Impact Story')">
    <div class="flex h-full w-full flex-1 flex-col gap-4">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-semibold text-neutral-900 dark:text-neutral-50">{{ __('Edit Impact Story') }}
                </h1>
                <p class="text-sm text-neutral-600 dark:text-neutral-400 mt-1">{{ __('Update impact story details') }}
                </p>
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
            <form action="{{ route('admin.impact_stories.update', $impact_story) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PUT')

                <!-- Page Field -->
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
                                {{ old('page', $impact_story->page->value) === $pageCase->value ? 'selected' : '' }}>
                                {{ $pageCase->label() }}
                            </option>
                        @endforeach
                    </select>
                    @error('page')
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
                        placeholder="{{ __('Enter person name') }}" value="{{ old('name', $impact_story->name) }}"
                        required />
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
                        placeholder="{{ __('Enter person designation') }}"
                        value="{{ old('designation', $impact_story->designation) }}" required />
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
                        placeholder="{{ __('Enter location') }}"
                        value="{{ old('location', $impact_story->location) }}" required />
                    @error('location')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Image Field -->
                <div>
                    <label for="image"
                        class="block text-sm font-semibold text-neutral-900 dark:text-neutral-50 mb-2">
                        {{ __('Image') }}
                    </label>
                    <p class="text-xs text-neutral-600 dark:text-neutral-400 mb-2">
                        {{ __('Leave empty to keep current image') }}</p>
                    <div class="flex flex-col gap-4">
                        <div class="flex-1">
                            <input type="file" id="image" name="image" accept="image/*"
                                class="w-full px-4 py-3 rounded-lg border-2 border-dashed border-neutral-300 dark:border-neutral-600 bg-neutral-50 dark:bg-zinc-900 text-neutral-900 dark:text-neutral-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('image') border-red-500 @enderror cursor-pointer file:mr-2 file:py-2 file:px-4 file:rounded file:border-0 file:text-xs file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-700" />
                            @error('image')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                            <p class="mt-2 text-xs text-neutral-600 dark:text-neutral-400">
                                {{ __('Drag and drop or click to select new image') }}
                            </p>
                        </div>

                        @if ($impact_story->image)
                            <div>
                                <p class="text-xs font-medium text-neutral-600 dark:text-neutral-400 mb-2">
                                    {{ __('Current Image') }}</p>
                                <div class="rounded-lg overflow-hidden border border-neutral-200 dark:border-neutral-700">
                                    <img src="{{ asset('storage/' . $impact_story->image) }}"
                                        alt="{{ $impact_story->name }}" class="w-auto h-40 object-cover" />
                                </div>
                            </div>
                        @endif
                    </div>

                    <div id="imagePreview" class="mt-4 hidden">
                        <p class="text-xs font-medium text-neutral-600 dark:text-neutral-400 mb-2">
                            {{ __('New Image Preview') }}</p>
                        <div class="rounded-lg overflow-hidden border border-neutral-200 dark:border-neutral-700">
                            <img id="previewImg" src="" alt="Preview" class="w-auto h-40 object-cover" />
                        </div>
                        <button type="button" id="removeImage" class="mt-2 text-xs text-red-600 dark:text-red-400 hover:underline">
                            {{ __('Remove New Image') }}
                        </button>
                    </div>
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
                    <input type="hidden" id="description" name="description"
                        value="{{ old('description', $impact_story->description) }}" />
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
                        placeholder="{{ __('0') }}" value="{{ old('sort_order', $impact_story->sort_order) }}"
                        required />
                    @error('sort_order')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status Field -->
                <div class="flex items-center gap-3">
                    <input type="checkbox" id="status" name="status" value="1"
                        {{ old('status', $impact_story->status) ? 'checked' : '' }}
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
                        {{ __('Update Story') }}
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
                initImagePreview();
            });

            document.addEventListener('livewire:navigated', function() {
                initDescriptionEditor();
                initImagePreview();
            });

            function initImagePreview() {
                const imageInput = document.getElementById('image');
                const imagePreview = document.getElementById('imagePreview');
                const previewImg = document.getElementById('previewImg');
                const removeImageBtn = document.getElementById('removeImage');

                if (!imageInput) return;

                imageInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(event) {
                            previewImg.src = event.target.result;
                            imagePreview.classList.remove('hidden');
                        }
                        reader.readAsDataURL(file);
                    } else {
                        imagePreview.classList.add('hidden');
                    }
                });

                removeImageBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    imageInput.value = '';
                    imagePreview.classList.add('hidden');
                });

                // Drag and drop support
                const inputWrapper = imageInput.parentElement;
                inputWrapper.addEventListener('dragover', function(e) {
                    e.preventDefault();
                    inputWrapper.classList.add('bg-blue-50', 'dark:bg-blue-900/20');
                });

                inputWrapper.addEventListener('dragleave', function(e) {
                    e.preventDefault();
                    inputWrapper.classList.remove('bg-blue-50', 'dark:bg-blue-900/20');
                });

                inputWrapper.addEventListener('drop', function(e) {
                    e.preventDefault();
                    inputWrapper.classList.remove('bg-blue-50', 'dark:bg-blue-900/20');
                    const files = e.dataTransfer.files;
                    if (files.length > 0) {
                        imageInput.files = files;
                        const event = new Event('change', { bubbles: true });
                        imageInput.dispatchEvent(event);
                    }
                });
            }

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
                            [{
                                'list': 'ordered'
                            }, {
                                'list': 'bullet'
                            }],
                            [{
                                'header': 1
                            }, {
                                'header': 2
                            }],
                            ['link', 'image'],
                            ['clean']
                        ]
                    }
                });

                const descriptionInput = document.getElementById('description');

                // Set initial content if present
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
