<?php require base_path('views/partials/head.php') ?>
    <?php require base_path('views/partials/nav.php') ?>

    <?php require base_path('views/partials/banner.php') ?>

    <main>
        <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
            <!-- Your content -->
            <p class="mb-5">
                <a class="text-blue-500 underline" href="/notes">Go back.</a>
            </p>
            
            <p>
                <?= $note['body'] ?>
            </p>

            <div class="flex gap-x-2 mt-6">
                <form method="POST">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="id" value="<?= $note['id'] ?>">
                    <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-red-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">Delete</button>
                </form>

                <a href="/notes/edit?id=<?= $note['id'] ?>" class="inline-flex justify-center rounded-md border border-transparent bg-gray-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">Edit</a>
            </div>
        </div>
    </main>

<?php require base_path('views/partials/footer.php') ?>