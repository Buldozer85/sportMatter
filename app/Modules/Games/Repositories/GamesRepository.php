<?php

declare(strict_types=1);

namespace App\Modules\Games\Repositories;

use App\Modules\Games\Contracts\GamesRepositoryInterface;
use App\Modules\Leagues\Contracts\RefereesRepositoryInterface;
use App\Modules\Matches\Models\Game;
use App\Services\Repository\Repository;
use Illuminate\Support\Collection;

final class GamesRepository extends Repository implements GamesRepositoryInterface
{

    /**
     * @inheritDoc
     */
    public function get(int $id): Game
    {
        return Game::query()->where(GAME::ATTR_ID, $id)->first();
    }

    /**
     * @inheritDoc
     */
    public function getAll(): Collection
    {
        return Game::all();
    }

    /**
     * @inheritDoc
     */
    public function delete(Game $game): void
    {
        $game->delete();
    }

    /**
     * @inheritDoc
     */
    public function save(Game $game): void
    {
        $this->transaction($game, static function () use ($game): void {
            $game->save();
        });
    }

    /**
     * @inheritDoc
     */
    public function create(array $data): Game
    {
        $game = new Game();
        $game->compactFill($data);
        $this->save($game);

        return $game;
    }
}
