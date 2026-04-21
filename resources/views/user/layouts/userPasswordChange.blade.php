@extends('layouts.app')

@section('content')
<main class="pt-90">
    <div class="mb-4 pb-4"></div>
    <section class="my-account container">
        <h2 class="page-title">Change Password</h2>
        <div class="row">
            <div class="col-lg-3">
                @include('user.include.sidebar')
            </div>
            <div class="col-lg-9">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
                @endif
                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show">{{ session('error') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
                @endif

                <div style="background:#fff;padding:30px;border-radius:10px;box-shadow:0 2px 8px rgba(0,0,0,0.05);">
                    <h5 style="font-weight:600;margin-bottom:25px;color:#333;">Update Your Password</h5>

                    <form method="POST" action="{{ route('change.password') }}">
                        @csrf
                        <div class="form-group mb-3">
                            <label style="font-weight:500;margin-bottom:6px;display:block;">Current Password <span style="color:red;">*</span></label>
                            <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" placeholder="Enter current password">
                            @error('current_password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-group mb-3">
                            <label style="font-weight:500;margin-bottom:6px;display:block;">New Password <span style="color:red;">*</span></label>
                            <input type="password" name="new_password" class="form-control @error('new_password') is-invalid @enderror" placeholder="Minimum 8 characters">
                            @error('new_password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-group mb-4">
                            <label style="font-weight:500;margin-bottom:6px;display:block;">Confirm New Password <span style="color:red;">*</span></label>
                            <input type="password" name="new_confirm_password" class="form-control @error('new_confirm_password') is-invalid @enderror" placeholder="Repeat new password">
                            @error('new_confirm_password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <button type="submit" class="btn site-btn">Change Password</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
