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

class Ace2026Controller extends Controller
{
    public function index()
    {
        $slider = Slider::where('page', SitePage::ACE2026->value)->active()->ordered()->get();
        $sections = ContentSection::where('page', SitePage::ACE2026->value)->ordered()->get()->groupBy('section_key');
        $feature_cards = FeatureCard::where('page', SitePage::ACE2026->value)->active()->ordered()->get();
        $missionSlides = MissionSlide::where('page', SitePage::ACE2026->value)->active()->ordered()->get();
        $impact_metrics = Impact::where('page', SitePage::ACE2026->value)->active()->ordered()->get();

        // group mission slides by title
        $missionGrouped = $missionSlides->groupBy('title');

        $responseSections = [];
        foreach ($sections as $key => $sectionGroup) {

            if ($missionGrouped->has($key)) {
                $responseSections[$key] = [
                    'section' => ContentSectionResource::collection($sectionGroup),
                    'mission_slider' => MissionSlideResource::collection($missionGrouped[$key]),
                ];

                $missionGrouped->forget($key);
            } else {
                $responseSections[$key] = ContentSectionResource::collection($sectionGroup);
            }
        }

        $finalists = collect();
        if ($missionGrouped->has('finalists')) {
            $finalists = $missionGrouped->get('finalists');
            $missionGrouped->forget('finalists');
        }
        $remainingMissionSlides = $missionGrouped->flatten();

        return response()->json(array_merge(
            ['slider' => SliderResource::collection($slider)],
            ['finalists' => MissionSlideResource::collection($finalists)],
            $responseSections,
            [
                'feature_cards' => FeatureCardResource::collection($feature_cards),
                'renew_ace' => ImpactResource::collection($impact_metrics),
                'mission_slider' => MissionSlideResource::collection($remainingMissionSlides),
            ]
        ));
    }
}
