@extends('backend.layouts.app')
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
                                    <h2 class="hk-pg-title font-weight-600">Group</h2>
                                </div>
                                <div class="col-12 col-sm-4 text-right">
                                    <span class="feather-icon"><a href="{{ route('group.create') }}"
                                            class="btn btn-info">Add Group</a></span>
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
                                <table id="datatable" class="table table-hover w-100 display pb-30">
                                    <thead>
                                        <tr>
                                            <th class="font-weight-bold">No</th>
                                            <th class="font-weight-bold">Name</th>
                                            <th>Action button</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($group as $item)
                                        <tr>
                                            <td>{{$no}}</td>
                                            <td>{{$item->name}}</td>
                                            <td style="text-align:center">
                                                <div class="row">
                                                        <a href="{{ route('group.edit', $item->id) }}" type="button" class="btn btn-sm mx-2 btn-success">
                                                            Edit
                                                        </a>
                                                        <a onclick="return confirm('Delete data?')" href="{{ route('group.delete',$item->id) }}" type="button" class="btn btn-sm mx-2 btn-danger">
                                                            Delete
                                                        </a>
                                                </div>
                                            </td>
                                        </tr>
                                         @php
                                             $no++
                                         @endphp
                                        @endforeach

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

    <script>
        var dtable;
        $(document).ready(function() {
            dtable = $('#datatable').DataTable({
                processing: true,
                responsive: false,
                ordering: false,
                scrollX: true,
            });
        })
    </script>
@endpush
