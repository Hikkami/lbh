</main>

        <footer class="bg-gray-900 text-white pt-12 pb-6 mt-12 border-t-4 border-blue-600 relative z-10">
            <div class="max-w-7xl mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
                    <div>
                        <h4 class="text-xl font-bold mb-4 text-blue-400">O Nas</h4>
                        <ul class="text-sm text-gray-400 space-y-2">
                            <li><a href="o-nas.php#historia" class="hover:text-blue-300 transition">Historia WAI</a></li>
                            <li><a href="o-nas.php#cele" class="hover:text-blue-300 transition">Nasze cele</a></li>
                            <li><a href="o-nas.php#zarzad" class="hover:text-blue-300 transition">Zarząd (2022-2024)</a></li>
                            <li><a href="galeria.php" class="hover:text-blue-300 transition">Galeria zdjęć</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-xl font-bold mb-4 text-blue-400">Statut</h4>
                        <ul class="text-sm text-gray-400 space-y-2">
                            <li><a href="statut.php#rozdzial-1" class="hover:text-blue-300 transition">Rozdział I</a></li>
                            <li><a href="statut.php#rozdzial-2" class="hover:text-blue-300 transition">Rozdział II</a></li>
                            <li><a href="statut.php#rozdzial-3" class="hover:text-blue-300 transition">Rozdział III</a></li>
                            <li><a href="statut.php#rozdzial-4" class="hover:text-blue-300 transition">Rozdział IV</a></li>
                            <li><a href="statut.php#rozdzial-5" class="hover:text-blue-300 transition">Rozdział V</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-xl font-bold mb-4 text-blue-400">Współpraca i Prawo</h4>
                        <ul class="text-sm text-gray-400 space-y-2">
                            <li><a href="dolacz.php#zaproszenie" class="hover:text-blue-300 transition">Zaproszenie</a></li>
                            <li><a href="dolacz.php#oferta" class="hover:text-blue-300 transition">Oferta dla biznesu</a></li>
                            <li><a href="dolacz.php#indywidualne" class="hover:text-blue-300 transition">Członkostwo indywidualne</a></li>
                            <li><a href="dolacz.php#platnosci" class="hover:text-blue-300 transition font-semibold">Dane i przelew składek</a></li>
                            <li class="pt-2"><a href="polityka-prywatnosci.php" class="text-blue-500 font-semibold hover:text-white transition">Polityka Prywatności i Cookies (RODO)</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-xl font-bold mb-4 text-blue-400">Kontakt i Dane</h4>
                        <address class="not-italic text-gray-400 text-sm mb-4 space-y-1">
                            <span class="font-semibold text-white block">WAI Poland Chapter</span>
                            <span>Borowa 75A</span><br/>
                            <span>97-540 Gidle</span><br/>
                            <span class="block pt-2">NIP: 949-18-24-435</span>
                            <span class="block">KRS: 0000090417</span>
                            <span class="block pt-2 text-xs font-semibold text-blue-300">Konto bankowe:</span>
                            <span class="block text-xs font-mono break-all bg-gray-800 p-1.5 rounded mt-1 text-gray-300">PL 85 1500 1399 1213 9004 0688 0000</span>
                        </address>
                        <p class="text-gray-400 text-sm mb-4"><i class="fas fa-envelope mr-2"></i> <a href="mailto:wai.poland@gmail.com" class="hover:text-blue-300 transition">wai.poland@gmail.com</a></p>
                        <a href="admin.php" class="text-sm text-gray-500 hover:text-white transition inline-flex items-center"><i class="fas fa-lock mr-2"></i>Panel Administratora</a>
                    </div>
                </div>
                
                <div class="border-t border-gray-800 pt-8">
                    <h4 class="text-center font-bold text-gray-400 mb-6 uppercase tracking-wider text-sm">Nasi Patroni i Partnerzy</h4>
                    <div class="flex flex-wrap justify-center gap-4 text-xs">
                        <?php
                        $partners = [
                            "https://wirenet.org",
                            "https://wwd.com.pl",
                            "https://www.prometsa.com.pl",
                            "https://herco.com.pl/pl/",
                            "https://gamametal.pl",
                            "https://www.wolco.pl",
                            "https://www.pphukonrad.pl/pl",
                            "https://efmetal.pl",
                            "https://www.agh.edu.pl",
                            "https://pawlakdrut.com",
                            "https://www.wlomet.com.pl/index.html"
                        ];
                        foreach ($partners as $p):
                            $cleanUrl = str_replace(['https://', 'www.'], '', $p);
                            $cleanName = explode('/', $cleanUrl)[0];
                        ?>
                            <a href="<?php echo $p; ?>" target="_blank" rel="noopener noreferrer" aria-label="Partner <?php echo $cleanName; ?>" class="bg-gray-800 hover:bg-blue-800 transition px-3 py-2 rounded text-gray-300 no-underline whitespace-nowrap"><?php echo $cleanName; ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>
                
                <div class="text-center text-gray-600 text-xs mt-12 pb-12 md:pb-4">
                    &copy; <?php echo date('Y'); ?> WAI Poland Chapter. Wszelkie prawa zastrzeżone.
                </div>
            </div>
        </footer>

        <!-- Cookie Banner -->
        <div id="cookie-banner" class="hidden fixed bottom-0 left-0 w-full bg-gray-900 border-t border-gray-700 p-4 z-50 shadow-2xl">
            <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-4 text-sm text-gray-300">
                <div class="flex-1">
                    <p>
                        Nasza strona internetowa korzysta z technologii takich jak pamięć lokalna przeglądarki (localStorage), 
                        aby zapewnić prawidłowe działanie serwisu (np. sesje logowania administratora) oraz w celach statystycznych. 
                        Dalsze korzystanie ze strony bez zmiany ustawień przeglądarki oznacza zgodę na ich użycie. 
                        Więcej informacji znajdziesz w naszej 
                        <a href="polityka-prywatnosci.php" class="text-blue-400 underline hover:text-blue-300 ml-1">Polityce Prywatności</a>.
                    </p>
                </div>
                <button id="accept-cookies" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded transition whitespace-nowrap">
                    Rozumiem i akceptuję
                </button>
            </div>
        </div>
    </div>

    <script>
        // Obsługa menu mobilnego
        const mobileBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        if (mobileBtn && mobileMenu) {
            mobileBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
                const icon = mobileBtn.querySelector('i');
                if (icon.classList.contains('fa-bars')) {
                    icon.classList.remove('fa-bars');
                    icon.classList.add('fa-times');
                } else {
                    icon.classList.remove('fa-times');
                    icon.classList.add('fa-bars');
                }
            });
        }

        // Obsługa banera cookies
        const cookieBanner = document.getElementById('cookie-banner');
        const acceptBtn = document.getElementById('accept-cookies');
        if (cookieBanner && acceptBtn) {
            if (!localStorage.getItem('wai_cookie_consent')) {
                cookieBanner.classList.remove('hidden');
            }
            acceptBtn.addEventListener('click', () => {
                localStorage.setItem('wai_cookie_consent', 'true');
                cookieBanner.classList.add('hidden');
            });
        }
    </script>
</body>
</html>