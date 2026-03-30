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

class AboutUsController extends Controller
{
    public function index()
    {
        $slider = Slider::where('page', SitePage::ABOUT_US->value)->active()->ordered()->get();
        $sections = ContentSection::where('page', SitePage::ABOUT_US->value)->ordered()->get()->groupBy('section_key');
        $feature_cards = FeatureCard::where('page', SitePage::ABOUT_US->value)->active()->ordered()->get();
        $mission_slider = MissionSlide::where('page', SitePage::ABOUT_US->value)->active()->ordered()->get();
        $groupedSections = [];
        foreach ($sections as $key => $sectionGroup) {
            $groupedSections[$key] = ContentSectionResource::collection($sectionGroup);
        }

        return response()->json(array_merge(
            ['slider' => SliderResource::collection($slider)],
            $groupedSections,
            [
                'feature_cards' => FeatureCardResource::collection($feature_cards),
                'mission_slider' => MissionSlideResource::collection($mission_slider),
            ]
        ));
    }
}
