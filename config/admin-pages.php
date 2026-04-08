<?php
use App\Enums\SitePage;

return [
    'pages' => [
        [
            'name' =>  SitePage::HOME->label(),
            'route' => 'admin.home',
            'icon' => 'M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 11l4-4m0 0l4 4m-4-4V3',
            'description' => 'Manage sliders and content',
            'color' => 'blue',
            'enabled' => true,
        ],
        [
            'name' =>  SitePage::EMPOWERING_LIVES->label(),
            'route' => 'admin.program.empowering',
            'icon' => 'M13 10V3L4 14h7v7l9-11h-7z',
            'description' => 'Manage program content',
            'color' => 'green',
            'enabled' => true,
        ],
        [
            'name' =>  SitePage::ACCELERATING_INNOVATION->label(),
            'route' => 'admin.program.innovation',
            'icon' => 'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z',
            'description' => 'Manage innovation program',
            'color' => 'purple',
            'enabled' => true,
        ],
        [
            'name' =>  SitePage::POWERING_EDUCATION->label(),
            'route' => 'admin.program.education',
            'icon' => 'M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222',
            'description' => 'Manage education program',
            'color' => 'orange',
            'enabled' => true,
        ],
        [
            'name' =>  SitePage::PUBLICATIONS->label(),
            'route' => 'admin.publications',
            'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
            'description' => 'Manage publications content',
            'color' => 'pink',
            'enabled' => true,
        ],
        [
            'name' =>  SitePage::ABOUT_US->label(),
            'route' => 'admin.about_us',
            'icon' => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
            'description' => 'Manage about us content',
            'color' => 'indigo',
            'enabled' => true,
        ],
        [
            'name' =>  SitePage::GET_INVOLVED->label(),
            'route' => 'admin.get_involved',
            'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z',
            'description' => 'Manage get involved content',
            'color' => 'cyan',
            'enabled' => true,
        ],
        [
            'name' =>  SitePage::ACE2026->label(),
            'route' => 'admin.program.ace_2026',
            'icon' => 'M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.922-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.176 0l-2.8 2.034c-.784.57-1.838-.196-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L4.98 8.72c-.784-.57-.38-1.81.588-1.81H9.03a1 1 0 00.95-.69l1.07-3.292z',
            'description' => 'Manage ACE 2026 program content',
            'color' => 'amber',
            'enabled' => true,
        ],
        [
            'name' =>  SitePage::CLIMATE_SOLUTIONS->label(),
            'route' => 'admin.program.climate_solutions',
            'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
            'description' => 'Manage institutional partnerships content',
            'color' => 'emerald',
            'enabled' => true,
        ]
    ],
];
