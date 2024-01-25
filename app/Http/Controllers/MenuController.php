<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuRequest;
use App\Models\Menu;
use App\Services\Datatables\MenuTableService;
use App\Services\MenuService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;

class MenuController extends Controller
{
  public function __construct(
    protected MenuService $service
  ) {
  }

  public function index(): View
  {
    return view('menu.index');
  }

  public function datatable(MenuTableService $datatable): JsonResponse
  {
    return $datatable->table();
  }

  public function create(): View
  {
    return view('menu.create');
  }

  public function store(MenuRequest $request): RedirectResponse
  {
    $query = $this->service->store($request);
    if ($query) Alert::html('<i>Sukses</i>', '<b>' . $query->name . '</b> berhasil ditambahkan.', 'success');

    return redirect()->route('menu.index');
  }

  public function edit(Menu $menu)
  {
    return view('menu.edit', [
      'data' => $menu
    ]);
  }

  public function update(Menu $menu, MenuRequest $request): RedirectResponse
  {
    $query = $this->service->update($menu, $request);
    if ($query) Alert::html('<i>Sukses</i>', '<b>' . $query->name . '</b> berhasil diubah.', 'success');

    return redirect()->route('menu.index');
  }

  public function destroy(Menu $menu): JsonResponse
  {
    try {
      $this->service->delete($menu);
      return response()->json(['sukses' => 'Data berhasil dihapus.']);
    } catch (\Throwable $th) {
      return response()->json(['gagal' => (string)$th]);
    }
  }
}
