<?php

declare(strict_types=1);

namespace App\Modules\Stadiums\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property int capacity
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
final class Stadium extends Model
{
    protected $table = 'stadiums';

}
