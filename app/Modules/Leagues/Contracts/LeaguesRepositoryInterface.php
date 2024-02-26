<?php

declare(strict_types=1);

namespace App\Modules\Leagues\Contracts;

use App\Modules\Leagues\Models\League;
use Illuminate\Support\Collection;

interface LeaguesRepositoryInterface
{
    /**
     * @param int $id
     *
     * @return \App\Modules\Leagues\Models\League
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function get(int $id): League;

    /**
     * @return \Illuminate\Support\Collection<array-key, \App\Modules\Leagues\Models\League>
     */
    public function getAll(): Collection;

    /**
     * @param \App\Modules\Leagues\Models\League $league
     */
    public function delete(League $league): void;

    /**
     * @param \App\Modules\Leagues\Models\League $league
     */
    public function save(League $league): void;

    /**
     * @return \App\Modules\Leagues\Contracts\LeaguesQueryInterface
     */
    public function query(): LeaguesQueryInterface;

    /**
     * @param array<string,mixed> $data
     *
     * @return \App\Modules\Leagues\Models\League
     */
    public function create(array $data): League;

    /**
     * @template TReturn
     *
     * @param \Closure(): TReturn $callback
     *
     * @return TReturn
     */
    public function databaseTransaction(\Closure $callback): mixed;
}
