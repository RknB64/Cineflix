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
                            <a class="nav-link" href="?table=film">Film</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?table=stream">Stream</a>
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
                    <!-- Table headings -->
                    <thead>
                        <tr>
                            <?php if ($table === 'film') : ?>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Durée</th>
                                <th>État</th>
                                <th>Date de Sortie</th>
                                <th>Affiche</th>
                                <th>Date d'Expiration</th>
                            <?php elseif ($table === 'stream') : ?>
                                <th>Stream ID</th>
                                <th>Date Achat</th>
                                <th>Date Expiration</th>
                                <th>Film ID</th>
                                <th>Adherent ID</th>
                            <?php endif; ?>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Table data -->
                        <?php foreach ($data as $item) : ?>
                            <tr>
                                <?php if ($table === 'film') : ?>
                                    <td><?= $item['titre'] ?></td>
                                    <td><?= $item['description'] ?></td>
                                    <td><?= $item['duree'] ?></td>
                                    <td><?= $item['etat'] ?></td>
                                    <td><?= $item['date_sortie'] ?></td>
                                    <td><?= $item['id_affiche'] ?></td>
                                    <td><?= $item['date_expiration'] ?></td>
                                <?php elseif ($table === 'stream') : ?>
                                    <td><?= $item['stream_id'] ?></td>
                                    <td><?= $item['date_achat'] ?></td>
                                    <td><?= $item['date_expiration'] ?></td>
                                    <td><?= $item['id_film'] ?></td>
                                    <td><?= $item['id_adherent'] ?></td>
                                <?php endif; ?>
                                <td>
                                    <a href="" class="btn btn-primary">
                                        <i class="bi bi-eye"></i> <!-- Eye icon for view -->
                                        Create
                                    </a>
                                  
                                    <button class="btn btn-danger">
                                        <i class="bi bi-trash"></i> <!-- Trash icon for delete -->
                                        Delete
                                    </button>
                                    <button class="btn btn-warning">
                                        <i class="bi bi-pencil"></i> <!-- Pencil icon for edit/update -->
                                        Edit
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                
                <button type="button" class="btn btn-outline-info" href="?page1">Info</button>
            </main>
            
        </div>
    </div>
    
    <!-- Bootstrap JS (optional) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>