<?php

namespace App\Http\Controllers\Admin;

use App\Enums\SitePage;
use App\Http\Controllers\Controller;
use App\Models\ContentSection;
use App\Models\FeatureCard;
use App\Models\Impact;
use App\Models\MissionSlide;
use App\Models\Slider;

class PublicationController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('page', SitePage::PUBLICATIONS->value)->ordered()->paginate(12);
        $missionSlides = MissionSlide::where('page', SitePage::PUBLICATIONS->value)->ordered()->get();
        $impacts = Impact::where('page', SitePage::PUBLICATIONS->value)->active()->ordered()->get();
        $featureCards = FeatureCard::where('page', SitePage::PUBLICATIONS->value)->ordered()->get();
        $contentSections = ContentSection::where('page', SitePage::PUBLICATIONS->value)->ordered()->get();

        return view('pages.admin.publications.index', compact(
            'sliders',
            'missionSlides',
            'impacts',
            'featureCards',
            'contentSections'
        ));
    }
}
