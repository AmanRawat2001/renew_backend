<x-layouts::app :title="__('Create Footer Item')">
    <div class="flex h-full w-full flex-1 flex-col gap-4">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-semibold text-neutral-900 dark:text-neutral-50">{{ __('Create New Footer Item') }}</h1>
                <p class="text-sm text-neutral-600 dark:text-neutral-400 mt-1">{{ __('Add a new footer item to your website') }}</p>
            </div>
            <a href="{{ route('admin.footers.index') }}" wire:navigate class="inline-flex items-center gap-2 px-4 py-2 text-neutral-600 dark:text-neutral-400 hover:text-neutral-900 dark:hover:text-neutral-50 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                {{ __('Back') }}
            </a>
        </div>

        <!-- Form -->
        <div class="rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-800">
            <form action="{{ route('admin.footers.store') }}" enctype="multipart/form-data" method="POST" class="p-8">
                @csrf

                <div class="space-y-8">
                    <!-- Key Field -->
                    <div>
                        <label for="key" class="block text-sm font-semibold text-neutral-900 dark:text-neutral-50 mb-2">
                            {{ __('Key') }} <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="key" name="key" 
                            class="w-full px-4 py-2 rounded-lg border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-900 text-neutral-900 dark:text-neutral-50 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('key') border-red-500 @enderror"
                            placeholder="{{ __('e.g., company_address, contact_email') }}"
                            value="{{ old('key') }}" required />
                        @error('key')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-neutral-600 dark:text-neutral-400">
                            {{ __('Unique identifier for this footer item (alphanumeric with underscores)') }}
                        </p>
                    </div>
                    <!-- Value Field -->
                    <div>
                        <label for="value" class="block text-sm font-semibold text-neutral-900 dark:text-neutral-50 mb-2">
                            {{ __('Content/Value') }}
                        </label>
                        <textarea id="value" name="value" rows="4"
                            class="w-full px-4 py-2 rounded-lg border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-900 text-neutral-900 dark:text-neutral-50 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('value') border-red-500 @enderror"
                            placeholder="{{ __('Enter footer item content') }}">{{ old('value') }}</textarea>
                        @error('value')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-neutral-600 dark:text-neutral-400">
                            {{ __('The main content or value for this footer item') }}
                        </p>
                    </div>

                    <!-- Image File Upload Field -->
                <div>
                    <label for="image"
                        class="block text-sm font-semibold text-neutral-900 dark:text-neutral-50 mb-2">
                        {{ __('Image') }}
                    </label>
                    <div class="flex flex-col gap-4">
                        <div class="flex-1">
                            <input type="file" id="image" name="image" accept="image/*"
                                class="w-full px-4 py-3 rounded-lg border-2 border-dashed border-neutral-300 dark:border-neutral-600 bg-neutral-50 dark:bg-zinc-900 text-neutral-900 dark:text-neutral-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('image') border-red-500 @enderror cursor-pointer file:mr-2 file:py-2 file:px-4 file:rounded file:border-0 file:text-xs file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-700" />
                            @error('image')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                            <p class="mt-2 text-xs text-neutral-600 dark:text-neutral-400">
                                {{ __('Drag and drop or click to select image (PNG, JPG, GIF up to 5MB)') }}
                            </p>
                        </div>
                        <div id="imagePreview" class="hidden">
                            <div class="rounded-lg overflow-hidden border border-neutral-200 dark:border-neutral-700">
                                <img id="previewImg" src="" alt="Preview" class="w-auto h-40 object-cover" />
                            </div>
                            <button type="button" id="removeImage"
                                class="mt-2 text-xs text-red-600 dark:text-red-400 hover:underline">
                                {{ __('Remove Image') }}
                            </button>
                        </div>
                    </div>
                </div>

                    <!-- Sequence Field -->
                    <div>
                        <label for="sequence" class="block text-sm font-semibold text-neutral-900 dark:text-neutral-50 mb-2">
                            {{ __('Sequence') }} <span class="text-red-500">*</span>
                        </label>
                        <input type="number" id="sequence" name="sequence" 
                            class="w-full px-4 py-2 rounded-lg border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-900 text-neutral-900 dark:text-neutral-50 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('sequence') border-red-500 @enderror"
                            placeholder="{{ __('e.g., 1') }}"
                            value="{{ old('sequence', 0) }}" min="0" max="999" required />
                        @error('sequence')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-neutral-600 dark:text-neutral-400">
                            {{ __('Order of display (lower numbers appear first)') }}
                        </p>
                    </div>

                    <!-- Active Status -->
                    <div class="flex items-center gap-3">
                        <input type="checkbox" id="is_active" name="is_active" value="1" class="w-4 h-4 rounded border-neutral-300 text-blue-600 focus:ring-2 focus:ring-blue-500" @if(old('is_active', true)) checked @endif />
                        <label for="is_active" class="text-sm font-medium text-neutral-900 dark:text-neutral-50">
                            {{ __('Active') }}
                        </label>
                        <p class="text-xs text-neutral-600 dark:text-neutral-400">
                            {{ __('Enable this footer item on your website') }}
                        </p>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex gap-3 pt-4">
                        <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            {{ __('Create Footer Item') }}
                        </button>
                        <a href="{{ route('admin.footers.index') }}" wire:navigate class="inline-flex items-center gap-2 px-6 py-3 border border-neutral-300 dark:border-neutral-600 text-neutral-700 dark:text-neutral-300 font-medium rounded-lg hover:bg-neutral-50 dark:hover:bg-zinc-700 transition-colors">
                            {{ __('Cancel') }}
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const fileInput = document.getElementById('image');
                const previewContainer = document.getElementById('imagePreview');
                const previewImg = document.getElementById('previewImg');
                const removeBtn = document.getElementById('removeImage');

                fileInput.addEventListener('change', function (e) {
                    const file = e.target.files[0];

                    if (file) {
                        const reader = new FileReader();

                        reader.onload = function (event) {
                            previewImg.src = event.target.result;
                            previewContainer.classList.remove('hidden');
                        };

                        reader.readAsDataURL(file);
                    }
                });

                removeBtn.addEventListener('click', function (e) {
                    e.preventDefault();
                    fileInput.value = '';
                    previewImg.src = '';
                    previewContainer.classList.add('hidden');
                });
            });
        </script>
    @endpush
</x-layouts::app>
