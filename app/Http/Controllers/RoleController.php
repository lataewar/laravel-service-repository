<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Services\Datatables\RoleTableService;
use App\Services\RoleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;

class RoleController extends Controller
{
  public function __construct(
    protected RoleService $service
  ) {
  }

  public function index(): View
  {
    return view('role.index');
  }

  public function datatable(): JsonResponse
  {
    $service = app(RoleTableService::class);
    return $service->table();
  }

  public function create(): View
  {
    return view('role.create');
  }

  public function store(RoleRequest $request): RedirectResponse
  {
    $query = $this->service->store($request);
    if ($query) Alert::html('<i>Sukses</i>', '<b>' . $query->name . '</b> berhasil ditambahkan.', 'success');

    return redirect()->route('role.index');
  }

  public function createAkses($role): View
  {
    return view('role.akses', $this->service->createAkses($role));
  }

  public function syncAkses($role, Request $request): RedirectResponse
  {
    $query = $this->service->syncAkses($role, $request->menus ?? []);
    if ($query) Alert::html('<i>Sukses</i>', 'berhasil mengubah hak akses', 'success');

    return redirect()->route('role.index');
  }

  public function edit($role): View
  {
    return view('role.edit', $this->service->edit($role));
  }

  public function update($role, RoleRequest $request): RedirectResponse
  {
    $query = $this->service->update($role, $request);
    if ($query) Alert::html('<i>Sukses</i>', '<b>' . $query->name . '</b> berhasil diubah.', 'success');

    return redirect()->route('role.index');
  }

  public function destroy($role): JsonResponse
  {
    try {
      $this->service->delete($role);
      return response()->json(['sukses' => 'Data berhasil dihapus.']);
    } catch (\Throwable $th) {
      return response()->json(['gagal' => (string)$th]);
    }
  }
}
