@extends('layouts.app')

@section('title', 'BUNNYPOP - E-commerce Aesthetic')

@section('content')
<!-- Hero Section -->
<section class="hero-section text-center text-dark">
    <div class="container">
        <h1 class="display-4 fw-bold mb-4">Welcome to BUNNYPOP! 🐰</h1>
        <p class="lead mb-4">Temukan produk aesthetic terbaik dengan harga terjangkau</p>
        <a href="{{ route('products.index') }}" class="btn btn-bunny btn-lg">Shop Now</a>
    </div>
</section>

<!-- Featured Products -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-5 fw-bold">Featured Products</h2>
        
        <div class="row g-4">
            @foreach($products as $product)
            <div class="col-md-3 col-6">
                <div class="card product-card h-100">
                    @if($product->image)
                    <img src="{{ Storage::url($product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                    @else
                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                        <i class="fas fa-image fa-3x text-muted"></i>
                    </div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text text-muted small">{{ Str::limit($product->description, 50) }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold" style="color: var(--pink-pastel);">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            @auth
                                @if(!auth()->user()->isAdmin())
                                <form method="POST" action="{{ route('cart.add', $product->id) }}" class="d-inline">
                                    @csrf
                                    <button type="submit" 
                                            class="btn btn-bunny btn-sm @if($product->stock < 1) disabled @endif"
                                            @if($product->stock < 1) disabled @endif
                                            title="Add to Cart">
                                        <i class="fas fa-cart-plus"></i>
                                    </button>
                                </form>
                                @endif
                            @else
                            <a href="{{ route('login') }}" class="btn btn-bunny btn-sm" title="Login to Add to Cart">
                                <i class="fas fa-cart-plus"></i>
                            </a>
                            @endauth
                        </div>
                        @if($product->stock < 1)
                        <div class="mt-2">
                            <small class="text-danger"><i class="fas fa-exclamation-circle"></i> Out of Stock</small>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-4">
            <a href="{{ route('products.index') }}" class="btn btn-bunny">View All Products</a>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-5" style="background: linear-gradient(135deg, var(--pink-pastel), #ffb6c1);">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-4 mb-4">
                <div class="feature-icon mb-3">
                    <i class="fas fa-shipping-fast fa-3x text-dark"></i>
                </div>
                <h5>Free Shipping</h5>
                <p class="text-muted">Gratis ongkir untuk semua order</p>
            </div>
            <div class="col-md-4 mb-4">
                <div class="feature-icon mb-3">
                    <i class="fas fa-shield-alt fa-3x text-dark"></i>
                </div>
                <h5>Secure Payment</h5>
                <p class="text-muted">Pembayaran aman & terjamin</p>
            </div>
            <div class="col-md-4 mb-4">
                <div class="feature-icon mb-3">
                    <i class="fas fa-headset fa-3x text-dark"></i>
                </div>
                <h5>24/7 Support</h5>
                <p class="text-muted">Customer service siap membantu</p>
            </div>
        </div>
    </div>
</section>

<style>
.hero-section {
    background: linear-gradient(135deg, var(--pink-pastel), #ffb6c1);
    padding: 80px 0;
    border-radius: 0 0 30px 30px;
}

.feature-icon {
    background: rgba(255, 255, 255, 0.3);
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
}

.product-card {
    border: none;
    border-radius: 20px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    overflow: hidden;
}

.product-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.15);
}

.btn-bunny {
    background: linear-gradient(135deg, var(--pink-pastel), #ffb6c1);
    border: none;
    color: var(--dark-gray);
    font-weight: 600;
    border-radius: 25px;
    padding: 10px 25px;
    transition: all 0.3s ease;
}

.btn-bunny:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(236, 202, 203, 0.4);
    color: var(--dark-gray);
}
</style>

<script>
// Add to Cart dengan confirm dialog
document.addEventListener('DOMContentLoaded', function() {
    const addToCartForms = document.querySelectorAll('form[action*="cart/add"]');
    
    addToCartForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const productCard = this.closest('.product-card');
            const productName = productCard?.querySelector('.card-title')?.textContent || 'produk ini';
            
            if (!confirm(`Tambahkan "${productName}" ke keranjang?`)) {
                e.preventDefault();
            }
        });
    });

    // Auto-hide alerts setelah 5 detik
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            if (alert.classList.contains('alert-dismissible')) {
                const closeButton = alert.querySelector('.btn-close');
                if (closeButton) {
                    closeButton.click();
                }
            }
        }, 5000);
    });
});
</script>
@endsection