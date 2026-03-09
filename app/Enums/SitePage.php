<?php

namespace App\Enums;

enum SitePage: string
{
    case HOME = 'home';
    case EMPOWERING_LIVES = 'empowering_lives';
    case ACCELERATING_INNOVATION = 'accelerating_innovation';

    public function label(): string
    {
        return match ($this) {
            self::HOME => 'Home',
            self::EMPOWERING_LIVES => 'Empowering Lives',
            self::ACCELERATING_INNOVATION => 'Accelerating Innovation',
        };
    }
}
