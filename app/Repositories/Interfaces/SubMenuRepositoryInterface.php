<?php

namespace App\Repositories\Interfaces;

use App\Models\SubMenu;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use stdClass;

interface SubMenuRepositoryInterface extends BaseRepositoryInterface
{
  public function table(int $id): Builder;
  public function show(int|string $id): SubMenu;
  public function store(stdClass $request): SubMenu;
  public function update(Model $model, stdClass $request): SubMenu;
}
