@extends('layouts.app')

@section('title', 'Shopping Cart - BUNNYPOP')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Shopping Cart</li>
                </ol>
            </nav>
        </div>
    </div>

    <h1 class="text-center mb-5">🛒 Shopping Cart</h1>

    <!-- Admin Info Banner -->
    @auth
        @if(auth()->user()->isAdmin())
        <div class="alert alert-info mb-4">
            <i class="fas fa-info-circle"></i>
            <strong>Admin Mode:</strong> Anda dapat melihat dan menghapus item cart, tetapi tidak dapat menambah atau mengupdate quantity.
        </div>
        @endif
    @endauth
    
    @if($cartItems->count() > 0)
    <div class="row">
        <!-- Cart Items -->
        <div class="col-lg-8">
            <div class="card product-card mb-4">
                <div class="card-header bg-transparent">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Cart Items ({{ $totalItems }})</h5>
                        @if($cartItems->count() > 0)
                        <form method="POST" action="{{ route('cart.clear') }}" 
                              onsubmit="return confirm('Yakin ingin mengosongkan keranjang?')">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                <i class="fas fa-trash"></i> Clear Cart
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    @foreach($cartItems as $item)
                    <div class="cart-item border-bottom pb-4 mb-4">
                        <div class="row align-items-center">
                            <div class="col-md-2">
                                @if($item->product->image)
                                <img src="{{ Storage::url($item->product->image) }}" 
                                     class="img-fluid rounded" 
                                     alt="{{ $item->product->name }}"
                                     style="height: 100px; object-fit: cover;">
                                @else
                                <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                     style="height: 100px;">
                                    <i class="fas fa-image fa-2x text-muted"></i>
                                </div>
                                @endif
                            </div>
                            
                            <div class="col-md-4">
                                <h6 class="mb-1">{{ $item->product->name }}</h6>
                                <p class="text-muted small mb-1">{{ $item->product->category }}</p>
                                
                                <!-- Show user info for admin -->
                                @auth
                                    @if(auth()->user()->isAdmin())
                                    <div class="admin-user-info mt-2">
                                        <small class="text-muted">
                                            <i class="fas fa-user"></i> 
                                            User: {{ $item->user->name }} ({{ $item->user->email }})
                                        </small>
                                    </div>
                                    @endif
                                @endauth
                                
                                <span class="badge 
                                    @if($item->is_available) bg-success @else bg-danger @endif">
                                    @if($item->is_available)
                                        Stok: {{ $item->product->stock }}
                                    @else
                                        Stok habis
                                    @endif
                                </span>
                            </div>
                            
                            <div class="col-md-2 text-center">
                                <span class="fw-bold" style="color: var(--pink-pastel);">
                                    Rp {{ number_format($item->product->price, 0, ',', '.') }}
                                </span>
                            </div>
                            
                            <div class="col-md-2">
                                @auth
                                    @if(!auth()->user()->isAdmin())
                                    <!-- Quantity controls for guest users -->
                                    <form method="POST" action="{{ route('cart.update', $item->id) }}" 
                                          class="quantity-form">
                                        @csrf
                                        <div class="input-group input-group-sm">
                                            <button type="button" class="btn btn-outline-secondary quantity-minus" 
                                                    data-cart-id="{{ $item->id }}">-</button>
                                            <input type="number" name="quantity" 
                                                   value="{{ $item->quantity }}" 
                                                   min="1" 
                                                   max="{{ $item->product->stock }}"
                                                   class="form-control text-center quantity-input">
                                            <button type="button" class="btn btn-outline-secondary quantity-plus"
                                                    data-cart-id="{{ $item->id }}">+</button>
                                        </div>
                                    </form>
                                    @else
                                    <!-- Display only for admin -->
                                    <div class="text-center">
                                        <span class="badge bg-secondary">Qty: {{ $item->quantity }}</span>
                                    </div>
                                    @endif
                                @endauth
                            </div>
                            
                            <div class="col-md-2 text-end">
                                <div class="mb-2">
                                    <strong style="color: var(--pink-pastel);">
                                        Rp {{ number_format($item->total_price, 0, ',', '.') }}
                                    </strong>
                                </div>
                                <form method="POST" action="{{ route('cart.remove', $item->id ) }}" 
                                      onsubmit="return confirm('Hapus produk dari keranjang?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Continue Shopping / Back to Dashboard -->
            <div class="text-center">
                @auth
                    @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-bunny-outline">
                        <i class="fas fa-arrow-left"></i> Back to Dashboard
                    </a>
                    @else
                    <a href="{{ route('products.index') }}" class="btn btn-bunny-outline">
                        <i class="fas fa-arrow-left"></i> Continue Shopping
                    </a>
                    @endif
                @endauth
            </div>
        </div>
        
        <!-- Order Summary -->
        <div class="col-lg-4">
            <div class="card product-card sticky-top" style="top: 20px;">
                <div class="card-header bg-transparent">
                    <h5 class="mb-0">Order Summary</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal:</span>
                        <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Shipping:</span>
                        <span class="text-success">Free</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Tax:</span>
                        <span>Rp 0</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-4">
                        <strong>Total:</strong>
                        <strong style="color: var(--pink-pastel); font-size: 1.2rem;">
                            Rp {{ number_format($subtotal, 0, ',', '.') }}
                        </strong>
                    </div>

                    @if($cartItems->where('is_available', false)->count() > 0)
                    <div class="alert alert-warning">
                        <small>
                            <i class="fas fa-exclamation-triangle"></i>
                            Beberapa produk stok tidak mencukupi. Silakan sesuaikan jumlah.
                        </small>
                    </div>
                    @endif

                    @auth
                        @if(!auth()->user()->isAdmin())
                        <!-- Checkout button hanya untuk guest -->
                        <a href="{{ route('checkout') }}" 
                           class="btn btn-bunny w-100 @if($cartItems->where('is_available', false)->count() > 0) disabled @endif">
                            <i class="fas fa-credit-card"></i> Proceed to Checkout
                        </a>
                        @else
                        <!-- Info untuk admin -->
                        <div class="alert alert-secondary text-center">
                            <small>
                                <i class="fas fa-info-circle"></i>
                                Admin tidak dapat melakukan checkout
                            </small>
                        </div>
                        @endif
                    @endauth

                    <div class="text-center mt-3">
                        <small class="text-muted">
                            <i class="fas fa-lock"></i> Secure checkout
                        </small>
                    </div>
                </div>
            </div>

            <!-- Admin Quick Actions -->
            @auth
                @if(auth()->user()->isAdmin())
                <div class="card product-card mt-3">
                    <div class="card-body">
                        <h6 class="card-title">Admin Actions</h6>
                        <div class="d-grid gap-2">
                            <a href="{{ route('admin.products') }}" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-box"></i> Manage Products
                            </a>
                            <a href="{{ route('admin.payments') }}" class="btn btn-outline-success btn-sm">
                                <i class="fas fa-credit-card"></i> View Payments
                            </a>
                        </div>
                    </div>
                </div>
                @endif
            @endauth

            <!-- Security Features -->
            <div class="card product-card mt-3">
                <div class="card-body text-center">
                    <div class="row">
                        <div class="col-4">
                            <i class="fas fa-shipping-fast text-primary"></i>
                            <small class="d-block">Free Shipping</small>
                        </div>
                        <div class="col-4">
                            <i class="fas fa-shield-alt text-success"></i>
                            <small class="d-block">Secure Payment</small>
                        </div>
                        <div class="col-4">
                            <i class="fas fa-undo text-info"></i>
                            <small class="d-block">Easy Return</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <!-- Empty Cart -->
    <div class="text-center py-5">
        <div class="empty-cart-icon mb-4">
            <i class="fas fa-shopping-cart fa-4x text-muted"></i>
        </div>
        <h3>Your cart is empty</h3>
        <p class="text-muted mb-4">Start adding some cute products to your cart!</p>
        
        @auth
            @if(auth()->user()->isAdmin())
            <a href="{{ route('admin.products') }}" class="btn btn-bunny btn-lg">
                <i class="fas fa-box"></i> Manage Products
            </a>
            @else
            <a href="{{ route('products.index') }}" class="btn btn-bunny btn-lg">
                <i class="fas fa-shopping-bag"></i> Start Shopping
            </a>
            @endif
        @endauth
    </div>
    @endif
</div>

<style>
.cart-item:last-child {
    border-bottom: none !important;
    margin-bottom: 0 !important;
    padding-bottom: 0 !important;
}

.quantity-input {
    max-width: 70px;
}

.sticky-top {
    position: -webkit-sticky;
    position: sticky;
}

.empty-cart-icon {
    opacity: 0.5;
}

.input-group .btn {
    padding: 0.25rem 0.5rem;
}

.admin-user-info {
    background: #f8f9fa;
    padding: 5px 10px;
    border-radius: 5px;
    border-left: 3px solid var(--pink-pastel);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Quantity minus button (hanya untuk guest)
    document.querySelectorAll('.quantity-minus').forEach(button => {
        button.addEventListener('click', function() {
            const cartId = this.getAttribute('data-cart-id');
            const input = this.closest('.quantity-form').querySelector('.quantity-input');
            const currentValue = parseInt(input.value);
            
            if (currentValue > 1) {
                input.value = currentValue - 1;
                this.closest('.quantity-form').submit();
            }
        });
    });

    // Quantity plus button (hanya untuk guest)
    document.querySelectorAll('.quantity-plus').forEach(button => {
        button.addEventListener('click', function() {
            const cartId = this.getAttribute('data-cart-id');
            const input = this.closest('.quantity-form').querySelector('.quantity-input');
            const max = parseInt(input.getAttribute('max'));
            const currentValue = parseInt(input.value);
            
            if (currentValue < max) {
                input.value = currentValue + 1;
                this.closest('.quantity-form').submit();
            } else {
                alert('Stok produk tidak mencukupi! Stok tersedia: ' + max);
            }
        });
    });

    // Auto submit on quantity input change (hanya untuk guest)
    document.querySelectorAll('.quantity-input').forEach(input => {
        input.addEventListener('change', function() {
            const max = parseInt(this.getAttribute('max'));
            const value = parseInt(this.value);
            
            if (value < 1) {
                this.value = 1;
            } else if (value > max) {
                this.value = max;
                alert('Stok produk tidak mencukupi! Stok tersedia: ' + max);
            }
            
            this.closest('.quantity-form').submit();
        });
    });
});
</script>
@endsection