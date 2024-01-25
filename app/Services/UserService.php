<?php

namespace App\Services;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserService
{
  public function __construct(
    protected UserRepositoryInterface $repository,
  ) {
  }

  public function store(UserRequest $request): User
  {
    return $this->repository->store((object) $request->validated());
  }

  public function edit($id): array
  {
    return [
      'data' => $this->repository->find($id),
    ];
  }

  public function update(int $id, UserRequest $request): User
  {
    $data = (object) $request->validated();
    if (isset($data->password)) {
      return $this->repository->update($id, $data);
    }
    return $this->repository->updateWithoutPwd($id, $data);
  }

  public function delete(int $id): bool
  {
    return $this->repository->delete($id);
  }

  public function multipleDelete(array $ids): bool
  {
    return $this->repository->multipleDelete($ids);
  }
}
