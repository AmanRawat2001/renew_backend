<?php

namespace App\Enums;

enum SitePage: string
{
    case HOME = 'home';
    case EMPOWERING_LIVES = 'empowering_lives';

    public function label(): string
    {
        return match ($this) {
            self::HOME => 'Home',
            self::EMPOWERING_LIVES => 'Empowering Lives',
        };
    }
}
