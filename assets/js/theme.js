/* S-Prestige theme — front-end interactions
   Ported from the prototype's inline <script>:
   - FAQ accordion (single-open)
   - Smooth "back to the top"
   Contact form submission is handled by Contact Form 7 server-side,
   so the prototype's handleContactSubmit() is intentionally gone.   */
(function () {
    'use strict';

    document.addEventListener('click', function (e) {
        // FAQ accordion — delegate so it works regardless of markup order
        var item = e.target.closest('.faq-item');
        if (item) {
            var isOpen = item.classList.contains('open');
            document.querySelectorAll('.faq-item').forEach(function (i) {
                i.classList.remove('open');
            });
            if (!isOpen) item.classList.add('open');
            return;
        }

        // Back to top
        var top = e.target.closest('[data-scroll-top]');
        if (top) {
            e.preventDefault();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    });
})();
