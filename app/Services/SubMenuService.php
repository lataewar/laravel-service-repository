<?php

namespace App\Services;

use App\Http\Requests\SubMenuRequest;
use App\Models\SubMenu;
use App\Repositories\Interfaces\SubMenuRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class SubMenuService
{
  public function __construct(
    protected SubMenuRepositoryInterface $repository
  ) {
  }

  public function store(SubMenuRequest $request): SubMenu
  {
    return $this->repository->store((object) $request->validated());
  }

  public function update(Model $model, SubMenuRequest $request): SubMenu
  {
    return $this->repository->update(
      $model,
      (object) $request->validated()
    );
  }

  public function delete(Model $model): bool
  {
    return $this->repository->delete($model);
  }
}
