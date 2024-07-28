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
        <h1 class="mb-4">Users List</h1>
        @can('view filter')
            <form method="GET" action="{{ route('users') }}" class="mb-3">
                <div class="row">
                    <div class="col-md-3">
                        <input type="text" name="name" class="form-control" placeholder="User Name"
                            value="{{ request('name') }}">
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="email" class="form-control" placeholder="Email"
                            value="{{ request('email') }}">
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="role" class="form-control" placeholder="Role"
                            value="{{ request('role') }}">
                    </div>
                    <div class="col-md-3">
                        <label>
                            <input type="checkbox" name="companyOwner" value="1"
                                {{ request('companyOwner') ? 'checked' : '' }}> Company Owner
                        </label>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-dark mt-3">Filter</button>
                    </div>
                </div>
            </form>
        @endcan

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Change of Role</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>
                            @foreach ($item->roles as $role)
                                {{ $role->name }}{{ !$loop->last ? ', ' : '' }}
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('users.update', $item->id) }}" class="btn btn-warning btn-sm"
                                title="Assign Role">
                                <i class="fas fa-user-plus"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>


    </div>
@endsection
