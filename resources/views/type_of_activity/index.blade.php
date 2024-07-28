@extends('layouts.app')

@section('content')
    <div class="container">
        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-1"></i>
                {{ Session::get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif(Session::has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-1"></i>
                {{ Session::get('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <h1 class="mb-4">Type Of Activities List</h1>
        <a href="{{ route('typeActivity.create') }}" class="btn btn-primary mb-3">Register Activity</a>
        @can('view filter')
            <form method="GET" action="{{ route('typeActivity') }}" class="mb-3">
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" name="name" class="form-control" placeholder="Activity Name"
                            value="{{ request('name') }}">
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-dark">Filter</button>
                    </div>
                </div>
            </form>
        @endcan
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($type_of_activity as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
