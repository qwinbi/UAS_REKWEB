@extends('layouts.app')

@section('title', 'Manage Payments - BUNNYPOP')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 col-lg-2 admin-sidebar">
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.products') }}">
                            <i class="fas fa-box"></i> Products
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('admin.payments') }}">
                            <i class="fas fa-credit-card"></i> Payments
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9 col-lg-10 ms-sm-auto px-4 py-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Payment Management</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <span class="badge bg-warning">{{ $payments->where('status', 'pending')->count() }} Pending</span>
                </div>
            </div>

            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            <div class="card product-card">
                <div class="card-body">
                    @if($payments->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Customer</th>
                                    <th>Method</th>
                                    <th>Amount</th>
                                    <th>Proof</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($payments as $payment)
                                <tr>
                                    <td>#{{ $payment->order_id }}</td>
                                    <td>
                                        <strong>{{ $payment->order->user->name }}</strong>
                                        <br>
                                        <small class="text-muted">{{ $payment->order->user->email }}</small>
                                    </td>
                                    <td>
                                        @if($payment->method == 'virtual_account')
                                        <span class="badge bg-info">
                                            <i class="fas fa-university"></i> Virtual Account
                                        </span>
                                        @else
                                        <span class="badge bg-success">
                                            <i class="fas fa-qrcode"></i> QRIS
                                        </span>
                                        @endif
                                    </td>
                                    <td>
                                        <strong style="color: var(--pink-pastel);">
                                            Rp {{ number_format($payment->order->total_amount, 0, ',', '.') }}
                                        </strong>
                                    </td>
                                    <td>
                                        @if($payment->proof_image)
                                        <button type="button" class="btn btn-sm btn-bunny-outline" 
                                                data-bs-toggle="modal" data-bs-target="#proofModal{{ $payment->id }}">
                                            <i class="fas fa-eye"></i> View Proof
                                        </button>
                                        @else
                                        <span class="badge bg-secondary">No proof</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($payment->status == 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                        @elseif($payment->status == 'approved')
                                        <span class="badge bg-success">Approved</span>
                                        @else
                                        <span class="badge bg-danger">Rejected</span>
                                        @endif
                                    </td>
                                    <td>
                                        <small>{{ $payment->created_at->format('M d, Y H:i') }}</small>
                                    </td>
                                    <td>
                                        @if($payment->status == 'pending')
                                        <div class="btn-group" role="group">
                                            <form method="POST" action="{{ route('admin.payments.status', $payment->id) }}" class="d-inline">
                                                @csrf
                                                <input type="hidden" name="status" value="approved">
                                                <button type="submit" class="btn btn-sm btn-outline-success" 
                                                        onclick="return confirm('Approve this payment?')">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>
                                            <form method="POST" action="{{ route('admin.payments.status', $payment->id) }}" class="d-inline">
                                                @csrf
                                                <input type="hidden" name="status" value="rejected">
                                                <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                        onclick="return confirm('Reject this payment?')">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </form>
                                        </div>
                                        @else
                                        <span class="text-muted small">Verified</span>
                                        @endif
                                    </td>
                                </tr>

                                <!-- Proof Modal -->
                                <div class="modal fade" id="proofModal{{ $payment->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Payment Proof - Order #{{ $payment->order_id }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <img src="{{ Storage::url($payment->proof_image) }}" 
                                                     alt="Payment Proof" class="img-fluid rounded">
                                                <div class="mt-3">
                                                    <p><strong>Customer:</strong> {{ $payment->order->user->name }}</p>
                                                    <p><strong>Amount:</strong> Rp {{ number_format($payment->order->total_amount, 0, ',', '.') }}</p>
                                                    <p><strong>Method:</strong> {{ ucfirst(str_replace('_', ' ', $payment->method)) }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="text-center py-5">
                        <i class="fas fa-credit-card fa-3x text-muted mb-3"></i>
                        <h4>No payments found</h4>
                        <p class="text-muted">Payment records will appear here when customers make orders.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection