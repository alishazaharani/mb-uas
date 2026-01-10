@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">Manajemen Pesanan</h3>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="text-white bg-dark">
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Produk</th>
                        <th>Qty</th>
                        <th>Harga</th>
                        <th>Total</th>
                        <th>Metode</th>
                        <th>Bukti</th>
                        <th>Status</th>
                        <th width="10%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->user->name }}</td>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->qty }}</td>
                        <td>Rp {{ number_format($item->price) }}</td>
                        <td>Rp {{ number_format($item->total) }}</td>
                        <td>{{ ucfirst($item->payment_method ?? '-') }}</td>
                        <td>
                            @if($item->payment_proof)
                                <a href="{{ asset('storage/'.$item->payment_proof) }}" target="_blank">
                                    Lihat
                                </a>
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            @if($item->status == 'pending')
                                <span class="badge bg-warning">Pending</span>
                            @elseif($item->status == 'completed')
                                <span class="badge bg-success">Completed</span>
                            @else
                                <span class="badge bg-danger">Cancelled</span>
                            @endif
                        </td>
                        <td>
                            @if($item->status != 'completed')
                                <button class="btn btn-sm btn-primary"
                                    onclick="openStatusModal({{ $item }})">
                                    Ubah
                                </button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="statusModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" id="statusForm">
            @csrf
            @method('PATCH')

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ubah Status Pesanan</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label>Status</label>
                        <select name="status" id="statusSelect" class="form-control">
                            <option value="pending">Pending</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>

                    <div class="alert alert-info">
                        Jika status <b>Completed</b>, stok produk akan otomatis dikurangi.
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary w-100">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function openStatusModal(order) {
        $('#statusForm').attr(
            'action',
            '/admin/pesanan/update-status/' + order.id
        );

        $('#statusSelect').val(order.status);
        $('#statusModal').modal('show');
    }
</script>
@endsection
