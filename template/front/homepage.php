<?php $title = "Le blog de l'AVBN"; ?>

<?php ob_start(); ?>
<section class="container mx-auto px-6 w-[80%]">
    <h1 class="text-center text-2xl mb-3">Le super blog de l'AVBN !</h1>

    <div class="mb-5">
        <?php
        foreach ($posts as $post): ?>
            <h3 class="text-center bg-black text-white mb-0">
                <?= htmlspecialchars($post->title); ?>
                <em> (<?= $post->frenchCreationDate; ?> par
                    <strong>
                        <?php if (isset($_SESSION['LOGGED_USER']) && isset($_COOKIE['LOGGED_USER']) && $loggedUser->pseudo === $post->pseudo): ?>
                            <a class="hover:underline text-blue-500" href="index.php?action=user&id=<?= urlencode($loggedUser->identifier); ?>"><?= $post->pseudo; ?></a><?php else: ?>
                            <?= $post->pseudo; ?><?php endif; ?></strong>)
                </em>
            </h3>
            <p class="mt-0 px-4" style="background-color: #1b1e1f">
                <?=
                // We display the post content
                nl2br(htmlspecialchars($post->content));
                ?>
                <br />
                <em><a class="hover:underline text-blue-500" href="index.php?action=post&id=<?= urlencode($post->identifier); ?>">Commentaires</a></em>
            </p>
        <?php endforeach; ?>
    </div>

    <?php if (isset($_SESSION['LOGGED_USER']) && isset($_COOKIE['LOGGED_USER'])): ?>
        <hr>

        <div class="mt-5 w-[50%] mx-auto">
            <h2 class="text-center text-xl">Ajouter un post</h2>

            <form action="index.php?action=addPost" method="POST">
                <div class="mb-4">
                    <input type="hidden" id="user_id" name="user_id" value="<?= $loggedUser->identifier; ?>" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-black text-white border border-gray-500 rounded bg-neutral-800 text-white">
                </div>

                <div class="mb-4">
                    <label for="title" class="form-label">Titre</label>
                    <input type="text" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-black text-white border border-gray-500 rounded bg-neutral-800 text-white" name="title" placeholder="Le titre de votre post">
                </div>

                <div class="mb-4">
                    <label for="post" class="form-label">Post</label>
                    <textarea name="content" id="content" cols="20" rows="5" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-black text-white border border-gray-500 rounded bg-neutral-800 text-white" placeholder="Votre post"></textarea>
                </div>

                <button type="submit" class="focus:outline-none text-white focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-5 bg-blue-600 hover:bg-blue-700 focus:ring-blue-800">Soumettre</button>
            </form>
        </div>
    <?php endif; ?>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('./template/layout.php') ?>