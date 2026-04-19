<nav class="bg-white shadow-md fixed w-full z-50">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        <div class="flex justify-between items-center h-16">

            <!-- Logo -->
            <a href="/" class="flex items-center space-x-3">
                <img src="{{ asset('assets/IC-PSM.jpg') }}"
                     alt="Logo PSM"
                     class="w-10 h-10 object-cover rounded-full">

                <span class="text-lg font-bold text-primary hidden sm:block">
                    UKM PSM
                </span>
            </a>

            <!-- Menu Desktop -->
            <div class="hidden md:flex space-x-8 font-medium">
                <a href="/" class="hover:text-primary">Beranda</a>
                <a href="/tentang" class="hover:text-primary">Tentang</a>
                <a href="/artikel" class="hover:text-primary">Artikel</a>
                <a href="/program" class="hover:text-primary">Program</a>
                <a href="/organisasi" class="hover:text-primary">Organisasi</a>
                <a href="/majalah" class="hover:text-primary">Majalah</a>
            </div>

            <!-- Hamburger Button -->
            <button id="menuBtn"
                class="md:hidden text-2xl focus:outline-none">
                ☰
            </button>

        </div>
    </div>
</nav>

<!-- Overlay -->
<div id="overlay"
     class="fixed inset-0 bg-black/40 opacity-0 pointer-events-none transition-opacity duration-300 z-40">
</div>

<!-- Sidebar Mobile -->
<div id="sidebar"
     class="fixed top-0 right-0 h-full w-64 bg-white shadow-lg transform translate-x-full transition-transform duration-300 z-50">

    <div class="flex justify-between items-center p-4 border-b">
        <span class="font-bold">Menu</span>
        <button id="closeBtn" class="text-2xl">✕</button>
    </div>

    <div class="flex flex-col space-y-4 p-6 font-medium">
        <a href="/" class="hover:text-primary">Beranda</a>
        <a href="/tentang" class="hover:text-primary">Tentang</a>
        <a href="/artikel" class="hover:text-primary">Artikel</a>
        <a href="/program" class="hover:text-primary">Program</a>
        <a href="/organisasi" class="hover:text-primary">Organisasi</a>
        <a href="/majalah" class="hover:text-primary">Majalah</a>
    </div>
</div>

<!-- Script -->
<script>
document.addEventListener("DOMContentLoaded", () => {
    const sidebar = document.getElementById("sidebar");
    const overlay = document.getElementById("overlay");
    const menuBtn = document.getElementById("menuBtn");
    const closeBtn = document.getElementById("closeBtn");

    function openMenu() {
        sidebar.classList.remove("translate-x-full");
        overlay.classList.remove("opacity-0", "pointer-events-none");
        menuBtn.textContent = "✕";
    }

    function closeMenu() {
        sidebar.classList.add("translate-x-full");
        overlay.classList.add("opacity-0", "pointer-events-none");
        menuBtn.textContent = "☰";
    }

    menuBtn.addEventListener("click", () => {
        if (sidebar.classList.contains("translate-x-full")) {
            openMenu();
        } else {
            closeMenu();
        }
    });

    closeBtn.addEventListener("click", closeMenu);
    overlay.addEventListener("click", closeMenu);

    // Auto close when resize > mobile
    window.addEventListener("resize", () => {
        if (window.innerWidth >= 768) {
            closeMenu();
        }
    });
});
</script>
