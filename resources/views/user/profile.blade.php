@extends('layouts.app')
@section('content')

<main class="pt-90">
    <div class="mb-4 pb-4"></div>
    <section class="my-account container">
        <h2 class="page-title">My Account</h2>
        <div class="row">
            <div class="col-lg-3">
                @include('user.include.sidebar')
            </div>
            <div class="col-lg-9">
                <div class="page-content my-account__edit">

                    <h4 class="mb-4" style="font-weight:600;">Profile Settings</h4>

                    <form action="{{ route('user-profile-update', $profile->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Personal Info --}}
                        <div class="mb-4">
                            <h6 style="font-weight:700;text-transform:uppercase;letter-spacing:.5px;font-size:12px;color:#888;border-bottom:1px solid #f0f0f0;padding-bottom:8px;">Personal Information</h6>
                            <div class="row mt-3">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" style="font-weight:600;font-size:14px;">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name', $profile->name) }}" placeholder="Your full name" required>
                                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" style="font-weight:600;font-size:14px;">Email Address</label>
                                    <input type="email" class="form-control" value="{{ $profile->email }}" disabled style="background:#f8f8f8;color:#999;">
                                    <small class="text-muted">Email cannot be changed.</small>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" style="font-weight:600;font-size:14px;">Phone Number</label>
                                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                                        value="{{ old('phone', $profile->phone ?? '') }}" placeholder="e.g. 9800000000">
                                    @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>

                        {{-- Address Info --}}
                        <div class="mb-4">
                            <h6 style="font-weight:700;text-transform:uppercase;letter-spacing:.5px;font-size:12px;color:#888;border-bottom:1px solid #f0f0f0;padding-bottom:8px;">Address</h6>
                            <div class="row mt-3">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" style="font-weight:600;font-size:14px;">House / Flat No.</label>
                                    <input type="text" name="house_no" class="form-control @error('house_no') is-invalid @enderror"
                                        value="{{ old('house_no', $profile->house_no ?? '') }}" placeholder="e.g. Flat 4B">
                                    @error('house_no')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" style="font-weight:600;font-size:14px;">City</label>
                                    <input type="text" name="city" class="form-control @error('city') is-invalid @enderror"
                                        value="{{ old('city', $profile->city ?? '') }}" placeholder="e.g. Kathmandu">
                                    @error('city')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" style="font-weight:600;font-size:14px;">Postal Code</label>
                                    <input type="text" name="postal_code" class="form-control @error('postal_code') is-invalid @enderror"
                                        value="{{ old('postal_code', $profile->postal_code ?? '') }}" placeholder="e.g. 44600">
                                    @error('postal_code')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label" style="font-weight:600;font-size:14px;">Full Address</label>
                                    <input type="text" name="address" class="form-control @error('address') is-invalid @enderror"
                                        value="{{ old('address', $profile->address ?? '') }}" placeholder="Street / locality">
                                    @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn site-btn" style="background:#7fba00;color:#fff;padding:12px 36px;border:none;border-radius:4px;font-weight:600;">
                            Save Changes
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </section>
</main>

@endsection
