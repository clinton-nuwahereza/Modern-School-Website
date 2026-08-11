
// Creta Testimonial Showcase plugin activation
document.addEventListener('DOMContentLoaded', function () {
    const fse_education_school_button = document.getElementById('install-activate-button');

    if (!fse_education_school_button) return;

    fse_education_school_button.addEventListener('click', function (e) {
        e.preventDefault();

        const fse_education_school_redirectUrl = fse_education_school_button.getAttribute('data-redirect');

        // Step 1: Check if plugin is already active
        const fse_education_school_checkData = new FormData();
        fse_education_school_checkData.append('action', 'check_creta_testimonial_activation');

        fetch(installcretatestimonialData.ajaxurl, {
            method: 'POST',
            body: fse_education_school_checkData,
        })
        .then(res => res.json())
        .then(res => {
            if (res.success && res.data.active) {
                // Plugin is already active → just redirect
                window.location.href = fse_education_school_redirectUrl;
            } else {
                // Not active → proceed with install + activate
                fse_education_school_button.textContent = 'Nevigate Getstart';

                const fse_education_school_installData = new FormData();
                fse_education_school_installData.append('action', 'install_and_activate_creta_testimonial_plugin');
                fse_education_school_installData.append('_ajax_nonce', installcretatestimonialData.nonce);

                fetch(installcretatestimonialData.ajaxurl, {
                    method: 'POST',
                    body: fse_education_school_installData,
                })
                .then(res => res.json())
                .then(res => {
                    if (res.success) {
                        window.location.href = fse_education_school_redirectUrl;
                    } else {
                        alert('Activation error: ' + (res.data?.message || 'Unknown error'));
                        fse_education_school_button.textContent = 'Try Again';
                    }
                })
                .catch(error => {
                    alert('Request failed: ' + error.message);
                    fse_education_school_button.textContent = 'Try Again';
                });
            }
        })
        .catch(error => {
            alert('Check request failed: ' + error.message);
        });
    });
});
