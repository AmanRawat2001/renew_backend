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

class GetInvolvedController extends Controller
{
    public function index()
    {
        $slider = Slider::where('page', SitePage::GET_INVOLVED->value)->active()->ordered()->get();
        $sections = ContentSection::where('page', SitePage::GET_INVOLVED->value)->ordered()->get()->groupBy('section_key');
        $feature_cards = FeatureCard::where('page', SitePage::GET_INVOLVED->value)->active()->ordered()->get();
        $impact_metrics = Impact::where('page', SitePage::GET_INVOLVED->value)->active()->ordered()->get();
        $mission_slider = MissionSlide::where('page', SitePage::GET_INVOLVED->value)->active()->ordered()->get();

        $groupedSections = [];
        foreach ($sections as $key => $sectionGroup) {
            $groupedSections[$key] = ContentSectionResource::collection($sectionGroup);
        }
        $impactGrouped = $impact_metrics->groupBy('metric_number');
        if (isset($groupedSections['partner_with_us'])) {
            $groupedSections['partner_with_us'] = [
                'section' => $groupedSections['partner_with_us'],
                'sub_section' => ImpactResource::collection(
                    $impactGrouped['partner_with_us'] ?? collect()
                ),
            ];
        }
        $impact_metrics = $impact_metrics->reject(function ($metric) {
            return $metric->metric_number === 'partner_with_us';
        });

        return response()->json(array_merge(
            ['main_slider' => SliderResource::collection($slider)],
            $groupedSections,
            [
                'climate_change' => FeatureCardResource::collection($feature_cards),
                'contribute_to_our_fundraisers' => MissionSlideResource::collection($mission_slider),
            ]
        ));
    }
}
