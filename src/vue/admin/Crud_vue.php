<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Films</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href=".//static/css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="">Dashboard</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="?action=admin&table=film">Film</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?table=stream">Stream</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?table=achat">Achat</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?table=adherent">Adherent</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">List of <?php echo ucfirst($table); ?>s</h1>
                </div>
                <table class="table">
                <a href="?action=create" class="btn btn-primary">
                                        <i class="bi bi-plus"></i> <!-- Plus icon for create -->
                                        Create
                                    </a>
                    <!-- Table headings -->
                    <thead>
                        <tr>
                            <?php switch ($table) {
                                case 'film':
                                    echo '
                                <th>Title</th>
                                <th>Description</th>
                                <th>Durée</th>
                                <th>État</th>
                                <th>Date de Sortie</th>
                                <th>Affiche</th>
                                <th>Date dExpiration</th>
                                ';
                                    break;
                                case 'stream':
                                    echo '
                                <th>Stream ID</th>
                                <th>Date Achat</th>
                                <th>Date Expiration</th>
                                <th>Film ID</th>
                                <th>Adherent ID</th>
                                ';
                                    break;
                                case 'achat':
                                    echo '
                                <th>id_billet</th>
                                <th>horaire_date</th>
                                <th>date_d’achat</th>
                                <th>nb_places_achetees</th>
                                <th>id_adherent</th>
                                <th>id_seance</th>
                                ';


                                    break;

                                case 'adherent':
                                    echo '
                                    <th>id</th>
                                    <th>nom</th>
                                    <th>prenom</th>
                                    <th>mail</th>
                                    <th>password</th>
                                    <th>points</th>
                                    <th>date_creation</th>
                                    <th>compte</th>
                                    <th>id_ville</th>
                                    ';


                                    break;
                            }
                            ?>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Table data -->
                        <?php foreach ($data as $item) : ?>
                            <tr>
                                <?php
                                // Switch statement to display table data based on the selected table
                                switch ($table) {
                                    case 'film':
                                        echo '
                                        <td>' . $item->titre . '</td>
                                        <td>' . $item->description . '</td>
                                        <td>' . $item->duree . '</td>
                                        <td>' . $item->etat . '</td>
                                        <td>' . $item->date_sortie . '</td>
                                        <td>' . $item->id_affiche . '</td>
                                        <td>' . $item->date_expiration . '</td>
                                             ';
                                        break;

                                    case 'stream':
                                        echo '
                                        <td>' . $item['stream_id'] . '</td>
                                        <td>' . $item['date_achat'] . '</td>
                                        <td>' . $item['date_expiration'] . '</td>
                                        <td>' . $item['id_film'] . '</td>
                                        <td>' . $item['id_adherent'] . '</td>
                                             ';
                                        break;
                                    case 'achat':
                                        echo '
                                            <td>' . $item['id_billet'] . '</td>
                                            <td>' . $item['horaire_date'] . '</td>
                                            <td>' . $item['date_d’achat'] . '</td>
                                            <td>' . $item['nb_places_achetees'] . '</td>
                                            <td>' . $item['id_adherent'] . '</td>
                                            <td>' . $item['id_seance'] . '</td>
                                                 ';
                                        break;
                                    case 'adherent':
                                        echo '
                                           <td>' . $item['id'] . '</td>
                                           <td>' . $item['nom'] . '</td>
                                            <td>' . $item['prenom'] . '</td>
                                            <td>' . $item['mail'] . '</td>
                                            <td>' . $item['password'] . '</td>
                                            <td>' . $item['date_creation'] . '</td>
                                            <td>' . $item['compte'] . '</td>
                                            <td>' . $item['id_ville'] . '</td>
                                        ';
                                        break;
                                }
                                ?>
                                <td>
                                 

                                    <a href="" class="btn btn-warning">
                                        <i class="bi bi-pencil"></i> <!-- Pencil icon for update -->
                                        Update
                                    </a>

                                    <a href="" class="btn btn-danger">
                                        <i class="bi bi-trash"></i> <!-- Trash icon for delete -->
                                        Delete
                                    </a>



                                </td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </table>

                <button type="button" class="btn btn-outline-info" href="">Info</button>
            </main>

        </div>
    </div>

    <!-- Bootstrap JS (optional) -->
    <script>
    // Function to get URL parameters
    function getUrlParameter(name) {
        name = name.replace(/[[]/, '\\[').replace(/[\]]/, '\\]');
        var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
        var results = regex.exec(location.search);
        return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
    };

    // Check for success parameter in URL
    var successParam = getUrlParameter('success');
    if (successParam === '1') {
        // If success parameter is present, show the success alert
        alert('Film created successfully!');
    }
</script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
