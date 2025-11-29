@extends('layouts.app')

@section('title', 'About Page Settings - BUNNYPOP')

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
                        <a class="nav-link active" href="{{ route('admin.about') }}">
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
                <h1 class="h2">About Page Settings</h1>
                <a href="{{ route('about') }}" target="_blank" class="btn btn-bunny-outline">
                    <i class="fas fa-eye"></i> View Page
                </a>
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
                            <h5 class="card-title">Edit About Content</h5>
                            
                            <form method="POST" action="{{ route('admin.about.update') }}" enctype="multipart/form-data">
                                @csrf
                                
                                <!-- Photo Upload Section -->
                                <div class="mb-4">
                                    <label for="about_photo" class="form-label">Profile Photo</label>
                                    <input type="file" class="form-control" id="about_photo" name="about_photo" 
                                           accept="image/*">
                                    <div class="form-text">
                                        Upload foto profil untuk halaman About (Recommended: 200x200px, JPG/PNG)
                                    </div>

                                    @if($about_photo)
                                    <div class="mt-3">
                                        <p class="mb-1">Current Photo:</p>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ Storage::url($about_photo) }}" alt="About Photo" 
                                                 class="img-thumbnail me-3" style="width: 100px; height: 100px; object-fit: cover;">
                                            <a href="{{ route('admin.about.removePhoto') }}" 
                                               class="btn btn-outline-danger btn-sm"
                                               onclick="return confirm('Hapus foto ini?')">
                                                <i class="fas fa-trash"></i> Remove Photo
                                            </a>
                                        </div>
                                    </div>
                                    @endif
                                </div>

                                <!-- Content Editor -->
                                <div class="mb-3">
                                    <label for="about_content" class="form-label">About Content (HTML Supported)</label>
                                    <textarea class="form-control" id="about_content" name="about_content" 
                                              rows="15" required>{{ $about }}</textarea>
                                    <div class="form-text">
                                        Anda bisa menggunakan HTML tags untuk formatting. Gunakan template di samping sebagai referensi.
                                    </div>
                                </div>

                                <div class="text-end">
                                    <button type="submit" class="btn btn-bunny">
                                        <i class="fas fa-save"></i> Save Changes
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <!-- Quick Templates -->
                    <div class="card product-card">
                        <div class="card-body">
                            <h5 class="card-title">Quick Templates</h5>
                            
                            <div class="mb-3">
                                <h6>Basic Personal Info:</h6>
                                <pre class="bg-dark text-light p-3 rounded small">
&lt;div class="text-center"&gt;
    &lt;div class="mb-4"&gt;
        &lt;img src="/storage/about/your-photo.jpg" alt="Profile" class="rounded-circle mb-3" width="200" height="200" style="object-fit: cover;"&gt;
        &lt;h3&gt;Syarifatul Azkiya Alganjari&lt;/h3&gt;
        &lt;p class="mb-1"&gt;&lt;strong&gt;NIM:&lt;/strong&gt; 241011701321&lt;/p&gt;
        &lt;p class="mb-1"&gt;&lt;strong&gt;Prodi:&lt;/strong&gt; Sistem Informasi&lt;/p&gt;
        &lt;p class="mb-0"&gt;&lt;strong&gt;Kelas:&lt;/strong&gt; 03SIFP014&lt;/p&gt;
    &lt;/div&gt;
&lt;/div&gt;</pre>
                                <small class="text-muted">* Setelah upload foto, ganti <code>your-photo.jpg</code> dengan nama file yang diupload</small>
                            </div>

                            <div class="mb-3">
                                <h6>With Photo & Project Info:</h6>
                                <pre class="bg-dark text-light p-3 rounded small">
&lt;div class="row"&gt;
    &lt;div class="col-md-4 text-center"&gt;
        &lt;div class="mb-4"&gt;
            &lt;img src="/storage/about/your-photo.jpg" alt="Profile" class="rounded-circle mb-3" width="200" height="200" style="object-fit: cover;"&gt;
            &lt;h4&gt;Syarifatul Azkiya Alganjari&lt;/h4&gt;
            &lt;p class="mb-1"&gt;&lt;strong&gt;NIM:&lt;/strong&gt; 241011701321&lt;/p&gt;
            &lt;p class="mb-1"&gt;&lt;strong&gt;Prodi:&lt;/strong&gt; Sistem Informasi&lt;/p&gt;
            &lt;p class="mb-0"&gt;&lt;strong&gt;Kelas:&lt;/strong&gt; 03SIFP014&lt;/p&gt;
        &lt;/div&gt;
    &lt;/div&gt;
    &lt;div class="col-md-8"&gt;
        &lt;h4 style="color: #ECCACB;"&gt;🎀 Tentang BUNNYPOP&lt;/h4&gt;
        &lt;p&gt;&lt;strong&gt;BUNNYPOP&lt;/strong&gt; adalah platform e-commerce aesthetic yang dibangun dengan Laravel framework.&lt;/p&gt;
        
        &lt;h5 style="color: #ECCACB;"&gt;🛠️ Teknologi yang Digunakan&lt;/h5&gt;
        &lt;ul&gt;
            &lt;li&gt;Laravel 10&lt;/li&gt;
            &lt;li&gt;Bootstrap 5&lt;/li&gt;
            &lt;li&gt;MySQL&lt;/li&gt;
            &lt;li&gt;Font Awesome&lt;/li&gt;
        &lt;/ul&gt;
        
        &lt;h5 style="color: #ECCACB;"&gt;🎯 Fitur Utama&lt;/h5&gt;
        &lt;ul&gt;
            &lt;li&gt;Dual Role (Admin &amp; Guest)&lt;/li&gt;
            &lt;li&gt;CRUD Products&lt;/li&gt;
            &lt;li&gt;Shopping Cart&lt;/li&gt;
            &lt;li&gt;Payment System&lt;/li&gt;
            &lt;li&gt;Dynamic Content&lt;/li&gt;
        &lt;/ul&gt;
    &lt;/div&gt;
&lt;/div&gt;</pre>
                            </div>

                            <div class="mb-3">
                                <h6>Dynamic Photo Template:</h6>
                                <pre class="bg-dark text-light p-3 rounded small">
@{{-- Gunakan template ini untuk foto yang diupload dinamis --}}
@{{-- Foto akan otomatis tampil setelah diupload --}}

&lt;div class="text-center"&gt;
    @{{-- Foto akan otomatis tampil di sini setelah diupload --}}
    &lt;h3&gt;Syarifatul Azkiya Alganjari&lt;/h3&gt;
    &lt;p class="mb-1"&gt;&lt;strong&gt;NIM:&lt;/strong&gt; 241011701321&lt;/p&gt;
    &lt;p class="mb-1"&gt;&lt;strong&gt;Prodi:&lt;/strong&gt; Sistem Informasi&lt;/p&gt;
    &lt;p class="mb-0"&gt;&lt;strong&gt;Kelas:&lt;/strong&gt; 03SIFP014&lt;/p&gt;
&lt;/div&gt;

&lt;div class="mt-5"&gt;
    &lt;h4 style="color: #ECCACB;"&gt;📋 Tentang Project&lt;/h4&gt;
    &lt;p&gt;Project UAS Pemrograman Web Framework - BUNNYPOP E-commerce&lt;/p&gt;
&lt;/div&gt;</pre>
                                <small class="text-muted">* Template ini akan otomatis menampilkan foto yang diupload</small>
                            </div>
                        </div>
                    </div>

                    <!-- Current Preview -->
                    <div class="card product-card mt-3">
                        <div class="card-body">
                            <h5 class="card-title">Current Preview</h5>
                            <div class="border rounded p-3 bg-light" style="max-height: 300px; overflow-y: auto;">
                                @if($about)
                                    {!! Str::limit(strip_tags($about), 200) !!}...
                                @else
                                    <p class="text-muted">No content set. The default about template will be displayed.</p>
                                @endif
                            </div>
                            <div class="mt-2 text-center">
                                <a href="{{ route('about') }}" target="_blank" class="btn btn-sm btn-bunny-outline">
                                    <i class="fas fa-external-link-alt"></i> View Full Page
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Photo Instructions -->
                    <div class="card product-card mt-3">
                        <div class="card-body">
                            <h6 class="card-title">📸 Photo Instructions</h6>
                            <ul class="small text-muted mb-0">
                                <li>Upload foto dengan format JPG/PNG</li>
                                <li>Ukuran maksimal 2MB</li>
                                <li>Rasio 1:1 (persegi) recommended</li>
                                <li>Foto akan disimpan di: <code>/storage/app/public/about/</code></li>
                                <li>Nama file akan di-generate otomatis</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
pre {
    white-space: pre-wrap;
    word-wrap: break-word;
    font-size: 0.75rem;
    line-height: 1.2;
}
</style>

<script>
// Auto-preview photo sebelum upload
document.getElementById('about_photo').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            // Tampilkan preview
            const previewArea = document.querySelector('.photo-preview');
            if (!previewArea) {
                const uploadSection = document.querySelector('[for="about_photo"]').parentNode;
                const previewDiv = document.createElement('div');
                previewDiv.className = 'mt-3 photo-preview';
                previewDiv.innerHTML = `
                    <p class="mb-1">Preview:</p>
                    <img src="${e.target.result}" class="img-thumbnail" style="width: 100px; height: 100px; object-fit: cover;">
                `;
                uploadSection.appendChild(previewDiv);
            } else {
                previewArea.querySelector('img').src = e.target.result;
            }
        }
        reader.readAsDataURL(file);
    }
});
</script>
@endsection