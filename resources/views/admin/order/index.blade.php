@extends('admin.includes.main')
@section('content')
<main class="content">
    <div class="container-fluid p-0">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3 d-inline align-middle">Order List</h1>
          
        </div>

        <div class="row">
            <div class="card shadow mb-4 w-100">
                <div class="row">
                    <div class="col-md-12">
                        @include('admin.includes.notification')
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table table-bordered" id="banner-dataTable" width="100%" cellspacing="0">
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
                                @foreach($orders as $order)
                                @php
                                $shipping_charge=DB::table('shippings')->where('id',$order->shipping_id)->pluck('price');
                                @endphp
                                <tr>
                                    <td>{{$order->id}}</td>
                                    <td>{{$order->order_number}}</td>
                                    <td>{{$order->first_name}} {{$order->last_name}}</td>
                                    <td>{{$order->email}}</td>
                                    <td>{{$order->quantity}}</td>

                                    </td>
                                    <td>Rs {{number_format($order->total_amount,2)}}</td>
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


                                        <a href="{{route('order.show',$order->id)}}"
                                            class="btn btn-sm btn-outline-info me-2" data-toggle="tooltip" title="view"
                                            data-placement="bottom"><i class="align-middle" data-feather="eye"></i></a>
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
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    feather.replace();
});
</script>
@endpush
@endsection