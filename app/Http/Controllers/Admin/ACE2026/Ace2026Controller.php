<?php

namespace App\Http\Controllers\Admin\ACE2026;

use App\Enums\SitePage;
use App\Http\Controllers\Controller;
use App\Models\ContentSection;
use App\Models\FeatureCard;
use App\Models\Impact;
use App\Models\MissionSlide;
use App\Models\Slider;
use Illuminate\View\View;

class Ace2026Controller extends Controller
{
    public function index(): View
    {
        $sliders = Slider::where('page', SitePage::ACE2026)->orderBy('sequence')->get();
        $missionSlides = MissionSlide::where('page', SitePage::ACE2026)->orderBy('page')->get();
        $impacts = Impact::where('page', SitePage::ACE2026)->orderBy('sequence')->get();
        $featureCards = FeatureCard::where('page', SitePage::ACE2026)->orderBy('sequence')->get();
        $contentSections = ContentSection::where('page', SitePage::ACE2026)->get();

        return view('pages.admin.program.ace2026', compact(
            'sliders',
            'missionSlides',
            'impacts',
            'featureCards',
            'contentSections'
        ));
    }
}
