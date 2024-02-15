@extends('templates.main')

@section('content')
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
