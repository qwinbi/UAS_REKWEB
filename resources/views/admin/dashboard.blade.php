@extends('layouts.app')

@section('title', 'Admin Dashboard - BUNNYPOP')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 col-lg-2 admin-sidebar">
            <div class="position-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.products') }}">
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
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">
                            <i class="fas fa-store"></i> Visit Store
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9 col-lg-10 ms-sm-auto px-4 py-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Admin Dashboard</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <span class="badge bg-success">Admin Mode</span>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="row mb-4">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card product-card h-100">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: var(--pink-pastel);">
                                        Total Products
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalProducts }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-box fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card product-card h-100">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: var(--pink-pastel);">
                                        Total Orders
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalOrders }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card product-card h-100">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: var(--pink-pastel);">
                                        Pending Payments
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pendingPayments }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-clock fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card product-card h-100">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-uppercase mb-1" style="color: var(--pink-pastel);">
                                        Total Users
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalUsers }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="row">
                <div class="col-12">
                    <div class="card product-card">
                        <div class="card-body">
                            <h5 class="card-title">Quick Actions</h5>
                            <div class="row text-center">
                                <div class="col-md-3 mb-3">
                                    <a href="{{ route('admin.products.create') }}" class="btn btn-bunny w-100">
                                        <i class="fas fa-plus"></i> Add Product
                                    </a>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <a href="{{ route('admin.payments') }}" class="btn btn-bunny-outline w-100">
                                        <i class="fas fa-eye"></i> View Payments
                                    </a>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <a href="{{ route('admin.about') }}" class="btn btn-bunny-outline w-100">
                                        <i class="fas fa-cog"></i> Edit About
                                    </a>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <a href="{{ route('admin.logo') }}" class="btn btn-bunny-outline w-100">
                                        <i class="fas fa-image"></i> Change Logo
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card product-card">
                        <div class="card-body">
                            <h5 class="card-title">Recent Activity</h5>
                            <div class="list-group list-group-flush">
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="fas fa-box text-success me-2"></i>
                                        <span>New product added</span>
                                    </div>
                                    <small class="text-muted">Just now</small>
                                </div>
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="fas fa-shopping-cart text-primary me-2"></i>
                                        <span>New order received</span>
                                    </div>
                                    <small class="text-muted">5 minutes ago</small>
                                </div>
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="fas fa-credit-card text-warning me-2"></i>
                                        <span>Payment pending verification</span>
                                    </div>
                                    <small class="text-muted">10 minutes ago</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection