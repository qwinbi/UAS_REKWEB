@extends('layouts.app')

@section('title', 'Add Product - BUNNYPOP')

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
                <h1 class="h2">Add New Product</h1>
                <a href="{{ route('admin.products') }}" class="btn btn-bunny-outline">
                    <i class="fas fa-arrow-left"></i> Back to Products
                </a>
            </div>

            <div class="card product-card">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Product Name *</label>
                                    <input type="text" class="form-control" id="name" name="name" 
                                           value="{{ old('name') }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="category" class="form-label">Category *</label>
                                    <select class="form-select" id="category" name="category" required>
                                        <option value="">Select Category</option>
                                        <option value="Toys" {{ old('category') == 'Toys' ? 'selected' : '' }}>Toys</option>
                                        <option value="Stationery" {{ old('category') == 'Stationery' ? 'selected' : '' }}>Stationery</option>
                                        <option value="Fashion" {{ old('category') == 'Fashion' ? 'selected' : '' }}>Fashion</option>
                                        <option value="Home" {{ old('category') == 'Home' ? 'selected' : '' }}>Home</option>
                                        <option value="Electronics" {{ old('category') == 'Electronics' ? 'selected' : '' }}>Electronics</option>
                                        <option value="Beauty" {{ old('category') == 'Beauty' ? 'selected' : '' }}>Beauty</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="price" class="form-label">Price *</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="number" class="form-control" id="price" name="price" 
                                               value="{{ old('price') }}" min="0" step="1000" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="stock" class="form-label">Stock *</label>
                                    <input type="number" class="form-control" id="stock" name="stock" 
                                           value="{{ old('stock') }}" min="0" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description *</label>
                                    <textarea class="form-control" id="description" name="description" 
                                              rows="5" required>{{ old('description') }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="image" class="form-label">Product Image *</label>
                                    <input type="file" class="form-control" id="image" name="image" 
                                           accept="image/*" required>
                                    <div class="form-text">
                                        Recommended: Square image, max 2MB, JPG/PNG format
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="featured" name="featured">
                                        <label class="form-check-label" for="featured">
                                            Feature this product
                                        </label>
                                    </div>
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
                            <button type="reset" class="btn btn-outline-secondary me-2">
                                <i class="fas fa-redo"></i> Reset
                            </button>
                            <button type="submit" class="btn btn-bunny">
                                <i class="fas fa-save"></i> Save Product
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection