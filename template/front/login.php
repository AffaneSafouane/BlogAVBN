<?php $title = "Connexion"; ?>
<?php ob_start(); ?>
<section class="container mx-auto w-[80%] px-6">
    <div class="w-[50%] mx-auto">
        <h1 class="text-center mb-4 text-2xl">Connectez Vous</h1>
        <form action="index.php?action=login" method="POST">
            <div class="mb-4">
                <label for="email" class="block mb-2 text-sm font-medium text-white">Email*</label>
                <input type="email" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-black text-white border border-gray-500 rounded bg-neutral-800 text-white" id="email" name="email" placeholder="L'email utilisé lors de la création de compte" required>
            </div>

            <div class="mb-4">
                <label for="password" class="block mb-2 text-sm font-medium text-white">Mot de passe*</label>
                <input type="password" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-black text-white border border-gray-500 rounded bg-neutral-800 text-white" id="password" name="password" placeholder="Votre mot de passe" required>
            </div>

            <div class="flex flex-wrap items-center justify-between mb-4">
                <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 focus:ring-blue-800">Connexion</button>
                <a href="index.php" class="text-blue-500 hover:underline">Continuer sans connexion</a>
            </div>
        </form>
    </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('./template/layout.php');
