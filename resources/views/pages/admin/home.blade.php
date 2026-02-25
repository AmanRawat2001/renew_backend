<x-layouts::app :title="__('Home')">
    <div class="flex h-full w-full flex-1 flex-col gap-6">
        <!-- Header Section -->
        <div class="rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-zinc-800 p-8">
            <div class="flex flex-col items-center text-center gap-4">
                <div>
                    <h1 class="text-3xl font-semibold text-neutral-900 dark:text-neutral-50">{{ __('Welcome to ReNew Foundation Home Page') }}</h1>
                </div>
            </div>
        </div>

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
                        <a href="{{ route(name: 'admin.slider') }}" class=" text-2xl text-neutral-600 dark:text-neutral-400">{{ __('Slider Section') }}</a>
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