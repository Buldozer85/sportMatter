<?php

namespace App\enums;

enum MatchResults: int
{
    case WIN = 1;
    case WIN_IN_EXTENSION = 2;

    case WIN_ON_PENALTIES = 3;

    case TIDE = 4;

    case LOSE = 5;

    case LOSE_IN_EXTENSION = 6;

    case LOSE_ON_PENALTIES = 7;

    public static function hockeyOptions(): array
    {
        return [
            self::WIN->value => 'Výhra',
            self::WIN_IN_EXTENSION->value => 'Výhra v prodloužení',
            self::WIN_ON_PENALTIES->value => 'Výhra na nájezdy',
            self::LOSE->value => 'Prohra',
            self::LOSE_IN_EXTENSION->value => 'Prohra po prodloužení',
            self::LOSE_ON_PENALTIES->value => 'Prohra na nájezdy'
        ];
    }

    public static function hockeyLabels(): array
    {
        return [
            self::WIN->value,
            self::WIN_IN_EXTENSION->value,
            self::WIN_ON_PENALTIES->value,
            self::LOSE->value,
            self::LOSE_IN_EXTENSION->value,
            self::LOSE_ON_PENALTIES->value
        ];
    }

    public static function FootballOptions(): array
    {
        return [
            self::WIN->value => 'Výhra',
            self::WIN_ON_PENALTIES->value => 'Výhra na penalty',
            self::LOSE->value => 'Prohra',
            self::LOSE_ON_PENALTIES->value => 'Prohra na penalty',
            self::TIDE->value => 'Remíza'
        ];
    }
    public static function FootballLabels(): array
    {
        return [
            self::WIN->value,
            self::WIN_ON_PENALTIES->value,
            self::LOSE->value,
            self::LOSE_ON_PENALTIES->value,
            self::TIDE->value
        ];
    }

    public static function DartsOptions(): array
    {
        return [
            self::WIN->value => 'Výhra',
            self::LOSE->value => 'Prohra',
        ];
    }

    public static function DartsLabels(): array
    {
        return ['Výhra', 'Prohra'];
    }

    public function points(): int
    {
        return match ($this) {
            self::WIN => 3,
            self::WIN_ON_PENALTIES, self::WIN_IN_EXTENSION => 2,
            self::TIDE,
            self::LOSE_IN_EXTENSION,
            self::LOSE_ON_PENALTIES => 1,
            self::LOSE => 0
        };
    }

}
