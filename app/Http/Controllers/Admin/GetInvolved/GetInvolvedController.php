<?php

namespace App\Http\Controllers\Admin\GetInvolved;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Enums\SitePage;
use App\Models\ContentSection;
use App\Models\FeatureCard;
use App\Models\Impact;
use App\Models\MissionSlide;
use App\Models\Slider;
use Illuminate\View\View;

class GetInvolvedController extends Controller
{
    public function index(): View
    {
        $sliders = Slider::where('page', SitePage::GET_INVOLVED)->orderBy('sequence')->get();
        $missionSlides = MissionSlide::where('page', SitePage::GET_INVOLVED)->orderBy('page')->get();
        $impacts = Impact::where('page', SitePage::GET_INVOLVED)->orderBy('sequence')->get();
        $featureCards = FeatureCard::where('page', SitePage::GET_INVOLVED)->orderBy('sequence')->get();
        $contentSections = ContentSection::where('page', SitePage::GET_INVOLVED)->get();

        return view('pages.admin.get_involved.index', compact(
            'sliders',
            'missionSlides',
            'impacts',
            'featureCards',
            'contentSections'
        ));
    }
}
