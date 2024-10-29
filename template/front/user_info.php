<?php $title = "Informations Utilisateur"; ?>
<?php ob_start(); ?>
<section class="container w-[80%] mx-auto px-6">
    <h1 class="text-center mb-4 text-2xl">Votre Utilisateur</h1>
    <div class="relative flex flex-col min-w-0 rounded break-words border bg-neutral-800 border-1 border-gray-300">
        <div class="flex-auto p-6 mb-3">
            <h5 class="mb-3 text-xl">Rappel de vos informations</h5>
            <p class="mb-0"><b>Email</b> : <?= nl2br(htmlspecialchars($user->email)); ?></p>
            <p class="mb-0"><b>Pseudo</b> : <?= nl2br(htmlspecialchars($user->pseudo)); ?></p>
            <p class="mb-0"><b>Age</b> : <?= nl2br(htmlspecialchars($user->age)); ?> ans</p>
            <p class="mb-0"><b>Genre</b> : <?php if ($user->sexe === 'H') : ?> Homme <?php else : ?> Femme <?php endif; ?></p>
            <?php if ($user->lastName !== null) : ?>
                <p class="mb-0"><b>Nom de famille</b> : <?= nl2br(htmlspecialchars($user->lastName)); ?></p>
            <?php endif; ?>
            <?php if ($user->firstName !== null) : ?>
                <p class="mb-0"><b>Prénom</b> : <?= nl2br(htmlspecialchars($user->firstName)); ?></p>
            <?php endif; ?>
            <p class="mb-0"><b>Date de création</b> : Le <?= nl2br(htmlspecialchars($user->userCreationDate)); ?></p>
        </div>
        <div class="flex flex-wrap items-center justify-between mb-4 mx-6">
            <em><a class="hover:underline text-yellow-500" href="index.php?action=updateUser&id=<?= urlencode($user->identifier); ?>">Modifier</a></em>
            <em><a class="hover:underline text-yellow-500" href="index.php?action=updatePassword&id=<?= urlencode($user->identifier); ?>">Modifier le mot de passe</a></em>
            <em><a class="hover:underline text-red-500" href="index.php?action=deleteUser&id=<?= urlencode($user->identifier); ?>">Supprimer</a></em>
        </div>
    </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('./template/layout.php'); ?>