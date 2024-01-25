<?php

namespace App\Repositories\Interfaces;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use stdClass;

interface MenuRepositoryInterface extends BaseRepositoryInterface
{
  public function table(): Builder;
  public function show(int|string $id): Menu;
  public function store(stdClass $request): Menu;
  public function update(Model $model, stdClass $request): Menu;
  public function all(): Collection;
}
