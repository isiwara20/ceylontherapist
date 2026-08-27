/**
 * WhatsApp Booking Client Logic
 */

document.addEventListener('DOMContentLoaded', () => {
    const bookingForm = document.querySelector('.booking-form');
    if (bookingForm) {
        bookingForm.addEventListener('submit', (e) => {
            const customerName = document.getElementById('customer_name');
            if (customerName && !customerName.value.trim()) {
                alert('Please enter your name for the booking inquiry.');
                e.preventDefault();
            }
        });
    }
});
