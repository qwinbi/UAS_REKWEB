@extends('layouts.app')

@section('title', 'Login - BUNNYPOP')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card product-card">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <i class="fas fa-bunny fa-3x text-pink" style="color: var(--pink-pastel);"></i>
                        <h2 class="mt-3 fw-bold">Login to BUNNYPOP</h2>
                        <p class="text-muted">Welcome back! Please sign in to your account.</p>
                    </div>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autofocus>
                        </div>
                        
                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        
                        <button type="submit" class="btn btn-bunny w-100 mb-3">Login</button>
                    </form>

                    <div class="text-center">
                        <p class="mb-2">Don't have an account? 
                            <a href="{{ route('register') }}" class="text-decoration-none">Register here</a>
                        </p>
                    </div>

                    <hr class="my-4">

                    <div class="card mt-4">
                        <div class="card-body">
                            <h6 class="card-title">Demo Accounts:</h6>
                            <div class="row">
                                <div class="col-6">
                                    <strong>Admin:</strong><br>
                                    admin@email.com<br>
                                    1234
                                </div>
                                <div class="col-6">
                                    <strong>Guest:</strong><br>
                                    guest@email.com<br>
                                    4321
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