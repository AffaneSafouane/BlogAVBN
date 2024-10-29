<?php $title = "Le blog de l'AVBN : Erreur"; ?>

<?php ob_start(); ?>
<section class="w-[80%] mx-auto px-6">
    <h1 class="text-center mb-6 text-2xl">Le super blog de l'AVBN !</h1>
    <div role="alert">
        <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
            Une erreur est survenue
        </div>
        <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
            <?= $errorMessage; ?>
        </div>
    </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('layout.php') ?>