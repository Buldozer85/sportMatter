<?php

declare(strict_types=1);

namespace App\Modules\Leagues\Repositories;

use App\Modules\Leagues\Contracts\LeaguesQueryInterface;
use App\Modules\Leagues\Contracts\LeaguesRepositoryInterface;
use App\Modules\Leagues\Models\League;
use App\Modules\Leagues\Queries\LeaguesQuery;
use App\Services\Repository\Repository;
use Illuminate\Support\Collection;

final class LeaguesRepository extends Repository implements LeaguesRepositoryInterface
{

    /**
     * @inheritDoc
     */
    public function get(int $id): League
    {
       //TODO:: doimplementovat model query builder
    }

    /**
     * @inheritDoc
     */
    public function getAll(): Collection
    {
        //TODO:: doimplementovat model query builder
    }

    /**
     * @inheritDoc
     */
    public function delete(League $league): void
    {
        $league->delete();
    }

    /**
     * @inheritDoc
     */
    public function save(League $league): void
    {
        $this->transaction($league, static function () use ($league): void {
            $league->save();
        });    }

    /**
     * @inheritDoc
     */
    public function query(): LeaguesQueryInterface
    {
        return new LeaguesQuery(new League());
    }

    /**
     * @inheritDoc
     */
    public function create(array $data): League
    {
        $league = new League();
        $league->compactFill($data);
        $this->save($league);

        return $league;
    }

    /**
     * @inheritDoc
     */
    public function databaseTransaction(\Closure $callback): mixed
    {
        return $this->transaction(new League(), $callback);
    }
}
