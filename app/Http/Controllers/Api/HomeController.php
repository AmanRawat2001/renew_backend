<?php

namespace App\Http\Controllers\API;

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
    public function index()
    {
        $slider = Slider::active()->ordered()->get();
        $sections = ContentSection::ordered()->get()->groupBy('section_key');
        $feature_cards = FeatureCard::active()->ordered()->get();
        $impact_metrics = Impact::active()->ordered()->get();
        $mission_slider = MissionSlide::active()->ordered()->get();
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
}
