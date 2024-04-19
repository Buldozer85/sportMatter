<?php

declare(strict_types=1);

namespace App\Modules\Stadiums\Models;

use Carbon\Carbon;
use Database\Factories\StadiumFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
    use HasFactory;

    protected $table = 'stadiums';

    protected static function newFactory(): StadiumFactory
    {
        return StadiumFactory::new();
    }

}
