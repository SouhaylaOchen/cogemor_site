<?php include("db.php"); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Contact - COGEMOR</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    :root {
      --primary-color: #198754;
      --secondary-color: #146c43;
      --light-color: #e6f4ea;
      --dark-color: #343a40;
    }
    
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f8f9fa;
    }
    
    .navbar {
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    .hero-section {
      background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), 
                  url('https://images.unsplash.com/photo-1492496913980-501348b61469?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
      background-size: cover;
      background-position: center;
      padding: 100px 0;
      color: white;
    }
    
    .section-title {
      position: relative;
      padding-bottom: 15px;
      margin-bottom: 30px;
      text-align: center;
    }
    
    .section-title:after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 80px;
      height: 3px;
      background: var(--primary-color);
    }
    
    .about-section {
      background: white;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.05);
      padding: 40px;
      margin-top: -50px;
      position: relative;
    }
    
    .contact-card {
      background: white;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.05);
      padding: 30px;
      transition: transform 0.3s ease;
      height: 100%;
    }
    
    .contact-card:hover {
      transform: translateY(-5px);
    }
    
    .contact-icon {
      width: 60px;
      height: 60px;
      background: var(--light-color);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 20px;
      font-size: 24px;
      color: var(--primary-color);
    }
    
    .map-container {
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 5px 15px rgba(0,0,0,0.05);
      height: 400px;
    }
    
    .social-links a {
      display: inline-block;
      width: 40px;
      height: 40px;
      background: var(--primary-color);
      color: white;
      border-radius: 50%;
      text-align: center;
      line-height: 40px;
      margin-right: 10px;
      transition: all 0.3s ease;
    }
    
    .social-links a:hover {
      background: var(--secondary-color);
      transform: translateY(-3px);
    }
    
    .value-item {
      padding: 20px;
      background: var(--light-color);
      border-radius: 10px;
      text-align: center;
      transition: all 0.3s ease;
    }
    
    .value-item:hover {
      background: var(--primary-color);
      color: white;
    }
    
    .value-icon {
      font-size: 2.5rem;
      margin-bottom: 15px;
      color: var(--primary-color);
    }
    
    .value-item:hover .value-icon {
      color: white;
    }
    
    .stats-number {
      font-size: 2.5rem;
      font-weight: bold;
      color: var(--primary-color);
    }
  </style>
</head>
<body>

<!-- Barre de navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
  <div class="container">
    <a class="navbar-brand fw-bold" href="index.php">
      <i class="fas fa-seedling me-2"></i>COGEMOR
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="index.php">Accueil</a></li>
        <li class="nav-item"><a class="nav-link" href="ajouter_client.php">Clients</a></li>
        <li class="nav-item"><a class="nav-link" href="ajouter_produit.php">Produits</a></li>
        <li class="nav-item"><a class="nav-link" href="ajouter_commandes.php">Commandes</a></li>
        <li class="nav-item"><a class="nav-link active" href="contact.php">Contact</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- En-tête hero section -->
<section class="hero-section">
  <div class="container text-center">
    <h1 class="display-4 fw-bold mb-3">Contactez COGEMOR</h1>
    <p class="lead">Votre partenaire de confiance pour les produits agricoles de qualité</p>
    <a href="#contact" class="btn btn-success btn-lg mt-3">
      <i class="fas fa-envelope me-2"></i>Nos Coordonnées
    </a>
  </div>
</section>

<!-- Section À propos -->
<section class="container py-5">
  <div class="about-section">
    <h2 class="section-title">Qui sommes-nous ?</h2>
    <div class="row">
      <div class="col-lg-6">
        <p class="lead">
          Fondée en <strong>2015</strong> et basée à <strong>Taza (Fes)</strong>, 
          <strong>COGEMOR</strong> est une société privée spécialisée dans le commerce et 
          la distribution de <strong>produits agricoles</strong>.
        </p>
        <p>
          Notre mission est d'assurer la commercialisation efficace des produits locaux, 
          en garantissant la qualité, la régularité d'approvisionnement et des relations durables 
          avec les producteurs comme avec les clients.
        </p>
      </div>
      <div class="col-lg-6">
        <p>
          La vision de COGEMOR est de devenir un acteur de référence régional dans la 
          distribution agricole, tout en respectant ses valeurs fondamentales : 
          <em>proximité, qualité, transparence, respect des producteurs et réactivité</em>.
        </p>
        <p>
          Notre organisation repose sur une équipe polyvalente couvrant les fonctions de direction, 
          commerce, achats, logistique, comptabilité et service clientèle.
        </p>
      </div>
    </div>
    
    <!-- Valeurs de l'entreprise -->
    <div class="row mt-5">
      <div class="col-12">
        <h3 class="text-center mb-4">Nos Valeurs</h3>
      </div>
      <div class="col-md-4 mb-4">
        <div class="value-item">
          <div class="value-icon">
            <i class="fas fa-handshake"></i>
          </div>
          <h4>Proximité</h4>
          <p>Relation directe et personnalisée avec nos clients et fournisseurs</p>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="value-item">
          <div class="value-icon">
            <i class="fas fa-award"></i>
          </div>
          <h4>Qualité</h4>
          <p>Produits sélectionnés rigoureusement pour répondre aux exigences</p>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="value-item">
          <div class="value-icon">
            <i class="fas fa-tachometer-alt"></i>
          </div>
          <h4>Réactivité</h4>
          <p>Service rapide et adapté aux besoins spécifiques de chaque client</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Section Statistiques -->
<section class="py-5 bg-light">
  <div class="container">
    <h2 class="section-title">COGEMOR en chiffres</h2>
    <div class="row text-center">
      <div class="col-md-3 col-6 mb-4">
        <div class="p-4">
          <div class="stats-number">8+</div>
          <p>Années d'expérience</p>
        </div>
      </div>
      <div class="col-md-3 col-6 mb-4">
        <div class="p-4">
          <div class="stats-number">500+</div>
          <p>Clients satisfaits</p>
        </div>
      </div>
      <div class="col-md-3 col-6 mb-4">
        <div class="p-4">
          <div class="stats-number">100+</div>
          <p>Produits disponibles</p>
        </div>
      </div>
      <div class="col-md-3 col-6 mb-4">
        <div class="p-4">
          <div class="stats-number">24/7</div>
          <p>Service client</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Section Contact -->
<section id="contact" class="py-5">
  <div class="container">
    <h2 class="section-title">Nos Coordonnées</h2>
    <div class="row mb-5">
      <div class="col-lg-4 col-md-6 mb-4">
        <div class="contact-card">
          <div class="contact-icon">
            <i class="fas fa-map-marker-alt"></i>
          </div>
          <h4>Adresse</h4>
          <p>Hey Asalam, A9 Kissaria Rue Khattabi<br>Taza - Fes, Maroc</p>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 mb-4">
        <div class="contact-card">
          <div class="contact-icon">
            <i class="fas fa-phone"></i>
          </div>
          <h4>Téléphones</h4>
          <p>Fixe: <a href="tel:+212536363835">05 54 76 34 98</a><br>
          Mobile: <a href="tel:+212661423248">06 44 76 94 55</a><br>
          Mobile: <a href="tel:+212661746197">06 33 72 91 97</a></p>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 mb-4">
        <div class="contact-card">
          <div class="contact-icon">
            <i class="fas fa-envelope"></i>
          </div>
          <h4>Email</h4>
          <p><a href="mailto:Chamllali@hotmail.fr">Entreprisetaza@gmail.com</a></p>
          <div class="social-links mt-3">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-linkedin-in"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Carte de localisation -->
    <div class="row">
      <div class="col-12">
        <h3 class="text-center mb-4">Notre Localisation</h3>
        <div class="map-container">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12970.478326921915!2d-3.008108!3d35.454299!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzXCsDI3JzE1LjUiTiAzwrAwMCcyOS4yIlc!5e0!3m2!1sfr!2sma!4v1623939668399!5m2!1sfr!2sma" 
                  width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Section Horaires -->
<section class="py-5 bg-light">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 text-center">
        <h2 class="section-title">Horaires d'ouverture</h2>
        <div class="row">
          <div class="col-md-6">
            <h5>Du Lundi au Vendredi</h5>
            <p>8h00 - 12h30 | 14h00 - 18h30</p>
          </div>
          <div class="col-md-6">
            <h5>Samedi</h5>
            <p>8h00 - 13h00</p>
          </div>
        </div>
        <p class="mt-3"><strong>Dimanche:</strong> Fermé</p>
      </div>
    </div>
  </div>
</section>

<!-- Pied de page -->
<footer class="bg-dark text-white py-4">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <h5><i class="fas fa-seedling me-2"></i>COGEMOR</h5>
        <p>Votre partenaire en distribution de produits agricoles</p>
      </div>
      <div class="col-md-6 text-md-end">
        <p>&copy; 2023 COGEMOR - Tous droits réservés</p>
      </div>
    </div>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>