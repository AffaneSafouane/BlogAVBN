<?php $title = 'Supprimer un commentaire'; ?>

<?php ob_start(); ?>
<h1 class="mb-6 text-2xl">Voulez-vous supprimer un commentaire ?</h1>

<form action="index.php?action=deleteComment&id=<?= urlencode($comment->identifier); ?>" method="POST">
    <div class="mb-3">
        <input type="hidden" id="id" name="id" value="<?= $comment->post; ?>">
    </div>

    <button class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">La suppression est définitive</button>
</form>

<?php $content = ob_get_clean(); ?>

<?php require('./template/layout.php'); ?>