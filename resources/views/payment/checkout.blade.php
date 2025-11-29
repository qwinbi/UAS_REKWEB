@extends('layouts.app')

@section('title', 'Checkout - BUNNYPOP')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-5">Checkout 🎀</h1>
    
    <div class="row">
        <div class="col-lg-8">
            <div class="card product-card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Order Items</h5>
                    @foreach($cartItems as $item)
                    <div class="row align-items-center mb-3 pb-3 border-bottom">
                        <div class="col-2">
                            @if($item->product->image)
                            <img src="{{ Storage::url($item->product->image) }}" class="img-fluid rounded" alt="{{ $item->product->name }}">
                            @else
                            <div class="bg-light rounded d-flex align-items-center justify-content-center" style="height: 60px;">
                                <i class="fas fa-image text-muted"></i>
                            </div>
                            @endif
                        </div>
                        <div class="col-6">
                            <h6 class="mb-1">{{ $item->product->name }}</h6>
                            <small class="text-muted">Qty: {{ $item->quantity }}</small>
                        </div>
                        <div class="col-4 text-end">
                            <span class="fw-bold">Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    @endforeach
                    
                    <div class="text-end">
                        <h5>Total: <span style="color: var(--pink-pastel);">Rp {{ number_format($total, 0, ',', '.') }}</span></h5>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card product-card">
                <div class="card-body">
                    <h5 class="card-title">Payment Method</h5>
                    <form method="POST" action="{{ route('payment.process') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-3">
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="payment_method" id="virtual_account" value="virtual_account" checked>
                                <label class="form-check-label" for="virtual_account">
                                    <i class="fas fa-university"></i> Virtual Account
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" id="qris" value="qris">
                                <label class="form-check-label" for="qris">
                                    <i class="fas fa-qrcode"></i> QRIS
                                </label>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="proof_image" class="form-label">Upload Payment Proof</label>
                            <input type="file" class="form-control" id="proof_image" name="proof_image" accept="image/*" required>
                            <div class="form-text">Upload screenshot of your payment confirmation</div>
                        </div>
                        
                        <div class="alert alert-info">
                            <small>
                                <i class="fas fa-info-circle"></i>
                                After payment, please upload proof of payment. Your order will be processed after verification.
                            </small>
                        </div>
                        
                        <button type="submit" class="btn btn-bunny w-100">
                            <i class="fas fa-paper-plane"></i> Submit Payment
                        </button>
                    </form>
                </div>
            </div>
            
            <div class="card product-card mt-3">
                <div class="card-body">
                    <h6>Need Help?</h6>
                    <p class="small text-muted mb-0">
                        Contact us if you have any issues with your payment.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection