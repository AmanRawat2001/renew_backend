<?php

namespace App\Http\Controllers\Admin\Program;

use App\Enums\SitePage;
use App\Http\Controllers\Controller;
use App\Models\ContentSection;
use App\Models\FeatureCard;
use App\Models\Impact;
use App\Models\ImpactStory;
use App\Models\ImpactStorySection;
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
    public function empowering(): View
    {
        $sliders = Slider::where('page', SitePage::EMPOWERING_LIVES)->orderBy('sequence')->get();
        $missionSlides = MissionSlide::where('page', SitePage::EMPOWERING_LIVES)->orderBy('page')->get();
        $impacts = Impact::where('page', SitePage::EMPOWERING_LIVES)->orderBy('sequence')->get();
        $featureCards = FeatureCard::where('page', SitePage::EMPOWERING_LIVES)->orderBy('sequence')->get();
        $contentSections = ContentSection::where('page', SitePage::EMPOWERING_LIVES)->get();
        $impactStories = ImpactStory::where('page', SitePage::EMPOWERING_LIVES)->orderBy('sort_order')->get();
        $impactStorySections = ImpactStorySection::where('page', SitePage::EMPOWERING_LIVES)->get();

        return view('pages.admin.program.empowering', compact(
            'sliders',
            'missionSlides',
            'impacts',
            'featureCards',
            'contentSections',
            'impactStories',
            'impactStorySections'
        ));
    }

    public function accelerating(): View
    {
        $sliders = Slider::where('page', SitePage::ACCELERATING_INNOVATION)->orderBy('sequence')->get();
        $missionSlides = MissionSlide::where('page', SitePage::ACCELERATING_INNOVATION)->orderBy('page')->get();
        $impacts = Impact::where('page', SitePage::ACCELERATING_INNOVATION)->orderBy('sequence')->get();
        $featureCards = FeatureCard::where('page', SitePage::ACCELERATING_INNOVATION)->orderBy('sequence')->get();
        $contentSections = ContentSection::where('page', SitePage::ACCELERATING_INNOVATION)->get();
        $impactStories = ImpactStory::where('page', SitePage::ACCELERATING_INNOVATION)->orderBy('sort_order')->get();
        $impactStorySections = ImpactStorySection::where('page', SitePage::ACCELERATING_INNOVATION)->get();

        return view('pages.admin.program.accelerating', compact(
            'sliders',
            'missionSlides',
            'impacts',
            'featureCards',
            'contentSections',
            'impactStories',
            'impactStorySections'
        ));
    }

    public function powering(): View
    {
        $sliders = Slider::where('page', SitePage::POWERING_EDUCATION)->orderBy('sequence')->get();
        $missionSlides = MissionSlide::where('page', SitePage::POWERING_EDUCATION)->orderBy('page')->get();
        $impacts = Impact::where('page', SitePage::POWERING_EDUCATION)->orderBy('sequence')->get();
        $featureCards = FeatureCard::where('page', SitePage::POWERING_EDUCATION)->orderBy('sequence')->get();
        $contentSections = ContentSection::where('page', SitePage::POWERING_EDUCATION)->get();
        $impactStories = ImpactStory::where('page', SitePage::POWERING_EDUCATION)->orderBy('sort_order')->get();
        $impactStorySections = ImpactStorySection::where('page', SitePage::POWERING_EDUCATION)->get();

        return view('pages.admin.program.powering', compact(
            'sliders',
            'missionSlides',
            'impacts',
            'featureCards',
            'contentSections',
            'impactStories',
            'impactStorySections'
        ));
    }

    public function climate(): View
    {
        $sliders = Slider::where('page', SitePage::CLIMATE_SOLUTIONS)->orderBy('sequence')->get();
        $missionSlides = MissionSlide::where('page', SitePage::CLIMATE_SOLUTIONS)->orderBy('page')->get();
        $featureCards = FeatureCard::where('page', SitePage::CLIMATE_SOLUTIONS)->orderBy('sequence')->get();
        $contentSections = ContentSection::where('page', SitePage::CLIMATE_SOLUTIONS)->get();

        return view('pages.admin.program.climate', compact(
            'sliders',
            'missionSlides',
            'featureCards',
            'contentSections',
        ));
    }
}
