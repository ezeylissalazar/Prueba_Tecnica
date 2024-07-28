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
        <h1 class="mb-4">Companies List</h1>
        <a href="{{ route('companies.create') }}" class="btn btn-primary mb-3">Register Company</a>
        @can('view filter')
            <form method="GET" action="{{ route('companies') }}" class="mb-3">
                <div class="row">
                    <div class="col-md-3">
                        <input type="text" name="name" class="form-control" placeholder="Company Name"
                            value="{{ request('name') }}">
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="owner" class="form-control" placeholder="Owner Name"
                            value="{{ request('owner') }}">
                    </div>
                    <div class="col-md-3">
                        <select name="status" class="form-control">
                            <option value="" hidden>Seleccione</option>
                            <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Inactive</option>
                            <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Active</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>
                            <input type="checkbox" name="withoutActivities" value="1"
                                {{ request('withoutActivities') ? 'checked' : '' }}> Without Activities
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
                    <th>Name</th>
                    <th>Owner</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($companies as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->user ? $item->user->name : 'N/A' }}</td>
                        <td> {{ \App\Enums\CompanieStatus::from($item->status)->name }}
                        </td>
                        <td>
                            @if ($item->status == 0)
                                <form action="{{ route('companies.activate', $item->id) }}" method="POST"
                                    style="display: inline;" id="approve-form-{{ $item->id }}">
                                    @csrf
                                    @method('PUT')
                                    <button type="button" class="btn btn-success btn-sm"
                                        onclick="confirmAction('approve-form-{{ $item->id }}')" title="Active">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('companies.desactivate', $item->id) }}" method="POST"
                                    style="display: inline;" id="decline-form-{{ $item->id }}">
                                    @csrf
                                    @method('PUT')
                                    <button type="button" class="btn btn-danger btn-sm"
                                        onclick="confirmAction('decline-form-{{ $item->id }}')" title="Inactive">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </form>
                            @endif
                            <a href="{{ route('typeActivity.associate', $item->id) }}" class="btn btn-warning btn-sm"
                                title="Associate Activities">
                                <i class="fas fa-plus"></i>
                            </a>

                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
