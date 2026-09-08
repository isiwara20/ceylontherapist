/**
 * Ceylon Therapist - Admin Media Interactions
 * Pure Vanilla JavaScript
 */

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
