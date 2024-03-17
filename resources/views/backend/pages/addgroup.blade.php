@extends('backend.layouts.app')

@section('content')
    <!-- Container -->
    <div class="container">

        <!-- Title -->
        <div class="hk-pg-header">
            <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i
                            data-feather="align-left"></i></span></span>Add Group</h4>
        </div>
        <!-- /Title -->

        <!-- Row -->
        <div class="row">
            <div class="col-xl-12">
                <section class="hk-sec-wrapper">
                    <h5 class="hk-sec-title">Group</h5>
                    <div class="row">
                        <div class="col-sm">
                            <form action="{{ Route::is('group.create') ? route('group.store') : route('group.update',$group->id )}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="firstName">Group Name</label>
                                        <input class="form-control" required="" placeholder="Group name" name="name" type="text" value="{{ $group->name ?? null }}">
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit">Add</button>
                                <a href="{{ route('group.index') }}" class="btn btn-warning" type="submit">Cancel</a>
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
