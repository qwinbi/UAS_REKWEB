@extends('layouts.app')

@section('title', 'Manage Products - BUNNYPOP')

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
                        <a class="nav-link active" href="{{ route('admin.products') }}">
                            <i class="fas fa-box"></i> Products
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.payments') }}">
                            <i class="fas fa-credit-card"></i> Payments
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.about') }}">
                            <i class="fas fa-info-circle"></i> About Page
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.footer') }}">
                            <i class="fas fa-shoe-prints"></i> Footer
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.logo') }}">
                            <i class="fas fa-image"></i> Logo
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9 col-lg-10 ms-sm-auto px-4 py-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Manage Products</h1>
                <a href="{{ route('admin.products.create') }}" class="btn btn-bunny">
                    <i class="fas fa-plus"></i> Add New Product
                </a>
            </div>

            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            <div class="card product-card">
                <div class="card-body">
                    @if($products->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                <tr>
                                    <td>
                                        @if($product->image)
                                        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" 
                                             class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                                        @else
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                             style="width: 50px; height: 50px;">
                                            <i class="fas fa-image text-muted"></i>
                                        </div>
                                        @endif
                                    </td>
                                    <td>
                                        <strong>{{ $product->name }}</strong>
                                        <br>
                                        <small class="text-muted">{{ Str::limit($product->description, 50) }}</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary">{{ $product->category }}</span>
                                    </td>
                                    <td>
                                        <strong style="color: var(--pink-pastel);">
                                            Rp {{ number_format($product->price, 0, ',', '.') }}
                                        </strong>
                                    </td>
                                    <td>
                                        @if($product->stock > 0)
                                        <span class="badge bg-success">{{ $product->stock }}</span>
                                        @else
                                        <span class="badge bg-danger">Out of stock</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.products.edit', $product->id) }}" 
                                               class="btn btn-sm btn-bunny-outline">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form method="POST" action="{{ route('admin.products.delete', $product->id) }}" 
                                                  class="d-inline" onsubmit="return confirm('Are you sure you want to delete this product?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="text-center py-5">
                        <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                        <h4>No products found</h4>
                        <p class="text-muted">Get started by adding your first product.</p>
                        <a href="{{ route('admin.products.create') }}" class="btn btn-bunny">
                            <i class="fas fa-plus"></i> Add Product
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection