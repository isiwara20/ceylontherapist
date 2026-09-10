/**
 * Ceylon Therapist - For Her Sanctuary Experience Modal Interactions
 * Pure Vanilla JavaScript
 */

function openFhModal(data) {
    const titleEl = document.getElementById('fhModalTitle');
    const shortEl = document.getElementById('fhModalShort');
    const descEl = document.getElementById('fhModalDesc');
    const durationEl = document.getElementById('fhModalDuration');
    const imgEl = document.getElementById('fhModalImg');
    const bookBtn = document.getElementById('fhModalBookBtn');
    const modal = document.getElementById('fhDetailModal');

    if (titleEl) titleEl.textContent = data.name || '';
    if (shortEl) shortEl.textContent = data.short || '';
    if (descEl) descEl.textContent = data.desc || data.short || '';
    if (durationEl) {
        const span = durationEl.querySelector('span');
        if (span) span.textContent = (data.duration || 60) + ' Min';
    }
    const priceEl = document.getElementById('fhModalPrice');
    if (priceEl) {
        if (data.price) {
            const pSpan = priceEl.querySelector('span');
            if (pSpan) pSpan.textContent = data.price;
            priceEl.style.display = 'inline-flex';
        } else {
            priceEl.style.display = 'none';
        }
    }
    if (imgEl) {
        imgEl.src = data.image || data.img || '';
        imgEl.alt = data.name || 'Treatment Experience';
    }
    if (bookBtn) {
        if (data.waLink) {
            bookBtn.href = data.waLink;
        } else {
            const waNum = (window.CT_WHATSAPP || '94762244114');
            const text = encodeURIComponent('Hello Ceylon Therapist, I would like to reserve the ' + (data.name || 'For Her') + ' private session.');
            bookBtn.href = 'https://wa.me/' + waNum + '?text=' + text;
        }
    }

    if (modal) {
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
}

function closeFhModalDirect() {
    const modal = document.getElementById('fhDetailModal');
    if (modal) {
        modal.style.display = 'none';
        document.body.style.overflow = '';
    }
}

function closeFhModal(e) {
    if (e.target && e.target.id === 'fhDetailModal') {
        closeFhModalDirect();
    }
}

// Global escape key listener
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        closeFhModalDirect();
    }
});

// Attach event listeners to detail buttons if dataset is present
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.fh-detail-btn[data-treatment]').forEach(btn => {
        btn.addEventListener('click', () => {
            try {
                const data = JSON.parse(btn.getAttribute('data-treatment'));
                openFhModal(data);
            } catch (err) {
                console.error('Invalid treatment data', err);
            }
        });
    });
});
