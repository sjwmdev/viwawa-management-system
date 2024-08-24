@extends('backend.layout.master')

@section('content')
    <div class="container p-4 shadow-sm rounded" style="background-color: #f0f4f8;">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-dark">Arifa</h1>
            @if ($notifications->count() > 1)
                <button id="clearAllBtn" class="btn btn-danger btn-sm" onclick="clearAllNotifications()">Futa Arifa
                    Zote</button>
            @endif
        </div>
        @if ($notifications->isEmpty())
            <div class="alert alert-info">Hakuna arifa zilizopatikana.</div>
        @else
            <ul class="list-group" id="notificationList">
                @foreach ($notifications as $notification)
                    <li class="list-group-item mb-3 shadow-sm" id="notification-{{ $notification->id }}">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold text-primary">{{ $notification->title }}</div>
                                <p class="mb-1">{{ $notification->message }}</p>
                                <small class="text-muted">Aina:
                                    {{ ucfirst(str_replace('_', ' ', $notification->type)) }}</small>
                            </div>
                            <div class="d-flex flex-column text-end">
                                <div class="d-flex align-items-center">
                                    <span
                                        class="badge bg-secondary-c rounded-pill-0 p-1">{{ $notification->created_at->diffForHumans() }}</span>
                                    <button type="button" class="close ms-2" aria-label="Close"
                                        onclick="removeNotification({{ $notification->id }})"
                                        style="font-size: 1.2rem; line-height: 1; margin-left: 10px">
                                        <span aria-hidden="true" title="remove">&times;</span>
                                    </button>
                                </div>
                                @if ($notification->read_at)
                                    <div class="mt-1">
                                        <span class="badge bg-success rounded-pill">Imesomwa</span>
                                    </div>
                                @else
                                    <div class="mt-1">
                                        <span class="badge bg-danger rounded-pill">Haijasomwa</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        @can('common.notifications.index')
                            <button class="btn btn-link mt-2" type="button" data-toggle="collapse"
                                data-target="#collapse{{ $notification->id }}" aria-expanded="false"
                                aria-controls="collapse{{ $notification->id }}" onclick="markAsRead({{ $notification->id }})">
                                Tazama Maelezo
                            </button>
                        @endcan

                        <div class="collapse mt-2" id="collapse{{ $notification->id }}">
                            <div class="card card-body">
                                <p><strong>Maelezo ya Arifa:</strong></p>
                                <p>{{ $notification->message }}</p>
                                <p><strong>Aina:</strong> {{ ucfirst(str_replace('_', ' ', $notification->type)) }}</p>
                                <p><strong>Imetengenezwa Tarehe:</strong>
                                    {{ $notification->created_at->format('M d, Y H:i:s') }}</p>
                                <p><strong>Imesomwa Tarehe:</strong>
                                    {{ $notification->read_at ? $notification->read_at->format('M d, Y H:i:s') : 'Haijasomwa' }}
                                </p>
                                @hasrole('admin')
                                    <p><strong>Taarifa za Mfano:</strong></p>
                                    <ul>
                                        @foreach (json_decode($notification->model_info, true) as $key => $value)
                                            <li><strong>{{ ucfirst(str_replace('_', ' ', $key)) }}:</strong>
                                                {{ $value }}</li>
                                        @endforeach
                                    </ul>
                                @endhasrole
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection

<!-- Custom css -->
@section('css')
    <style>
        .container {
            max-width: 900px;
        }

        h1 {
            color: var(--matisse);
        }

        .list-group-item {
            border-radius: 0.5rem;
            background-color: #ffffff;
            position: relative;
        }

        .list-group-item .fw-bold {
            font-size: 1.2rem;
        }

        .badge {
            font-size: 0.75rem;
            color: #666;
        }

        .badge.bg-secondary-c {
            font-size: 0.8rem;
        }

        .badge.bg-success {
            background-color: var(--tulip-tree);
        }

        .badge.bg-danger {
            background-color: var(--cabaret);
        }

        .btn-link {
            color: var(--dodger-blue);
            text-decoration: none;
            padding: 0;
        }

        .btn-link:hover {
            color: var(--cabaret);
            text-decoration: underline;
        }

        .card {
            margin-bottom: 1rem;
            border: none;
        }

        .close {
            background: none;
            border: none;
            font-size: 1.2rem;
            line-height: 1;
            margin-left: 10px;
        }
    </style>
@endsection

<!-- Custom js -->
@section('js')
    <script>
        function clearAllNotifications() {
            if (confirm('Una uhakika unataka kufuta arifa zote?')) {
                fetch('{{ route('common.notifications.clearAll') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById('notificationList').innerHTML =
                                '<div class="alert alert-info">Hakuna arifa zilizopatikana.</div>';
                        } else {
                            alert('Kuna tatizo limejitokeza, tafadhali jaribu tena.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Kuna tatizo limejitokeza, tafadhali jaribu tena.');
                    });
            }
        }

        function markAsRead(notificationId) {
            fetch(`/notifications/mark-as-read/${notificationId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById(`notification-${notificationId}`).querySelector('.badge.bg-danger')
                            .classList.replace('bg-danger', 'bg-success');
                        document.getElementById(`notification-${notificationId}`).querySelector('.badge.bg-success')
                            .textContent = 'Imesomwa';
                    }
                });
        }

        function removeNotification(notificationId) {
            fetch(`/notifications/remove-notification/${notificationId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById(`notification-${notificationId}`).remove();
                    }
                });
        }
    </script>
@endsection
