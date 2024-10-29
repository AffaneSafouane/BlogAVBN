<?php $title = "Contact"; ?>

<?php ob_start(); ?>
<section class="container w-[80%] mx-auto">
    <h1 class="text-center mb-4 text-2xl">Nous contacter</h1>
    <div class="w-[50%] mx-auto">
        <form action="index.php?action=addMessage" method="POST" enctype="multipart/form-data" class="w-[90%] mx-auto">
            <div class="mb-4">
                <label for="author" class="block mb-2 text-sm font-medium text-white">Email*</label>
                <input type="email" id="author" name="author" aria-describedby="email-help" placeholder="you@exemple.com" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-black text-white border border-gray-500 rounded bg-neutral-800 text-white" required>
                <div id="email-help">Nous ne revendrons pas votre email</div>
            </div>

            <div class="mb-4">
                <label for="message" class="block mb-2 text-sm font-medium text-white">Message*</label>
                <textarea name="message" id="message" cols="30" rows="5" placeholder="Exprimez vous" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-neutral-800 text-white border border-gray-500 rounded bg-gray-900 text-white" required></textarea>
            </div>

            <div class="mb-4">
                <label for="screenshot" class="block mb-2 text-sm font-medium text-white">Capture d'écran</label>
                <input class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-black text-white border border-gray-500 rounded bg-neutral-800 text-white" type="file" id="screenshot" name="screenshot">
            </div>

            <button type="submit" class="focus:outline-none text-white focus:ring-4 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 bg-blue-600 hover:bg-blue-700 focus:ring-blue-800">Envoyer</button>
        </form>
    </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('./template/layout.php') ?>