{{-- Admin Loading Screen Component --}}
<div id="admin-loading-screen" class="fixed inset-0 bg-white z-[9999] flex items-center justify-center transition-opacity duration-300 ease-in-out"
     style="opacity: 1; visibility: visible;">
    <div class="text-center">
        {{-- Admin Logo/Icon --}}
        <div class="mb-4">
            <div class="w-20 h-20 mx-auto bg-white rounded-xl flex items-center justify-center mb-3 shadow-lg p-2">
                <img src="{{ asset('images/logo-dinas.png') }}"
                     alt="Logo Dinas"
                     class="w-16 h-16 object-contain">
            </div>
            <h3 class="text-sm font-medium text-gray-600">Dashboard Admin</h3>
        </div>

        {{-- Simple Loading Spinner --}}
        <div class="w-8 h-8 mx-auto">
            <div class="w-8 h-8 border-2 border-blue-100 border-t-blue-500 rounded-full animate-spin"></div>
        </div>

        <p class="text-xs text-gray-400 mt-3">Memuat dashboard...</p>
    </div>
</div>

{{-- Admin Loading Screen Styles --}}
<style>
/* Admin loading screen - Light theme */
#admin-loading-screen {
    background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
    box-shadow: inset 0 0 50px rgba(0, 0, 0, 0.02);
}

#admin-loading-screen.fade-out {
    opacity: 0;
    visibility: hidden;
}

#admin-loading-screen {
    pointer-events: auto;
}

#admin-loading-screen.fade-out {
    pointer-events: none;
}
</style>

{{-- Admin Loading Screen Script --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const adminLoadingScreen = document.getElementById('admin-loading-screen');

    if (!adminLoadingScreen) return;

    // Simple timeout-based loading for admin
    function hideAdminLoadingScreen() {
        if (adminLoadingScreen) {
            adminLoadingScreen.classList.add('fade-out');

            setTimeout(() => {
                if (adminLoadingScreen.parentNode) {
                    adminLoadingScreen.parentNode.removeChild(adminLoadingScreen);
                }
            }, 300);
        }
    }

    // Hide when page is loaded
    window.addEventListener('load', function() {
        setTimeout(hideAdminLoadingScreen, 200);
    });

    // Fallback timeout
    setTimeout(hideAdminLoadingScreen, 3000);

    // Skip with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && adminLoadingScreen && !adminLoadingScreen.classList.contains('fade-out')) {
            hideAdminLoadingScreen();
        }
    });
});

// Prevent flash on fast connections
if (document.readyState === 'complete') {
    const adminLoadingScreen = document.getElementById('admin-loading-screen');
    if (adminLoadingScreen) {
        adminLoadingScreen.style.display = 'none';
    }
}
</script>
