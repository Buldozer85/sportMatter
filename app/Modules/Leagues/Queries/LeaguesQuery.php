<?php

declare(strict_types=1);

namespace App\Modules\Leagues\Queries;

use App\Modules\Leagues\Contracts\LeaguesQueryInterface;
use Illuminate\Database\Query\Builder;

final class LeaguesQuery extends Builder implements LeaguesQueryInterface
{

}
