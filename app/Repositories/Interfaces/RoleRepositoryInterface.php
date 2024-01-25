<?php

namespace App\Repositories\Interfaces;

use App\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use stdClass;

interface RoleRepositoryInterface extends BaseRepositoryInterface
{
  public function table(): Builder;
  public function store(stdClass $request): Role;
  public function findByIdWithMenus(int $id): ?Role;
  public function update(int $id, stdClass $request): Role;
  public function syncMenus(int $id, array $menus);
}
