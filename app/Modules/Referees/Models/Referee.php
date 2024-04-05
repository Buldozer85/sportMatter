<?php

declare(strict_types=1);

namespace App\Modules\Referees\Models;

use App\Modules\Sports\Models\Sport;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
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
        return $this->belongsTo(Sport::class);
    }

    public function fullName(): Attribute
    {
        return Attribute::make(get: fn() =>  $this->first_name . " " . $this->last_name);
    }

}
