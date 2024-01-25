<?php

namespace App\Services\Datatables;

use App\Repositories\Interfaces\RoleRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\DataTables;

class RoleTableService extends DatatableService
{
  public function __construct(
    protected RoleRepositoryInterface $repository
  ) {
  }

  public function table(): JsonResponse
  {
    $repo = app(RoleRepositoryInterface::class);
    return DataTables::of($repo->table())
      ->addColumn('aksi', function ($data) {
        return
          self::btn(route('role.akses', ['role' => $data->id]), "Akses", "General/Unlock.svg")
          . self::editBtnA(route('role.edit', ['role' => $data->id]))
          . self::deleteBtn($data->id, $data->name);
      })
      ->rawColumns(['aksi'])
      ->make();
  }
}
