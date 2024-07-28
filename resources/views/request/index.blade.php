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
        <h1 class="mb-4">Request List</h1>
        @can('view filter')
            <form method="GET" action="{{ route('requests') }}" class="mb-3">
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" name="name" class="form-control" placeholder="User Name"
                            value="{{ request('name') }}">
                    </div>
                    <div class="col-md-4">
                        <select name="status" class="form-control">
                            <option value="">Select Status</option>
                            <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Created</option>
                            <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Accepted</option>
                            <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>Reject</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-dark">Filter</button>
                    </div>
                </div>
            </form>
        @endcan
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($requests as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->user->name }}</td>
                        <td>{{ \App\Enums\RequestStatus::from($item->status)->name }}</td>
                        <td>
                            @if ($item->status == 0)
                                <form action="{{ route('requests.approve', $item->id) }}" method="POST"
                                    style="display: inline;" id="approve-form-{{ $item->id }}">
                                    @csrf
                                    <button type="button" class="btn btn-success btn-sm"
                                        onclick="confirmAction('approve-form-{{ $item->id }}')" title="Approve">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </form>
                                <form action="{{ route('requests.decline', $item->id) }}" method="POST"
                                    style="display: inline;" id="decline-form-{{ $item->id }}">
                                    @csrf
                                    <button type="button" class="btn btn-danger btn-sm"
                                        onclick="confirmAction('decline-form-{{ $item->id }}')" title="Decline">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </form>
                            @elseif ($item->status == 1)
                                <form action="{{ route('requests.decline', $item->id) }}" method="POST"
                                    style="display: inline;" id="decline-form-{{ $item->id }}">
                                    @csrf
                                    <button type="button" class="btn btn-danger btn-sm"
                                        onclick="confirmAction('decline-form-{{ $item->id }}')" title="Decline">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </form>
                            @elseif ($item->status == 2)
                                <form action="{{ route('requests.approve', $item->id) }}" method="POST"
                                    style="display: inline;" id="approve-form-{{ $item->id }}">
                                    @csrf
                                    <button type="button" class="btn btn-success btn-sm"
                                        onclick="confirmAction('approve-form-{{ $item->id }}')" title="Approve">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection
