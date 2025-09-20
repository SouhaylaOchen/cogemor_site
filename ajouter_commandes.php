<?php include("db.php"); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Gestion des Commandes</title>
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
    .status-confirmed {
      color: #198754;
      font-weight: bold;
    }
    .status-pending {
      color: #ffc107;
      font-weight: bold;
    }
    .status-cancelled {
      color: #dc3545;
      font-weight: bold;
    }
    .info-box {
      background-color: #f8f9fa;
      border-radius: 0.5rem;
      padding: 15px;
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
        <h2 class="mb-4 text-center">Gestion des Commandes</h2>
        
        <!-- Informations sur les clients et produits -->
        <div class="info-box mb-4">
          <h5 class="text-success"><i class="fas fa-info-circle me-2"></i>Informations disponibles</h5>
          <div class="row">
            <div class="col-md-6">
              <strong>Clients:</strong>
              <?php
              $clients = $conn->query("SELECT ID_Client, Nom FROM Clients ORDER BY Nom");
              while($client = $clients->fetch_assoc()) {
                  echo "<div class='small'>ID: {$client['ID_Client']} - {$client['Nom']}</div>";
              }
              ?>
            </div>
            <div class="col-md-6">
              <strong>Produits:</strong>
              <?php
              $produits = $conn->query("SELECT ID_Produit, Nom, Stock FROM Produits ORDER BY Nom");
              while($produit = $produits->fetch_assoc()) {
                  $stockClass = $produit['Stock'] > 0 ? 'text-success' : 'text-danger';
                  echo "<div class='small'>ID: {$produit['ID_Produit']} - {$produit['Nom']} <span class='$stockClass'>(Stock: {$produit['Stock']})</span></div>";
              }
              ?>
            </div>
          </div>
        </div>
        
        <!-- Formulaire d'ajout -->
        <div class="mb-5 p-4 bg-light rounded">
          <h4 class="text-success section-title">Ajouter une nouvelle commande</h4>
          <form method="post">
            <input type="hidden" name="action" value="ajouter">
            <div class="row">
              <div class="col-md-4 mb-3">
                <label class="form-label fw-bold">Client</label>
                <select name="ID_Client" class="form-select" required>
                  <option value="">Sélectionnez un client</option>
                  <?php
                  $clients = $conn->query("SELECT * FROM Clients ORDER BY Nom");
                  while($client = $clients->fetch_assoc()) {
                      echo "<option value='{$client['ID_Client']}'>{$client['Nom']} (ID: {$client['ID_Client']})</option>";
                  }
                  ?>
                </select>
              </div>
              <div class="col-md-4 mb-3">
                <label class="form-label fw-bold">Produit</label>
                <select name="ID_Produit" class="form-select" required>
                  <option value="">Sélectionnez un produit</option>
                  <?php
                  $produits = $conn->query("SELECT * FROM Produits ORDER BY Nom");
                  while($produit = $produits->fetch_assoc()) {
                      $disabled = $produit['Stock'] == 0 ? 'disabled' : '';
                      echo "<option value='{$produit['ID_Produit']}' $disabled>{$produit['Nom']} (Stock: {$produit['Stock']})</option>";
                  }
                  ?>
                </select>
              </div>
              <div class="col-md-4 mb-3">
                <label class="form-label fw-bold">Quantité</label>
                <input type="number" name="Quantite" min="1" class="form-control" placeholder="Nombre d'articles" required>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-add btn-lg shadow">
                  <i class="fas fa-plus-circle me-2"></i>Ajouter la commande
                </button>
              </div>
            </div>
          </form>
        </div>

        <!-- Liste des commandes -->
        <div class="p-3">
          <h4 class="text-success section-title">Liste des commandes</h4>
          <div class="table-responsive">
            <table class="table table-striped table-hover">
              <thead class="table-success">
                <tr>
                  <th>ID</th>
                  <th>Client</th>
                  <th>Produit</th>
                  <th>Quantité</th>
                  <th>Prix Unitaire</th>
                  <th>Total</th>
                  <th>Date</th>
                  <th class="text-center">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $sql = "SELECT c.ID_Commande, cl.Nom as Client, p.Nom as Produit, 
                        c.Quantite, p.Prix, c.Date_Commande 
                        FROM Commandes c
                        JOIN Clients cl ON c.ID_Client = cl.ID_Client
                        JOIN Produits p ON c.ID_Produit = p.ID_Produit
                        ORDER BY c.ID_Commande DESC";
                
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $total = $row['Quantite'] * $row['Prix'];
                        echo "<tr>";
                        echo "<td class='fw-bold'>" . $row['ID_Commande'] . "</td>";
                        echo "<td>" . $row['Client'] . "</td>";
                        echo "<td>" . $row['Produit'] . "</td>";
                        echo "<td>" . $row['Quantite'] . "</td>";
                        echo "<td>" . number_format($row['Prix'], 2) . " MAD</td>";
                        echo "<td class='fw-bold'>" . number_format($total, 2) . " MAD</td>";
                        echo "<td>" . date('d/m/Y H:i', strtotime($row['Date_Commande'])) . "</td>";
                        echo "<td class='action-buttons text-center'>";
                        echo "<a href='ajouter_commandes.php?supprimer=" . $row['ID_Commande'] . "' class='btn btn-sm btn-danger' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer cette commande ?\")'>";
                        echo "<i class='fas fa-trash me-1'></i>Supprimer";
                        echo "</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8' class='text-center py-4'>Aucune commande trouvée</td></tr>";
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
                $client = intval($_POST['ID_Client']);
                $produit = intval($_POST['ID_Produit']);
                $qte = intval($_POST['Quantite']);

                // Vérifier si le client existe
                $checkClient = $conn->query("SELECT COUNT(*) as total FROM Clients WHERE ID_Client = $client");
                $clientExists = $checkClient->fetch_assoc()['total'] > 0;
                
                // Vérifier si le produit existe
                $checkProduit = $conn->query("SELECT COUNT(*) as total FROM Produits WHERE ID_Produit = $produit");
                $produitExists = $checkProduit->fetch_assoc()['total'] > 0;
                
                if (!$clientExists) {
                    echo "<div class='alert alert-danger mt-3 text-center'>❌ Client non trouvé !</div>";
                } elseif (!$produitExists) {
                    echo "<div class='alert alert-danger mt-3 text-center'>❌ Produit non trouvé !</div>";
                } else {
                    // Vérifier le stock
                    $res = $conn->query("SELECT Stock FROM Produits WHERE ID_Produit=$produit");
                    $row = $res->fetch_assoc();

                    if ($row && $row['Stock'] >= $qte) {
                        $conn->query("INSERT INTO Commandes (ID_Client, ID_Produit, Quantite) 
                                      VALUES ('$client','$produit','$qte')");
                        $conn->query("UPDATE Produits SET Stock = Stock - $qte WHERE ID_Produit=$produit");
                        echo "<div class='alert alert-success mt-3 text-center'>✅ Commande ajoutée avec succès !</div>";
                        echo "<script>setTimeout(function(){ window.location.href = 'ajouter_commandes.php'; }, 1500);</script>";
                    } else {
                        echo "<div class='alert alert-danger mt-3 text-center'>❌ Stock insuffisant !</div>";
                    }
                }
            }
        }
        
        // Traitement de la suppression
        if (isset($_GET['supprimer'])) {
            $id = intval($_GET['supprimer']);
            
            // Récupérer les informations de la commande avant suppression
            $commandeInfo = $conn->query("SELECT ID_Produit, Quantite FROM Commandes WHERE ID_Commande = $id");
            
            if ($commandeInfo->num_rows > 0) {
                $info = $commandeInfo->fetch_assoc();
                $produitId = $info['ID_Produit'];
                $quantite = $info['Quantite'];
                
                // Restaurer le stock
                $conn->query("UPDATE Produits SET Stock = Stock + $quantite WHERE ID_Produit = $produitId");
                
                // Supprimer la commande
                $sql = "DELETE FROM Commandes WHERE ID_Commande = $id";
                if ($conn->query($sql)) {
                    echo "<div class='alert alert-success mt-3 text-center'>✅ Commande supprimée avec succès ! Le stock a été restauré.</div>";
                    echo "<script>setTimeout(function(){ window.location.href = 'ajouter_commandes.php'; }, 1500);</script>";
                } else {
                    echo "<div class='alert alert-danger mt-3 text-center'>❌ Erreur: " . $conn->error . "</div>";
                }
            } else {
                echo "<div class='alert alert-danger mt-3 text-center'>❌ Commande non trouvée !</div>";
            }
        }
        ?>
      </div>
    </div>
  </div>
</div>

</body>
</html>