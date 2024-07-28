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
                    <div class="card-header">Register Company</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('companies.store') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="document_type" class="col-md-4 col-form-label text-md-end">Document Type</label>

                                <div class="col-md-6">
                                    <select class="form-select @error('document_type') is-invalid @enderror"
                                        name="document_type">
                                        <option value="" hidden>Seleccione</option>
                                        @foreach (App\Enums\DocumentType::cases() as $estatus)
                                            <option
                                                value="{{ $estatus->value }}"{{ old('document_type') == $estatus->value ? 'selected' : '' }}>
                                                {{ $estatus->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('document_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="document_number" class="col-md-4 col-form-label text-md-end">Document
                                    Number</label>

                                <div class="col-md-6">
                                    <input id="document_number" type="text"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                        class="form-control @error('document_number') is-invalid @enderror"
                                        name="document_number" value="{{ old('document_number') }}">

                                    @error('document_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            @can('add users')
                                <div class="row mb-3">
                                    <label for="" class="col-md-4 col-form-label text-md-end">Owner</label>

                                    <div class="col-md-6">
                                        <select class="form-select @error('owner') is-invalid @enderror" name="owner">
                                            <option value="" hidden>Seleccione</option>
                                            @foreach ($users as $user)
                                                <option
                                                    value="{{ $user->id }}"{{ old('owner') == $user->id ? 'selected' : '' }}>
                                                    {{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('owner')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                </div>
                            @endcan

                            <div class="row mb-3">
                                <label for="status" class="col-md-4 col-form-label text-md-end">Status</label>

                                <div class="col-md-6">
                                    <select class="form-select @error('status') is-invalid @enderror" name="status">
                                        <option value="" hidden>Seleccione</option>
                                        @foreach (App\Enums\CompanieStatus::cases() as $estatus)
                                            <option value="{{ $estatus->value }}"
                                                {{ old('status') == $estatus->value ? 'selected' : '' }}>
                                                {{ $estatus->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-success">
                                        {{ __('Register') }}
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
