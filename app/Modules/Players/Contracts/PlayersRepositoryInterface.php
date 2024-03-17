<?php

declare(strict_types=1);

namespace App\Modules\Leagues\Contracts;

use App\Modules\Players\Models\Referee;
use Illuminate\Support\Collection;

interface PlayersRepositoryInterface
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
     * @param \App\Modules\Players\Models\Referee $player
     */
    public function delete(Referee $player): void;

    /**
     * @param \App\Modules\Players\Models\Referee $player
     */
    public function save(Referee $player): void;

    /**
     * @param array<string,mixed> $data
     *
     * @return \App\Modules\Players\Models\Referee
     */
    public function create(array $data): Referee;
}
