<x-layouts::app :title="__('Edit Impact Story Section')">
    <div class="flex h-full w-full flex-1 flex-col gap-4">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-semibold text-neutral-900 dark:text-neutral-50">
                    {{ __('Edit Impact Story Section') }}</h1>
                <p class="text-sm text-neutral-600 dark:text-neutral-400 mt-1">{{ __('Update impact story section') }}
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
            <form action="{{ route('admin.impact_story_sections.update', $impact_story_section) }}" method="POST"
                enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PUT')

                <!-- Title Field -->
                <div>
                    <label for="title"
                        class="block text-sm font-semibold text-neutral-900 dark:text-neutral-50 mb-2">
                        {{ __('Title') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="title" name="title"
                        class="w-full px-4 py-2 rounded-lg border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-900 text-neutral-900 dark:text-neutral-50 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('title') border-red-500 @enderror"
                        placeholder="{{ __('Enter section title') }}"
                        value="{{ old('title', $impact_story_section->title) }}" required />
                    @error('title')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Main Image Field -->
                <div>
                    <label for="main_image"
                        class="block text-sm font-semibold text-neutral-900 dark:text-neutral-50 mb-2">
                        {{ __('Main Image') }}
                    </label>
                    <p class="text-xs text-neutral-600 dark:text-neutral-400 mb-2">
                        {{ __('Leave empty to keep current image') }}</p>
                    <input type="file" id="main_image" name="main_image" accept="image/*"
                        class="w-full px-4 py-2 rounded-lg border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-900 text-neutral-900 dark:text-neutral-50 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('main_image') border-red-500 @enderror" />
                    @error('main_image')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror

                    @if ($impact_story_section->main_image)
                        <div class="mt-4">
                            <p class="text-xs font-medium text-neutral-600 dark:text-neutral-400 mb-2">
                                {{ __('Current Image') }}</p>
                            <div class="rounded-lg overflow-hidden max-w-sm">
                                <img src="{{ asset('storage/' . $impact_story_section->main_image) }}"
                                    alt="{{ $impact_story_section->title }}" class="w-full h-48 object-cover" />
                            </div>
                        </div>
                    @endif

                    <div id="imagePreview" class="mt-4 rounded-lg overflow-hidden max-w-sm" style="display: none;">
                        <img id="previewImg" src="" alt="Preview" class="w-full h-48 object-cover" />
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
                                {{ old('page', $impact_story_section->page->value) === $pageCase->value ? 'selected' : '' }}>
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

                <!-- Sort Order Field -->
                <div>
                    <label for="sort_order"
                        class="block text-sm font-semibold text-neutral-900 dark:text-neutral-50 mb-2">
                        {{ __('Sort Order') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="number" id="sort_order" name="sort_order" min="0"
                        class="w-full px-4 py-2 rounded-lg border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-900 text-neutral-900 dark:text-neutral-50 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('sort_order') border-red-500 @enderror"
                        placeholder="{{ __('0') }}"
                        value="{{ old('sort_order', $impact_story_section->sort_order) }}" required />
                    @error('sort_order')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status Field -->
                <div class="flex items-center gap-3">
                    <input type="checkbox" id="status" name="status" value="1"
                        {{ old('status', $impact_story_section->status) ? 'checked' : '' }}
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
                        {{ __('Update Section') }}
                    </button>
                    <a href="{{ route('admin.impact_story_sections.index') }}" wire:navigate
                        class="inline-flex items-center gap-2 px-6 py-2 text-neutral-600 dark:text-neutral-400 hover:text-neutral-900 dark:hover:text-neutral-50 transition-colors">
                        {{ __('Cancel') }}
                    </a>
                </div>
            </form>
        </div>

        <!-- Stories Section -->
        <div
            class="rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-800 overflow-hidden">
            <div class="p-8">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-semibold text-neutral-900 dark:text-neutral-50">
                        {{ __('Stories in this Section') }}</h2>
                    <a href="{{ route('admin.impact_stories.create', ['section_id' => $impact_story_section->id]) }}"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition-colors text-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4v16m8-8H4" />
                        </svg>
                        {{ __('Add Story') }}
                    </a>
                </div>

                @if ($impact_story_section->stories->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr
                                    class="border-b border-neutral-200 dark:border-neutral-700 bg-neutral-50 dark:bg-zinc-900">
                                    <th
                                        class="px-4 py-3 text-left font-semibold text-neutral-900 dark:text-neutral-50">
                                        {{ __('Name') }}</th>
                                    <th
                                        class="px-4 py-3 text-left font-semibold text-neutral-900 dark:text-neutral-50">
                                        {{ __('Designation') }}</th>
                                    <th
                                        class="px-4 py-3 text-left font-semibold text-neutral-900 dark:text-neutral-50">
                                        {{ __('Location') }}</th>
                                    <th
                                        class="px-4 py-3 text-left font-semibold text-neutral-900 dark:text-neutral-50">
                                        {{ __('Sort Order') }}</th>
                                    <th
                                        class="px-4 py-3 text-left font-semibold text-neutral-900 dark:text-neutral-50">
                                        {{ __('Status') }}</th>
                                    <th
                                        class="px-4 py-3 text-right font-semibold text-neutral-900 dark:text-neutral-50">
                                        {{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($impact_story_section->stories->sortBy('sort_order') as $story)
                                    <tr
                                        class="border-b border-neutral-200 dark:border-neutral-700 hover:bg-neutral-50 dark:hover:bg-zinc-700/50">
                                        <td class="px-4 py-3 text-neutral-900 dark:text-neutral-50 max-w-xs truncate">
                                            {{ $story->name }}</td>
                                        <td class="px-4 py-3 text-neutral-600 dark:text-neutral-400">
                                            {{ $story->designation }}</td>
                                        <td class="px-4 py-3 text-neutral-600 dark:text-neutral-400">
                                            {{ $story->location }}</td>
                                        <td class="px-4 py-3 text-neutral-600 dark:text-neutral-400">
                                            {{ $story->sort_order }}</td>
                                        <td class="px-4 py-3">{{ $story->status ? '✓' : '—' }}</td>
                                        <td class="px-4 py-3 text-right">
                                            <div class="flex items-center justify-end gap-2">
                                                <a href="{{ route('admin.impact_stories.edit', $story) }}" wire:navigate
                                                    class="inline-flex items-center gap-1 px-3 py-1.5 bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 hover:bg-blue-100 dark:hover:bg-blue-900/50 rounded font-medium text-xs transition-colors">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                    {{ __('Edit') }}
                                                </a>
                                                <form action="{{ route('admin.impact_stories.destroy', $story) }}"
                                                    method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="inline-flex items-center gap-1 px-3 py-1.5 bg-red-50 dark:bg-red-900/30 text-red-600 dark:text-red-400 hover:bg-red-100 dark:hover:bg-red-900/50 rounded font-medium text-xs transition-colors"
                                                        onclick="return confirm('{{ __('Are you sure you want to delete this story?') }}')">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                        {{ __('Delete') }}
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="p-8 text-center text-neutral-600 dark:text-neutral-400">
                        <p>{{ __('No stories added yet.') }}</p>
                        <a href="{{ route('admin.impact_stories.create', ['section_id' => $impact_story_section->id]) }}"
                            class="inline-flex items-center gap-2 mt-3 px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition-colors text-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            {{ __('Add First Story') }}
                        </a>
                    </div>
                @endif
            </div>
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
