<?php $title = "Modification d'utilisateur"; ?>

<?php ob_start(); ?>
<h1 class="text-center mb-4 text-2xl">Modification de compte</h1>

<form action="index.php?action=updateUser&id=<?= urlencode($user->identifier); ?>" method="POST">
    <div class="mb-4">
        <label for="email" class="block mb-2 text-sm font-medium text-white">Email*</label>
        <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-black text-white border border-gray-500 rounded bg-neutral-800 text-white" id="email" name="email" placeholder="you@exemple.com" value="<?= htmlspecialchars($user->email); ?>" required>
    </div>

    <div class="mb-4">
        <label for="pseudo" class="block mb-2 text-sm font-medium text-white">Pseudo*</label>
        <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-black text-white border border-gray-500 rounded bg-neutral-800 text-white" id="pseudo" name="pseudo" placeholder="Choisissez un pseudo" value="<?= htmlspecialchars($user->pseudo); ?>" required>
    </div>

    <div class="mb-4">
        <label for="last_name" class="block mb-2 text-sm font-medium text-white">Nom de famille</label>
        <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-black text-white border border-gray-500 rounded bg-neutral-800 text-white" id="last_name" name="last_name" placeholder="Votre nom de famille" value="<?= htmlspecialchars($user->lastName); ?>">
    </div>

    <div class="mb-4">
        <label for="first_name" class="block mb-2 text-sm font-medium text-white">Prénom</label>
        <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-black text-white border border-gray-500 rounded bg-neutral-800 text-white" id="first_name" name="first_name" placeholder="Votre Prénom" value="<?= htmlspecialchars($user->firstName); ?>">
    </div>

    <div class="mb-4">
        <label for="age" class="block mb-2 text-sm font-medium text-white">Age*</label>
        <input type="number" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-black text-white border border-gray-500 rounded bg-neutral-800 text-white" id="age" name="age" placeholder="Votre age" min="18" max="90" value="<?= $user->age; ?>" required>
    </div>

    <div class="mb-4">
        <label for="genre" class="block mb-2 text-sm font-medium text-white">Genre*</label>
        <select name="sexe" id="sexe" class="block w-full px-3 py-2 text-base text-white bg-neutral-800 border border-gray-500 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" required>
            <option value="" selected disabled>Genre</option>
            <option value="H" <?= $user->sexe === "H" ? 'selected' : ''; ?>>Homme</option>
            <option value="F" <?= $user->sexe === "F" ? 'selected' : ''; ?>>Femme</option>
        </select>
    </div>

    <button type="submit" class="focus:outline-none text-white focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 bg-blue-600 hover:bg-blue-700 focus:ring-blue-800">Envoyer</button>
</form>

<?php $content = ob_get_clean(); ?>

<?php require('./template/layout.php'); ?>