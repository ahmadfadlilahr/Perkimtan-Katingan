{{-- Minimal Loading Screen Component --}}
<div id="loading-screen" class="fixed inset-0 bg-white z-[9999] flex items-center justify-center transition-opacity duration-300 ease-in-out"
     style="opacity: 1; visibility: visible;">
    <div class="text-center">
        {{-- Logo Dinas --}}
        <div class="w-20 h-20 mx-auto mb-4 bg-white rounded-xl flex items-center justify-center shadow-lg p-2">
            <img src="{{ asset('images/logo-dinas.png') }}"
                 alt="Logo Dinas"
                 class="w-16 h-16 object-contain">
        </div>

        {{-- Simple Loading Spinner --}}
        <div class="w-8 h-8 mx-auto">
            <div class="w-8 h-8 border-2 border-blue-100 border-t-blue-500 rounded-full animate-spin"></div>
        </div>

        {{-- Minimal Text --}}
        <p class="text-sm text-gray-500 mt-3">Memuat...</p>
    </div>
</div>

{{-- Minimal Loading Screen Styles --}}
<style>
/* Simple loading screen */
#loading-screen {
    background: #ffffff;
}

/* Fade out animation */
#loading-screen.fade-out {
    opacity: 0;
    visibility: hidden;
}

/* Pointer events */
#loading-screen {
    pointer-events: auto;
}

#loading-screen.fade-out {
    pointer-events: none;
}
</style>

{{-- Minimal Loading Screen JavaScript --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const loadingScreen = document.getElementById('loading-screen');

    if (!loadingScreen) return;

    // Hide loading screen when page is loaded
    window.addEventListener('load', function() {
        setTimeout(() => {
            hideLoadingScreen();
        }, 200);
    });

    // Function to hide loading screen
    function hideLoadingScreen() {
        if (loadingScreen) {
            loadingScreen.classList.add('fade-out');

            // Remove from DOM after animation
            setTimeout(() => {
                if (loadingScreen.parentNode) {
                    loadingScreen.parentNode.removeChild(loadingScreen);
                }
            }, 300);
        }
    }

    // Fallback timeout
    setTimeout(() => {
        if (loadingScreen && !loadingScreen.classList.contains('fade-out')) {
            hideLoadingScreen();
        }
    }, 5000);
});

// Quick hide for fast connections
if (document.readyState === 'complete') {
    const loadingScreen = document.getElementById('loading-screen');
    if (loadingScreen) {
        loadingScreen.style.display = 'none';
    }
}
</script>
