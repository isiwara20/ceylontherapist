</main>

<?php
$footerWa = defined('DEFAULT_WHATSAPP_NUMBER') ? DEFAULT_WHATSAPP_NUMBER : '94762244114';
$footerEmail = defined('DEFAULT_BUSINESS_EMAIL') ? DEFAULT_BUSINESS_EMAIL : 'info@ceylontherapist.lk';
?>

<footer class="public-footer">
    <div class="footer-container container">
        <!-- Brand Column -->
        <div class="footer-col brand-col">
            <a href="<?= baseUrl('index.php') ?>" class="footer-logo-link" aria-label="Ceylon Therapist Home">
                <img src="<?= assetUrl('images/logo.png') ?>" alt="Ceylon Therapist Logo" class="footer-logo-img">
            </a>
            <p class="footer-brand-desc">Private wellness experiences designed around relaxation, comfort and personal well-being in Sri Lanka.</p>
            <div class="footer-socials">
                <a href="https://wa.me/<?= $footerWa ?>" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp" class="social-icon"><i class="fa-brands fa-whatsapp"></i></a>
                <a href="mailto:<?= $footerEmail ?>" aria-label="Email" class="social-icon"><i class="fa-solid fa-envelope"></i></a>
            </div>
        </div>
        
        <!-- Navigation Links Column -->
        <div class="footer-col links-col">
            <h4 class="footer-title">Quick Links</h4>
            <ul class="footer-links">
                <li><a href="<?= baseUrl('index.php') ?>">Home</a></li>
                <li><a href="<?= baseUrl('treatments.php') ?>">Treatments</a></li>
                <li><a href="<?= baseUrl('for-her.php') ?>">For Her</a></li>
                <li><a href="<?= baseUrl('couples.php') ?>">Couples</a></li>
                <li><a href="<?= baseUrl('about.php') ?>">About</a></li>
                <li><a href="<?= baseUrl('contact.php') ?>">Contact</a></li>
            </ul>
        </div>
        
        <!-- Contact Information Column -->
        <div class="footer-col contact-col">
            <h4 class="footer-title">Contact &amp; Location</h4>
            <div class="contact-list">
                <p class="contact-item"><i class="fa-solid fa-location-dot gold-icon"></i> <span>Sri Lanka</span></p>
                <p class="contact-item"><i class="fa-solid fa-phone gold-icon"></i> <a href="tel:+<?= $footerWa ?>">+<?= $footerWa ?></a></p>
                <p class="contact-item"><i class="fa-solid fa-envelope gold-icon"></i> <a href="mailto:<?= $footerEmail ?>"><?= $footerEmail ?></a></p>
            </div>
        </div>

        <!-- Booking / Reservations Column -->
        <div class="footer-col booking-col">
            <h4 class="footer-title">Private Reservations</h4>
            <p class="booking-text">Contact us directly via WhatsApp for quick, discreet communication.</p>
            <a href="https://wa.me/<?= $footerWa ?>?text=Hello%20Ceylon%20Therapist%2C%20I%20would%20like%20to%20reserve%20a%20private%20wellness%20session." target="_blank" rel="noopener noreferrer" class="btn-footer-whatsapp">
                <i class="fa-brands fa-whatsapp"></i> Reserve Privately via WhatsApp
            </a>
        </div>
    </div>
    
    <div class="footer-bottom">
        <div class="container footer-bottom-flex">
            <p>&copy; <?= date('Y') ?> Ceylon Therapist. All Rights Reserved.</p>
            <p class="footer-tagline">Private &bull; Discreet &bull; Restorative</p>
        </div>
    </div>
</footer>

<script src="<?= assetUrl('js/main.js') ?>"></script>
<script src="<?= assetUrl('js/booking.js') ?>"></script>
</body>
</html>
