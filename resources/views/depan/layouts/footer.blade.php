<!-- Footer -->
<footer class="site-footer">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-4 mb-4 mb-md-0">
                <div class="footer-brand">
                    PRABHAKALA<br>E-BOOKING
                </div>
            </div>
            <div class="col-12 col-md-8">
                <h3 class="footer-heading">Ready for offers and cooperation</h3>
                <ul class="footer-list">
                    <li>Traditional Dance</li>
                    <li>Modern Dance</li>
                    <li>Wedding Dance</li>
                    <li>Event Performance</li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<!-- Bootstrap 5 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>

<script>
    // Navbar scroll effect
    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('.navbar-custom');
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });
</script>

@stack('scripts')

</body>

</html>
