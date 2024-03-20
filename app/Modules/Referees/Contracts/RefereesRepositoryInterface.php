<?php

declare(strict_types=1);

namespace App\Modules\Leagues\Contracts;

use App\Modules\Players\Models\Referee;
use Illuminate\Support\Collection;

interface RefereesRepositoryInterface
{
    /**
     * @param int $id
     *
     * @return \App\Modules\Players\Models\Referee
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function get(int $id): Referee;

    /**
     * @return \Illuminate\Support\Collection<array-key, \App\Modules\Players\Models\Referee>
     */
    public function getAll(): Collection;

    /**
     * @param \App\Modules\Players\Models\Referee $referee
     */
    public function delete(Referee $referee): void;

    /**
     * @param \App\Modules\Players\Models\Referee $referee
     */
    public function save(Referee $referee): void;

    /**
     * @param array<string,mixed> $data
     *
     * @return \App\Modules\Players\Models\Referee
     */
    public function create(array $data): Referee;
}
