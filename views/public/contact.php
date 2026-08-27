<?php require BASE_PATH . '/views/partials/public-header.php'; ?>

<section class="page-banner">
    <div class="container text-center">
        <h1>Reservations & Contact</h1>
        <p>Book directly via WhatsApp or reach our concierge desk through email.</p>
    </div>
</section>

<section class="section-padding">
    <div class="container grid-2-col">
        <!-- WhatsApp Direct Booking Form -->
        <div class="booking-card">
            <div class="card-header">
                <h2><i class="fa-brands fa-whatsapp icon-whatsapp"></i> Reserve via WhatsApp</h2>
                <p>Select your desired service, date, and time. Submitting will pre-fill a WhatsApp message to our concierge.</p>
            </div>

            <form action="<?= baseUrl('contact.php') ?>" method="POST" class="booking-form">
                <?= CsrfService::getHiddenInput() ?>
                <input type="hidden" name="action" value="whatsapp">

                <div class="form-group">
                    <label for="customer_name">Your Full Name *</label>
                    <input type="text" id="customer_name" name="customer_name" required placeholder="e.g. Anura Perera">
                </div>

                <div class="form-group">
                    <label for="service_name">Service / Treatment / Package</label>
                    <input type="text" id="service_name" name="service_name" placeholder="e.g. Signature Aromatherapy Massages">
                </div>

                <div class="grid-2-col-inner">
                    <div class="form-group">
                        <label for="preferred_date">Preferred Date</label>
                        <input type="date" id="preferred_date" name="preferred_date">
                    </div>
                    <div class="form-group">
                        <label for="preferred_time">Preferred Time</label>
                        <input type="time" id="preferred_time" name="preferred_time">
                    </div>
                </div>

                <div class="form-group">
                    <label for="duration_minutes">Duration</label>
                    <select id="duration_minutes" name="duration_minutes">
                        <option value="60">60 Minutes</option>
                        <option value="90">90 Minutes</option>
                        <option value="120">120 Minutes (2 Hours)</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="message">Special Requests / Notes</label>
                    <textarea id="message" name="message" rows="3" placeholder="Any preferences, focus areas, or inquiries..."></textarea>
                </div>

                <button type="submit" class="btn-whatsapp-submit">
                    <i class="fa-brands fa-whatsapp"></i> Continue to WhatsApp Booking
                </button>
            </form>
        </div>

        <!-- Direct Email Contact Form -->
        <div class="contact-card">
            <div class="card-header">
                <h2><i class="fa-solid fa-envelope icon-gold"></i> Send Email Message</h2>
                <p>For general inquiries or partnerships, email our administrative desk directly.</p>
            </div>

            <form action="<?= baseUrl('contact.php') ?>" method="POST" class="contact-form">
                <?= CsrfService::getHiddenInput() ?>
                <input type="hidden" name="action" value="email">

                <div class="form-group">
                    <label for="email_name">Your Name *</label>
                    <input type="text" id="email_name" name="name" required placeholder="Your name">
                </div>

                <div class="form-group">
                    <label for="email_addr">Email Address *</label>
                    <input type="email" id="email_addr" name="email" required placeholder="your.email@example.com">
                </div>

                <div class="form-group">
                    <label for="email_phone">Phone Number</label>
                    <input type="tel" id="email_phone" name="phone" placeholder="+94 77 123 4567">
                </div>

                <div class="form-group">
                    <label for="email_msg">Message *</label>
                    <textarea id="email_msg" name="message" rows="4" required placeholder="How can we assist you?"></textarea>
                </div>

                <button type="submit" class="btn-gold-filled">Send Email Message</button>
            </form>
        </div>
    </div>
</section>

<?php require BASE_PATH . '/views/partials/public-footer.php'; ?>
