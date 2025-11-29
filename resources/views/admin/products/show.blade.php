@extends('layouts.app')

@section('title', $product->name . ' - BUNNYPOP')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-6 mb-4">
            @if($product->image)
            <img src="{{ Storage::url($product->image) }}" class="img-fluid rounded-3" alt="{{ $product->name }}">
            @else
            <div class="bg-light rounded-3 d-flex align-items-center justify-content-center" style="height: 400px;">
                <i class="fas fa-image fa-5x text-muted"></i>
            </div>
            @endif
        </div>
        
        <div class="col-md-6">
            <div class="card product-card">
                <div class="card-body">
                    <h1 class="h2 fw-bold">{{ $product->name }}</h1>
                    <div class="mb-3">
                        <span class="badge bg-secondary">{{ $product->category }}</span>
                    </div>
                    
                    <h3 class="text-pink fw-bold mb-4" style="color: var(--pink-pastel);">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </h3>
                    
                    <div class="mb-4">
                        <h5>Description</h5>
                        <p class="text-muted">{{ $product->description }}</p>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-6">
                            <strong>Stock:</strong> 
                            @if($product->stock > 0)
                                <span class="text-success">{{ $product->stock }} available</span>
                            @else
                                <span class="text-danger">Out of stock</span>
                            @endif
                        </div>
                        <div class="col-6">
                            <strong>Category:</strong> {{ $product->category }}
                        </div>
                    </div>
                    
                    @if($product->stock > 0)
                        @auth
                            @if(!auth()->user()->isAdmin())
                            <div class="d-grid gap-2">
                                <a href="{{ route('cart.add', $product->id) }}" class="btn btn-bunny btn-lg">
                                    <i class="fas fa-cart-plus"></i> Add to Cart
                                </a>
                            </div>
                            @endif
                        @else
                        <div class="d-grid gap-2">
                            <a href="{{ route('login') }}" class="btn btn-bunny btn-lg">
                                <i class="fas fa-cart-plus"></i> Add to Cart
                            </a>
                        </div>
                        @endauth
                    @else
                    <button class="btn btn-secondary btn-lg w-100" disabled>Out of Stock</button>
                    @endif
                    
                    <div class="mt-4">
                        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Products
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection