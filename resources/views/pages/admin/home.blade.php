<x-layouts::app :title="__('Home')">
    <div class="flex h-full w-full flex-1 flex-col gap-6">
        <!-- Header Slider Section -->
        @if ($sliders->count() > 0)
            <h1 class="text-2xl font-bold text-neutral-900 dark:text-white mb-4">
                Slider Section
            </h1>
            <div class="relative rounded-xl border border-neutral-200 dark:border-neutral-700 overflow-hidden bg-white dark:bg-zinc-800"
                x-data="{ currentSlide: 0, maxSlides: {{ $sliders->count() }} }"
                @keydown.left="currentSlide = currentSlide === 0 ? maxSlides - 1 : currentSlide - 1"
                @keydown.right="currentSlide = currentSlide === maxSlides - 1 ? 0 : currentSlide + 1">
                <div class="relative h-80 md:h-96">
                    @foreach ($sliders as $index => $slider)
                        <div class="absolute inset-0 transition-opacity duration-1000"
                            :class="currentSlide === {{ $index }} ? 'opacity-100' : 'opacity-0 pointer-events-none'">
                            <div class="h-full bg-cover bg-center flex flex-col items-center justify-center text-center px-6 py-12"
                                style="background-image: url('{{ asset('storage/' . $slider->image) }}');">
                                <div class="absolute inset-0 bg-black/50"></div>
                                <div class="relative z-10">
                                    <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">{!! $slider->title !!}
                                    </h1>
                                    <p class="text-lg text-gray-100">{{ $slider->sub_title }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Navigation Controls -->
                <div class="absolute bottom-6 left-0 right-0 flex items-center justify-center gap-4 z-10">
                    <!-- Previous Button -->
                    <button @click="currentSlide = currentSlide === 0 ? maxSlides - 1 : currentSlide - 1"
                        class="p-2 rounded-full bg-white/80 hover:bg-white dark:bg-zinc-700/80 dark:hover:bg-zinc-700 transition-colors">
                        <svg class="w-5 h-5 text-neutral-900 dark:text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>

                    <!-- Slide Indicators -->
                    <div class="flex gap-2">
                        @foreach ($sliders as $index => $slider)
                            <button @click="currentSlide = {{ $index }}"
                                :class="currentSlide === {{ $index }} ? 'bg-white dark:bg-blue-400' :
                                    'bg-white/50 dark:bg-zinc-500'"
                                class="h-3 rounded-full transition-all"
                                :style="currentSlide === {{ $index }} ? 'width: 24px' : 'width: 12px'" />
                        @endforeach
                    </div>

                    <!-- Next Button -->
                    <button @click="currentSlide = currentSlide === maxSlides - 1 ? 0 : currentSlide + 1"
                        class="p-2 rounded-full bg-white/80 hover:bg-white dark:bg-zinc-700/80 dark:hover:bg-zinc-700 transition-colors">
                        <svg class="w-5 h-5 text-neutral-900 dark:text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>
        @else
            <div
                class="rounded-xl border border-neutral-200 dark:border-neutral-700 overflow-hidden bg-gradient-to-br from-blue-500 to-blue-600 dark:from-blue-700 dark:to-blue-800 px-8 py-12 text-center">
                <img src="/images/renew-foundation-logo.png" alt="ReNew Foundation"
                    class="h-20 w-auto object-contain mx-auto mb-6" />
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">{{ __('Welcome to ReNew Foundation') }}</h1>
                <p class="text-lg text-blue-100">{{ __('Empowering Communities, Renewing Futures') }}</p>
            </div>
        @endif

        <!-- Stats Section -->
        <div class="flex justify-center">

            <div class="grid gap-6 grid-cols-1 md:grid-cols-2 lg:grid-cols-3 max-w-6xl w-full">

                <!-- Card -->
                <div
                    class="rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-800 p-6 flex items-center gap-4 hover:shadow-lg transition">

                    <div class="h-12 w-12 rounded-lg bg-blue-100 dark:bg-blue-900 flex items-center justify-center">
                        <svg class="h-6 w-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 10h11M3 14h11M5 19h7m-7-4h7m5-4v1a3 3 0 003 3h2M5 19a3 3 0 01-3-3v-1a3 3 0 013-3h2a3 3 0 013 3v1a3 3 0 01-3 3H5z" />
                        </svg>
                    </div>

                    <div>
                        <a href="{{ route('admin.sections.index') }}"
                            class="text-lg font-semibold text-neutral-900 dark:text-white hover:text-blue-600">
                            Details Section
                        </a>
                        <p class="text-sm text-neutral-500">Manage content sections</p>
                    </div>

                </div>


                <div
                    class="rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-800 p-6 flex items-center gap-4 hover:shadow-lg transition">

                    <div class="h-12 w-12 rounded-lg bg-green-100 dark:bg-green-900 flex items-center justify-center">
                        <svg class="h-6 w-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <div>
                        <a href="{{ route('admin.feature-cards.index') }}"
                            class="text-lg font-semibold text-neutral-900 dark:text-white hover:text-green-600">
                            Feature Card
                        </a>
                        <p class="text-sm text-neutral-500">Manage feature cards</p>
                    </div>
                </div>
                <!-- Card -->
                <div
                    class="rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-800 p-6 flex items-center gap-4 hover:shadow-lg transition">

                    <div class="h-12 w-12 rounded-lg bg-purple-100 dark:bg-purple-900 flex items-center justify-center">
                        <svg class="h-6 w-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>

                    <div>
                        <a href="{{ route('admin.impacts.index') }}"
                            class="text-lg font-semibold text-neutral-900 dark:text-white hover:text-purple-600">
                            Impact Section
                        </a>
                        <p class="text-sm text-neutral-500">Manage community impact data</p>
                    </div>

                </div>
                {{-- create a card for the mission slider --}}
                <div
                    class="rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-800 p-6 flex items-center gap-4 hover:shadow-lg transition">

                    <div class="h-12 w-12 rounded-lg bg-yellow-100 dark:bg-yellow-900 flex items-center justify-center">
                        <svg class="h-6 w-6 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.498 3.498 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.39-1.754-1.118-2.385l-.548-.547z" />
                        </svg>
                    </div>

                    <div>
                        <a href="{{ route('admin.mission-slides.index') }}"
                            class="text-lg font-semibold text-neutral-900 dark:text-white hover:text-yellow-600">
                            Mission Slides
                        </a>
                        <p class="text-sm text-neutral-500">Manage mission statement slides</p>
                    </div>

            </div>

        </div>
    </div>
</x-layouts::app>
