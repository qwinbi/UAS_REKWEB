@extends('layouts.app')

@section('title', 'Footer Settings - BUNNYPOP')

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
                        <a class="nav-link active" href="{{ route('admin.footer') }}">
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
                <h1 class="h2">Footer Settings</h1>
            </div>

            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            <div class="row">
                <div class="col-lg-8">
                    <div class="card product-card">
                        <div class="card-body">
                            <h5 class="card-title">Edit Footer Content</h5>
                            <form method="POST" action="{{ route('admin.footer.update') }}">
                                @csrf
                                
                                <div class="mb-3">
                                    <label for="footer_content" class="form-label">Footer Text</label>
                                    <textarea class="form-control" id="footer_content" name="footer_content" 
                                              rows="5" required>{{ $footer }}</textarea>
                                    <div class="form-text">
                                        This text will appear in the footer of every page.
                                    </div>
                                </div>

                                <div class="text-end">
                                    <button type="submit" class="btn btn-bunny">
                                        <i class="fas fa-save"></i> Save Footer
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card product-card">
                        <div class="card-body">
                            <h5 class="card-title">Current Footer Preview</h5>
                            <div class="border rounded p-3 bg-dark text-light">
                                @if($footer)
                                    {{ $footer }}
                                @else
                                    <p class="mb-0">BUNNYPOP - E-commerce Aesthetic © 2024. All rights reserved.</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="card product-card mt-3">
                        <div class="card-body">
                            <h6>Tips:</h6>
                            <ul class="small text-muted">
                                <li>Keep it short and professional</li>
                                <li>Include copyright information</li>
                                <li>Add your website name</li>
                                <li>You can include current year: &copy; {{ date('Y') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection