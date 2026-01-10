@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <h1>Data Kategori</h1>
        <button type="button" class="mb-4 btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
            Tambah Kategori
        </button>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h2>List Kategori</h2>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead style="background-color: black">
                        <tr class="text-white">
                            <th>Nama Kategori</th>
                            <th>Gambar Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>
                                @if($item->image)
                                    <img src="{{ asset('storage/' . $item->image) }}" width="80">
                                @else
                                    <span>-</span>
                                @endif
                                </td>
                                <td>
                                    <button class="btn btn-warning btn-sm" onclick="editKategori({{ $item }})">Edit</button>
                                    <form action="{{ route('admin.kategori.delete', $item->id) }}" method="POST" style="display:inline;" id="deleteForm_{{ $item->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $item->id }})">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Modal Tambah --}}
        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('admin.kategori.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Kategori</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Nama Kategori</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Gambar Kategori</label>
                                <input type="file" name="image" id="imageInput" class="form-control" required>
                                <img id="imagePreview" src="#" alt="Preview Gambar" class="mt-2 img-fluid" style="display: none; max-height: 200px;">
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary" type="submit">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- modal edit --}}
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form id="editForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Kategori</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Nama Kategori</label>
                                <input type="text" name="name" class="form-control" id="edit_name" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Gambar Baru (Opsional)</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Gambar Saat Ini</label><br>
                                <img id="preview_image" src="" width="120" class="border rounded" />
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary" type="submit">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
    </div>

<script>
    document.getElementById('imageInput').addEventListener('change', function(event) {
        const [file] = event.target.files;
        const preview = document.getElementById('imagePreview');

        if (file) {
            preview.src = URL.createObjectURL(file); 
            preview.style.display = 'block'; 
        } else {
            preview.src = '#';
            preview.style.display = 'none';
        }
    });

    function editKategori(item) {
        $('#editForm').attr('action', '/admin/kategori/update/' + item.id);
        $('#edit_name').val(item.name);

        if (item.image) {
            $('#preview_image').attr('src', '/storage/' + item.image);
        } else {
            $('#preview_image').attr('src', 'https://via.placeholder.com/120x120?text=No+Image');
        }
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