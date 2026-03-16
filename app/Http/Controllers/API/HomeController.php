<?php

namespace App\Http\Controllers\API;

use App\Enums\SitePage;
use App\Http\Controllers\Controller;
use App\Http\Resources\ContentSectionResource;
use App\Http\Resources\FeatureCardResource;
use App\Http\Resources\ImpactResource;
use App\Http\Resources\ImpactStorySectionResource;
use App\Http\Resources\MissionSlideResource;
use App\Http\Resources\SliderResource;
use App\Models\ContentSection;
use App\Models\FeatureCard;
use App\Models\Impact;
use App\Models\ImpactStorySection;
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
        $impact_story_sections = ImpactStorySection::with('stories')->where('page', SitePage::EMPOWERING_LIVES->value)->ordered()->get();
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
                'impact_story_sections' => ImpactStorySectionResource::collection($impact_story_sections),
                'mission_slider' => MissionSlideResource::collection($mission_slider),
            ]
        ));
    }

    public function accelerating_innovation()
    {
        $slider = Slider::where('page', SitePage::ACCELERATING_INNOVATION->value)->active()->ordered()->get();
        $sections = ContentSection::where('page', SitePage::ACCELERATING_INNOVATION->value)->ordered()->get()->groupBy('section_key');
        $feature_cards = FeatureCard::where('page', SitePage::ACCELERATING_INNOVATION->value)->active()->ordered()->get();
        $impact_story_sections = ImpactStorySection::with('stories')->where('page', SitePage::ACCELERATING_INNOVATION->value)->ordered()->get();
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
                'impact_story_sections' => ImpactStorySectionResource::collection($impact_story_sections),
                'mission_slider' => MissionSlideResource::collection($mission_slider),
            ]
        ));

    }

    public function powering_education()
    {
        $slider = Slider::where('page', SitePage::POWERING_EDUCATION->value)->active()->ordered()->get();
        $sections = ContentSection::where('page', SitePage::POWERING_EDUCATION->value)->ordered()->get()->groupBy('section_key');
        $feature_cards = FeatureCard::where('page', SitePage::POWERING_EDUCATION->value)->active()->ordered()->get();
        $impact_story_sections = ImpactStorySection::with('stories')->where('page', SitePage::POWERING_EDUCATION->value)->ordered()->get();
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
                'mission_slider' => MissionSlideResource::collection($mission_slider),
            ]
        ));
    }

    public function publications()
    {
        $slider = Slider::where('page', SitePage::PUBLICATIONS->value)->active()->ordered()->get();
        $sections = ContentSection::where('page', SitePage::PUBLICATIONS->value)->ordered()->get()->groupBy('section_key');
        $feature_cards = FeatureCard::where('page', SitePage::PUBLICATIONS->value)->active()->ordered()->get();
        $mission_slider = MissionSlide::where('page', SitePage::PUBLICATIONS->value)->active()->ordered()->get();
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

    public function about_us()
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
            ]
        ));
    }

    public function get_involved()
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

    public function ace2026()
    {
        $slider = Slider::where('page', SitePage::ACE2026->value)->active()->ordered()->get();

        $sections = ContentSection::where('page', SitePage::ACE2026->value)
            ->ordered()
            ->get()
            ->groupBy('section_key');

        $feature_cards = FeatureCard::where('page', SitePage::ACE2026->value)->active()->ordered()->get();

        $missionSlides = MissionSlide::where('page', SitePage::ACE2026->value)
            ->active()
            ->ordered()
            ->get();

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

        // ⭐ handle finalists separately
        $finalists = collect();

        if ($missionGrouped->has('finalists')) {
            $finalists = $missionGrouped->get('finalists');
            $missionGrouped->forget('finalists');
        }

        // remaining slides (like solution showcase)
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
