<?php

namespace App\enums;

enum HockeyActions: int
{
    case GOL = 1;
    case ASSIST = 2;

    case SMALL_FOUL = 3;

    case FOUR_MINUTES_FOUL = 4;

    case FIVE_MINUTES_FOUL = 5;

    case PERSONAL_FOUL = 6;

    case GOALKEEPER_IN = 7;

    case GOALKEEPER_OUT = 8;

    public function label(): string
    {
        return match ($this) {
            self::GOL => 'Gól',
            self::ASSIST => 'Asistence',
            self::SMALL_FOUL => 'Menší trest',
            self::FOUR_MINUTES_FOUL => 'Vyloučení 4 min.',
            self::FIVE_MINUTES_FOUL => 'Vyloučení 5 min.',
            self::PERSONAL_FOUL => 'Vyloučení do konce utkání',
            self::GOALKEEPER_IN => 'Brankář střídá',
            self::GOALKEEPER_OUT => 'Brankář do hry'
        };
    }

    public static function options(): array
    {
        return [
            self::GOL->value => self::GOL->label(),
            self::ASSIST->value => self::ASSIST->label(),
            self::SMALL_FOUL->value => self::SMALL_FOUL->label(),
            self::FOUR_MINUTES_FOUL->value => self::FOUR_MINUTES_FOUL->label(),
            self::FIVE_MINUTES_FOUL->value => self::FIVE_MINUTES_FOUL->label(),
            self::PERSONAL_FOUL->value => self::PERSONAL_FOUL->label(),
            self::GOALKEEPER_IN->value => self::GOALKEEPER_IN->label(),
            self::GOALKEEPER_OUT->value => self::GOALKEEPER_OUT->label(),
        ];
    }
}
