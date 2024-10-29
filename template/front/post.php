<?php $title = $post->title ?>

<?php ob_start(); ?>
<section class="w-[80%] mx-auto px-6">
    <h1 class="text-center mb-4 text-2xl">Le super blog de l'AVBN !</h1>
    <div class="mb-5">
        <h3 class="text-center bg-black text-white mb-0">
            <?= htmlspecialchars($post->title); ?>
            <em> (<?= $post->frenchCreationDate; ?> par <strong><?php if (isset($_SESSION['LOGGED_USER']) && isset($_COOKIE['LOGGED_USER']) && $loggedUser->pseudo === $post->pseudo) :  ?><a class="hover:underline text-blue-500" href="index.php?action=user&id=<?= urlencode($loggedUser->identifier); ?>"><?= $post->pseudo; ?></a><?php else : ?><?= $post->pseudo; ?><?php endif; ?></strong>)</em>
        </h3>

        <p class="bg-neutral-800 text-white mt-0 px-4 py-2">
            <?=
            nl2br(htmlspecialchars($post->content));
            ?>
            <?php if (isset($_SESSION['LOGGED_USER']) && isset($_COOKIE['LOGGED_USER']) && $_COOKIE['LOGGED_USER'] === $post->pseudo) : ?>
                <div class="flex flex-wrap items-center justify-between mb-4 bg-neutral-800 text-white mt-0">
                    <em><a class="hover:underline text-yellow-500" href="index.php?action=updatePost&id=<?= urlencode($post->identifier) ?>">Modifier</a></em>
                    <em><a class="hover:underline text-red-500" href="index.php?action=deletePost&id=<?= urlencode($post->identifier) ?>">Supprimer</a></em>
                </div>
            <?php endif; ?>
        </p>
    </div>

    <div class="mb-3">
        <?php if (!empty($comments)) : ?>
            <hr class="mb-5">

            <h2 class="mb-5 text-xl">Liste de commentaires</h2>
            <?php foreach ($comments as $comment): ?>
                <div class="mb-5 border rounded-lg border-gray-300 bg-neutral-800 p-4">
                    <p><strong>
                        <?php if (isset($_SESSION['LOGGED_USER']) && isset($_COOKIE['LOGGED_USER']) && $loggedUser->pseudo === $comment->pseudo) :  ?>
                            <a class="hover:underline text-blue-500" href="index.php?action=user&id=<?= urlencode($loggedUser->identifier); ?>">
                                <?= $comment->pseudo; ?>
                            </a>
                        <?php else : ?>
                            <?= $comment->pseudo; ?>
                        <?php endif; ?>
                    </strong> le <?= $comment->frenchCreationDate ?> 
                    <?php if (isset($_SESSION['LOGGED_USER']) && isset($_COOKIE['LOGGED_USER']) && $_COOKIE['LOGGED_USER'] === $comment->pseudo) : ?> 
                        (<a class="hover:underline text-yellow-500" href="index.php?action=updateComment&id=<?= urlencode($comment->identifier); ?>">Modifier</a>) 
                        (<a class="hover:underline text-red-500" href="index.php?action=deleteComment&id=<?= urlencode($comment->identifier); ?>">Supprimer</a>) 
                    <?php endif; ?></p>
                    <p><?= nl2br(htmlspecialchars($comment->comment)) ?></p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['LOGGED_USER']) && isset($_COOKIE['LOGGED_USER'])) : ?>
            <hr class="mb-5">

            <div class="w-[50%] mx-auto">
                <h2 class="mb-5 text-xl text-center">Ajouter un commentaire</h2>
                <form action="index.php?action=addComment&id=<?= $post->identifier ?>" method="POST">
                    <div class="mb-4">
                        <input type="hidden" id="user_id" name="user_id" value="<?= $loggedUser->identifier; ?>">
                    </div>
                    <div class="mb-4">
                        <label for="comment" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Commentaire</label>
                        <textarea name="comment" id="comment" cols="20" rows="5" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-neutral-800 text-white border border-gray-500 rounded bg-gray-900 text-white" placeholder="Votre commentaire"></textarea>
                    </div>
                    <button type="submit" class="focus:outline-none text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Soumettre</button>
                </form>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('./template/layout.php'); ?>