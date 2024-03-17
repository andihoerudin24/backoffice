@extends('backend.layouts.app')

@section('content')
    <!-- Container -->
    <div class="container">

        <!-- Title -->
        <div class="hk-pg-header">

        </div>
        <!-- /Title -->

        <!-- Row -->
        <div class="row">
            <div class="col-xl-12">
                <section class="hk-sec-wrapper">
                    <h5 class="hk-sec-title">Group</h5>
                    <div class="row">
                        <div class="col-sm">
                            <form action="{{ Route::is('listgroup.create') ? route('store.group')  : route('listgroup.update',$listgroup->id) }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label for="firstName">Group Name </label>
                                            <select class="js-example-basic-single" name="id_group">

                                                    @foreach ($group as $key => $value)
                                                        <option
                                                         @if ($groupselected)
                                                         {{ $groupselected->id == $value->id ? 'selected' : '' }}
                                                         @endif
                                                         value="{{$value->id}}">{{$value->name}}</option>
                                                    @endforeach
                                            </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label for="firstName">Company Name</label>
                                            <select class="js-example-basic-multiple" name="id_perusahaan[]" multiple="multiple">
                                                @if ($companies)
                                                     <option selected value="{{$companies->id}}">{{$companies->nama}}</option>
                                                @endif
                                            </select>
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit">Add</button>
                                <a href="{{ route('listgroup.index') }}" class="btn btn-warning" type="submit">Cancel</a>
                            </form>
                        </div>
                    </div>
                </section>

            </div>
        </div>
        <!-- /Row -->
    </div>
    <!-- /Container -->

    <!-- /Container -->
@endsection


@push('js')
     <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
            $('.js-example-basic-multiple').select2({
                placeholder: 'Cari Nama Perusahaan Or Id perusahaan...',
                ajax: {
                    delay: 250,
                    dataType: 'json',
                    url: "{{ route('search.group') }}",
                    processResults: function(data) {
                        console.log({data});
                        return {
                            results: $.map(data, function(item) {
                                console.log(item)
                                return {
                                    id: `${item.id}`,
                                    text: item.nama + ' - ' + item.id
                                };
                            })
                        };
                    },
                }
            });
        });
     </script>
@endpush
