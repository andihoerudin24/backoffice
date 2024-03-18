@extends('backend.layouts.app')
@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
	<!-- Container -->
    <div class="container mt-xl-50 mt-sm-30 mt-15">

        <!-- Row -->
        <div class="row">
            <div class="col-xl-12">
                <section class="hk-sec-wrapper">
                    <div class="row">

                      	<div class="col-sm-12 mb-4">
                            <div class="row justify-content-end">
                                <div class="col-12 col-sm-8">
                                    <h2 class="hk-pg-title font-weight-600">List Group</h2>
                                </div>
                                <div class="col-12 col-sm-4 text-right">
                                    <span class="feather-icon"><a href="{{ route('listgroup.create') }}"
                                        class="btn btn-info">Create Permission Group</a></span>
                                </div>
                            </div>
                            @if ($message = Session::get('success'))
                                <div class="alert alert-info">
                                    <ul>
                                        <li>{{ $message }}</li>
                                </div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-info">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>

                        <div class="col-sm">
                            <div class="table-wrap">
                                <div class="row mb-3">
                                    <div class="col-sm">
                                        <h6 class="mb-1"> Filter </h6>

                                        <div class="border pt-10 px-10">
                                            <form>
                                                <div class="row">
                                                    <div class="col-md-6 mb-10">
                                                        <label for="state">Group Name</label>
														<select id="idgroup" class="form-control form-control-sm">
                                                            <option value="all">All</option>
                                                            @foreach ($group as $key => $value)
                                                               <option value="{{$value->id}}">{{$value->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <table id="datatable" class="table table-hover w-100 display pb-30">
                                    <thead>
                                        <tr>
                                            <th class="font-weight-bold">Company Name</th>
                                            <th class="font-weight-bold">Email</th>
                                            <th class="font-weight-bold">Group Name</th>
                                            <th class="font-weight-bold">Address</th>
                                            <th class="font-weight-bold">Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
							        </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <!-- /Row -->
    </div>
    <!-- /Container -->
    {{-- modal --}}
@endsection

@push('js')
    <!-- Data Table JavaScript -->
    <script src="{{ asset('vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-dt/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('vendors/jszip/dist/jszip.min.js') }}"></script>
    <script src="{{ asset('vendors/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('vendors/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-waitingfor.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        var dtable;
        $(document).ready(function() {
           $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
           });
           dtable = $('#datatable').DataTable({
           processing: true,
           serverSide: true,
           responsive: false,
           scrollX: true,
           ordering: false,
           ajax: {
               url: "{{ route('listgroup.datatable') }}",
               data: function(d) {
                   d.idgroup = $('#idgroup').val()
               }
           },
           columns: [
               {
                   targets: 1,
                   data: 'nama',
                   name: 'nama',
                   searchable: true
               },
               {
                   targets: 2,
                   data: 'email',
                   name: 'email',
                   searchable: true
               },
               {
                   targets: 3,
                   data: 'namagroup',
                   name: 'namagroup',
                   searchable: true
               },
               {
                   targets: 4,
                   data: 'alamat',
                   name: 'alamat',
                   searchable: true
               },
               {
					targets: 5,
                    data: 'id',
                    name: 'id',
                    orderable: false,
                    searchable: false,
                    "render": function(data, type, row) {
                        var id =  row.id;
                        var url  = `{{ route('listgroup.edit') }}` ;
                        var urldelete  = `{{ route('listgroup.delete') }}` ;
                        action = `<a style="display: list-item; margin-top: 7px;" href="${urldelete}/${id}" type="button" class="btn btn-danger btn-sm">Delete</a>
                        <a style="display: list-item; margin-top: 7px;" href="${url}/${id}" type="button" class="btn btn-info btn-sm">Edit</a>
                        `;
                        return action;
                     }

                },
           ],
         });
         $('#idgroup').on("change", function () {
              dtable.ajax.reload();
         });
       })
   </script>

@endpush
