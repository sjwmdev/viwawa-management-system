<script>
    $(function() {
        $.ajax({
            url: '<?php echo e(route('common.notifications.get-unread')); ?>',
            method: 'GET',
            success: function(response) {
                if (response && Array.isArray(response)) {
                    var count = response.length;
                    $('#unread-notifications-count').text(count);

                    if (count === 0) {
                        $('#unread-notifications').html('<p class="dropdown-item">No new notifications</p>');
                        return;
                    }

                    var html = '';
                    for (var i = 0; i < response.length; i++) {
                        html += '<a href="#" class="dropdown-item notification" data-notification-id="' + response[i].id + '">' +
                                '<span class="notification-message">' + (response[i].message || 'No message') + '</span>' +
                                '<span class="notification-close"><i class="fas fa-times"></i></span>' +
                                '</a>';
                    }

                    $('#unread-notifications').html(html);

                    $('.notification-close').click(function(e) {
                        e.preventDefault();

                        var notificationId = $(this).closest('.notification').data('notification-id');

                        $.ajax({
                            url: '/notifications/mark-as-read/' + notificationId,
                            method: 'POST',
                            data: {
                                _token: '<?php echo e(csrf_token()); ?>',
                            },
                            success: function(response) {
                                if (response && typeof response.unread_count !== 'undefined') {
                                    $('#unread-notifications-count').text(response.unread_count);
                                    $('.notification[data-notification-id="' + notificationId + '"]').remove();

                                    if (response.unread_count === 0) {
                                        $('#unread-notifications').html('<p class="dropdown-item">No new notifications</p>');
                                    }
                                } else {
                                    console.error('Error: Invalid response format.', response);
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error('Error marking notification as read:', error);
                            }
                        });
                    });
                } else {
                    $('#unread-notifications-count').text(0);
                    $('#unread-notifications').html('<p class="dropdown-item">No new notifications</p>');
                    console.error('Error: Invalid response format.', response);
                }
            },
            error: function(xhr, status, error) {
                $('#unread-notifications-count').text(0);
                $('#unread-notifications').html('<p class="dropdown-item">No new notifications</p>');
                console.error('Error fetching notifications:', error);
            }
        });
    });
</script>
<?php /**PATH /var/www/html/resources/views/backend/components/notification_dropdown_js.blade.php ENDPATH**/ ?>