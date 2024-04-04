<?php

declare(strict_types=1);

namespace App\Modules\Referees\Contracts;

use App\Modules\Referees\Models\Referee;
use Illuminate\Support\Collection;

interface RefereesRepositoryInterface
{
    /**
     * @param int $id
     *
     * @return \App\Modules\Referees\Models\Referee
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function get(int $id): Referee;

    /**
     * @return \Illuminate\Support\Collection<array-key, \App\Modules\Referees\Models\Referee>
     */
    public function getAll(): Collection;

    /**
     * @param \App\Modules\Referees\Models\Referee $referee
     */
    public function delete(Referee $referee): void;

    /**
     * @param \App\Modules\Referees\Models\Referee $referee
     */
    public function save(Referee $referee): void;

    /**
     * @param array<string,mixed> $data
     *
     * @return \App\Modules\Referees\Models\Referee
     */
    public function create(array $data): Referee;
}
