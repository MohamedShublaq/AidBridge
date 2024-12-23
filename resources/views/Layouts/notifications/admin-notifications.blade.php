<li class="nav-item dropdown no-arrow mx-1">
    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdownAdmin" role="button"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-bell fa-fw"></i>
        <!-- Counter - Alerts -->
        <span class="badge badge-danger badge-counter"
            id="count-notification-admin">{{ auth('admin')->user()->unreadNotifications()->count() }}</span>
    </a>
    <!-- Dropdown - Alerts -->
    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
        aria-labelledby="alertsDropdownAdmin">
        <h6 class="dropdown-header">
            Notifications
        </h6>
        <div id="push-notification-admin">

            @foreach (auth('admin')->user()->unreadNotifications as $notification)

                {{-- Notifications for New Deletion Requests --}}
                @if ($notification->type == 'DeletionRequestNotification')
                    <div class="dropdown-item d-flex align-items-center">
                        <div class="mr-3">
                            <div class="icon-circle bg-warning">
                                <i class="fas fa-question text-white"></i>
                            </div>
                        </div>
                        <div>
                            <div class="small text-info">{{ $notification->created_at->format('F d, Y') }}
                            </div>
                            <span class="font-weight-bold">Admin {{ $notification->data['requester'] }}
                                wants to
                                delete the {{ $notification->data['deletableType'] }}
                                {{ $notification->data['deletableName'] }}. </span>

                            <form action="{{ $notification->data['responseDeletionLink'] }}" method="POST"
                                class="mt-2">
                                @csrf
                                <input type="hidden" name="notification_id"
                                    value="{{ $notification->id }}">
                                <input type="hidden" name="deletion_request_id"
                                    value="{{ $notification->data['deletionRequestId'] }}">
                                <button type="submit" name="response" value="1"
                                    class="btn btn-success btn-sm">Approve</button>
                                <button type="submit" name="response" value="0"
                                    class="btn btn-danger btn-sm">Reject</button>
                            </form>
                        </div>
                    </div>

                {{-- Notifications for Approved/Rejected Requests --}}
                @elseif ($notification->type == 'DeletionResponseNotification')
                    <a class="dropdown-item d-flex align-items-center"
                        href="{{ $notification->data['showResponsesLink'] }}">
                        <div class="mr-3">
                            <div
                                class="icon-circle {{ $notification->data['response'] == App\Models\DeletionResponse::APPROVED ? 'bg-success' : 'bg-danger' }}">
                                <i
                                    class="fas fa-{{ $notification->data['response'] == App\Models\DeletionResponse::APPROVED ? 'check' : 'times' }} }} text-white"></i>
                            </div>
                        </div>
                        <div>
                            <div class="small text-info">{{ $notification->created_at->format('F d, Y') }}
                            </div>
                            <span class="font-weight-bold">
                                Your request for deleting
                                {{ $notification->data['deletableType'] }}
                                {{ $notification->data['deletableName'] }}
                                was
                                {{ $notification->data['response'] == App\Models\DeletionResponse::APPROVED ? 'approved' : 'rejected' }}.
                            </span>
                        </div>
                    </a>

                {{-- Notifications for Contacts --}}
                @elseif ($notification->type == 'ContactNotification')
                    <a class="dropdown-item d-flex align-items-center"
                        href="{{ $notification->data['showContactLink'] }}">
                        <div class="mr-3">
                            <div>
                                <i class="fas fa-envelope fa-2x text-info"></i>
                            </div>
                        </div>
                        <div>
                            <div class="small text-info">{{ $notification->created_at->format('F d, Y') }}
                            </div>
                            <span class="font-weight-bold">
                                New Contact From {{ $notification->data['name'] }}
                            </span>
                        </div>
                    </a>
                @endif
            @endforeach
        </div>
        @if (auth('admin')->user()->unreadNotifications()->count() == 0)
            <div class="dropdown-item text-center text-danger" id="no-notifications-admin">No Notifications</div>
        @endif
    </div>
</li>
{{-- Add scroll in notifications if their count > 3 --}}
<script>
    document.getElementById('alertsDropdownAdmin').addEventListener('click', function () {
        const scrollContainer = document.getElementById('push-notification-admin');
        const notificationCount = scrollContainer.children.length;
        if (notificationCount > 3) {
            scrollContainer.classList.add('notification-scroll');
        } else {
            scrollContainer.classList.remove('notification-scroll');
        }
        scrollContainer.scrollTop = 0;
    });
</script>
