{{-- resources/views/components/scroll-to-top.blade.php --}}
<button id="scrollToTop"
        class="fixed bottom-6 right-6 z-50 hidden rounded-full bg-indigo-600 p-3 text-white shadow-lg hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all duration-300 transform hover:scale-110">
    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
    </svg>
    <span class="sr-only">Scroll to top</span>
</button>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const scrollToTopBtn = document.getElementById('scrollToTop');

    // Show/hide scroll to top button
    window.addEventListener('scroll', function() {
        if (window.pageYOffset > 300) {
            scrollToTopBtn.classList.remove('hidden');
            scrollToTopBtn.classList.add('animate-fade-in');
        } else {
            scrollToTopBtn.classList.add('hidden');
            scrollToTopBtn.classList.remove('animate-fade-in');
        }
    });

    // Smooth scroll to top
    scrollToTopBtn.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
});
</script>
