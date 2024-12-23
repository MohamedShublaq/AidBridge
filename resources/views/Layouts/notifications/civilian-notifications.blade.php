<li class="nav-item dropdown no-arrow mx-1">
    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdownCivilian" role="button"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-bell fa-fw"></i>
        <!-- Counter - Alerts -->
        <span class="badge badge-danger badge-counter"
            id="count-notification-civilian">{{ auth('web')->user()->unreadNotifications()->count() }}</span>
    </a>
    <!-- Dropdown - Alerts -->
    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
        aria-labelledby="alertsDropdownCivilian">
        <h6 class="dropdown-header">
            Notifications
        </h6>
        <div id="push-notification-civilian">

            @foreach (auth('web')->user()->unreadNotifications as $notification)

                {{-- Notifications for New Aid --}}
                @if ($notification->type == 'NewAidNotification')
                    <a class="dropdown-item d-flex align-items-center"
                        href="{{ $notification->data['showAidLink'] }}">
                        <div class="mr-3">
                            <div>
                                <i class="fas
                                    {{ $notification->data['aidType'] == App\Models\Aid::NUTRITIONAL ? 'fa-utensils' : '' }}
                                    {{ $notification->data['aidType'] == App\Models\Aid::CASH ? 'fa-money-bill-wave' : '' }}
                                    {{ $notification->data['aidType'] == App\Models\Aid::MEDICAL ? 'fa-medkit' : '' }}
                                    fa-2x text-success"></i>
                            </div>
                        </div>
                        <div>
                            <div class="small text-info">{{ $notification->created_at->format('F d, Y') }}
                            </div>
                            <span class="font-weight-bold">
                                Submit your application now to request "{{ $notification->data['aidName'] }}" from "{{ $notification->data['ngoName'] }}".
                            </span>
                        </div>
                    </a>
                @endif

                {{-- Notifications for Approve Request --}}
                @if($notification->type == 'ApproveAidRequestNotification')
                    <a class="dropdown-item d-flex align-items-center" href="{{ $notification->data['showDistributionLink'] }}">
                        <div class="mr-3">
                            <div class="icon-circle bg-success">
                                <i class="fas fa-check text-white"></i>
                            </div>
                        </div>
                        <div>
                            <div class="small text-info">{{ $notification->created_at->format('F d, Y') }}</div>
                            <span class="font-weight-bold">
                                "{{ $notification->data['ngoName'] }}" was approved your reqest for "{{ $notification->data['aidName'] }}".
                            </span>
                        </div>
                    </a>
                @endif

                {{-- Notifications for Reject Request --}}
                @if($notification->type == 'RejectAidRequestNotification')
                    <div class="dropdown-item d-flex align-items-center">
                        <div class="mr-3">
                            <div class="icon-circle bg-danger">
                                <i class="fas fa-times text-white"></i>
                            </div>
                        </div>
                        <div>
                            <div class="small text-info">{{ $notification->created_at->format('F d, Y') }}</div>
                            <span class="font-weight-bold">
                                "{{ $notification->data['ngoName'] }}" was rejected your reqest for "{{ $notification->data['aidName'] }}".
                            </span>
                        </div>
                    </div>
                @endif

                {{-- Notifications for Unavailable Quantity --}}
                @if($notification->type == 'UnvailableAidRequestNotification')
                    <div class="dropdown-item d-flex align-items-center">
                        <div class="mr-3">
                            <div class="icon-circle bg-warning">
                                <i class="fas fa-exclamation-circle text-white"></i>
                            </div>
                        </div>
                        <div>
                            <div class="small text-info">{{ $notification->created_at->format('F d, Y') }}</div>
                            <span class="font-weight-bold">
                                The aid "{{ $notification->data['aidName'] }}" is no longer available.
                                Please wait for new aids from "{{ $notification->data['ngoName'] }}" soon.
                            </span>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        @if (auth('web')->user()->unreadNotifications()->count() == 0)
            <div class="dropdown-item text-center text-danger" id="no-notifications-civilian">No Notifications</div>
        @endif
    </div>
</li>
{{-- Add scroll in notifications if their count > 3 --}}
<script>
    document.getElementById('alertsDropdownCivilian').addEventListener('click', function () {
        const scrollContainer = document.getElementById('push-notification-civilian');
        const notificationCount = scrollContainer.children.length;
        if (notificationCount > 3) {
            scrollContainer.classList.add('notification-scroll');
        } else {
            scrollContainer.classList.remove('notification-scroll');
        }
        scrollContainer.scrollTop = 0;
    });
</script>
