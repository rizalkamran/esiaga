@extends('templates.main')

@section('content')
    <div class="card shadow">
        <div class="card-header">
            Edit User
        </div>
        <div class="card-body">

            <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
                @method('PATCH')
                @include('admin.users.partial.form')
            </form>

        </div>
    </div>
@endsection
