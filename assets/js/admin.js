/**
 * Ceylon Therapist Admin Portal Javascript
 * Pure Vanilla JS - No external libraries
 */

document.addEventListener('DOMContentLoaded', function () {
    // 1. Mobile Sidebar Toggle
    window.toggleAdminSidebar = function () {
        const sidebar = document.getElementById('adminSidebar');
        const backdrop = document.getElementById('sidebarBackdrop');
        if (sidebar && backdrop) {
            sidebar.classList.toggle('show');
            backdrop.classList.toggle('show');
        }
    };

    // 2. Profile Dropdown Menu Toggle
    window.toggleProfileDropdown = function () {
        const dropdown = document.getElementById('profileDropdown');
        if (dropdown) {
            dropdown.classList.toggle('show');
        }
    };

    // Close profile dropdown when clicking outside
    document.addEventListener('click', function (e) {
        const pill = document.querySelector('.admin-profile-pill');
        const dropdown = document.getElementById('profileDropdown');
        if (pill && dropdown && !pill.contains(e.target)) {
            dropdown.classList.remove('show');
        }
    });

    // 3. Password Toggle Functionality
    const toggleButtons = document.querySelectorAll('.password-toggle-icon');
    toggleButtons.forEach(btn => {
        btn.addEventListener('click', function () {
            const input = this.parentElement.querySelector('input');
            if (input) {
                if (input.type === 'password') {
                    input.type = 'text';
                    this.classList.remove('fa-eye');
                    this.classList.add('fa-eye-slash');
                } else {
                    input.type = 'password';
                    this.classList.remove('fa-eye-slash');
                    this.classList.add('fa-eye');
                }
            }
        });
    });

    // 4. Copy Path helper for media
    window.copyToClipboard = function (text, btnElement) {
        if (navigator.clipboard) {
            navigator.clipboard.writeText(text).then(() => {
                const originalHtml = btnElement.innerHTML;
                btnElement.innerHTML = '<i class="fa-solid fa-check"></i> Copied';
                setTimeout(() => {
                    btnElement.innerHTML = originalHtml;
                }, 2000);
            }).catch(err => {
                prompt('Copy path:', text);
            });
        } else {
            prompt('Copy path:', text);
        }
    };

    // 5. Auto-dismiss alerts after 5 seconds
    const alerts = document.querySelectorAll('.admin-alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.opacity = '0';
            alert.style.transition = 'opacity 0.5s ease';
            setTimeout(() => alert.remove(), 500);
        }, 5000);
    });
});
