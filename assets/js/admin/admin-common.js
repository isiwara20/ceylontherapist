/**
 * Ceylon Therapist - Admin Common JavaScript
 * Pure Vanilla JavaScript
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

    const sidebarToggleBtn = document.getElementById('sidebarToggleBtn');
    if (sidebarToggleBtn) {
        sidebarToggleBtn.addEventListener('click', window.toggleAdminSidebar);
    }

    const sidebarBackdrop = document.getElementById('sidebarBackdrop');
    if (sidebarBackdrop) {
        sidebarBackdrop.addEventListener('click', window.toggleAdminSidebar);
    }

    // 2. Profile Dropdown Menu Toggle
    window.toggleProfileDropdown = function () {
        const dropdown = document.getElementById('profileDropdown');
        if (dropdown) {
            dropdown.classList.toggle('show');
        }
    };

    const profilePill = document.querySelector('.admin-profile-pill');
    if (profilePill) {
        profilePill.addEventListener('click', window.toggleProfileDropdown);
    }

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

    // 4. Auto-dismiss alerts after 5 seconds
    const alerts = document.querySelectorAll('.admin-alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.opacity = '0';
            alert.style.transition = 'opacity 0.5s ease';
            setTimeout(() => alert.remove(), 500);
        }, 5000);
    });

    // Close buttons on alerts
    document.querySelectorAll('.admin-alert .alert-close').forEach(btn => {
        btn.addEventListener('click', function () {
            const alert = this.closest('.admin-alert');
            if (alert) alert.remove();
        });
    });
});
