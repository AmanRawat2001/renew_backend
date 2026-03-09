<?php

namespace App\Http\Controllers\API;

use App\Enums\SitePage;
use App\Http\Controllers\Controller;
use App\Http\Resources\ContentSectionResource;
use App\Http\Resources\FeatureCardResource;
use App\Http\Resources\ImpactResource;
use App\Http\Resources\MissionSlideResource;
use App\Http\Resources\SliderResource;
use App\Models\ContentSection;
use App\Models\FeatureCard;
use App\Models\Impact;
use App\Models\MissionSlide;
use App\Models\Slider;

class HomeController extends Controller
{
    public function home()
    {
        $slider = Slider::where('page', SitePage::HOME->value)->active()->ordered()->get();
        $sections = ContentSection::where('page', SitePage::HOME->value)->ordered()->get()->groupBy('section_key');
        $feature_cards = FeatureCard::where('page', SitePage::HOME->value)->active()->ordered()->get();
        $impact_metrics = Impact::where('page', SitePage::HOME->value)->active()->ordered()->get();
        $mission_slider = MissionSlide::where('page', SitePage::HOME->value)->active()->ordered()->get();
        $groupedSections = [];
        foreach ($sections as $key => $sectionGroup) {
            $groupedSections[$key] = ContentSectionResource::collection($sectionGroup);
        }

        return response()->json(array_merge(
            ['slider' => SliderResource::collection($slider)],
            $groupedSections,
            [
                'feature_cards' => FeatureCardResource::collection($feature_cards),
                'impact_metrics' => ImpactResource::collection($impact_metrics),
                'mission_slider' => MissionSlideResource::collection($mission_slider),
            ]
        ));
    }

    public function empowering_lives()
    {
        $slider = Slider::where('page', SitePage::EMPOWERING_LIVES->value)->active()->ordered()->get();
        $sections = ContentSection::where('page', SitePage::EMPOWERING_LIVES->value)->ordered()->get()->groupBy('section_key');
        $feature_cards = FeatureCard::where('page', SitePage::EMPOWERING_LIVES->value)->active()->ordered()->get();
        $impact_metrics = Impact::where('page', SitePage::EMPOWERING_LIVES->value)->active()->ordered()->get();
        $mission_slider = MissionSlide::where('page', SitePage::EMPOWERING_LIVES->value)->active()->ordered()->get();
        $groupedSections = [];
        foreach ($sections as $key => $sectionGroup) {
            $groupedSections[$key] = ContentSectionResource::collection($sectionGroup);
        }
        $missionGrouped = $mission_slider->groupBy('title');
        if (isset($groupedSections['project_surya'])) {
            $groupedSections['project_surya'] = [
                'section' => $groupedSections['project_surya'],
                'mission_slider' => MissionSlideResource::collection(
                    $missionGrouped['project_surya'] ?? collect()
                ),
            ];
        }
        $mission_slider = $mission_slider->reject(function ($slide) {
            return $slide->title === 'project_surya';
        });

        return response()->json(array_merge(
            ['slider' => SliderResource::collection($slider)],
            $groupedSections,
            [
                'feature_cards' => FeatureCardResource::collection($feature_cards),
                'impact_metrics' => ImpactResource::collection($impact_metrics),
                'mission_slider' => MissionSlideResource::collection($mission_slider),
            ]
        ));
    }

    public function accelerating_innovation()
    {
        $slider = Slider::where('page', SitePage::ACCELERATING_INNOVATION->value)->active()->ordered()->get();
        $sections = ContentSection::where('page', SitePage::ACCELERATING_INNOVATION->value)->ordered()->get()->groupBy('section_key');
        $feature_cards = FeatureCard::where('page', SitePage::ACCELERATING_INNOVATION->value)->active()->ordered()->get();
        $impact_metrics = Impact::where('page', SitePage::ACCELERATING_INNOVATION->value)->active()->ordered()->get();
        $mission_slider = MissionSlide::where('page', SitePage::ACCELERATING_INNOVATION->value)->active()->ordered()->get();
        $groupedSections = [];
        foreach ($sections as $key => $sectionGroup) {
            $groupedSections[$key] = ContentSectionResource::collection($sectionGroup);
        }
        $missionGrouped = $mission_slider->groupBy('title');
        if (isset($groupedSections['renew_ace'])) {
            $groupedSections['renew_ace'] = [
                'section' => $groupedSections['renew_ace'],
                'mission_slider' => MissionSlideResource::collection(
                    $missionGrouped['renew_ace'] ?? collect()
                ),
            ];
        }
        $mission_slider = $mission_slider->reject(function ($slide) {
            return $slide->title === 'renew_ace';
        });

        return response()->json(array_merge(
            ['slider' => SliderResource::collection($slider)],
            $groupedSections,
            [
                'feature_cards' => FeatureCardResource::collection($feature_cards),
                'impact_metrics' => ImpactResource::collection($impact_metrics),
                'mission_slider' => MissionSlideResource::collection($mission_slider),
            ]
        ));

    }

    public function powering_education()
    {
        $slider = Slider::where('page', SitePage::POWERING_EDUCATION->value)->active()->ordered()->get();
        $sections = ContentSection::where('page', SitePage::POWERING_EDUCATION->value)->ordered()->get()->groupBy('section_key');
        $feature_cards = FeatureCard::where('page', SitePage::POWERING_EDUCATION->value)->active()->ordered()->get();
        $impact_metrics = Impact::where('page', SitePage::POWERING_EDUCATION->value)->active()->ordered()->get();
        $mission_slider = MissionSlide::where('page', SitePage::POWERING_EDUCATION->value)->active()->ordered()->get();
        $groupedSections = [];
        foreach ($sections as $key => $sectionGroup) {
            $groupedSections[$key] = ContentSectionResource::collection($sectionGroup);
        }
        $missionGrouped = $mission_slider->groupBy('title');
        if (isset($groupedSections['young_climate'])) {
            $groupedSections['young_climate'] = [
                'section' => $groupedSections['young_climate'],
                'mission_slider' => MissionSlideResource::collection(
                    $missionGrouped['young_climate'] ?? collect()
                ),
            ];
        }
        $mission_slider = $mission_slider->reject(function ($slide) {
            return $slide->title === 'young_climate';
        });

        return response()->json(array_merge(
            ['slider' => SliderResource::collection($slider)],
            $groupedSections,
            [
                'feature_cards' => FeatureCardResource::collection($feature_cards),
                'impact_metrics' => ImpactResource::collection($impact_metrics),
                'mission_slider' => MissionSlideResource::collection($mission_slider),
            ]
        ));
    }
}
