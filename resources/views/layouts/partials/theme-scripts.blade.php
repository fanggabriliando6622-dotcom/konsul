<script>
document.addEventListener('DOMContentLoaded', function() {
    // Scroll Reveal
    var els = document.querySelectorAll('.rk-reveal');
    if ('IntersectionObserver' in window) {
        var obs = new IntersectionObserver(function(entries) {
            entries.forEach(function(e) {
                if (e.isIntersecting) { e.target.classList.add('rk-visible'); obs.unobserve(e.target); }
            });
        }, { threshold: 0.12, rootMargin: '0px 0px -30px 0px' });
        els.forEach(function(el) { obs.observe(el); });
    } else {
        els.forEach(function(el) { el.classList.add('rk-visible'); });
    }
});
</script>
