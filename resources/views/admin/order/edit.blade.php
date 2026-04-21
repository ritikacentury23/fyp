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
                    <form action="{{route('order.update',$order->id)}}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="status">Status :</label>
                            <select name="status" id="" class="form-control">
                                <option value="new"
                                    {{($order->status=='delivered' || $order->status=="process" || $order->status=="cancel") ? 'disabled' : ''}}
                                    {{(($order->status=='new')? 'selected' : '')}}>New</option>
                                <option value="process"
                                    {{($order->status=='delivered'|| $order->status=="cancel") ? 'disabled' : ''}}
                                    {{(($order->status=='process')? 'selected' : '')}}>process</option>
                                <option value="delivered" {{($order->status=="cancel") ? 'disabled' : ''}}
                                    {{(($order->status=='delivered')? 'selected' : '')}}>Delivered</option>
                                <option value="cancel" {{($order->status=='delivered') ? 'disabled' : ''}}
                                    {{(($order->status=='cancel')? 'selected' : '')}}>Cancel</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>




@endsection