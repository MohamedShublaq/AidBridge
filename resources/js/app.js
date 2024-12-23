require('./bootstrap');

//Look at header.blade.php in Layouts

//Admin Notifications
if(role == "admin"){
    window.Echo.private("App.Models.Admin." + adminId).notification((notification) => {

        count = Number($("#count-notification-admin").text());
        count++;
        $("#count-notification-admin").text(count);

        if (count > 0) {
            $("#no-notifications-admin").hide();
        }
        let pushNotificationAdmin = document.getElementById('push-notification-admin');

        // Notifications for Approved/Rejected Requests
        if (notification.type == 'DeletionResponseNotification') {
            let responseClass = notification.response === 1 ? 'bg-success' : 'bg-danger';
            let responseIcon = notification.response === 1 ? 'check' : 'times';
            let responseText = notification.response === 1 ? 'approved' : 'rejected';

            pushNotificationAdmin.insertAdjacentHTML(
                'afterbegin',
                `
                <a class="dropdown-item d-flex align-items-center" href="${notification.showResponsesLink}">
                    <div class="mr-3">
                        <div class="icon-circle ${responseClass}">
                            <i class="fas fa-${responseIcon} text-white"></i>
                        </div>
                    </div>
                    <div>
                        <div class="small text-info">${moment(notification.created_at).format('MMMM D, YYYY')}</div>
                        <span class="font-weight-bold">
                            Your request for deleting ${notification.deletableType} ${notification.deletableName} was ${responseText}.
                        </span>
                    </div>
                </a>
                `
            );
        }

        // Notifications for New Deletion Requests
        if (notification.type == 'DeletionRequestNotification') {
            pushNotificationAdmin.insertAdjacentHTML(
                'afterbegin',
                `
                <div class="dropdown-item d-flex align-items-center">
                    <div class="mr-3">
                        <div class="icon-circle bg-warning">
                            <i class="fas fa-question text-white"></i>
                        </div>
                    </div>
                    <div>
                        <div class="small text-info">${moment(notification.created_at).format('MMMM D, YYYY')}</div>
                        <span class="font-weight-bold">
                            Admin ${notification.requester} wants to delete the ${notification.deletableType} ${notification.deletableName}.
                        </span>
                        <form action="${notification.responseDeletionLink}" method="POST" class="mt-2">
                            <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').content}">
                            <input type="hidden" name="notification_id" value="${notification.id}">
                            <input type="hidden" name="deletion_request_id" value="${notification.deletionRequestId}">
                            <button type="submit" name="response" value="1" class="btn btn-success btn-sm">Approve</button>
                            <button type="submit" name="response" value="0" class="btn btn-danger btn-sm">Reject</button>
                        </form>
                    </div>
                </div>
                `
            );
        }

        // Notifications for Contacts
        if (notification.type == 'ContactNotification') {
            pushNotificationAdmin.insertAdjacentHTML(
                'afterbegin',
                `
                <a class="dropdown-item d-flex align-items-center" href="${notification.showContactLink}">
                    <div class="mr-3">
                        <div>
                            <i class="fas fa-envelope fa-2x text-info"></i>
                        </div>
                    </div>
                    <div>
                        <div class="small text-info">${moment(notification.created_at).format('MMMM D, YYYY')}</div>
                        <span class="font-weight-bold">
                            New Contact From ${notification.name}
                        </span>
                    </div>
                </a>
                `
            );
        }
    });
}


//Civilian Notifications
if(role == "civilian"){
    window.Echo.private("App.Models.User." + civilianId).notification((notification) => {
        count = Number($("#count-notification-civilian").text());
        count++;
        $("#count-notification-civilian").text(count);

        if (count > 0) {
            $("#no-notifications-civilian").hide();
        }
        let pushNotificationCivilian = document.getElementById('push-notification-civilian');

        // Notifications for New Aid
        if (notification.type == 'NewAidNotification') {

            let iconHtml = '';
            let aidType = notification.aidType;

            if (aidType === 1) {
                iconHtml = '<i class="fas fa-utensils fa-2x text-success"></i>';
            } else if (aidType === 2) {
                iconHtml = '<i class="fas fa-money-bill-wave fa-2x text-success"></i>';
            } else if (aidType === 3) {
                iconHtml = '<i class="fas fa-medkit fa-2x text-success"></i>';
            }

            pushNotificationCivilian.insertAdjacentHTML(
                'afterbegin',
                `
                <a class="dropdown-item d-flex align-items-center"
                        href="${notification.showAidLink}">
                        <div class="mr-3">
                            <div>${iconHtml}</div>
                        </div>
                        <div>
                            <div class="small text-info">${moment(notification.created_at).format('MMMM D, YYYY')}</div>
                            <span class="font-weight-bold">
                                Submit your application now to request ${notification.aidName} from ${notification.ngoName}.
                            </span>
                        </div>
                </a>
                `
            );
        }

        // Notifications for Approve Request
        if (notification.type == 'ApproveAidRequestNotification') {
            pushNotificationCivilian.insertAdjacentHTML(
                'afterbegin',
                `
                <a class="dropdown-item d-flex align-items-center"
                        href="${notification.showDistributionLink}">
                        <div class="mr-3">
                            <div class="icon-circle bg-success">
                                <i class="fas fa-check text-white"></i>
                            </div>
                        </div>
                        <div>
                            <div class="small text-info">${moment(notification.created_at).format('MMMM D, YYYY')}</div>
                            <span class="font-weight-bold">
                                "${notification.ngoName }" was approved your reqest for ${notification.aidName }".
                            </span>
                        </div>
                </a>
                `
            );
        }

        // Notifications for Reject Request
        if (notification.type == 'RejectAidRequestNotification') {
            pushNotificationCivilian.insertAdjacentHTML(
                'afterbegin',
                `
                <div class="dropdown-item d-flex align-items-center">
                        <div class="mr-3">
                            <div class="icon-circle bg-danger">
                                <i class="fas fa-times text-white"></i>
                            </div>
                        </div>
                        <div>
                            <div class="small text-info">${moment(notification.created_at).format('MMMM D, YYYY')}</div>
                            <span class="font-weight-bold">
                                "${notification.ngoName }" was rejected your reqest for ${notification.aidName }".
                            </span>
                        </div>
                </div>
                `
            );
        }

        // Notifications for Unavailable Quantity
        if (notification.type == 'UnvailableAidRequestNotification') {
            pushNotificationCivilian.insertAdjacentHTML(
                'afterbegin',
                `
                <div class="dropdown-item d-flex align-items-center">
                        <div class="mr-3">
                            <div class="icon-circle bg-warning">
                                <i class="fas fa-exclamation-circle text-white"></i>
                            </div>
                        </div>
                        <div>
                            <div class="small text-info">${moment(notification.created_at).format('MMMM D, YYYY')}</div>
                            <span class="font-weight-bold">
                                The aid "${notification.aidName}" is no longer available.
                                Please wait for new aids from "${notification.ngoName}" soon.
                            </span>
                        </div>
                </div>
                `
            );
        }
    });
}
