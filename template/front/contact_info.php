<?php $title = "Confirmation Contact"; ?>

<?php ob_start(); ?>
<h1 class="text-center mb-4 text-2xl">Message bien reçu !</h1>

<div class="relative flex flex-col min-w-0 rounded break-words border bg-neutral-800 border-1 border-gray-300">
    <div class="flex-auto p-6">
        <h5 class="mb-3">Rappel de vos informations</h5>
        <p class="mb-0"><b>Email</b> : <?= nl2br(htmlspecialchars($input['author'])); ?> </p>
        <p class="mb-3"><b>Message</b> : <?= nl2br(htmlspecialchars($input['message'])); ?> </p>
        <?php if ($image != null) : ?>
            <div class="relative px-3 py-3 mb-4 border rounded bg-green-200 border-green-300 text-green-800" role="alert">
                <p class="mb-0"><b>Capture d'écran</b> : <?= "L'envoi a bien été effectué !" ?> </p>
            </div>
        <?php endif; ?>
    </div>
    <a class="inline-block py-2 px-4 no-underline text-blue-500 hover:underline" href="index.php">Retour à l'accueil</a>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('./template/layout.php'); ?>