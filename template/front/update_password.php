<?php $title = "Le blog de l'AVBN"; ?>

<?php ob_start(); ?>
<h1 class="text-center mb-6 text-2xl">Le super blog de l'AVBN !</h1>

<div class="w-[90%] mx-auto">
    <h2 class="mb-4 text-xl">Modifier de votre mot de passe</h2>

    <form action="index.php?action=updatePassword&id=<?= urlencode($user->identifier); ?>" method="POST">
        <div class="mb-4">
            <label for="password" class="block mb-2 text-sm font-medium text-white">Ancien mot de passe*</label>
            <input type="password" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-black text-white border border-gray-500 rounded bg-neutral-800 text-white" id="password" name="password" placeholder="Votre mot de passe" required>
        </div>

        <div class="mb-4">
            <label for="new_password" class="block mb-2 text-sm font-medium text-white">Nouveau mot de passe*</label>
            <input type="password" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-black text-white border border-gray-500 rounded bg-neutral-800 text-white" id="new_password" name="new_password" placeholder="Votre mot de passe" required>
        </div>

        <div class="mb-4">
            <label for="confirm_password" class="block mb-2 text-sm font-medium text-white">Confirmation mot de passe*</label>
            <input type="password" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-black text-white border border-gray-500 rounded bg-neutral-800 text-white" id="confirm_password" name="confirm_password" placeholder="Confirmer votre mot de passe" required>
        </div>

        <button type="submit" class="focus:outline-none text-white focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 bg-blue-600 hover:bg-blue-700 focus:ring-blue-800">Envoyer</button>
    </form>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('./template/layout.php'); ?>