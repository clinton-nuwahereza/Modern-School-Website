jQuery(document).ready(function($) {
    // Handle notice action clicks
    $('.author-personal-blog-notice__dismiss-forever, .author-personal-blog-notice__remind-later, .author-personal-blog-notice__setup-demo-again').on('click', function(e) {
        e.preventDefault();

        var $link = $(this);
        var action = $link.data('action');
        var nonce = $link.data('nonce');
        var $notice = $link.closest('.author-personal-blog-notice');

        $.ajax({
            url: authorPersonalBlogNotice.ajaxurl,
            type: 'POST',
            data: {
                action: authorPersonalBlogNotice.action,
                action_type: action,
                nonce: nonce
            },
            success: function(response) {
                if (response.success) {
                    // Hide the notice on success
                    $notice.fadeOut(300, function() {
                        $(this).remove();
                    });
                    console.log('Notice action successful: ' + response.data.message);
                } else {
                    console.error('Notice action failed: ' + (response.data.message || 'Unknown error'));
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX error: ' + status + ' - ' + error);
            }
        });
    });
});