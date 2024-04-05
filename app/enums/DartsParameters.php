<?php

namespace App\enums;

enum DartsParameters: string
{
    case COUNT_OF_SETS_FIRST_PLAYER = 'count_of_sets_first_player';

    case COUNT_OF_LEGS_FIRST_PLAYER = 'count_of_legs_first_player';

    case AVERAGE_FIRST_PLAYER = 'average_first_player';

    case COUNT_OF_SETS_SECOND_PLAYER = 'count_of_sets_second_player';

    case COUNT_OF_LEGS_SECOND_PLAYER = 'count_of_legs_second_player';

    case AVERAGE_SECOND_PLAYER = 'average_second_player';
}
