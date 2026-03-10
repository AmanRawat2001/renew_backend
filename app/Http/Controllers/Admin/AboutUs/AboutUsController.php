<?php

namespace App\Http\Controllers\Admin\AboutUs;

use App\Enums\SitePage;
use App\Http\Controllers\Controller;
use App\Models\ContentSection;
use App\Models\FeatureCard;
use App\Models\Impact;
use App\Models\MissionSlide;
use App\Models\Slider;
use Illuminate\View\View;

class AboutUsController extends Controller
{
    public function index(): View
    {
        $sliders = Slider::where('page', SitePage::ABOUT_US)->orderBy('sequence')->get();
        $missionSlides = MissionSlide::where('page', SitePage::ABOUT_US)->orderBy('page')->get();
        $impacts = Impact::where('page', SitePage::ABOUT_US)->orderBy('sequence')->get();
        $featureCards = FeatureCard::where('page', SitePage::ABOUT_US)->orderBy('sequence')->get();
        $contentSections = ContentSection::where('page', SitePage::ABOUT_US)->get();

        return view('pages.admin.about_us.index', compact(
            'sliders',
            'missionSlides',
            'impacts',
            'featureCards',
            'contentSections'
        ));
    }
}
