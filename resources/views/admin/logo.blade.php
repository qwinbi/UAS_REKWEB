@extends('layouts.app')

@section('title', 'Logo Settings - BUNNYPOP')

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
                        <a class="nav-link active" href="{{ route('admin.logo') }}">
                            <i class="fas fa-image"></i> Logo
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9 col-lg-10 ms-sm-auto px-4 py-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Logo Settings</h1>
            </div>

            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            <div class="row">
                <div class="col-lg-6">
                    <div class="card product-card">
                        <div class="card-body">
                            <h5 class="card-title">Upload New Logo</h5>
                            <form method="POST" action="{{ route('admin.logo.update') }}" enctype="multipart/form-data">
                                @csrf
                                
                                <div class="mb-3">
                                    <label for="logo" class="form-label">Logo Image</label>
                                    <input type="file" class="form-control" id="logo" name="logo" 
                                           accept="image/*" required>
                                    <div class="form-text">
                                        Recommended: PNG with transparent background, max 1MB
                                    </div>
                                </div>

                                <div class="text-end">
                                    <button type="submit" class="btn btn-bunny">
                                        <i class="fas fa-upload"></i> Upload Logo
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card product-card">
                        <div class="card-body">
                            <h5 class="card-title">Current Logo</h5>
                            
                            @if($logo)
                            <div class="text-center mb-3">
                                <img src="{{ Storage::url($logo) }}" alt="Current Logo" 
                                     class="img-fluid rounded" style="max-height: 150px;">
                                <p class="mt-2 text-muted small">Current logo displayed in navbar</p>
                            </div>
                            @else
                            <div class="text-center py-4">
                                <i class="fas fa-image fa-3x text-muted mb-3"></i>
                                <p class="text-muted">No logo uploaded yet</p>
                                <p class="small text-muted">
                                    Default bunny icon is being used: <i class="fas fa-bunny"></i>
                                </p>
                            </div>
                            @endif

                            <div class="alert alert-info">
                                <small>
                                    <i class="fas fa-info-circle"></i>
                                    The logo will appear in the navigation bar. Make sure it looks good on both light and dark backgrounds.
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Logo Preview -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card product-card">
                        <div class="card-body">
                            <h5 class="card-title">Live Preview</h5>
                            <div class="navbar navbar-custom rounded p-3">
                                <div class="container">
                                    <a class="navbar-brand fw-bold" href="#">
                                        @if($logo)
                                        <img src="{{ Storage::url($logo) }}" alt="Logo" height="30" class="me-2">
                                        @else
                                        <i class="fas fa-bunny bunny-icon"></i>
                                        @endif
                                        BUNNYPOP
                                    </a>
                                    <div class="navbar-nav ms-auto">
                                        <a class="nav-link" href="#">Home</a>
                                        <a class="nav-link" href="#">Products</a>
                                        <a class="nav-link" href="#">About</a>
                                    </div>
                                </div>
                            </div>
                            <p class="text-muted small mt-2">This is how your logo appears in the navbar</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection