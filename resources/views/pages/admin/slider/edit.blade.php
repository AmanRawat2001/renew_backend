<x-layouts::app :title="__('Edit Slider')">
    <div class="flex h-full w-full flex-1 flex-col gap-4">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-semibold text-neutral-900 dark:text-neutral-50">{{ __('Edit Slider') }}</h1>
                <p class="text-sm text-neutral-600 dark:text-neutral-400 mt-1">{{ __('Update slider details') }}</p>
            </div>
            <a href="{{ route('admin.sliders.index') }}" wire:navigate
                class="inline-flex items-center gap-2 px-4 py-2 text-neutral-600 dark:text-neutral-400 hover:text-neutral-900 dark:hover:text-neutral-50 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                {{ __('Back') }}
            </a>
        </div>

        <!-- Form -->
        <div class="rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-800">
            <form action="{{ route('admin.sliders.update', $slider) }}" method="POST" class="p-8">
                @csrf
                @method('PUT')

                <div class="space-y-8">
                    <!-- Title Field with Quill Editor -->
                    <div>
                        <label for="title"
                            class="block text-sm font-semibold text-neutral-900 dark:text-neutral-50 mb-2">
                            {{ __('Title') }} <span class="text-red-500">*</span>
                        </label>
                        <div id="quillEditor"
                            class="w-full rounded-lg border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-900 @error('title') border-red-500 @enderror"
                            style="height: 200px;"></div>
                        <input type="hidden" id="title" name="title" value="{{ old('title', $slider->title) }}"
                            required />
                        @error('title')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                        <p class="mt-1 text-xs text-neutral-600 dark:text-neutral-400">
                            {{ __('Rich HTML editor for formatting your slider title') }}</p>
                    </div>

                    <!-- Sub Title Field -->
                    <div>
                        <label for="sub_title"
                            class="block text-sm font-semibold text-neutral-900 dark:text-neutral-50 mb-2">
                            {{ __('Description') }} <span class="text-red-500">*</span>
                        </label>
                        <textarea id="sub_title" name="sub_title" rows="3"
                            class="w-full px-4 py-2 rounded-lg border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-900 text-neutral-900 dark:text-neutral-50 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('sub_title') border-red-500 @enderror"
                            placeholder="{{ __('Enter slider description') }}" required>{{ old('sub_title', $slider->sub_title) }}</textarea>
                        @error('sub_title')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Button Text Field -->
                    <div>
                        <label for="button_text"
                            class="block text-sm font-semibold text-neutral-900 dark:text-neutral-50 mb-2">
                            {{ __('Button Text') }}
                        </label>
                        <input type="text" id="button_text" name="button_text"
                            class="w-full px-4 py-2 rounded-lg border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-900 text-neutral-900 dark:text-neutral-50 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="{{ __('e.g., Learn More') }}"
                            value="{{ old('button_text', $slider->button_text) }}" />
                        <p class="mt-1 text-xs text-neutral-600 dark:text-neutral-400">
                            {{ __('Optional CTA button text for this slider') }}
                        </p>
                    </div>

                    <!-- Image File Upload Field -->
                    <div>
                        <label for="image"
                            class="block text-sm font-semibold text-neutral-900 dark:text-neutral-50 mb-2">
                            {{ __('Image Upload') }} <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="file" id="image" name="image" accept="image/*"
                                class="w-full px-4 py-2 rounded-lg border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-900 text-neutral-900 dark:text-neutral-50 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('image') border-red-500 @enderror" />
                        </div>
                        @error('image')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                        <div id="imagePreview" class="mt-4 rounded-lg overflow-hidden max-w-sm">
                            <img id="previewImg" src="{{ asset('storage/' . $slider->image) }}" alt="Preview"
                                class="w-full h-48 object-cover" />
                        </div>
                    </div>

                    <!-- Sequence Field -->
                    <div>
                        <label for="sequence"
                            class="block text-sm font-semibold text-neutral-900 dark:text-neutral-50 mb-2">
                            {{ __('Sequence/Order') }} <span class="text-red-500">*</span>
                        </label>
                        <input type="number" id="sequence" name="sequence" min="1"
                            class="w-full px-4 py-2 rounded-lg border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-900 text-neutral-900 dark:text-neutral-50 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('sequence') border-red-500 @enderror"
                            placeholder="{{ __('1') }}" value="{{ old('sequence', $slider->sequence) }}"
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
                            {{ old('is_active', $slider->is_active) ? 'checked' : '' }}
                            class="w-4 h-4 rounded border-neutral-300 text-blue-600 focus:ring-blue-500" />
                        <label for="is_active" class="text-sm font-medium text-neutral-900 dark:text-neutral-50">
                            {{ __('Active') }}
                        </label>
                    </div>
                </div>

                <!-- Actions -->
                <div class="mt-8 flex items-center gap-3 pt-8 border-t border-neutral-200 dark:border-neutral-700">
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        {{ __('Update Slider') }}
                    </button>
                    <a href="{{ route('admin.sliders.index') }}" wire:navigate
                        class="inline-flex items-center gap-2 px-6 py-2 text-neutral-600 dark:text-neutral-400 hover:text-neutral-900 dark:hover:text-neutral-50 transition-colors">
                        {{ __('Cancel') }}
                    </a>
                </div>
            </form>
        </div>
    </div>

    @once
        @push('scripts')
          <script>
document.addEventListener("livewire:navigated", initPage);
document.addEventListener("DOMContentLoaded", initPage);

function initPage() {
    initQuill();
    initImagePreview();
}

/* -------------------------
   QUILL
--------------------------*/

function initQuill() {

    const editor = document.querySelector('#quillEditor');
    if (!editor) return;

    if (editor.classList.contains("ql-container")) return;

    window.quill = new Quill('#quillEditor', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ header: [1,2,3,false] }],
                ['bold','italic','underline'],
                [{ list:'ordered' },{ list:'bullet' }],
                [{ color:[] },{ background:[] }],
                ['link'],
                ['clean']
            ]
        }
    });

    let titleValue = document.getElementById('title').value;

    if (titleValue) {
        window.quill.clipboard.dangerouslyPasteHTML(titleValue);
    }

    window.quill.on('text-change', function () {
        document.getElementById('title').value = window.quill.root.innerHTML;
    });

    const form = document.querySelector('form');

    if (form) {
        form.addEventListener('submit', function () {
            document.getElementById('title').value = window.quill.root.innerHTML;
        });
    }
}

/* -------------------------
   IMAGE PREVIEW
--------------------------*/

function initImagePreview() {

    const imageInput = document.getElementById('image');
    const previewImg = document.getElementById('previewImg');

    if (!imageInput || imageInput.dataset.listener === "true") return;

    imageInput.dataset.listener = "true";

    imageInput.addEventListener('change', function () {

        const file = this.files[0];
        if (!file) return;

        const reader = new FileReader();

        reader.onload = function (e) {
            previewImg.src = e.target.result;
        };

        reader.readAsDataURL(file);
    });
}
</script>
        @endpush
    @endonce
</x-layouts::app>
