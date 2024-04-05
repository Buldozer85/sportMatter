<?php

namespace App\enums;

enum FootballActions: int
{
    case GOL = 1;
    case ASSIST = 2;

    case YELLOW_CARD = 3;

    case RED_CARD = 4;

    case SWITCH_IN = 5;

    case SWITCH_OUT = 6;

    public function label(): string
    {
        return match ($this) {
            self::GOL => 'Gól',
            self::ASSIST => 'Asistence',
            self::YELLOW_CARD => 'Žlutá karta',
            self::RED_CARD => 'Červená karta',
            self::SWITCH_IN => 'Střídání do hry',
            self::SWITCH_OUT => 'Odchod ze hry'
        };
    }

    public static function options(): array
    {
        return [
            self::GOL->value => self::GOL->label(),
            self::ASSIST->value => self::ASSIST->label(),
            self::YELLOW_CARD->value => self::YELLOW_CARD->label(),
            self::RED_CARD->value => self::RED_CARD->label(),
            self::SWITCH_IN->value => self::SWITCH_IN->label(),
            self::SWITCH_OUT->value => self::SWITCH_OUT->label(),
        ];
    }
}
