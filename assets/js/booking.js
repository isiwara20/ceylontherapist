/**
 * Ceylon Therapist - Client-side Booking & Contact Interaction
 * Pure Vanilla JavaScript
 */

document.addEventListener('DOMContentLoaded', () => {
    // 1. Enforce min date for date pickers to today
    const dateInputs = document.querySelectorAll('input[type="date"]');
    const today = new Date().toISOString().split('T')[0];
    dateInputs.forEach(input => {
        input.setAttribute('min', today);
    });

    // 2. WhatsApp Booking Form Validation & Submission
    const bookingForm = document.getElementById('ct-whatsapp-booking-form');
    if (bookingForm) {
        const nameInput = document.getElementById('booking_name');
        const treatmentSelect = document.getElementById('booking_treatment');
        const dateInput = document.getElementById('booking_date');
        const timeInput = document.getElementById('booking_time');
        const phoneInput = document.getElementById('booking_phone');

        const clearError = (fieldId, errId) => {
            const errSpan = document.getElementById(errId);
            const field = document.getElementById(fieldId);
            if (errSpan) errSpan.textContent = '';
            if (field) field.classList.remove('has-error');
        };

        const showError = (fieldId, errId, message) => {
            const errSpan = document.getElementById(errId);
            const field = document.getElementById(fieldId);
            if (errSpan) errSpan.textContent = message;
            if (field) {
                field.classList.add('has-error');
                field.focus();
            }
        };

        // Real-time error clearing on input
        if (nameInput) nameInput.addEventListener('input', () => clearError('booking_name', 'err-name'));
        if (treatmentSelect) treatmentSelect.addEventListener('change', () => clearError('booking_treatment', 'err-treatment'));
        if (dateInput) dateInput.addEventListener('change', () => clearError('booking_date', 'err-date'));
        if (timeInput) timeInput.addEventListener('change', () => clearError('booking_time', 'err-time'));
        if (phoneInput) phoneInput.addEventListener('input', () => clearError('booking_phone', 'err-phone'));

        bookingForm.addEventListener('submit', (e) => {
            let isValid = true;

            if (phoneInput && !phoneInput.value.trim()) {
                showError('booking_phone', 'err-phone', 'Please enter your WhatsApp contact number.');
                isValid = false;
            }

            if (timeInput && !timeInput.value.trim()) {
                showError('booking_time', 'err-time', 'Please choose a preferred time.');
                isValid = false;
            }

            if (dateInput && !dateInput.value.trim()) {
                showError('booking_date', 'err-date', 'Please choose a preferred date.');
                isValid = false;
            }

            if (treatmentSelect && !treatmentSelect.value.trim()) {
                showError('booking_treatment', 'err-treatment', 'Please select a preferred treatment.');
                isValid = false;
            }

            if (nameInput && !nameInput.value.trim()) {
                showError('booking_name', 'err-name', 'Please enter your full name.');
                isValid = false;
            }

            if (!isValid) {
                e.preventDefault();
            }
        });
    }

    // 3. Smooth Toggle to Email Section
    const toggleEmailBtn = document.getElementById('toggle-email-btn');
    if (toggleEmailBtn) {
        toggleEmailBtn.addEventListener('click', (e) => {
            e.preventDefault();
            const emailSection = document.getElementById('ct-email-section');
            if (emailSection) {
                const headerOffset = 90;
                const elementPosition = emailSection.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
            }
        });
    }
});
