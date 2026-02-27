<?php

namespace App\Http\Controllers\Admin;

use App\Enums\SitePage;
use App\Http\Controllers\Controller;
use App\Models\ContentSection;
use App\Models\FeatureCard;
use App\Models\Impact;
use App\Models\MissionSlide;
use App\Models\Slider;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the home page.
     */
    public function index(): View
    {
        $sliders = Slider::where('page', SitePage::HOME->value)->ordered()->paginate(12);
        $missionSlides = MissionSlide::ordered()->get();
        $impacts = Impact::active()->ordered()->get();
        $featureCards = FeatureCard::ordered()->get();
        $contentSections = ContentSection::ordered()->get();

        return view('pages.admin.home.home', compact(
            'sliders',
            'missionSlides',
            'impacts',
            'featureCards',
            'contentSections'
        ));
    }
}
