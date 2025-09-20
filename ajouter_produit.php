<?php include("db.php"); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Gestion des Produits</title>
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
    .stock-low {
      color: #dc3545;
      font-weight: bold;
    }
    .stock-medium {
      color: #ffc107;
      font-weight: bold;
    }
    .stock-high {
      color: #198754;
      font-weight: bold;
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
        <h2 class="mb-4 text-center">Gestion des Produits</h2>
        
        <!-- Formulaire d'ajout -->
        <div class="mb-5 p-4 bg-light rounded">
          <h4 class="text-success section-title">Ajouter un nouveau produit</h4>
          <form method="post">
            <input type="hidden" name="action" value="ajouter">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Nom</label>
                <input type="text" name="Nom" class="form-control" placeholder="Entrez le nom du produit" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Catégorie</label>
                <select name="Categorie" class="form-select" required>
                  <option value="">Sélectionnez une catégorie</option>
                  <option value="Semences">Semences</option>
                  <option value="Outils">Outils</option>
                  <option value="Équipements">Équipements</option>
                  <option value="Engrais">Engrais</option>
                  <option value="Pesticides">Pesticides</option>
                  <option value="Irrigation">Irrigation</option>
                </select>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Prix (MAD)</label>
                <input type="number" name="Prix" step="0.01" min="0" class="form-control" placeholder="Ex: 120.50" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Stock</label>
                <input type="number" name="Stock" min="0" class="form-control" placeholder="Quantité disponible" required>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-add btn-lg shadow">
                  <i class="fas fa-plus-circle me-2"></i>Ajouter le produit
                </button>
              </div>
            </div>
          </form>
        </div>

        <!-- Formulaire de modification (caché par défaut) -->
        <?php
        // Récupérer les données du produit à modifier si l'ID est passé en paramètre
        $produitToEdit = null;
        if (isset($_GET['modifier'])) {
            $id = $_GET['modifier'];
            $result = $conn->query("SELECT * FROM Produits WHERE ID_Produit = $id");
            if ($result->num_rows > 0) {
                $produitToEdit = $result->fetch_assoc();
            }
        }
        ?>
        
        <?php if ($produitToEdit): ?>
        <div class="mb-5 p-4 bg-light rounded">
          <h4 class="text-primary section-title">Modifier le produit</h4>
          <form method="post">
            <input type="hidden" name="action" value="modifier">
            <input type="hidden" name="ID_Produit" value="<?php echo $produitToEdit['ID_Produit']; ?>">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Nom</label>
                <input type="text" name="Nom" class="form-control" value="<?php echo $produitToEdit['Nom']; ?>" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Catégorie</label>
                <select name="Categorie" class="form-select" required>
                  <option value="Semences" <?php echo ($produitToEdit['Categorie'] == 'Semences') ? 'selected' : ''; ?>>Semences</option>
                  <option value="Outils" <?php echo ($produitToEdit['Categorie'] == 'Outils') ? 'selected' : ''; ?>>Outils</option>
                  <option value="Équipements" <?php echo ($produitToEdit['Categorie'] == 'Équipements') ? 'selected' : ''; ?>>Équipements</option>
                  <option value="Engrais" <?php echo ($produitToEdit['Categorie'] == 'Engrais') ? 'selected' : ''; ?>>Engrais</option>
                  <option value="Pesticides" <?php echo ($produitToEdit['Categorie'] == 'Pesticides') ? 'selected' : ''; ?>>Pesticides</option>
                  <option value="Irrigation" <?php echo ($produitToEdit['Categorie'] == 'Irrigation') ? 'selected' : ''; ?>>Irrigation</option>
                </select>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Prix (MAD)</label>
                <input type="number" name="Prix" step="0.01" min="0" class="form-control" value="<?php echo $produitToEdit['Prix']; ?>" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Stock</label>
                <input type="number" name="Stock" min="0" class="form-control" value="<?php echo $produitToEdit['Stock']; ?>" required>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary btn-lg shadow">
                  <i class="fas fa-edit me-2"></i>Modifier le produit
                </button>
                <a href="ajouter_produit.php" class="btn btn-secondary ms-2">Annuler</a>
              </div>
            </div>
          </form>
        </div>
        <?php endif; ?>

        <!-- Liste des produits -->
        <div class="p-3">
          <h4 class="text-success section-title">Liste des produits</h4>
          <div class="table-responsive">
            <table class="table table-striped table-hover">
              <thead class="table-success">
                <tr>
                  <th>ID</th>
                  <th>Nom</th>
                  <th>Catégorie</th>
                  <th>Prix (MAD)</th>
                  <th>Stock</th>
                  <th class="text-center">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $result = $conn->query("SELECT * FROM Produits ORDER BY ID_Produit DESC");
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $stockClass = '';
                        if ($row['Stock'] == 0) {
                            $stockClass = 'stock-low';
                        } elseif ($row['Stock'] < 10) {
                            $stockClass = 'stock-medium';
                        } else {
                            $stockClass = 'stock-high';
                        }
                        
                        echo "<tr>";
                        echo "<td class='fw-bold'>" . $row['ID_Produit'] . "</td>";
                        echo "<td>" . $row['Nom'] . "</td>";
                        echo "<td><span class='badge bg-info'>" . $row['Categorie'] . "</span></td>";
                        echo "<td class='fw-bold'>" . number_format($row['Prix'], 2) . " MAD</td>";
                        echo "<td class='$stockClass'>" . $row['Stock'] . " unités</td>";
                        echo "<td class='action-buttons text-center'>";
                        echo "<a href='ajouter_produit.php?modifier=" . $row['ID_Produit'] . "' class='btn btn-sm btn-primary me-1'>";
                        echo "<i class='fas fa-edit me-1'></i>Modifier";
                        echo "</a>";
                        echo "<a href='ajouter_produit.php?supprimer=" . $row['ID_Produit'] . "' class='btn btn-sm btn-danger' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer ce produit ?\")'>";
                        echo "<i class='fas fa-trash me-1'></i>Supprimer";
                        echo "</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center py-4'>Aucun produit trouvé</td></tr>";
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
                $cat = $conn->real_escape_string($_POST['Categorie']);
                $prix = floatval($_POST['Prix']);
                $stock = intval($_POST['Stock']);

                $sql = "INSERT INTO Produits (Nom, Categorie, Prix, Stock) 
                        VALUES ('$nom','$cat','$prix','$stock')";
                if ($conn->query($sql)) {
                    echo "<div class='alert alert-success mt-3 text-center'>✅ Produit ajouté avec succès !</div>";
                    echo "<script>setTimeout(function(){ window.location.href = 'ajouter_produit.php'; }, 1500);</script>";
                } else {
                    echo "<div class='alert alert-danger mt-3 text-center'>❌ Erreur: " . $conn->error . "</div>";
                }
            }
            
            if ($action == 'modifier') {
                $id = intval($_POST['ID_Produit']);
                $nom = $conn->real_escape_string($_POST['Nom']);
                $cat = $conn->real_escape_string($_POST['Categorie']);
                $prix = floatval($_POST['Prix']);
                $stock = intval($_POST['Stock']);

                $sql = "UPDATE Produits SET 
                        Nom = '$nom', 
                        Categorie = '$cat', 
                        Prix = '$prix', 
                        Stock = '$stock' 
                        WHERE ID_Produit = $id";
                
                if ($conn->query($sql)) {
                    echo "<div class='alert alert-success mt-3 text-center'>✅ Produit modifié avec succès !</div>";
                    echo "<script>setTimeout(function(){ window.location.href = 'ajouter_produit.php'; }, 1500);</script>";
                } else {
                    echo "<div class='alert alert-danger mt-3 text-center'>❌ Erreur: " . $conn->error . "</div>";
                }
            }
        }
        
        // Traitement de la suppression
        if (isset($_GET['supprimer'])) {
            $id = intval($_GET['supprimer']);
            
            // Vérifier si le produit a des commandes
            $check = $conn->query("SELECT COUNT(*) as total FROM Commandes WHERE ID_Produit = $id");
            $row = $check->fetch_assoc();
            
            if ($row['total'] > 0) {
                echo "<div class='alert alert-danger mt-3 text-center'>❌ Impossible de supprimer ce produit car il est associé à des commandes.</div>";
            } else {
                $sql = "DELETE FROM Produits WHERE ID_Produit = $id";
                if ($conn->query($sql)) {
                    echo "<div class='alert alert-success mt-3 text-center'>✅ Produit supprimé avec succès !</div>";
                    echo "<script>setTimeout(function(){ window.location.href = 'ajouter_produit.php'; }, 1500);</script>";
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