<?php

namespace App\Enums;

enum SitePage: string
{
    case HOME = 'home';
    case EMPOWERING_LIVES = 'empowering_lives';
    case ACCELERATING_INNOVATION = 'accelerating_innovation';
    case POWERING_EDUCATION = 'powering_education';
    case PUBLICATIONS = 'publications';
    case ABOUT_US = 'about_us';
    case GET_INVOLVED = 'get_involved';

    public function label(): string
    {
        return match ($this) {
            self::HOME => 'Home',
            self::EMPOWERING_LIVES => 'Empowering Lives',
            self::ACCELERATING_INNOVATION => 'Accelerating Innovation',
            self::POWERING_EDUCATION => 'Powering Education',
            self::PUBLICATIONS => 'Publications',
            self::ABOUT_US => 'About Us',
            self::GET_INVOLVED => 'Get Involved',
        };
    }
}
