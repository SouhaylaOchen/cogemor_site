<?php include("db.php"); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Gestion des Clients</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    body {
      background: linear-gradient(to right, #e6f4ea, #f8fff9);
      font-family: "Segoe UI", sans-serif;
    }
    .card {
      border-radius: 1rem;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }
    h2 {
      color: #198754;
      font-weight: bold;
    }
    .table-responsive {
      border-radius: 0.5rem;
      overflow: hidden;
    }
    .action-buttons {
      white-space: nowrap;
    }
    .btn-add {
      background: linear-gradient(to right, #198754, #20c997);
      border: none;
      padding: 10px 20px;
      font-weight: bold;
    }
    .section-title {
      border-left: 4px solid #198754;
      padding-left: 12px;
      margin-bottom: 20px;
    }
  </style>
</head>
<body class="container py-5">

<div class="text-end mb-3">
  <a href="index.php" class="btn btn-success shadow-sm">
    <i class="fas fa-arrow-left me-2"></i>Retour à l'accueil
  </a>
</div>

<div class="row justify-content-center">
  <div class="col-md-11 col-lg-10">
    <div class="card p-4">
      <div class="card-body">
        <h2 class="mb-4 text-center">Gestion des Clients</h2>
        
        <!-- Formulaire d'ajout -->
        <div class="mb-5 p-4 bg-light rounded">
          <h4 class="text-success section-title">Ajouter un nouveau client</h4>
          <form method="post">
            <input type="hidden" name="action" value="ajouter">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Nom</label>
                <input type="text" name="Nom" class="form-control" placeholder="Entrez le nom complet" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Adresse</label>
                <input type="text" name="Adresse" class="form-control" placeholder="Entrez l'adresse">
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Téléphone</label>
                <input type="text" name="Telephone" class="form-control" placeholder="Ex: 06 12 34 56 78" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Email</label>
                <input type="email" name="Email" class="form-control" placeholder="exemple@email.com">
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Type Client</label>
                <select name="Type_Client" class="form-select">
                  <option value="Particulier">Particulier</option>
                  <option value="Entreprise">Entreprise</option>
                </select>
              </div>
              <div class="col-md-6 d-flex align-items-end mb-3">
                <button type="submit" class="btn btn-add btn-lg w-100 shadow">
                  <i class="fas fa-plus-circle me-2"></i>Ajouter le client
                </button>
              </div>
            </div>
          </form>
        </div>

        <!-- Formulaire de modification (caché par défaut) -->
        <?php
        // Récupérer les données du client à modifier si l'ID est passé en paramètre
        $clientToEdit = null;
        if (isset($_GET['modifier'])) {
            $id = $_GET['modifier'];
            $result = $conn->query("SELECT * FROM Clients WHERE ID_Client = $id");
            if ($result->num_rows > 0) {
                $clientToEdit = $result->fetch_assoc();
            }
        }
        ?>
        
        <?php if ($clientToEdit): ?>
        <div class="mb-5 p-4 bg-light rounded">
          <h4 class="text-primary section-title">Modifier le client</h4>
          <form method="post">
            <input type="hidden" name="action" value="modifier">
            <input type="hidden" name="ID_Client" value="<?php echo $clientToEdit['ID_Client']; ?>">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Nom</label>
                <input type="text" name="Nom" class="form-control" value="<?php echo $clientToEdit['Nom']; ?>" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Adresse</label>
                <input type="text" name="Adresse" class="form-control" value="<?php echo $clientToEdit['Adresse']; ?>">
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Téléphone</label>
                <input type="text" name="Telephone" class="form-control" value="<?php echo $clientToEdit['Telephone']; ?>" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Email</label>
                <input type="email" name="Email" class="form-control" value="<?php echo $clientToEdit['Email']; ?>">
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Type Client</label>
                <select name="Type_Client" class="form-select">
                  <option value="Particulier" <?php echo ($clientToEdit['Type_Client'] == 'Particulier') ? 'selected' : ''; ?>>Particulier</option>
                  <option value="Entreprise" <?php echo ($clientToEdit['Type_Client'] == 'Entreprise') ? 'selected' : ''; ?>>Entreprise</option>
                </select>
              </div>
              <div class="col-md-6 d-flex align-items-end mb-3">
                <button type="submit" class="btn btn-primary btn-lg w-100 shadow">
                  <i class="fas fa-edit me-2"></i>Modifier le client
                </button>
                <a href="ajouter_client.php" class="btn btn-secondary ms-2">Annuler</a>
              </div>
            </div>
          </form>
        </div>
        <?php endif; ?>

        <!-- Liste des clients -->
        <div class="p-3">
          <h4 class="text-success section-title">Liste des clients</h4>
          <div class="table-responsive">
            <table class="table table-striped table-hover">
              <thead class="table-success">
                <tr>
                  <th>ID</th>
                  <th>Nom</th>
                  <th>Téléphone</th>
                  <th>Email</th>
                  <th>Type</th>
                  <th class="text-center">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $result = $conn->query("SELECT * FROM Clients ORDER BY ID_Client DESC");
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td class='fw-bold'>" . $row['ID_Client'] . "</td>";
                        echo "<td>" . $row['Nom'] . "</td>";
                        echo "<td>" . $row['Telephone'] . "</td>";
                        echo "<td>" . ($row['Email'] ? $row['Email'] : '<span class="text-muted">Non spécifié</span>') . "</td>";
                        echo "<td><span class='badge bg-" . ($row['Type_Client'] == 'Particulier' ? 'info' : 'warning') . "'>" . $row['Type_Client'] . "</span></td>";
                        echo "<td class='action-buttons text-center'>";
                        echo "<a href='ajouter_client.php?modifier=" . $row['ID_Client'] . "' class='btn btn-sm btn-primary me-1'>";
                        echo "<i class='fas fa-edit me-1'></i>Modifier";
                        echo "</a>";
                        echo "<a href='ajouter_client.php?supprimer=" . $row['ID_Client'] . "' class='btn btn-sm btn-danger' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer ce client ?\")'>";
                        echo "<i class='fas fa-trash me-1'></i>Supprimer";
                        echo "</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center py-4'>Aucun client trouvé</td></tr>";
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>

        <?php
        // Traitement des formulaires
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $action = $_POST['action'];
            
            if ($action == 'ajouter') {
                $nom = $conn->real_escape_string($_POST['Nom']);
                $adresse = $conn->real_escape_string($_POST['Adresse']);
                $tel = $conn->real_escape_string($_POST['Telephone']);
                $email = $conn->real_escape_string($_POST['Email']);
                $type = $conn->real_escape_string($_POST['Type_Client']);

                $sql = "INSERT INTO Clients (Nom, Adresse, Telephone, Email, Type_Client) 
                        VALUES ('$nom','$adresse','$tel','$email','$type')";
                if ($conn->query($sql)) {
                    echo "<div class='alert alert-success mt-3 text-center'>✅ Client ajouté avec succès !</div>";
                    echo "<script>setTimeout(function(){ window.location.href = 'ajouter_client.php'; }, 1500);</script>";
                } else {
                    echo "<div class='alert alert-danger mt-3 text-center'>❌ Erreur: " . $conn->error . "</div>";
                }
            }
            
            if ($action == 'modifier') {
                $id = intval($_POST['ID_Client']);
                $nom = $conn->real_escape_string($_POST['Nom']);
                $adresse = $conn->real_escape_string($_POST['Adresse']);
                $tel = $conn->real_escape_string($_POST['Telephone']);
                $email = $conn->real_escape_string($_POST['Email']);
                $type = $conn->real_escape_string($_POST['Type_Client']);

                $sql = "UPDATE Clients SET 
                        Nom = '$nom', 
                        Adresse = '$adresse', 
                        Telephone = '$tel', 
                        Email = '$email', 
                        Type_Client = '$type' 
                        WHERE ID_Client = $id";
                
                if ($conn->query($sql)) {
                    echo "<div class='alert alert-success mt-3 text-center'>✅ Client modifié avec succès !</div>";
                    echo "<script>setTimeout(function(){ window.location.href = 'ajouter_client.php'; }, 1500);</script>";
                } else {
                    echo "<div class='alert alert-danger mt-3 text-center'>❌ Erreur: " . $conn->error . "</div>";
                }
            }
        }
        
        // Traitement de la suppression
        if (isset($_GET['supprimer'])) {
            $id = intval($_GET['supprimer']);
            
            // Vérifier si le client a des commandes
            $check = $conn->query("SELECT COUNT(*) as total FROM Commandes WHERE ID_Client = $id");
            $row = $check->fetch_assoc();
            
            if ($row['total'] > 0) {
                echo "<div class='alert alert-danger mt-3 text-center'>❌ Impossible de supprimer ce client car il a des commandes associées.</div>";
            } else {
                $sql = "DELETE FROM Clients WHERE ID_Client = $id";
                if ($conn->query($sql)) {
                    echo "<div class='alert alert-success mt-3 text-center'>✅ Client supprimé avec succès !</div>";
                    echo "<script>setTimeout(function(){ window.location.href = 'ajouter_client.php'; }, 1500);</script>";
                } else {
                    echo "<div class='alert alert-danger mt-3 text-center'>❌ Erreur: " . $conn->error . "</div>";
                }
            }
        }
        ?>
      </div>
    </div>
  </div>
</div>

</body>
</html>