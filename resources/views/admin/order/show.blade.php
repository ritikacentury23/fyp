@extends('admin.includes.main')
@section('content')
<main class="content">
    <div class="container-fluid p-0">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3 d-inline align-middle">Order Edit</h1>
            <a href="{{ route('category.index') }}" class="btn btn-primary"><i class="align-middle"
                    data-feather="arrow-left"></i> Back</a>
        </div>

        <div class="row">
            <div class="card shadow mb-4 w-100">
                <div class="row">
                    <div class="col-md-12">
                        @include('admin.includes.notification')
                    </div>
                </div>

                <div class="card-body p-4">
                    @if($order)
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>S.N.</th>
                                <th>Order No.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Quantity</th>

                                <th>Total Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$order->id}}</td>
                                <td>{{$order->order_number}}</td>
                                <td>{{$order->first_name}} {{$order->last_name}}</td>
                                <td>{{$order->email}}</td>
                                <td>{{$order->quantity}}</td>

                                <td>Rs{{number_format($order->total_amount,2)}}</td>
                                <td>
                                    @if($order->status=='new')
                                    <span class="badge bg-primary">{{$order->status}}</span>
                                    @elseif($order->status=='process')
                                    <span class="badge bg-warning">{{$order->status}}</span>
                                    @elseif($order->status=='delivered')
                                    <span class="badge bg-success">{{$order->status}}</span>
                                    @else
                                    <span class="badge bg-danger">{{$order->status}}</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('order.edit',$order->id)}}"
                                        class="btn btn-sm btn-outline-info me-2" data-toggle="tooltip" title="edit"
                                        data-placement="bottom"><i class="align-middle" data-feather="edit"></i></a>

                                    <form method="POST" action="{{ route('order.destroy', [$order->id]) }}"
                                        onsubmit="return confirm('Are you sure you want to delete this Order?');">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                            <i class="align-middle" data-feather="trash"></i>
                                        </button>
                                    </form>
                                </td>

                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-body p-4">
                    <section class="confirmation_part section_padding">
                        <div class="order_boxes">
                            <div class="row">

                                <div class="col-lg-4 col-lx-4">
                                    <div class="shipping-info">
                                        <h4 class="text-center pb-4">SHIPPING INFORMATION</h4>
                                        <table class="table">
                                            <tr class="">
                                                <td>Full Name</td>
                                                <td> : {{$order->first_name}} {{$order->last_name}}</td>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td> : {{$order->email}}</td>
                                            </tr>
                                            <tr>
                                                <td>Phone No.</td>
                                                <td> : {{$order->phone}}</td>
                                            </tr>
                                            <tr>
                                                <td>Address</td>
                                                <td> : {{$order->address1}}, {{$order->address2}}</td>
                                            </tr>
                                          
                                            <tr>
                                                <td>Post Code</td>
                                                <td> : {{$order->post_code}}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>



                                <div class="col-lg-4 col-lx-4">
                                    <div class="shipping-info">
                                        <h4 class="text-center pb-4">ORDER DETAILS</h4>
                                        <div class="table-responsive"
                                            style="max-height: 400px; overflow-y: auto; overflow-x: auto;">
                                            <table class="table">
                                                <thead
                                                    style="position: sticky; top: 0; background: white; z-index: 10;">
                                                    <tr>
                                                        <th style="width: 70px;">No.</th>
                                                        <th>Item</th>
                                                        <th>Image</th>
                                                        <th>Price</th>
                                                        <th>Quantity</th>
                                                        <th class="text-end" style="width: 120px;">Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php $totalAmount = 0; @endphp
                                                    @foreach($order->orderItems as $key => $item)
                                                    @php
                                                    $itemTotal = $item->price * $item->quantity;

                                                    $totalAmount += $itemTotal;
                                                    @endphp
                                                    <tr>
                                                        <th scope="row">{{ $key + 1 }}</th>
                                                        {{-- Auto-incrementing item number --}}
                                                        <td>
                                                            <div>
                                                                <p class="text-truncate font-size-14 mb-1">
                                                                    {{ $item->product->title }}</p>
                                                                <div class="text-sm text-muted mt-1">
                                                                    @if(@$item->color)
                                                                    <div><strong>Color:</strong> <span
                                                                            style="display:inline-block;width:15px;height:15px;background-color:{{ $item->color }};border:1px solid #ccc;border-radius:50%;margin-left:5px;"></span>
                                                                    </div>
                                                                    @endif
                                                                    @if(@$item->size)
                                                                    <div><strong>Size:</strong> {{ $item->size }}</div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <img src="{{ asset($item->product->photo) }}"
                                                                alt="Product Image" class="img-thumbnail"
                                                                style="width: 50px; height: 50px;">
                                                        </td>
                                                        <td>Rs{{ number_format($item->price, 2) }}</td>

                                                        <td>{{ $item->quantity }}</td>
                                                        <td class="text-end">Rs{{ number_format($itemTotal, 2) }}</td>
                                                    </tr>
                                                    @endforeach
                                                    <tr>
                                                        <th scope="row" colspan="5" class="border-0 text-end">Total</th>
                                                        <td class="border-0 text-end">
                                                            <p class="m-0">Rs{{ number_format($totalAmount, 2) }}</p>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-lx-4">
                                    <div class="order-info">
                                        <h4 class="text-center pb-4">ORDER INFORMATION</h4>
                                        <table class="table">
                                            <tr class="">
                                                <td>Order Number</td>
                                                <td> : {{$order->order_number}}</td>
                                            </tr>
                                            <tr>
                                                <td>Order Date</td>
                                                <td> : {{$order->created_at->format('D d M, Y')}} at
                                                    {{$order->created_at->format('g : i a')}} </td>
                                            </tr>
                                            <tr>
                                                <td>Quantity</td>
                                                <td> : {{$order->quantity}}</td>
                                            </tr>
                                            <tr>
                                                <td>Order Status</td>
                                                <td> : {{$order->status}}</td>
                                            </tr>


                                            <tr>
                                                <td>Total Amount</td>
                                                <td> : Rs {{number_format($order->total_amount,2)}}</td>
                                            </tr>
                                            <tr>
                                                <td>Payment Method</td>
                                                <td> : @if($order->payment_method=='cod') Cash on Delivery @else Khalti
                                                    @endif</td>
                                            </tr>
                                            <tr>
                                                <td>Payment Status</td>
                                                <td> : {{$order->payment_status}}</td>
                                            </tr>

                                        </table>
                                    </div>
                                </div>



                            </div>
                        </div>
                    </section>
                    @endif
                </div>
            </div>
        </div>
    </div>
</main>




@endsection