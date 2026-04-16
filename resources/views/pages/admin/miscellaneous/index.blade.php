<x-layouts::app :title="__('Create files for External Users')">
    <div class="flex h-full w-full flex-1 flex-col gap-4">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-semibold text-neutral-900 dark:text-neutral-50">
                    {{ __('Create files for External Users') }}
                </h1>
                <p class="text-sm text-neutral-600 dark:text-neutral-400 mt-1">
                    {{ __('Add new files for external users') }}
                </p>
            </div>
        </div>
        @if (session('success'))
            {{ session('success') }} <br>
            <a href="{{ session('url') }}" target="_blank" class="text-blue-500 underline">
                {{ session('url') }}
            </a>
        @endif
        <!-- Form -->
        <div class="rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-800">
            <form action="{{ route('admin.miscellaneous.store') }}" enctype="multipart/form-data" method="POST"
                class="p-8">
                @csrf

                <div class="space-y-8">
                    <!-- file File Upload Field -->
                    <div>
                        <label for="file"
                            class="block text-sm font-semibold text-neutral-900 dark:text-neutral-50 mb-2">
                            {{ __('file Upload') }} <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="file" id="file" name="file"
                                class="w-full px-4 py-2 rounded-lg border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-900 text-neutral-900 dark:text-neutral-50 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('file') border-red-500 @enderror"
                                required />
                        </div>
                        @error('file')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Actions -->
                <div class="mt-8 flex items-center gap-3 pt-8 border-t border-neutral-200 dark:border-neutral-700">
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        {{ __('Create file') }}
                    </button>
                    <a href="{{ route('admin.miscellaneous.index') }}" wire:navigate
                        class="inline-flex items-center gap-2 px-6 py-2 text-neutral-600 dark:text-neutral-400 hover:text-neutral-900 dark:hover:text-neutral-50 transition-colors">
                        {{ __('Cancel') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-layouts::app>