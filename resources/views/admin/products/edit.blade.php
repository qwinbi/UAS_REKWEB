@extends('layouts.app')

@section('title', 'Edit Product - BUNNYPOP')

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
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9 col-lg-10 ms-sm-auto px-4 py-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Edit Product</h1>
                <a href="{{ route('admin.products') }}" class="btn btn-bunny-outline">
                    <i class="fas fa-arrow-left"></i> Back to Products
                </a>
            </div>

            <div class="card product-card">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Product Name *</label>
                                    <input type="text" class="form-control" id="name" name="name" 
                                           value="{{ old('name', $product->name) }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="category" class="form-label">Category *</label>
                                    <select class="form-select" id="category" name="category" required>
                                        <option value="">Select Category</option>
                                        <option value="Toys" {{ old('category', $product->category) == 'Toys' ? 'selected' : '' }}>Toys</option>
                                        <option value="Stationery" {{ old('category', $product->category) == 'Stationery' ? 'selected' : '' }}>Stationery</option>
                                        <option value="Fashion" {{ old('category', $product->category) == 'Fashion' ? 'selected' : '' }}>Fashion</option>
                                        <option value="Home" {{ old('category', $product->category) == 'Home' ? 'selected' : '' }}>Home</option>
                                        <option value="Electronics" {{ old('category', $product->category) == 'Electronics' ? 'selected' : '' }}>Electronics</option>
                                        <option value="Beauty" {{ old('category', $product->category) == 'Beauty' ? 'selected' : '' }}>Beauty</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="price" class="form-label">Price *</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control" id="price" name="price" 
                                               value="{{ old('price', $product->price) }}" min="0" step="1000" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="stock" class="form-label">Stock *</label>
                                    <input type="number" class="form-control" id="stock" name="stock" 
                                           value="{{ old('stock', $product->stock) }}" min="0" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description *</label>
                                    <textarea class="form-control" id="description" name="description" 
                                              rows="5" required>{{ old('description', $product->description) }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="image" class="form-label">Product Image</label>
                                    <input type="file" class="form-control" id="image" name="image" 
                                           accept="image/*">
                                    <div class="form-text">
                                        Leave empty to keep current image
                                    </div>
                                    
                                    @if($product->image)
                                    <div class="mt-2">
                                        <p class="mb-1">Current Image:</p>
                                        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" 
                                             class="img-thumbnail" style="max-height: 150px;">
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <div class="text-end">
                            <a href="{{ route('admin.products') }}" class="btn btn-outline-secondary me-2">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-bunny">
                                <i class="fas fa-save"></i> Update Product
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection