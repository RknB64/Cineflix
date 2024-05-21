<?php
ob_start();

require_once "modele/FilmBD.php";
require_once "modele/StreamBD.php"; // Assuming you have a StreamBD class

$table = isset($_GET['table']) ? $_GET['table'] : (isset($_POST['table']) ? $_POST['table'] : 'stream');

switch ($table) {
    case 'film':
        if (isset($_POST['title']) && isset($_POST['description']) && isset($_POST['duration']) && isset($_POST['etat']) && isset($_POST['date_s']) && isset($_POST['show']) && isset($_POST['date_e'])) {
            $titre = $_POST['title'];
            $desc = $_POST['description'];
            $duree = $_POST['duration'];
            $etat = $_POST['etat'];
            $date = $_POST['date_s'];
            $affiche = $_POST['show'];
            $date_e = $_POST['date_e'];

            try {
                FilmBD::addFilm($table, $titre, $desc, $droit, $date, $duree, $affiche, $etat);

                // Redirect to the current page with the success parameter
                header('Location: ' . '?table=film&success=1');
                exit();
            } catch (PDOException $e) {
                $errorMessage = $e->getMessage();
            }
        }
        break;

    case 'stream':
        if (isset($_POST['date_achat']) && isset($_POST['date_expiration']) && isset($_POST['id_film']) && isset($_POST['id_adherent'])) {
            $id_film = $_POST['id_film'];
            $id_adherent = $_POST['id_adherent'];
            $date_expiration = $_POST['date_expiration'];
            $date_achat = $_POST['date_achat'];

            try {
                StreamBD::addStream($id_film, $id_adherent, $date_expiration, $date_achat);
                 header('Location: ' .'?table=stream&success=1');
                exit();
            } catch (PDOException $e) {
                $errorMessage = $e->getMessage();
            }
        }
        break;

    default:
        
        break;
}

ob_end_flush();
?>

<body>

    <div class="container">
        <h1>Create New <?php echo ucfirst($table) ?></h1>

        <?php if (isset($errorMessage)) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $errorMessage; ?>
            </div>
        <?php endif; ?>
        <?php switch ($table):
            case 'film':
        ?>
                <form method="POST">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="duration">Durée</label>
                        <input type="text" class="form-control" id="duration" name="duration" required>
                    </div>
                    <div class="form-group">
                        <label for="etat">État</label>
                        <select class="form-control" id="etat" name="etat">
                            <option value="">Select État</option>
                            <option value="cinema">cinema</option>
                            <option value="streaming">streaming</option>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="show">Affiche</label>
                        <input type="number" class="form-control" id="show" name="show" required>
                    </div>
                    <div class="form-group">
                        <label for="date_e">Date dExpiration</label>
                        <input type="date" class="form-control" id="date_e" name="date_e" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
    </div>
<?php break;
            case 'stream': ?>

    <!-- From Stream -->
    <form method="POST">
        <div class="form-group">
            <label for="id_film">id_film</label>
            <input type="text" class="form-control" id="id_film" name="id_film" required>
        </div>
        <div class="form-group">
            <label for="id_adherent">id_adherent</label>
            <textarea class="form-control" id="id_adherent" name="id_adherent" rows="3" required></textarea>
        </div>
        <div class="form-group">
            <label for="date_expiration">date_expiration</label>
            <input type="date" class="form-control" id="date_expiration" name="date_expiration" required>
        </div>


        <div class="form-group">
            <label for="date_achat">date_achat</label>
            <input type="number" class="form-control" id="date_achat" name="date_achat" required>
        </div>
        <div class="form-group">
            <label for="date_e2">Date dExpiration</label>
            <input type="date" class="form-control" id="date_e2" name="date_e" required>
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
<?php break;
            default:
                // Handle default case or add more cases for other tables
                break;
        endswitch; ?>
</div>
<!-- Bootstrap JS (optional) -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</body>

</html>
