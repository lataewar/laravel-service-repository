<?php

namespace App\Services;

use App\Http\Requests\RoleRequest;
use App\Models\Role;
use App\Repositories\Interfaces\MenuRepositoryInterface;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use Illuminate\Support\Facades\App;

class RoleService
{
  public function __construct(
    protected RoleRepositoryInterface $repository,
  ) {
  }

  public function store(RoleRequest $request): Role
  {
    return $this->repository->store((object) $request->validated());
  }

  public function edit($id): array
  {
    return [
      'data' => $this->repository->find($id),
    ];
  }

  public function update(int $id, RoleRequest $request): Role
  {
    return $this->repository->update(
      $id,
      (object) $request->validated()
    );
  }

  public function createAkses(int $id)
  {
    $menuRepo = App::make(MenuRepositoryInterface::class);
    return ['app' => (object) [
      'data' => $this->repository->findByIdWithMenus($id),
      'menus' => $menuRepo->all(),
    ]];
  }

  public function syncAkses(int $id, array $menus)
  {
    $repo = app(RoleRepositoryInterface::class);
    return $repo->syncMenus($id, $menus);
  }

  public function delete(int $id): bool
  {
    return $this->repository->delete($id);
  }
}
