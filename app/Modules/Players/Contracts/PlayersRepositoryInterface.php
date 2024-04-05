<?php

declare(strict_types=1);

namespace App\Modules\Players\Contracts;

use App\Modules\Players\Models\Player;
use Illuminate\Support\Collection;

interface PlayersRepositoryInterface
{
    /**
     * @param int $id
     *
     * @return \App\Modules\Players\Models\Player
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function get(int $id): Player;

    /**
     * @return \Illuminate\Support\Collection<array-key, \App\Modules\Players\Models\Player>
     */
    public function getAll(): Collection;

    /**
     * @param \App\Modules\Players\Models\Player $player
     */
    public function delete(Player $player): void;

    /**
     * @param \App\Modules\Players\Models\Player $player
     */
    public function save(Player $player): void;

    /**
     * @param array<string,mixed> $data
     *
     * @return \App\Modules\Players\Models\Player
     */
    public function create(array $data): Player;
}
