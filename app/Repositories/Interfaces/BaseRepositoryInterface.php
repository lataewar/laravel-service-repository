<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{
  public function find(int $id): ?Model;
  public function delete(int $id): bool;
  public function multipleDelete(array $ids): bool;
}
