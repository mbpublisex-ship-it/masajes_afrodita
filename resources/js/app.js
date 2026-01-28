import './bootstrap';
import '../scss/app.scss';

document.addEventListener('DOMContentLoaded', () => {
    const overlay = document.querySelector('.age-gate-overlay');
    if (!overlay) {
        return;
    }

    const acceptButton = overlay.querySelector('.age-gate-overlay__btn--accept');
    const exitButton = overlay.querySelector('.age-gate-overlay__btn--exit');
    const storageKey = 'mt_afrodita_18_ok';

    if (localStorage.getItem(storageKey) === 'yes') {
        overlay.classList.add('is-hidden');
    } else {
        overlay.classList.remove('is-hidden');
    }

    acceptButton?.addEventListener('click', () => {
        localStorage.setItem(storageKey, 'yes');
        overlay.classList.add('is-hidden');
    });

    exitButton?.addEventListener('click', () => {
        window.location.href = 'https://www.google.es';
    });
});
