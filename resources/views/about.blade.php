@extends('layouts.app')

@section('title', 'About - BUNNYPOP')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card product-card">
                <div class="card-body p-5">
                    <div class="text-center mb-5">
                        <i class="fas fa-bunny fa-4x" style="color: var(--pink-pastel);"></i>
                        <h1 class="mt-3 fw-bold">About BUNNYPOP</h1>
                        <p class="lead">Your Favorite Aesthetic E-commerce Destination 🐰</p>
                    </div>

                    @if(\App\Models\Setting::getValue('about_content'))
                        {!! \App\Models\Setting::getValue('about_content') !!}
                    @else
                    <!-- Default About Content dengan foto dinamis -->
                    <div class="row">
                        <!-- Developer Info -->
                        <div class="col-md-4 text-center mb-4">
                            <div class="mb-4">
                                @if(\App\Models\Setting::getValue('about_photo'))
                                    <img src="{{ Storage::url(\App\Models\Setting::getValue('about_photo')) }}" 
                                         alt="Profile" 
                                         class="rounded-circle mb-3" 
                                         width="200" 
                                         height="200" 
                                         style="object-fit: cover;">
                                @else
                                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" 
                                         style="width: 200px; height: 200px;">
                                        <i class="fas fa-user fa-3x text-muted"></i>
                                    </div>
                                @endif
                                <h3>Nama Developer</h3>
                                <p class="mb-1"><strong>NIM:</strong> 123456789</p>
                                <p class="mb-1"><strong>Prodi:</strong> Teknik Informatika</p>
                                <p class="mb-0"><strong>Kelas:</strong> TI-01</p>
                            </div>
                        </div>

                        <!-- Project Info -->
                        <div class="col-md-8">
                            <!-- Tetap tampilkan informasi project seperti sebelumnya -->
                            <div class="mb-4">
                                <h4 class="fw-bold" style="color: var(--pink-pastel);">🎀 Tentang BUNNYPOP</h4>
                                <p class="mb-3">
                                    <strong>BUNNYPOP</strong> adalah platform e-commerce aesthetic yang menghadirkan pengalaman berbelanja online yang menyenangkan, lucu, dan modern dengan tema kelinci yang menggemaskan.
                                </p>
                                <p>
                                    Website ini dibangun dengan konsep user-friendly interface, color palette yang soft, dan fitur-fitur lengkap yang memudahkan baik customer maupun administrator.
                                </p>
                            </div>

                            <!-- ... bagian lainnya tetap sama ... -->
                        </div>
                    </div>
                    @endif

                    <div class="mt-5 text-center">
                        <a href="{{ route('home') }}" class="btn btn-bunny me-2">
                            <i class="fas fa-home"></i> Back to Home
                        </a>
                        <a href="{{ route('products.index') }}" class="btn btn-bunny-outline">
                            <i class="fas fa-shopping-bag"></i> Start Shopping
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection