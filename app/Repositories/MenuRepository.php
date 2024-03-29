<?php

namespace App\Repositories;

use App\Models\Menu;
use App\Repositories\Interfaces\MenuRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use stdClass;

class MenuRepository extends BaseRepository implements MenuRepositoryInterface
{
  public function __construct(Menu $x_model)
  {
    parent::__construct($x_model);
  }

  public function table(): Builder
  {
    return $this->model->query();
  }

  public function show(int|string $id): Menu
  {
    return $this->model->findOrFail($id);
  }

  public function store(stdClass $request): Menu
  {
    return $this->model->create([
      'name' => $request->name,
      'route' => $request->route,
      'icon' => $request->icon,
      'desc' => $request->desc,
      'has_submenu' => $request->has_submenu,
    ]);
  }

  public function update(Model $model, stdClass $request): Menu
  {
    return tap($model)->update([
      'name' => $request->name,
      'route' => $request->route,
      'icon' => $request->icon,
      'desc' => $request->desc,
      'has_submenu' => $request->has_submenu,
    ]);
  }

  public function all(): Collection
  {
    return $this->model->select(['id', 'name'])->get();
  }
}
