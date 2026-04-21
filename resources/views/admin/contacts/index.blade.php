@extends('admin.includes.main')
@section('content')
<main class="content">
    <div class="container-fluid p-0">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3 d-inline align-middle">Contact Messages <span class="badge bg-danger">{{ $unreadCount }}</span></h1>
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
                        @if(count($contacts)>0)
                        <table class="table table-bordered" id="contacts-dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>S.N.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Message</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                   
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($contacts as $contact)
                                <tr class="@if($contact->status === 'unread') table-warning @endif">
                                    <td>{{$contact->id}}</td>
                                    <td>
                                        <strong>{{$contact->name}}</strong>
                                    </td>
                                    <td>
                                        <a href="mailto:{{$contact->email}}">{{$contact->email}}</a>
                                    </td>
                                    <td>
                                        {{ Str::limit($contact->message, 50, '...') }}
                                    </td>
                                    <td>
                                        @if($contact->status === 'unread')
                                            <span class="badge bg-danger">Unread</span>
                                        @elseif($contact->status === 'read')
                                            <span class="badge bg-warning">Read</span>
                                        @else
                                            <span class="badge bg-success">Replied</span>
                                        @endif
                                    </td>
                                    <td>
                                        <small>{{ $contact->created_at->format('M d, Y H:i') }}</small>
                                    </td>
                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-md-12">
                                {{ $contacts->links() }}
                            </div>
                        </div>
                        @else
                        <h6 class="text-center">No contact messages found!!!</h6>
                        @endif
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