jQuery(document).ready(function ($) {
    $('#install-wpopus').on('click', function (e) {
        e.preventDefault();

        var $button = $(this);
        var $notice = $button.closest('.notice'); // Target the notice container

        // Clear any previous messages
        $notice.find('.wpopus-message').remove();

        $button.prop('disabled', true).text('Installing...');

        $.ajax({
            url: wpopusAjax.ajax_url,
            method: 'POST',
            data: {
                action: 'install_wpopus_plugin',
                nonce: wpopusAjax.nonce,
            },
            success: function (response) {
                if (response.success) {
                    // Display success message
                    $notice.append('<p class="wpopus-message success">' + response.data.message + '</p>');
                    $button.text(wpopusAjax.success_label).removeClass('button-primary').addClass('button-disabled');
                    window.location.href = 'admin.php?page=wpopus';
                } else {
                    // Display error message
                    $notice.append('<p class="wpopus-message error">' + response.data.message + '</p>');
                    $button.prop('disabled', false).text(wpopusAjax.label);
                }
            },
            error: function () {
                // Display general error message
                $notice.append('<p class="wpopus-message error">An error occurred. Please try again.</p>');
                $button.prop('disabled', false).text(wpopusAjax.label);
            },
        });
    });
});
