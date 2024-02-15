@extends('templates.main')

@section('content')
    <div class="card shadow mt-3">
        <div class="card-header">
            Data User
        </div>
        <div class="card-body">
            <a class="btn btn-sm btn-primary mb-3" href="{{ route('admin.users.create') }}" role="button">Create</a>

            <div class="table-responsive-md">
                <table class="table table-sm table-hover">
                    <thead>
                      <tr>
                        <th scope="col">#ID</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <th scope="row">{{ $user->id }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <a class="btn btn-sm btn-success" href="{{ route('admin.users.edit', $user->id) }}" role="button">Edit</a>
                                <button type="button" class="btn btn-sm btn-danger"
                                    onclick="event.preventDefault();
                                    document.getElementById('delete-user-form-{{ $user->id }}').submit()">
                                    Delete
                                </button>
                                <form id="delete-user-form-{{ $user->id }}" action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display: none">
                                    @csrf
                                    @method("DELETE")
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
            </div>

              {{ $users->links() }}
        </div>
    </div>
@endsection
