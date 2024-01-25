<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;
use stdClass;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
  public function __construct(User $x_model)
  {
    parent::__construct($x_model);
  }

  public function table(): Builder
  {
    return $this->model->query();
  }

  public function store(stdClass $request): User
  {
    return $this->model->create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => Hash::make($request->password),
      'role_id' => $request->role_id,
    ]);
  }

  public function update(int $id, stdClass $request): User
  {
    $model = $this->find($id);
    return tap($model)->update([
      'name' => $request->name,
      'email' => $request->email,
      'password' => $request->password,
      'role_id' => $request->role_id,
    ]);
  }

  public function updateWithoutPwd(int $id, stdClass $request): User
  {
    $model = $this->find($id);
    return tap($model)->update([
      'name' => $request->name,
      'email' => $request->email,
      'role_id' => $request->role_id,
    ]);
  }
}
