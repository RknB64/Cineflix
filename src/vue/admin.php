<?php
/*
* Cette vue utilise les fonctions ajax situées dans le fichier ajaxAdminOperation.js
* pour toutes les opérations sur les adhérents et les films
*/
?>

<script src="static/js/ajaxAdminOperation.js" defer></script>

<body>
  <div class="bg-white">
    <div class="d-flex">
      <!-- Sidebar -->
    <div id="admin-sidebar" class="d-flex flex-column p-3 bg-light" style="width: 280px;">
        <div class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-decoration-none">
          <i class="bi bi-pencil-square mx-3"></i>
          <span class="fs-4">Administration</span>
        </div>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
          <li class="nav-item">
            <a class="nav-link link-dark <?= $table === 'film' ? 'active text-white' : '' ?>" href="?action=admin&table=film"> 
                <i class="bi bi-film"></i>
                Films
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link link-dark <?= $table === 'adherent' ? 'active text-white' : '' ?>" href="?action=admin&table=adherent">
              <i class="bi bi-person-fill"></i>
              Adhérents
            </a>
          </li>
        </ul>
        <hr>
      </div>

      <!-- Main Content -->
      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Liste des <?php echo ucfirst($table); ?>s</h1>
        </div>
        <table class="table table-responsive">
          <!-- Table headings -->
          <thead>
            <tr>
              <?php switch ($table) {
                case 'film':
                  echo '
                      <th>id</th>
                      <th>Titre</th>
                      <th>Description</th>
                      <th>Durée</th>
                      <th>État</th>
                      <th>Date de Sortie</th>
                      <th>Affiche</th>
                      <th>Date d\'expiration</th>
                      ';
                  break;

                case 'adherent':
                  echo '
                      <th>Id</th>
                      <th>Nom</th>
                      <th>Prenom</th>
                      <th>Mail</th>
                      <th>Date creation</th>
                      <th>Admin</th>
                      <th>Ville</th>
                      ';

                  break;
              }
              ?>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <!-- Table data -->
            <!-- formulaire pour ajouter un film -->
            <?php foreach ($data as $item) : ?>
                <tr id="<?= 'tr-'.$item->id ?>">
                <?php
                // Switch statement to display table data based on the selected table
                switch ($table) {
                  case 'film':
                    echo '
                          <td>' . $item->id . '</td>
                          <td>' . $item->titre . '</td>
                          <td>' . $item->description . '</td>
                          <td>' . $item->duree . '</td>
                          <td>' . $item->etat . '</td>
                          <td>' . (new DateTime($item->date_sortie))->format('d/m/y') . '</td>
                          <td>' . $item->id_affiche . '</td>
                          <td>' . (new DateTime($item->date_expiration))->format('d/m/y') . '</td>
                        ';
                    break;

                  case 'adherent':
                    echo '
                          <td>' . $item->id . '</td>
                          <td>' . $item->nom . '</td>
                          <td>' . $item->prenom . '</td>
                          <td>' . $item->mail . '</td>
                          <td>' . (new DateTime($item->date_creation))->format('d/m/y') . '</td>
                          <td id="estAdmin-'.$item->id .'">' . ($item->estAdmin ? 'Oui' : 'Non') . '</td>
                          <td>' . $item->getVilleName() . '</td>
                      ';
                    break;
                }
                ?>
                <td>


                  <?php if ($table === 'adherent') : ?>
                    <button onclick="AjaxAdmin.toggleAdmin(event)" class="btn btn-warning" data-idadherent="<?= $item->id ?>">
                        <i class="bi bi-pencil"></i> <!-- Pencil icon for update -->
                        Toggle admin
                    </button>
                  <?php endif; ?>

                    <button onclick="AjaxAdmin.delete(event, {table: '<?=$table?>' })" class="btn btn-danger" data-id="<?= $item->id ?>">
                        <i class="bi bi-trash"></i> <!-- Pencil icon for update -->
                    </button>

                </td>
              </tr>
            <?php endforeach; ?>

            <!-- formulaire pour ajouter un film -->
            <?php if($table === 'film'): ?>
                <tr id="film-form-tr">
                    <form id="film-form">


                                <td></td>
                                <td><input name="titre" class="form-control" type="text" placeholder="titre"></td>
                                <td><input name="description" class="form-control" type="text" placeholder="description"></td>
                                <td><input name="duree" class="form-control" type="text" placeholder="durée"></td>
                                <td> <select name="etat" class="form-control">
                                    <option value="cinema">cinema</option>
                                    <option value="streaming">streaming</option>
                                </select>
                                </td>
                                <td><input name="date_sortie" class="form-control" type="date"></td>
                                <td><input name="id_affiche" class="form-control" type="number"></td>
                                <td><input name="date_expiration" class="form-control" type="date"></td>
                                <td>
                                    <div onclick="AjaxAdmin.addFilm()" class="btn btn-primary" >
                                        <i class="bi bi-plus"></i>
                                    </div>
                                </td>

                    </form>
                </tr>
            <?php endif; ?>


          </tbody>
        </table>
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
</body>

</html>
