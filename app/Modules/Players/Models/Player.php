<?php

declare(strict_types=1);

namespace App\Modules\Players\Models;

use App\Modules\Countries\Models\Country;
use App\Modules\Teams\Models\Team;
use Carbon\Carbon;
use Database\Factories\PlayerFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
* @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property Carbon $birthdate
 * @property int $country_id
 * @property int $team_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Player extends Model
{
    use HasFactory;

    public function fullName(): Attribute
    {
        return Attribute::make(get: fn() => $this->first_name . ' ' . $this->last_name);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    protected $casts = [
      'birthdate' => 'date'
    ];

    protected static function newFactory(): PlayerFactory
    {
        return PlayerFactory::new();
    }

}
