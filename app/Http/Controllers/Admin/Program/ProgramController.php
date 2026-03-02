<?php

namespace App\Http\Controllers\Admin\Program;

use App\Enums\SitePage;
use App\Http\Controllers\Controller;
use App\Models\ContentSection;
use App\Models\FeatureCard;
use App\Models\Impact;
use App\Models\MissionSlide;
use App\Models\Slider;
use Illuminate\View\View;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $sliders = Slider::where('page', SitePage::EMPOWERING_LIVES)->orderBy('sequence')->get();
        $missionSlides = MissionSlide::where('page', SitePage::EMPOWERING_LIVES)->orderBy('sequence')->get();
        $impacts = Impact::where('page', SitePage::EMPOWERING_LIVES)->orderBy('sequence')->get();
        $featureCards = FeatureCard::where('page', SitePage::EMPOWERING_LIVES)->orderBy('sequence')->get();
        $contentSections = ContentSection::where('page', SitePage::EMPOWERING_LIVES)->get();

        return view('pages.admin.program.index', compact(
            'sliders',
            'missionSlides',
            'impacts',
            'featureCards',
            'contentSections'
        ));
    }
}
