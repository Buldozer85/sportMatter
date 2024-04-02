<?php

declare(strict_types=1);

namespace App\Modules\Referees\Models;

use App\Modules\Sports\Models\Country;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int $sport_id
 *
 */
class Referee extends Model
{
    public function sport(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

}
