<body>
  <div class="container-fluid bg-white">
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
              <a class="nav-link" href="?action=admin&table=adherent">Adherent</a>
            </li>
          </ul>
        </div>
      </nav>

      <!-- Main Content -->
      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Liste des <?php echo ucfirst($table); ?>s</h1>
        </div>
        <table class="table">
          <a href="?action=create" class="btn btn-primary">
            <i class="bi bi-plus"></i>
            Ajouter
          </a>
          <!-- Table headings -->
          <thead>
            <tr>
              <?php switch ($table) {
                case 'film':
                  echo '
                      <th>id</th>
                      <th>Title</th>
                      <th>Description</th>
                      <th>Durée</th>
                      <th>État</th>
                      <th>Date de Sortie</th>
                      <th>Affiche</th>
                      <th>Date dExpiration</th>
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
            <?php foreach ($data as $item) : ?>
              <tr>
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
                          <td>' . $item->date_sortie . '</td>
                          <td>' . $item->id_affiche . '</td>
                          <td>' . $item->date_expiration . '</td>
                        ';
                    break;

                  case 'adherent':
                    echo '
                          <td>' . $item->id . '</td>
                          <td>' . $item->nom . '</td>
                          <td>' . $item->prenom . '</td>
                          <td>' . $item->mail . '</td>
                          <td>' . $item->date_creation . '</td>
                          <td id="estAdmin-"'.$item->id .'>' . ($item->estAdmin ? 'Oui' : 'Non') . '</td>
                          <td>' . $item->getVilleName() . '</td>
                      ';
                    break;
                }
                ?>
                <td>


                  <?php if ($table === 'adherent') : ?>
                        <button onclick="ajaxToggleAdmin(event)" class="btn btn-warning" data-idadherent="<?= $item->id ?>">
                            <i class="bi bi-pencil"></i> <!-- Pencil icon for update -->
                            Toggle admin
                      </button>
                  <?php endif; ?>

                  <a href="" class="btn btn-danger">
                    <i class="bi bi-trash"></i> <!-- Trash icon for delete -->
                    Supprimer
                  </a>
                </td>
              </tr>
            <?php endforeach; ?>

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
