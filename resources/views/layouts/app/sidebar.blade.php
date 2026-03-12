<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
    <!-- Quill Editor Stylesheet -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet" />
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800">
    <flux:sidebar sticky collapsible class="bg-zinc-50 dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-700">
        <flux:sidebar.header>
            <x-app.logo :sidebar="true" href="{{ route('dashboard') }}" wire:navigate />
            <flux:sidebar.collapse
                class="in-data-flux-sidebar-on-desktop:not-in-data-flux-sidebar-collapsed-desktop:-mr-2" />
        </flux:sidebar.header>

        <flux:sidebar.nav>
            <flux:sidebar.group :heading="__('Pages')" class="grid">
                <flux:sidebar.item icon="home" :href="route('admin.home')" :current="request()->routeIs('admin.home')"
                    wire:navigate>
                    {{ __('Home Page') }}
                </flux:sidebar.item>
                <flux:sidebar.item icon="newspaper" :href="route('admin.publications')"
                    :current="request()->routeIs('admin.publications')" wire:navigate>
                    {{ __('Publications') }}
                </flux:sidebar.item>
                                <flux:sidebar.item icon="newspaper" :href="route('admin.about_us')"
                :current="request()->routeIs('admin.about_us')" wire:navigate>
                {{ __('About Us') }}
            </flux:sidebar.item>
             <flux:sidebar.item icon="hand-raised" :href="route('admin.get_involved')"
                    :current="request()->routeIs('admin.get_involved')" wire:navigate>
                    {{ __('Get Involved') }}
                </flux:sidebar.item>
            </flux:sidebar.group>
            <flux:sidebar.group :heading="__('Program Page')" class="grid">
                <flux:sidebar.item icon="bolt" :href="route('admin.program.empowering')"
                    :current="request()->routeIs('admin.program.empowering')" wire:navigate>
                    {{ __('Empowering Lives') }}
                </flux:sidebar.item>
                <flux:sidebar.item icon="device-tablet" :href="route('admin.program.innovation')"
                    :current="request()->routeIs('admin.program.innovation')" wire:navigate>
                    {{ __('Accelerating Innovation') }}
                </flux:sidebar.item>
                <flux:sidebar.item icon="book-open" :href="route('admin.program.education')"
                    :current="request()->routeIs('admin.program.education')" wire:navigate>
                    {{ __('Powering Education') }}
                </flux:sidebar.item>
            </flux:sidebar.group>
    </flux:sidebar.nav>
        
        <flux:sidebar.group :heading="__('Detail Sections')">
            <flux:sidebar.group :heading="__('Home Page Sections')" expandable
                :expanded="request()->routeIs('admin.sliders.*', 'admin.sections.*', 'admin.feature-cards.*', 'admin.impacts.*', 'admin.mission_sliders.*')">
                <flux:sidebar.item icon="photo" :href="route('admin.sliders.index')"
                    :current="request()->routeIs('admin.sliders.*')" wire:navigate>
                    {{ __('Slider Section') }}
                </flux:sidebar.item>

                <flux:sidebar.item icon="document-text" :href="route('admin.sections.index')"
                    :current="request()->routeIs('admin.sections.*')" wire:navigate>
                    {{ __('Details Section') }}
                </flux:sidebar.item>

                <flux:sidebar.item icon="squares-2x2" :href="route('admin.feature-cards.index')"
                    :current="request()->routeIs('admin.feature-cards.*')" wire:navigate>
                    {{ __('Feature Cards') }}
                </flux:sidebar.item>

                <flux:sidebar.item icon="chart-bar" :href="route('admin.impacts.index')"
                    :current="request()->routeIs('admin.impacts.*')" wire:navigate>
                    {{ __('Impact Section') }}
                </flux:sidebar.item>

                <flux:sidebar.item icon="rocket-launch" :href="route('admin.mission_sliders.index')"
                    :current="request()->routeIs('admin.mission_sliders.*')" wire:navigate>
                    {{ __('Mission Sliders') }}
                </flux:sidebar.item>
            </flux:sidebar.group>

            <flux:sidebar.group :heading="__('Program Page')" expandable
                :expanded="request()->routeIs('admin.main_sliders.*', 'admin.other_sections.*', 'admin.other_feature_cards.*', 'admin.other_impacts.*', 'admin.other_mission_sliders.*')">
                <flux:sidebar.item icon="photo" :href="route('admin.main_sliders.index')"
                    :current="request()->routeIs('admin.main_sliders.*')" wire:navigate>
                    {{ __('Slider Sections') }}
                </flux:sidebar.item>

                <flux:sidebar.item icon="document-text" :href="route('admin.other_sections.index')"
                    :current="request()->routeIs('admin.other_sections.*')" wire:navigate>
                    {{ __('Details Section') }}
                </flux:sidebar.item>

                <flux:sidebar.item icon="squares-2x2" :href="route('admin.other_feature_cards.index')"
                    :current="request()->routeIs('admin.other_feature_cards.*')" wire:navigate>
                    {{ __('Feature Cards') }}
                </flux:sidebar.item>

                <flux:sidebar.item icon="chart-bar" :href="route('admin.other_impacts.index')"
                    :current="request()->routeIs('admin.other_impacts.*')" wire:navigate>
                    {{ __('Impact Section') }}
                </flux:sidebar.item>

                <flux:sidebar.item icon="rocket-launch" :href="route('admin.other_mission_sliders.index')"
                    :current="request()->routeIs('admin.other_mission_sliders.*')" wire:navigate>
                    {{ __('Mission Sliders') }}
                </flux:sidebar.item>
            </flux:sidebar.group>
        </flux:sidebar.group>

        <flux:sidebar.spacer />

        <flux:sidebar.nav>
            <flux:sidebar.item icon="cog-6-tooth" :href="route('profile.edit')" wire:navigate>
                {{ __('Settings') }}
            </flux:sidebar.item>
        </flux:sidebar.nav>

        <flux:dropdown position="top" align="start" class="max-lg:hidden">
            <flux:sidebar.profile :initials="auth()->user()->initials()" name="{{ auth()->user()->name }}" />

            <flux:menu>
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                            <flux:avatar :name="auth()->user()->name" :initials="auth()->user()->initials()" />
                            <div class="grid flex-1 text-start text-sm leading-tight">
                                <flux:heading class="truncate">{{ auth()->user()->name }}</flux:heading>
                                <flux:text class="truncate">{{ auth()->user()->email }}</flux:text>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle"
                        class="w-full cursor-pointer" data-test="logout-button">
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:sidebar>


    <!-- Mobile User Menu -->
    <flux:header class="lg:hidden">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

        <flux:spacer />

        <flux:dropdown position="top" align="end">
            <flux:profile :initials="auth()->user()->initials()" icon-trailing="chevron-down" />

            <flux:menu>
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                            <flux:avatar :name="auth()->user()->name" :initials="auth()->user()->initials()" />

                            <div class="grid flex-1 text-start text-sm leading-tight">
                                <flux:heading class="truncate">{{ auth()->user()->name }}</flux:heading>
                                <flux:text class="truncate">{{ auth()->user()->email }}</flux:text>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <flux:menu.radio.group>
                    <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>
                        {{ __('Settings') }}
                    </flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle"
                        class="w-full cursor-pointer" data-test="logout-button">
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:header>

    {{ $slot }}

    @fluxScripts
    <!-- Quill Editor Library -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    @stack('scripts')
</body>

</html>
