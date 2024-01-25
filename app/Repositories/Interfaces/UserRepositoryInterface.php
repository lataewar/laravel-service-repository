<?php

namespace App\Repositories\Interfaces;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use stdClass;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
  public function table(): Builder;
  public function store(stdClass $request): User;
  public function update(int $id, stdClass $request): User;
  public function updateWithoutPwd(int $id, stdClass $request): User;
}
