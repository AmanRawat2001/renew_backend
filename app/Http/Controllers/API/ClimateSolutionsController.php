<?php

namespace App\Http\Controllers\API;

use App\Enums\SitePage;
use App\Http\Controllers\Controller;
use App\Http\Resources\ContentSectionResource;
use App\Http\Resources\FeatureCardResource;
use App\Http\Resources\MissionSlideResource;
use App\Http\Resources\SliderResource;
use App\Models\ContentSection;
use App\Models\FeatureCard;
use App\Models\MissionSlide;
use App\Models\Slider;

class ClimateSolutionsController extends Controller
{
    public function index()
    {
        $slider = Slider::where('page', SitePage::CLIMATE_SOLUTIONS->value)->active()->ordered()->get();
        $sections = ContentSection::where('page', SitePage::CLIMATE_SOLUTIONS->value)->ordered()->get()->groupBy('section_key');
        $mission_slider = MissionSlide::where('page', SitePage::CLIMATE_SOLUTIONS->value)->active()->ordered()->get();
        $feature_cards = FeatureCard::where('page', SitePage::CLIMATE_SOLUTIONS->value)->active()->ordered()->get();

        $groupedSections = [];
        $missionGrouped = $mission_slider->groupBy('title');

        foreach ($sections as $key => $sectionGroup) {

            if ($key === 'the_purpose' && $missionGrouped->has('the_purpose')) {
                $groupedSections[$key] = [
                    'section' => ContentSectionResource::collection($sectionGroup),
                    'mission_slider' => MissionSlideResource::collection($missionGrouped['the_purpose']),
                ];
                $missionGrouped->forget('the_purpose');
            } else {
                $groupedSections[$key] = ContentSectionResource::collection($sectionGroup);
            }
        }

        return response()->json(array_merge(
            ['main_slider' => SliderResource::collection($slider)],
            $groupedSections,
            [
                'drive_impact_with_us' => FeatureCardResource::collection($feature_cards),
            ]
        ));
    }
}
