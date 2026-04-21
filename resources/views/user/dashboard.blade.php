@extends('layouts.app')

@section('content')
<main class="pt-90">
    <div class="mb-4 pb-4"></div>
    <section class="my-account container">
        <h2 class="page-title">My Dashboard</h2>
        <div class="row">
            <div class="col-lg-3">
                @include('user.include.sidebar')
            </div>
            <div class="col-lg-9">

                {{-- Alerts --}}
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif
                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                {{-- Welcome Banner --}}
                <div class="dashboard-welcome mb-4">
                    <div style="background:linear-gradient(135deg,#7fba00 0%,#4a8f00 100%);border-radius:12px;padding:28px 30px;color:#fff;display:flex;justify-content:space-between;align-items:center;">
                        <div>
                            <h4 style="margin:0 0 6px;font-size:22px;font-weight:700;">Welcome back, {{ Auth::user()->name }}!</h4>
                            <p style="margin:0;opacity:0.85;font-size:14px;">Manage your orders, reviews, and wishlist from your personal dashboard.</p>
                        </div>
                        <div style="font-size:60px;opacity:0.25;"><i class="fa fa-user-circle"></i></div>
                    </div>
                </div>

                {{-- Stats Cards --}}
                <div class="row mb-4">
                    <div class="col-sm-6 col-xl-3 mb-3">
                        <div class="stat-card" style="background:#fff;border-radius:10px;padding:20px;box-shadow:0 2px 12px rgba(0,0,0,0.07);border-left:4px solid #007bff;display:flex;align-items:center;gap:16px;">
                            <div style="background:#e8f0fe;border-radius:50%;width:52px;height:52px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <i class="fa fa-shopping-bag" style="font-size:22px;color:#007bff;"></i>
                            </div>
                            <div>
                                <div style="font-size:28px;font-weight:700;color:#007bff;line-height:1;">{{ $totalOrders }}</div>
                                <div style="font-size:13px;color:#888;margin-top:3px;">Total Orders</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3 mb-3">
                        <div class="stat-card" style="background:#fff;border-radius:10px;padding:20px;box-shadow:0 2px 12px rgba(0,0,0,0.07);border-left:4px solid #ffc107;display:flex;align-items:center;gap:16px;">
                            <div style="background:#fff8e1;border-radius:50%;width:52px;height:52px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <i class="fa fa-clock-o" style="font-size:22px;color:#ffc107;"></i>
                            </div>
                            <div>
                                <div style="font-size:28px;font-weight:700;color:#ffc107;line-height:1;">{{ $pendingOrders }}</div>
                                <div style="font-size:13px;color:#888;margin-top:3px;">Pending Orders</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3 mb-3">
                        <div class="stat-card" style="background:#fff;border-radius:10px;padding:20px;box-shadow:0 2px 12px rgba(0,0,0,0.07);border-left:4px solid #e83e8c;display:flex;align-items:center;gap:16px;">
                            <div style="background:#fce4ec;border-radius:50%;width:52px;height:52px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <i class="fa fa-heart" style="font-size:22px;color:#e83e8c;"></i>
                            </div>
                            <div>
                                <div style="font-size:28px;font-weight:700;color:#e83e8c;line-height:1;">{{ $wishlistCount }}</div>
                                <div style="font-size:13px;color:#888;margin-top:3px;">Wishlist Items</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3 mb-3">
                        <div class="stat-card" style="background:#fff;border-radius:10px;padding:20px;box-shadow:0 2px 12px rgba(0,0,0,0.07);border-left:4px solid #28a745;display:flex;align-items:center;gap:16px;">
                            <div style="background:#e8f5e9;border-radius:50%;width:52px;height:52px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <i class="fa fa-star" style="font-size:22px;color:#28a745;"></i>
                            </div>
                            <div>
                                <div style="font-size:28px;font-weight:700;color:#28a745;line-height:1;">{{ $totalReviews }}</div>
                                <div style="font-size:13px;color:#888;margin-top:3px;">Reviews Given</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Quick Actions --}}
                <div class="row mb-4">
                    <div class="col-12">
                        <div style="background:#fff;border-radius:10px;padding:20px;box-shadow:0 2px 12px rgba(0,0,0,0.07);">
                            <h6 style="font-weight:600;margin-bottom:16px;color:#333;">Quick Actions</h6>
                            <div style="display:flex;flex-wrap:wrap;gap:10px;">
                                <a href="{{ route('user.order.index') }}" style="background:#f0f7e6;color:#4a8f00;padding:10px 18px;border-radius:8px;text-decoration:none;font-size:13px;font-weight:500;display:flex;align-items:center;gap:8px;">
                                    <i class="fa fa-list-alt"></i> My Orders
                                </a>
                                <a href="{{ route('wishlist') }}" style="background:#fce4ec;color:#e83e8c;padding:10px 18px;border-radius:8px;text-decoration:none;font-size:13px;font-weight:500;display:flex;align-items:center;gap:8px;">
                                    <i class="fa fa-heart"></i> My Wishlist
                                </a>
                                <a href="{{ route('user.productreview.index') }}" style="background:#e8f5e9;color:#28a745;padding:10px 18px;border-radius:8px;text-decoration:none;font-size:13px;font-weight:500;display:flex;align-items:center;gap:8px;">
                                    <i class="fa fa-star"></i> My Reviews
                                </a>
                                <a href="{{ route('user-profile') }}" style="background:#e8f0fe;color:#007bff;padding:10px 18px;border-radius:8px;text-decoration:none;font-size:13px;font-weight:500;display:flex;align-items:center;gap:8px;">
                                    <i class="fa fa-user"></i> Edit Profile
                                </a>
                                <a href="{{ route('user.change.password.form') }}" style="background:#fff3e0;color:#f57c00;padding:10px 18px;border-radius:8px;text-decoration:none;font-size:13px;font-weight:500;display:flex;align-items:center;gap:8px;">
                                    <i class="fa fa-lock"></i> Change Password
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Recent Orders --}}
                <div style="background:#fff;border-radius:10px;padding:20px;box-shadow:0 2px 12px rgba(0,0,0,0.07);">
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;">
                        <h6 style="font-weight:600;color:#333;margin:0;">Recent Orders</h6>
                        <a href="{{ route('user.order.index') }}" style="font-size:13px;color:#007bff;text-decoration:none;">View All</a>
                    </div>
                    @if($recentOrders->isEmpty())
                        <div style="text-align:center;padding:30px 0;color:#aaa;">
                            <i class="fa fa-shopping-bag fa-2x mb-2"></i>
                            <p style="margin:0;font-size:14px;">No orders yet. <a href="{{ route('product-grids') }}">Start shopping!</a></p>
                        </div>
                    @else
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" style="font-size:13px;">
                            <thead>
                                <tr>
                                    <th>Order #</th>
                                    <th>Amount</th>
                                    <th>Payment</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentOrders as $order)
                                <tr>
                                    <td><strong>{{ $order->order_number }}</strong></td>
                                    <td>Rs {{ number_format($order->total_amount, 2) }}</td>
                                    <td>
                                        <span class="badge {{ $order->payment_status == 'paid' ? 'bg-success' : 'bg-warning' }}">
                                            {{ ucfirst($order->payment_status ?? 'pending') }}
                                        </span>
                                    </td>
                                    <td>
                                        @php
                                            $statusColors = ['new'=>'bg-primary','process'=>'bg-warning','delivered'=>'bg-success','cancel'=>'bg-danger'];
                                            $color = $statusColors[$order->status] ?? 'bg-secondary';
                                        @endphp
                                        <span class="badge {{ $color }}">{{ ucfirst($order->status) }}</span>
                                    </td>
                                    <td>{{ $order->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <a href="{{ route('user.order.show', $order->id) }}" class="btn btn-sm btn-outline-primary" style="font-size:11px;">View</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>

            </div>
        </div>
    </section>
</main>
@endsection
