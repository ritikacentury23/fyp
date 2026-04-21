 @extends('layouts.app')

@section('content')
<style>
<style>.table> :not(caption)>tr>th {
    padding: 0.625rem 1.5rem 0.625rem !important;
    background-color: #6a6e51 !important;
}

.table>tr>td {
    padding: 0.625rem 1.5rem 0.625rem !important;
}

.table-bordered> :not(caption)>tr>th,
.table-bordered> :not(caption)>tr>td {
    border-width: 1px 1px;
    border-color: #6a6e51;
}

.table> :not(caption)>tr>td {
    padding: 0.8rem 1rem !important;
}

.bg-success {
    background-color: #40c710 !important;
}

.bg-danger {
    background-color: #f44032 !important;
}

.bg-warning {
    background-color: #f5d700 !important;
    color: #000;
}
</style>

<main class="pt-90" style="padding-top: 0px">
    <div class="mb-4 pb-4"></div>
    <section class="my-account container">
        <h2 class="page-title">Orders</h2>
        <div class="row">
            <div class="col-lg-2">
                @include('user.include.sidebar')
            </div>
            <div class="col-lg-10">
                <div class="wg-table table-all-user">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 80px">OrderNo</th>

                                    <th class="text-center">Name</th>
                                    <th class="text-center">
                                        Email
                                    </th>
                                    <th class="text-center">QTY</th>
                                    <th class="text-center">Total Amount</th>

                                    <th class="text-center">Status</th>
                                    <th class="text-center">
                                        Action
                                    </th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                @php
                                $shipping_charge = DB::table('shippings')->where('id',
                                $order->shipping_id)->pluck('price');
                                @endphp
                                <tr>

                                    <td class="text-center">{{$order->order_number}}</td>
                                    <td class="text-center">
                                        {{$order->first_name}} {{$order->last_name}}
                                    </td>
                                    <td class="text-center">
                                        {{$order->email}} 
                                    </td>
                                    <td class="text-center">
                                        {{$order->quantity}}
                                    </td>
                                    <td class="text-center">Rs {{number_format($order->total_amount,2)}}</td>


                                    <td class="text-center">
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

                                    <td class="text-center">
                                        <a href="{{ route('user.order.show',[$order->id]) }}">
                                            <div class="list-icon-function view-icon">
                                                <div class="item eye">
                                                    <i class="fa fa-eye"></i>
                                                </div>
                                            </div>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination"></div>
            </div>
        </div>
    </section>
</main>

@endsection