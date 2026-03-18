<?php

namespace App\Http\Controllers\API;

use App\Enums\SitePage;
use App\Http\Controllers\Controller;
use App\Http\Resources\ContentSectionResource;
use App\Http\Resources\FeatureCardResource;
use App\Http\Resources\ImpactResource;
use App\Http\Resources\ImpactStoryResource;
use App\Http\Resources\ImpactStorySectionResource;
use App\Http\Resources\MissionSlideResource;
use App\Http\Resources\SliderResource;
use App\Models\ContentSection;
use App\Models\FeatureCard;
use App\Models\Impact;
use App\Models\ImpactStory;
use App\Models\ImpactStorySection;
use App\Models\MissionSlide;
use App\Models\Slider;

class PoweringEducationController extends Controller
{
    public function index()
    {
        $slider = Slider::where('page', SitePage::POWERING_EDUCATION->value)->active()->ordered()->get();
        $sections = ContentSection::where('page', SitePage::POWERING_EDUCATION->value)->ordered()->get()->groupBy('section_key');
        $feature_cards = FeatureCard::where('page', SitePage::POWERING_EDUCATION->value)->active()->ordered()->get();
        $impact_story_sections = ImpactStorySection::where('page', SitePage::POWERING_EDUCATION->value)->ordered()->get();
        $impact_story = ImpactStory::where('page', SitePage::POWERING_EDUCATION->value)->ordered()->get();
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
        if (isset($groupedSections['lighting_lives'])) {
            $groupedSections['lighting_lives'] = [
                'section' => $groupedSections['lighting_lives'],
                'mission_slider' => MissionSlideResource::collection(
                    $missionGrouped['lighting_lives'] ?? collect()
                ),
            ];
        }
        $mission_slider = $mission_slider->reject(function ($slide) {
            return $slide->title === 'young_climate' || $slide->title === 'lighting_lives';
        });

        return response()->json(array_merge(
            ['slider' => SliderResource::collection($slider)],
            $groupedSections,
            [
                'feature_cards' => FeatureCardResource::collection($feature_cards),
                'impact_metrics' => ImpactResource::collection($impact_metrics),
                'impact_story_sections' => ImpactStorySectionResource::collection($impact_story_sections),
                'impact_story' => ImpactStoryResource::collection($impact_story),
                'mission_slider' => MissionSlideResource::collection($mission_slider),
            ]
        ));
    }
}
