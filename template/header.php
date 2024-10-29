<header class="mb-5">
  <nav class="bg-black relative">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4 px-6 w-[80%]">
      <!-- Logo ou Nom du site -->
      <span class="text-white font-bold text-xl">BlogAVBN</span>

      <!-- Bouton Toggler pour mobile -->
      <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm rounded-lg md:hidden focus:outline-none focus:ring-2 text-gray-400 hover:bg-gray-700 focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false" id="navbar-toggler">
        <span class="sr-only">Open main menu</span>
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
        </svg>
      </button>

      <!-- Menu Navigation -->
      <div class="hidden w-full md:block md:w-auto" id="navbar-default">
        <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border rounded-lg md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 border-gray-700">
          <li>
            <a href="index.php" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Accueil</a>
          </li>
          <li>
            <a href="index.php?action=addMessage" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Contact</a>
          </li>
          <?php if (isset($_SESSION['LOGGED_USER']) && isset($_COOKIE['LOGGED_USER'])): ?>
            <li>
              <a href="index.php?action=user&id=<?= urlencode($_SESSION['LOGGED_USER']); ?>" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Utilisateur</a>
            </li>
          <?php else: ?>
            <li>
              <a href="index.php?action=login" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Connexion</a>
            </li>
            <li>
              <a href="index.php?action=addUser" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Inscription</a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>
</header>

<script>
  // Script pour toggler le menu mobile
  document.getElementById('navbar-toggler').addEventListener('click', function() {
    var menu = document.getElementById('navbar-default');
    // Toggle `hidden` to show/hide the menu
    menu.classList.toggle('hidden');
  });
</script>