<?php

namespace App\Services;

use App\Http\Requests\MenuRequest;
use App\Models\Menu;
use App\Repositories\Interfaces\MenuRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class MenuService
{
  public function __construct(
    protected MenuRepositoryInterface $repository
  ) {
  }

  public function store(MenuRequest $request): Menu
  {
    return $this->repository->store((object) $request->validated());
  }

  public function update(Model $model, MenuRequest $request): Menu
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

  public function getAll(): Collection
  {
    return $this->repository->all();
  }
}
