<x-layouts::app :title="__('Home')">
    <div class="flex h-full w-full flex-1 flex-col gap-6">
        <!-- Header Slider Section -->
        @if ($sliders->count() > 0)
            <div class="relative rounded-xl border border-neutral-200 dark:border-neutral-700 overflow-hidden bg-white dark:bg-zinc-800" x-data="{ currentSlide: 0, maxSlides: {{ $sliders->count() }} }" @keydown.left="currentSlide = currentSlide === 0 ? maxSlides - 1 : currentSlide - 1" @keydown.right="currentSlide = currentSlide === maxSlides - 1 ? 0 : currentSlide + 1">
                <div class="relative h-80 md:h-96">
                    @foreach ($sliders as $index => $slider)
                        <div class="absolute inset-0 transition-opacity duration-1000" :class="currentSlide === {{ $index }} ? 'opacity-100' : 'opacity-0 pointer-events-none'">
                            <div class="h-full bg-cover bg-center flex flex-col items-center justify-center text-center px-6 py-12" style="background-image: url('{{ $slider->image }}');">
                                <div class="absolute inset-0 bg-black/50"></div>
                                <div class="relative z-10">
                                    <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">{!! $slider->title !!}</h1>
                                    <p class="text-lg text-gray-100">{{ $slider->sub_title }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Navigation Controls -->
                <div class="absolute bottom-6 left-0 right-0 flex items-center justify-center gap-4 z-10">
                    <!-- Previous Button -->
                    <button @click="currentSlide = currentSlide === 0 ? maxSlides - 1 : currentSlide - 1" class="p-2 rounded-full bg-white/80 hover:bg-white dark:bg-zinc-700/80 dark:hover:bg-zinc-700 transition-colors">
                        <svg class="w-5 h-5 text-neutral-900 dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>

                    <!-- Slide Indicators -->
                    <div class="flex gap-2">
                        @foreach ($sliders as $index => $slider)
                            <button @click="currentSlide = {{ $index }}" :class="currentSlide === {{ $index }} ? 'bg-white dark:bg-blue-400' : 'bg-white/50 dark:bg-zinc-500'" class="h-3 rounded-full transition-all" :style="currentSlide === {{ $index }} ? 'width: 24px' : 'width: 12px'" />
                        @endforeach
                    </div>

                    <!-- Next Button -->
                    <button @click="currentSlide = currentSlide === maxSlides - 1 ? 0 : currentSlide + 1" class="p-2 rounded-full bg-white/80 hover:bg-white dark:bg-zinc-700/80 dark:hover:bg-zinc-700 transition-colors">
                        <svg class="w-5 h-5 text-neutral-900 dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>
        @else
            <div class="rounded-xl border border-neutral-200 dark:border-neutral-700 overflow-hidden bg-gradient-to-br from-blue-500 to-blue-600 dark:from-blue-700 dark:to-blue-800 px-8 py-12 text-center">
                <img src="/images/renew-foundation-logo.png" alt="ReNew Foundation" class="h-20 w-auto object-contain mx-auto mb-6" />
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">{{ __('Welcome to ReNew Foundation') }}</h1>
                <p class="text-lg text-blue-100">{{ __('Empowering Communities, Renewing Futures') }}</p>
            </div>
        @endif

        <!-- Stats Section -->
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-800 p-6 flex flex-col gap-2">
                <div class="flex items-center gap-3">
                    <div class="h-10 w-10 rounded-lg bg-blue-100 dark:bg-blue-900 flex items-center justify-center">
                        <svg class="h-6 w-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-neutral-600 dark:text-neutral-400">{{ __('Active Members') }}</p>
                        <p class="text-2xl font-semibold text-neutral-900 dark:text-neutral-50">2,847</p>
                    </div>
                </div>
            </div>

            <div class="rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-800 p-6 flex flex-col gap-2">
                <div class="flex items-center gap-3">
                    <div class="h-10 w-10 rounded-lg bg-green-100 dark:bg-green-900 flex items-center justify-center">
                        <svg class="h-6 w-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-neutral-600 dark:text-neutral-400">{{ __('Projects Completed') }}</p>
                        <p class="text-2xl font-semibold text-neutral-900 dark:text-neutral-50">156</p>
                    </div>
                </div>
            </div>

            <div class="rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-800 p-6 flex flex-col gap-2">
                <div class="flex items-center gap-3">
                    <div class="h-10 w-10 rounded-lg bg-purple-100 dark:bg-purple-900 flex items-center justify-center">
                        <svg class="h-6 w-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-neutral-600 dark:text-neutral-400">{{ __('Community Impact') }}</p>
                        <p class="text-2xl font-semibold text-neutral-900 dark:text-neutral-50">45K+</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Section -->
        <div class="grid auto-rows-min gap-4 lg:grid-cols-2">
            <div class="rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-800 p-6">
                <h2 class="text-lg font-semibold text-neutral-900 dark:text-neutral-50 mb-4">{{ __('About Us') }}</h2>
                <p class="text-sm text-neutral-600 dark:text-neutral-400 leading-relaxed">ReNew Foundation is dedicated to empowering communities and creating sustainable positive change. Our mission is to renew futures through innovative programs and community engagement.</p>
            </div>

            <div class="rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-800 p-6">
                <h2 class="text-lg font-semibold text-neutral-900 dark:text-neutral-50 mb-4">{{ __('Get Involved') }}</h2>
                <p class="text-sm text-neutral-600 dark:text-neutral-400 leading-relaxed">Join our community and make a difference. Whether you're interested in volunteering, supporting our mission, or partnering with us, we'd love to hear from you.</p>
            </div>
        </div>
    </div>
</x-layouts::app>