@extends('layouts.template')

@push('css')
  <link href="{{ asset('assets') }}/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
@endpush

@section('subheader')
  <x-subheader title="Role">
    @slot('breadcrumb')
      <x-bc.item route="#">Data</x-bc.item>
    @endslot

    <div class="default-btns">
      <x-btn.weight-bold-svg svg="General/Trash.svg" style="display: none;"
        class="btn-sm btn-light-danger mr-2 btn-multdelete">
        Hapus Terpilih</x-btn.weight-bold-svg>

      <x-btn.a-weight-bold-svg svg="Design/Flatten.svg" href="{{ route('role.create') }}"
        class="btn-sm btn-light-success btn-create">
        Tambah Data</x-btn.a-weight-bold-svg>
    </div>
    <x-btn.weight-bold-svg svg="Navigation/Angle-left.svg" style="display: none;" class="btn-sm btn-light-primary ml-2">
      Kembali</x-btn.weight-bold-svg>
  </x-subheader>
@endsection

@section('content')
  @include('sweetalert::alert')
  <!--begin::Card-->
  <input type="hidden" id="urx" value="{{ URL('role') }}">
  <div class="card card-custom gutter-b">
    <div class="card-body">
      <!--begin: Datatable-->
      <table class="table table-hover" id="Datatable">
        <thead>
          <tr>
            <th>No</th>
            <th>Name</th>
            <th>Jumlah Akses</th>
            <th>Keterangan</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>

        </tbody>
      </table>
      <!--end: Datatable-->
    </div>
  </div>
  <!--end::Card-->
@endsection

@push('js')
  <!--begin::Page Vendors(used by this page)-->
  <script src="{{ asset('assets') }}/plugins/custom/datatables/datatables.bundle.js"></script>
  <script src="{{ asset('assets') }}/js/pages/features/miscellaneous/sweetalert2.js"></script>
  <!--end::Page Vendors-->
  <!--begin::Page Scripts(used by this page)-->
  <script src="{{ asset('js') }}/datatable/role.js"></script>
  <script src="{{ asset('js') }}/app.js"></script>
  <script src="{{ asset('js') }}/datatable/dt.js"></script>
  <!--end::Page Scripts-->
@endpush
