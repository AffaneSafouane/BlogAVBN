<?php $title = "Le blog de l'AVBN"; ?>

<?php ob_start(); ?>
<h1 class="text-center mb-6 text-2xl">Le super blog de l'AVBN !</h1>

<div class="w-[90%] mx-auto">
    <h2 class="mb-4 text-xl">Modifier Votre Commentaire</h2>

    <form action="index.php?action=updateComment&id=<?= urlencode($comment->identifier); ?>" method="POST">
        <div>
            <input type="hidden" id="id" name="id" value="<?= $comment->post ?>">
        </div>

        <div class="mb-4">
            <label for="comment" class="block mb-2 text-sm font-medium text-white">Commentaire</label>
            <textarea name="comment" id="comment" cols="20" rows="5" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-neutral-800 text-white border border-gray-500 rounded bg-gray-900 text-white"><?= htmlspecialchars($comment->comment); ?></textarea>
        </div>

        <button type="submit" class="focus:outline-none text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Envoyer</button>
    </form>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('./template/layout.php') ?>