<x-layouts::app :title="__('Edit Feature Card')">
    <div class="flex h-full w-full flex-1 flex-col gap-4">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-semibold text-neutral-900 dark:text-neutral-50">{{ __('Edit Feature Card') }}
                </h1>
                <p class="text-sm text-neutral-600 dark:text-neutral-400 mt-1">{{ $featureCard->title }}</p>
            </div>
            <a href="{{ route('admin.feature-cards.index') }}" wire:navigate
                class="inline-flex items-center gap-2 px-4 py-2 text-neutral-600 dark:text-neutral-400 hover:text-neutral-900 dark:hover:text-neutral-50 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                {{ __('Back') }}
            </a>
        </div>

        <!-- Form -->
        <div class="rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-800">
            <form action="{{ route('admin.feature-cards.update', $featureCard) }}" method="POST"
                enctype="multipart/form-data" class="p-8">
                @csrf
                @method('PUT')

                <div class="space-y-8">
                    <!-- Title Field -->
                    <div>
                        <label for="title"
                            class="block text-sm font-semibold text-neutral-900 dark:text-neutral-50 mb-2">
                            {{ __('Title') }} <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="title" name="title"
                            class="w-full px-4 py-2 rounded-lg border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-900 text-neutral-900 dark:text-neutral-50 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('title') border-red-500 @enderror"
                            placeholder="{{ __('Enter card title') }}" value="{{ old('title', $featureCard->title) }}"
                            required />
                        @error('title')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description Field -->
                    <div>
                        <label for="descriptionEditor"
                            class="block text-sm font-semibold text-neutral-900 dark:text-neutral-50 mb-2">
                            {{ __('Description') }} <span class="text-red-500">*</span>
                        </label>
                        <div wire:ignore>
                            <div id="descriptionEditor"
                                class="bg-white dark:bg-zinc-900 border border-neutral-200 dark:border-neutral-700 rounded-lg overflow-hidden focus-within:ring-2 focus-within:ring-blue-500 @error('description') border-red-500 @enderror">
                            </div>
                        </div>
                        <input type="hidden" id="description" name="description"
                            value="{{ old('description', $featureCard->description) }}">
                        @error('description')
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
                        <input type="file" id="image" name="image" accept="image/*"
                            class="w-full px-4 py-2 rounded-lg border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-900 text-neutral-900 dark:text-neutral-50 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('image') border-red-500 @enderror" />
                        @error('image')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror

                        <!-- Current Image -->
                        @if ($featureCard->image)
                            <div class="mt-4">
                                <p class="text-xs font-medium text-neutral-600 dark:text-neutral-400 mb-2">
                                    {{ __('Current Image') }}</p>
                                <div class="rounded-lg overflow-hidden max-w-sm">
                                    <img src="{{ asset('storage/' . $featureCard->image) }}"
                                        alt="{{ $featureCard->title }}" class="w-full h-48 object-cover" />
                                </div>
                            </div>
                        @endif

                        <!-- Image Preview -->
                        <div id="imagePreview" class="mt-4 rounded-lg overflow-hidden max-w-sm" style="display: none;">
                            <img id="previewImg" src="" alt="Preview" class="w-full h-48 object-cover" />
                        </div>
                    </div>

                    <!-- Sequence Field -->
                    <div>
                        <label for="sequence"
                            class="block text-sm font-semibold text-neutral-900 dark:text-neutral-50 mb-2">
                            {{ __('Order/Sequence') }} <span class="text-red-500">*</span>
                        </label>
                        <input type="number" id="sequence" name="sequence" min="0"
                            class="w-full px-4 py-2 rounded-lg border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-900 text-neutral-900 dark:text-neutral-50 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('sequence') border-red-500 @enderror"
                            placeholder="{{ __('0') }}" value="{{ old('sequence', $featureCard->sequence) }}"
                            required />
                        @error('sequence')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-neutral-600 dark:text-neutral-400">
                            {{ __('Lower numbers appear first') }}</p>
                    </div>

                    <!-- Active Status -->
                    <div class="flex items-center gap-3">
                        <input type="checkbox" id="is_active" name="is_active" value="1"
                            {{ old('is_active', $featureCard->is_active) ? 'checked' : '' }}
                            class="w-4 h-4 rounded border-neutral-300 text-blue-600 focus:ring-blue-500" />
                        <label for="is_active" class="text-sm font-medium text-neutral-900 dark:text-neutral-50">
                            {{ __('Active') }}
                        </label>
                    </div>
                </div>

                <!-- Actions -->
                <div class="mt-8 flex items-center gap-3 pt-8 border-t border-neutral-200 dark:border-neutral-700">
                    <form action="{{ route('admin.feature-cards.update', $featureCard) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- form fields -->


                        <!-- Update -->
                        <button type="submit"
                            class="inline-flex items-center gap-2 px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">
                            Update Card
                        </button>

                        <!-- Cancel -->
                        <a href="{{ route('admin.feature-cards.index') }}" wire:navigate
                            class="px-6 py-2 text-neutral-600">
                            Cancel
                        </a>
                    </form>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener("livewire:navigated", initDescriptionEditor)
            document.addEventListener("livewire:navigated", initImagePreview)
            document.addEventListener("DOMContentLoaded", initDescriptionEditor)
            document.addEventListener("DOMContentLoaded", initImagePreview)

            function initDescriptionEditor() {
                const editor = document.getElementById('descriptionEditor')
                const descriptionInput = document.getElementById('description')

                if (!editor || editor.classList.contains("ql-container")) return

                const quillDescription = new Quill('#descriptionEditor', {
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
                    },
                    placeholder: '{{ __('Enter card description') }}'
                })

                if (descriptionInput.value) {
                    quillDescription.root.innerHTML = descriptionInput.value
                }

                const form = document.querySelector('form')
                if (form) {
                    form.addEventListener('submit', function() {
                        descriptionInput.value = quillDescription.root.innerHTML
                    })
                }
            }

            function initImagePreview() {
                const imageInput = document.getElementById('image')
                const imagePreview = document.getElementById('imagePreview')
                const previewImg = document.getElementById('previewImg')

                if (!imageInput || imageInput.dataset.listener === "true") return

                imageInput.dataset.listener = "true"

                imageInput.addEventListener('change', function(e) {
                    const file = e.target.files[0]
                    if (file) {
                        const reader = new FileReader()
                        reader.onload = function(event) {
                            previewImg.src = event.target.result
                            imagePreview.style.display = 'block'
                        }
                        reader.readAsDataURL(file)
                    } else {
                        imagePreview.style.display = 'none'
                    }
                })
            }
        </script>
    @endpush
</x-layouts::app>
