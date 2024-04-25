@extends('templates.main')

@section('content')
    <div class="card shadow mt-3">
        <div class="card-header">
            Data User
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-4">
                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                        <a class="btn btn-primary" href="{{ route('admin.users.create') }}" target="_blank">Create</a>
                        <a class="btn btn-secondary" href="{{ route('admin.users.index') }}">Reset</a>
                        <button class="btn btn-warning dropdown-toggle" type="button" id="sortDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            Sort
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="sortDropdown">
                            <li><a class="dropdown-item" href="{{ route('admin.users.index', ['sort_by' => 'id', 'sort_order' => 'asc', 'search' => $searchQuery]) }}">ID</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.users.index', ['sort_by' => 'nama_lengkap', 'sort_order' => ($sortField == 'nama_lengkap' && $sortOrder == 'asc') ? 'desc' : 'asc', 'search' => $searchQuery]) }}">Nama Lengkap</a></li>
                            <!-- Add more sorting options as needed -->
                        </ul>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="float-end">
                        <form action="{{ route('admin.users.index') }}" method="GET" style="display: inline-flex; align-items: center;">
                            <div class="form-group" style="margin-bottom: 0;">
                                <select name="per_page" class="form-select form-select-sm" id="perPage" onchange="this.form.submit()">
                                    <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                                    <option value="15" {{ $perPage == 15 ? 'selected' : '' }}>15</option>
                                    <option value="20" {{ $perPage == 20 ? 'selected' : '' }}>20</option>
                                    <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25</option>
                                    <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                                    <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100</option>
                                </select>
                            </div>
                        </form>
                        <form action="{{ route('admin.users.index') }}" method="get" style="display: inline-flex; align-items: center;">
                            <div class="form-group ms-2" style="margin-bottom: 0;">
                                <input type="text" name="search" class="form-control form-control-sm" placeholder="Search ..." value="{{ $searchQuery }}">
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary" style="margin-left: 5px;">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="table-responsive-md">
                <table class="table table-sm table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Nomor</th>
                            <th scope="col">Username</th>
                            <th scope="col">Nama Lengkap</th>
                            <th scope="col">Role</th>
                            <th scope="col">Email</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $index => $user)
                            <tr>
                                <th scope="row">{{ $index + $users->firstItem() }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->nama_lengkap }}</td>
                                <td>
                                    @foreach ($user->roles as $role)
                                        {{ $role->name }}
                                    @endforeach
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <button class="btn btn-sm btn-success dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Link
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" target="_blank" href="{{ route('biodata_admin.index', ['user_id' => $user->id]) }}">
                                                Biodata
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" target="_blank" href="{{ route('lisensi.index', ['user_id' => $user->id]) }}">
                                                Lisensi
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" target="_blank" href="{{ route('diklat.index', ['user_id' => $user->id]) }}">
                                                Diklat
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" target="_blank" href="{{ route('pendidikan.index', ['user_id' => $user->id]) }}">
                                                Pendidikan
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" target="_blank" href="{{ route('prestasi.index', ['user_id' => $user->id]) }}">
                                                Prestasi
                                            </a>
                                        </li>
                                        <li><a class="dropdown-item" href="#">Pekerjaan</a></li>
                                    </ul>
                                    @if(auth()->user() && $user->id !== auth()->user()->id)
                                        @if(!$user->hasAnyRole('admin'))
                                            <a class="btn btn-sm btn-success" href="{{ route('admin.users.edit', $user->id) }}" role="button">Edit</a>
                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $user->id }}">
                                                Delete
                                            </button>
                                            <form id="delete-user-form-{{ $user->id }}" action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display: none">
                                                @csrf
                                                @method("DELETE")
                                            </form>
                                        @else
                                            <a class="btn btn-sm btn-success" href="{{ route('admin.users.edit', $user->id) }}" role="button">Edit</a>
                                            <button type="button" class="btn btn-sm btn-danger" disabled>
                                                Delete
                                            </button>
                                        @endif
                                    @else
                                        <button type="button" class="btn btn-sm btn-primary" disabled>
                                            Login
                                        </button>
                                        <button type="button" class="btn btn-sm btn-danger" disabled>
                                            Delete
                                        </button>
                                    @endif
                                </td>
                            </tr>

                            <!-- Delete Modal -->
                            <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $user->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel{{ $user->id }}">Hapus data user</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <strong>Apakah anda ingin menghapus user ini?</strong>
                                            <div class="alert alert-danger mt-2" role="alert">
                                                <strong>Jika hapus data user, maka data turunan lainnya akan terhapus</strong>
                                                <ul>
                                                    <li>Biodata, diklat, dan lain-lain</li>
                                                    <li>Registrasi, Kehadiran & Tanda Terima (Data keterlibatan user)</li>
                                                </ul>
                                            <strong>Klik hapus jika anda yakin</strong>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="button" class="btn btn-sm btn-danger" onclick="document.getElementById('delete-user-form-{{ $user->id }}').submit()">Hapus</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{ $users->onEachSide(1)->appends(['search' => $searchQuery, 'sort_by' => $sortField, 'sort_order' => $sortOrder, 'per_page' => $perPage])->links() }}

            <div>
                <div class="row">
                    <div class="col">
                        <p class="btn btn-sm btn-secondary">Total Data: {{ $users->total() }}</p>
                    </div>
                    <div class="col">
                        <div class="float-end">
                            <p class="btn btn-sm btn-secondary">Data/Page: {{ $users->count() }} / {{ $users->currentPage() }}</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @include('templates.footer')

    <!-- JavaScript Section -->
    @section('scripts')
        <script>
            // Initialize Bootstrap modal
            var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));

            // Show modal on delete button click
            $('#deleteModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var modal = $(this);
                // Extract user ID from button data-id attribute
                var userId = button.data('id');
                modal.find('.modal-footer #userId').val(userId);
            });

            // Handle form submission when modal delete button is clicked
            $('#deleteModal .btn-danger').on('click', function () {
                var userId = $('#userId').val();
                $('#delete-user-form-' + userId).submit();
            });
        </script>
    @endsection
@endsection
