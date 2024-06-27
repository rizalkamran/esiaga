@extends('templates.main')

@section('content')

    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('web-landing') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Data User</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create</li>
        </ol>
    </nav>

    <div class="card shadow">
        <div class="card-header">
            Buat user baru
        </div>
        <div class="card-body">

            <form method="POST" action="{{ route('admin.users.store') }}">
                @include('admin.users.partial.form', ['create' => true])
            </form>

        </div>
    </div>
@endsection
