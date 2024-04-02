<?php

declare(strict_types=1);

namespace App\Modules\Countries\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $short_name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
final class Country extends Model
{

}
