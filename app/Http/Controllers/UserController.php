<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Services\Datatables\UserTableService;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
  public function __construct(
    protected UserService $service
  ) {
  }

  public function index(): View
  {
    return view('user.index');
  }

  public function datatable(): JsonResponse
  {
    $service = app(UserTableService::class);
    return $service->table();
  }

  public function create(): View
  {
    return view('user.create');
  }

  public function store(UserRequest $request): RedirectResponse
  {
    $query = $this->service->store($request);
    if ($query) Alert::html('<i>Sukses</i>', '<b>' . $query->name . '</b> berhasil ditambahkan.', 'success');

    return redirect()->route('user.index');
  }

  public function edit($user): View
  {
    return view('user.edit', $this->service->edit($user));
  }

  public function update($user, UserRequest $request)
  {
    // return $request->validated();

    $query = $this->service->update($user, $request);
    if ($query) Alert::html('<i>Sukses</i>', '<b>' . $query->name . '</b> berhasil diubah.', 'success');

    return redirect()->route('user.index');
  }

  public function destroy($user): JsonResponse
  {
    try {
      $this->service->delete($user);
      return response()->json(['sukses' => 'Data berhasil dihapus.']);
    } catch (\Throwable $th) {
      return response()->json(['gagal' => (string)$th]);
    }
  }

  public function multdelete(Request $request)
  {
    try {
      $this->service->multipleDelete($request->post('ids'));
      return response()->json(['sukses' => count($request->post('ids')) . ' Data berhasil dihapus.']);
    } catch (\Throwable $th) {
      return response()->json(['gagal' => (string)$th]);
    }
  }
}
