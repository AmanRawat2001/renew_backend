<x-layouts::app :title="__('Create Impact Story Section')">
    <div class="flex h-full w-full flex-1 flex-col gap-4">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-semibold text-neutral-900 dark:text-neutral-50">
                    {{ __('Create Impact Story Section') }}</h1>
                <p class="text-sm text-neutral-600 dark:text-neutral-400 mt-1">{{ __('Add a new impact story section') }}
                </p>
            </div>
            <a href="{{ route('admin.impact_story_sections.index') }}" wire:navigate
                class="inline-flex items-center gap-2 px-4 py-2 text-neutral-600 dark:text-neutral-400 hover:text-neutral-900 dark:hover:text-neutral-50 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                {{ __('Back') }}
            </a>
        </div>

        <!-- Form -->
        <div class="rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-800 p-8">
            <form action="{{ route('admin.impact_story_sections.store') }}" method="POST" enctype="multipart/form-data"
                class="space-y-8">
                @csrf

                <!-- Title Field -->
                <div>
                    <label for="title"
                        class="block text-sm font-semibold text-neutral-900 dark:text-neutral-50 mb-2">
                        {{ __('Title') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="title" name="title"
                        class="w-full px-4 py-2 rounded-lg border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-900 text-neutral-900 dark:text-neutral-50 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('title') border-red-500 @enderror"
                        placeholder="{{ __('Enter section title') }}" value="{{ old('title') }}" required />
                    @error('title')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Main Image Field -->
                <div>
                    <label for="main_image"
                        class="block text-sm font-semibold text-neutral-900 dark:text-neutral-50 mb-2">
                        {{ __('Main Image') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="file" id="main_image" name="main_image" accept="image/*"
                        class="w-full px-4 py-2 rounded-lg border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-900 text-neutral-900 dark:text-neutral-50 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('main_image') border-red-500 @enderror"
                        required />
                    @error('main_image')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                    <div id="imagePreview" class="mt-4 rounded-lg overflow-hidden max-w-sm" style="display: none;">
                        <img id="previewImg" src="" alt="Preview" class="w-full h-48 object-cover" />
                    </div>
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
                <button type="submit"
                    class="inline-flex items-center gap-2 px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    {{ __('Create Section') }}
                </button>
                <a href="{{ route('admin.impact_story_sections.index') }}" wire:navigate
                    class="inline-flex items-center gap-2 px-6 py-2 text-neutral-600 dark:text-neutral-400 hover:text-neutral-900 dark:hover:text-neutral-50 transition-colors">
                    {{ __('Cancel') }}
                </a>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const imageInput = document.getElementById('main_image');
                const imagePreview = document.getElementById('imagePreview');
                const previewImg = document.getElementById('previewImg');

                imageInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(event) {
                            previewImg.src = event.target.result;
                            imagePreview.style.display = 'block';
                        }
                        reader.readAsDataURL(file);
                    } else {
                        imagePreview.style.display = 'none';
                    }
                });
            });
        </script>
    @endpush
</x-layouts::app>
