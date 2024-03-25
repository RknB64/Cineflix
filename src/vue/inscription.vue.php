<div class="mx-3">

    <div class="container mt-3">
        <h1 class="text-white">Je m'inscris</h1>
        <p class="text-white">Complétez le formulaire pour vous inscrire</p>
    </div>

    <div class="container bg-dark text-white p-4 mt-3 rounded border border-secondary">
        <form action="" method="post">

            <?php foreach ($fields as $field) :
                $id = str_replace(" ", "_", $field[LABEL]); ?>

                <div class="w-75 mx-auto mb-3">
                    <label for='<?= $id ?>'> <?= $field[LABEL] ?> </label>
                    <input class="form-control" type="<?= $field[TYPE] ?>" value="" id="<?= $id ?>" required>
                </div>
            <?php endforeach; ?>

            <div class="w-75 mx-auto mb-3">
                <button type="submit" class="btn btn-outline-light ">Submit</button>
            </div>
        </form>
    </div>
</div>
