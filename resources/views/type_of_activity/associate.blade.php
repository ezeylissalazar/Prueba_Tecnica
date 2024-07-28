@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
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
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Associate Activities with Company</div>

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <span>
                                    @foreach ($errors->all() as $error)
                                        {{ $error }}
                                    @endforeach
                                </span>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('typeActivity.associate.store', $companies->id) }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">Company Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" disabled class="form-control" name="name"
                                        value="{{ isset($companies) ? $companies->name : '' }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="document_type" class="col-md-4 col-form-label text-md-end">Type of
                                    Activities</label>

                                <div class="col-md-6">
                                    @foreach ($activities as $activity)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="activities[]"
                                                value="{{ $activity->id }}" id="activity-{{ $activity->id }}"
                                                {{ in_array($activity->id, $associatedActivities) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="activity-{{ $activity->id }}">
                                                {{ $activity->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-success">Save
                                    </button>
                                    <a href="{{ route('companies') }}" class="btn btn-primary">Back
                                    </a>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
