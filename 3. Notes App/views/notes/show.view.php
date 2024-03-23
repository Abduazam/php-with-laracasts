<?php require('views/partials/head.php') ?>

    <?php require('views/partials/nav.php') ?>

    <?php require('views/partials/banner.php') ?>

    <main>
        <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
            <!-- Your content -->
            <p class="mb-5">
                <a class="text-blue-500 underline" href="/notes">Go back.</a>
            </p>
            
            <p>
                <?= $note['body'] ?>
            </p>
        </div>
    </main>

<?php require('views/partials/footer.php') ?>