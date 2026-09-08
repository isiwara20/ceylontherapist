    </main>

    <!-- Admin Footer -->
    <footer class="admin-portal-footer">
        <div class="footer-left">
            <span>&copy; <?= date('Y') ?> <strong>Ceylon Therapist</strong>. All rights reserved.</span>
        </div>
        <div class="footer-right">
            <span>Control Panel &bull; Pure PHP &bull; Secure Engine</span>
        </div>
    </footer>
</div><!-- /.admin-main-container -->

</div><!-- /.admin-wrapper -->

<!-- Admin Core JS -->
<script src="<?= baseUrl('assets/js/admin/admin-common.js') ?>" defer></script>
<?php if (!empty($pageJs)): ?>
    <script src="<?= baseUrl($pageJs) ?>" defer></script>
<?php endif; ?>
</body>
</html>
