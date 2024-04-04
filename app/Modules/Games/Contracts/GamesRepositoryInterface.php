<?php

declare(strict_types=1);

namespace App\Modules\Games\Contracts;

use App\Modules\Games\Models\Game;
use Illuminate\Support\Collection;

interface GamesRepositoryInterface
{
    /**
     * @param int $id
     *
     * @return \App\Modules\Games\Models\Game
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function get(int $id): Game;

    /**
     * @return \Illuminate\Support\Collection<array-key, \App\Modules\Games\Models\Game>
     */
    public function getAll(): Collection;

    /**
     * @param \App\Modules\Games\Models\Game $game
     */
    public function delete(Game $game): void;

    /**
     * @param \App\Modules\Games\Models\Game $game
     */
    public function save(Game $game): void;


    /**
     * @param array<string,mixed> $data
     *
     * @return \App\Modules\Games\Models\Game
     */
    public function create(array $data): Game;
}
