</main>

<footer class="public-footer">
    <div class="footer-container container">
        <div class="footer-col brand-col">
            <a href="<?= baseUrl('index.php') ?>" class="footer-logo-link">
                <img src="<?= assetUrl('images/logo.png') ?>" alt="Ceylon Therapist Logo" class="footer-logo-img" style="height:48px;max-height:48px;width:auto;max-width:200px;object-fit:contain;display:block;margin-bottom:16px;">
            </a>
            <p class="footer-brand-desc">Private wellness experiences designed around relaxation, comfort and personal well-being in Sri Lanka.</p>
            <div class="footer-socials">
                <a href="#" aria-label="Facebook" class="social-icon"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#" aria-label="Instagram" class="social-icon"><i class="fa-brands fa-instagram"></i></a>
                <a href="https://wa.me/94771234567" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp" class="social-icon"><i class="fa-brands fa-whatsapp"></i></a>
            </div>
        </div>
        
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
        
        <div class="footer-col contact-col">
            <h4 class="footer-title">Contact & Location</h4>
            <p class="contact-item"><i class="fa-solid fa-location-dot gold-icon"></i> Sri Lanka</p>
            <p class="contact-item"><i class="fa-solid fa-phone gold-icon"></i> +94 77 123 4567</p>
            <p class="contact-item"><i class="fa-solid fa-envelope gold-icon"></i> hello@ceylontherapist.lk</p>
        </div>

        <div class="footer-col booking-col">
            <h4 class="footer-title">Private Reservations</h4>
            <p class="booking-text">Contact us directly via WhatsApp for quick, discreet communication.</p>
            <a href="https://wa.me/94771234567?text=Hello%20Ceylon%20Therapist%2C%20I%20would%20like%20to%20reserve%20a%20private%20wellness%20session." target="_blank" rel="noopener noreferrer" class="btn-footer-whatsapp">
                <i class="fa-brands fa-whatsapp"></i> Reserve Privately via WhatsApp
            </a>
        </div>
    </div>
    
    <div class="footer-bottom">
        <div class="container footer-bottom-flex">
            <p>&copy; <?= date('Y') ?> Ceylon Therapist. All Rights Reserved.</p>
            <p class="footer-tagline">Private • Discreet • Restorative</p>
        </div>
    </div>
</footer>

<script src="<?= assetUrl('js/main.js') ?>"></script>
</body>
</html>
