@extends('admin.includes.main')
@section('content')
<main class="content">
    <div class="container-fluid p-0">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3 d-inline align-middle">Contact Message Details</h1>
            <a href="{{ route('admin.contacts.index') }}" class="btn btn-primary"><i class="align-middle"
                    data-feather="arrow-left"></i> Back</a>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow mb-4">
                    <div class="row">
                        <div class="col-md-12">
                            @include('admin.includes.notification')
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="message-details">
                            <div class="detail-item mb-4">
                                <h6 class="text-muted mb-2">Sender Name</h6>
                                <p class="h5">{{ $contact->name }}</p>
                            </div>

                            <div class="detail-item mb-4">
                                <h6 class="text-muted mb-2">Email Address</h6>
                                <p class="h5">
                                    <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a>
                                </p>
                            </div>

                            <div class="detail-item mb-4">
                                <h6 class="text-muted mb-2">Status</h6>
                                <p>
                                    @if($contact->status === 'unread')
                                        <span class="badge bg-danger">Unread</span>
                                    @elseif($contact->status === 'read')
                                        <span class="badge bg-warning">Read</span>
                                    @else
                                        <span class="badge bg-success">Replied</span>
                                    @endif
                                </p>
                            </div>

                            <div class="detail-item mb-4">
                                <h6 class="text-muted mb-2">Received Date & Time</h6>
                                <p class="h5">{{ $contact->created_at->format('M d, Y H:i A') }}</p>
                            </div>

                            <hr>

                            <div class="detail-item">
                                <h6 class="text-muted mb-3">Message</h6>
                                <div class="message-content p-3 bg-light rounded" style="border-left: 4px solid #7fad39;">
                                    <p>{{ $contact->message }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Actions</h5>
                    </div>
                    <div class="card-body">
                        @if($contact->status !== 'replied')
                        <form action="{{ route('admin.contacts.mark-as-replied', $contact->id) }}" method="POST" class="mb-3">
                            @csrf
                            <button type="submit" class="btn btn-success w-100 mb-2">
                                <i class="align-middle" data-feather="check-circle"></i> Mark as Replied
                            </button>
                        </form>
                        @else
                        <p class="text-success">
                            <i class="align-middle" data-feather="check-circle"></i> Already marked as replied
                        </p>
                        @endif

                        <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" 
                            onsubmit="return confirm('Are you sure you want to delete this message?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="align-middle" data-feather="trash-2"></i> Delete Message
                            </button>
                        </form>
                    </div>
                </div>

                <div class="card shadow">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Quick Reply</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted small">You can reply to this message using your email client:</p>
                        <a href="mailto:{{ $contact->email }}?subject=Re: Contact Form Message" class="btn btn-primary w-100">
                            <i class="align-middle" data-feather="mail"></i> Send Email Reply
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
    .message-details {
        padding: 20px 0;
    }

    .detail-item {
        border-bottom: 1px solid #eee;
        padding-bottom: 15px;
    }

    .detail-item:last-child {
        border-bottom: none;
    }

    .message-content {
        line-height: 1.8;
        color: #333;
    }

    .message-content p {
        margin: 0;
        white-space: pre-wrap;
        word-wrap: break-word;
    }
</style>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    feather.replace();
});
</script>
@endpush
@endsection