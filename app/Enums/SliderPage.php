<?php

namespace App\Enums;

enum SliderPage: string
{
    case HOME = 'home';
    case EMPOWERING_LIVES = 'empowering_lives';
    case ABOUT_US = 'about_us';
    case SERVICES = 'services';
    case CONTACT = 'contact';

    public function label(): string
    {
        return match ($this) {
            self::HOME => 'Home',
            self::EMPOWERING_LIVES => 'Empowering Lives',
            self::ABOUT_US => 'About Us',
            self::SERVICES => 'Services',
            self::CONTACT => 'Contact',
        };
    }
}
