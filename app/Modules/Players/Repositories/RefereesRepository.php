<?php

declare(strict_types=1);

namespace App\Modules\Referees\Repositories;


use App\Modules\Referees\Contracts\RefereesRepositoryInterface;
use App\Modules\Referees\Models\Referee;
use App\Services\Repository\Repository;

final class RefereesRepository extends Repository implements RefereesRepositoryInterface
{

    /**
     * @inheritDoc
     */
    public function get(int $id): Referee
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
    public function delete(Referee $referee): void
    {
        $referee->delete();
    }

    /**
     * @inheritDoc
     */
    public function save(Referee $referee): void
    {
        $this->transaction($referee, static function () use ($referee): void {
            $referee->save();
        });
    }

    /**
     * @inheritDoc
     */
    public function create(array $data): Referee
    {
        $player = new Referee();
        $player->compactFill($data);
        $this->save($player);

        return $player;
    }
}
