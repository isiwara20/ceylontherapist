</main>

<?php
$footerWa = defined('DEFAULT_WHATSAPP_NUMBER') ? DEFAULT_WHATSAPP_NUMBER : '94762244114';
?>

<footer class="public-footer">
    <div class="footer-container container">
        <!-- Brand Column -->
        <div class="footer-col brand-col">
            <a href="<?= baseUrl('index.php') ?>" class="footer-logo-link" aria-label="Ceylon Therapist Home">
                <img src="<?= assetUrl('images/branding/logo.png') ?>" alt="Ceylon Therapist Logo" class="footer-logo-img">
            </a>
            <p class="footer-brand-desc">Private wellness experiences designed around relaxation, comfort and personal well-being in Sri Lanka.</p>
            <div class="footer-socials">
                <a href="https://wa.me/<?= $footerWa ?>" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp" class="social-icon"><i class="fa-brands fa-whatsapp"></i></a>
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
                <li><a href="<?= baseUrl('packages.php') ?>">Packages</a></li>
                <li><a href="<?= baseUrl('about.php') ?>">About</a></li>
                <li><a href="<?= baseUrl('contact.php') ?>">Contact</a></li>
            </ul>
        </div>
        
        <!-- Contact Information Column -->
        <div class="footer-col contact-col">
            <h4 class="footer-title">Contact &amp; Location</h4>
            <div class="contact-list">
                <p class="contact-item"><i class="fa-solid fa-location-dot gold-icon"></i> <span>Sri Lanka</span></p>
                <p class="contact-item"><i class="fa-brands fa-whatsapp gold-icon"></i> <a href="https://wa.me/<?= $footerWa ?>" target="_blank" rel="noopener noreferrer">+<?= $footerWa ?></a></p>
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
            <p>&copy; <?= date('Y') ?> Ceylon Therapist. All Rights Reserved. &bull; Developed By <a href="https://www.facebook.com/share/1FdKVkAS6X/?mibextid=wwXIfr" target="_blank" rel="noopener noreferrer" class="footer-developer-link" style="color:var(--color-champagne-gold, #D4AF37);text-decoration:none;">CHANDILA</a></p>
            <p class="footer-tagline">Private &bull; Discreet &bull; Restorative</p>
        </div>
    </div>
</footer>

<!-- Shared JavaScript -->
<script src="<?= baseUrl('assets/js/common/navigation.js') ?>" defer></script>
<script src="<?= baseUrl('assets/js/common/main.js') ?>" defer></script>

<!-- Page-Specific JavaScript -->
<?php if (!empty($pageJs)): ?>
    <script src="<?= baseUrl($pageJs) ?>" defer></script>
<?php endif; ?>

</body>
</html>
