<?php

namespace App\Services\Repository;

use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Eloquent\Model;

abstract class Repository
{
    /**
     * @param \Illuminate\Database\DatabaseManager $databaseManager
     */
    public function __construct(
        protected readonly DatabaseManager $databaseManager,
    ) {
    }

    /**
     * @template TReturn
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param \Closure(): TReturn $callback
     * @param int $attempts
     *
     * @return TReturn
     *
     * @throws \Throwable
     */
    protected function transaction(Model $model, \Closure $callback, int $attempts = 1): mixed
    {
        return $this->databaseManager->connection($model->getConnectionName())->transaction($callback, $attempts);
    }
}
