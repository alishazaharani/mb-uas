@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h4 class="mb-3 fw-bold">Manajemen User & Admin</h4>

    <button class="mb-4 btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
        + Tambah User / Admin
    </button>

    <div class="mb-4 card">
        <div class="text-white card-header bg-info">
            Data User
        </div>
        <div class="p-0 card-body">
            <table class="table mb-0 table-bordered">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th width="20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($dataUser as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm"
                                onclick='openEditModal(@json($item))'>
                                Edit
                            </button>

                            <form action="{{ route('superadmin.users.delete', $item->id) }}"
                                  method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Hapus user ini?')">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada data user</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="text-white card-header bg-dark">
            Data Admin
        </div>
        <div class="p-0 card-body">
            <table class="table mb-0 table-bordered">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th width="20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($dataAdmin as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm"
                                onclick='openEditModal(@json($item))'>
                                Edit
                            </button>

                            <form action="{{ route('superadmin.users.delete', $item->id) }}" method="POST" style="display:inline;" id="deleteForm_{{ $item->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $item->id }})">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada data admin</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('superadmin.users.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah User / Admin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-2">
                        <label>Nama</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-2">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="mb-2">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="mb-2">
                        <label>Role</label>
                        <select name="role" class="form-control">
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary w-100">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog">
        <form id="editForm" method="POST">
            @csrf
            @method('PATCH')

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit User / Admin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-2">
                        <label>Nama</label>
                        <input type="text" name="name" id="edit_name" class="form-control" required>
                    </div>

                    <div class="mb-2">
                        <label>Email</label>
                        <input type="email" name="email" id="edit_email" class="form-control" required>
                    </div>

                    <div class="mb-2">
                        <label>Role</label>
                        <select name="role" id="edit_role" class="form-control">
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary w-100">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function openEditModal(user) {
        $('#editForm').attr('action', '/superadmin/users/update/' + user.id);
        $('#edit_name').val(user.name);
        $('#edit_email').val(user.email);
        $('#edit_role').val(user.role);

        $('#editModal').modal('show');
    }

    function confirmDelete(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Data ini akan dihapus!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteForm_' + id).submit();
            }
        });
    }
</script>
@endsection


