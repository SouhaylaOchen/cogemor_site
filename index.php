<?php include("db.php"); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>COGEMOR - Votre Partenaire Agricole</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary-color: #198754;
      --secondary-color: #146c43;
      --light-color: #e6f4ea;
      --dark-color: #343a40;
      --text-color: #333;
    }
    
    body {
      font-family: 'Roboto', sans-serif;
      color: var(--text-color);
      background-color: #f8f9fa;
    }
    
    .navbar {
      box-shadow: 0 2px 15px rgba(0,0,0,0.1);
      padding: 15px 0;
      transition: all 0.3s ease;
    }
    
    .navbar-brand {
      font-size: 1.8rem;
      font-weight: 700;
    }
    
    .nav-link {
      font-weight: 500;
      margin: 0 10px;
      position: relative;
    }
    
    .nav-link:after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 0;
      height: 2px;
      background: var(--primary-color);
      transition: width 0.3s ease;
    }
    
    .nav-link:hover:after {
      width: 100%;
    }
    
    .hero-section {
      background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), 
                  url('https://images.unsplash.com/photo-1500937386664-56d1dfef3854?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
      background-size: cover;
      background-position: center;
      padding: 120px 0;
      color: white;
      text-align: center;
    }
    
    .hero-title {
      font-size: 3.5rem;
      font-weight: 700;
      margin-bottom: 20px;
      animation: fadeInDown 1s ease;
    }
    
    .hero-subtitle {
      font-size: 1.5rem;
      margin-bottom: 30px;
      animation: fadeInUp 1s ease;
    }
    
    .btn-hero {
      background: var(--primary-color);
      border: none;
      padding: 15px 30px;
      font-size: 1.1rem;
      font-weight: 500;
      border-radius: 50px;
      transition: all 0.3s ease;
    }
    
    .btn-hero:hover {
      background: var(--secondary-color);
      transform: translateY(-3px);
      box-shadow: 0 10px 20px rgba(0,0,0,0.2);
    }
    
    .section-title {
      position: relative;
      padding-bottom: 15px;
      margin-bottom: 40px;
      text-align: center;
      font-weight: 700;
    }
    
    .section-title:after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 100px;
      height: 3px;
      background: var(--primary-color);
    }
    
    .feature-card {
      background: white;
      border-radius: 15px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.08);
      padding: 30px;
      text-align: center;
      transition: all 0.3s ease;
      height: 100%;
    }
    
    .feature-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    }
    
    .feature-icon {
      width: 80px;
      height: 80px;
      background: var(--light-color);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 20px;
      font-size: 30px;
      color: var(--primary-color);
      transition: all 0.3s ease;
    }
    
    .feature-card:hover .feature-icon {
      background: var(--primary-color);
      color: white;
    }
    
    .product-card {
      border-radius: 15px;
      overflow: hidden;
      box-shadow: 0 10px 30px rgba(0,0,0,0.08);
      transition: all 0.3s ease;
      height: 100%;
    }
    
    .product-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    }
    
    .carousel-control-prev, .carousel-control-next {
      width: 50px;
      height: 50px;
      background: rgba(0,0,0,0.3);
      border-radius: 50%;
      top: 50%;
      transform: translateY(-50%);
      opacity: 0;
      transition: opacity 0.3s ease;
    }
    
    .product-card:hover .carousel-control-prev,
    .product-card:hover .carousel-control-next {
      opacity: 1;
    }
    
    .stats-section {
      background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
      color: white;
      padding: 80px 0;
    }
    
    .stat-item {
      text-align: center;
      padding: 20px;
    }
    
    .stat-number {
      font-size: 3rem;
      font-weight: 700;
      margin-bottom: 10px;
    }
    
    .stat-label {
      font-size: 1.2rem;
      opacity: 0.9;
    }
    
    .quick-action {
      background: white;
      border-radius: 15px;
      padding: 30px;
      text-align: center;
      box-shadow: 0 10px 30px rgba(0,0,0,0.08);
      transition: all 0.3s ease;
    }
    
    .quick-action:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    }
    
    .action-icon {
      font-size: 3rem;
      color: var(--primary-color);
      margin-bottom: 20px;
    }
    
    footer {
      background: var(--dark-color);
      color: white;
      padding: 40px 0 20px;
    }
    
    .social-links a {
      display: inline-block;
      width: 40px;
      height: 40px;
      background: rgba(255,255,255,0.1);
      color: white;
      border-radius: 50%;
      text-align: center;
      line-height: 40px;
      margin-right: 10px;
      transition: all 0.3s ease;
    }
    
    .social-links a:hover {
      background: var(--primary-color);
      transform: translateY(-3px);
    }
    
    @keyframes fadeInDown {
      from {
        opacity: 0;
        transform: translateY(-30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    @media (max-width: 768px) {
      .hero-title {
        font-size: 2.5rem;
      }
      
      .hero-subtitle {
        font-size: 1.2rem;
      }
    }
  </style>
</head>
<body>

<!-- Barre de navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
  <div class="container">
    <a class="navbar-brand" href="index.php">
      <i class="fas fa-seedling me-2"></i>COGEMOR
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link active" href="index.php">Accueil</a></li>
        <li class="nav-item"><a class="nav-link" href="ajouter_client.php">Clients</a></li>
        <li class="nav-item"><a class="nav-link" href="ajouter_produit.php">Produits</a></li>
        <li class="nav-item"><a class="nav-link" href="ajouter_commandes.php">Commandes</a></li>
        <li class="nav-item">
          <a class="btn btn-success ms-3" href="contact.php">
            <i class="fas fa-envelope me-2"></i>Contact
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Hero Section -->
<section class="hero-section">
  <div class="container">
    <h1 class="hero-title">COGEMOR</h1>
    <p class="hero-subtitle">Votre partenaire de confiance en distribution de produits agricoles</p>
    <a href="#services" class="btn btn-hero">
      <i class="fas fa-arrow-down me-2"></i>Découvrir nos services
    </a>
  </div>
</section>

<!-- Section Services -->
<section id="services" class="py-5">
  <div class="container">
    <h2 class="section-title">Nos Services</h2>
    <div class="row">
      <div class="col-lg-4 col-md-6 mb-4">
        <div class="feature-card">
          <div class="feature-icon">
            <i class="fas fa-users"></i>
          </div>
          <h3>Gestion des Clients</h3>
          <p>Gérez efficacement votre base de clients avec notre système intuitif et performant.</p>
          <a href="ajouter_client.php" class="btn btn-outline-success mt-3">Gérer les clients</a>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 mb-4">
        <div class="feature-card">
          <div class="feature-icon">
            <i class="fas fa-box"></i>
          </div>
          <h3>Gestion des Produits</h3>
          <p>Contrôlez votre inventaire et suivez vos stocks en temps réel avec précision.</p>
          <a href="ajouter_produit.php" class="btn btn-outline-success mt-3">Gérer les produits</a>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 mb-4">
        <div class="feature-card">
          <div class="feature-icon">
            <i class="fas fa-shopping-cart"></i>
          </div>
          <h3>Gestion des Commandes</h3>
          <p>Traitez et suivez toutes vos commandes avec un système intégré et automatisé.</p>
          <a href="ajouter_commandes.php" class="btn btn-outline-success mt-3">Gérer les commandes</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Section Produits -->
<section class="py-5 bg-light">
  <div class="container">
    <h2 class="section-title">Nos Produits Agricoles</h2>
    <div class="row">
      <!-- Produit 1 : Semences -->
      <div class="col-lg-4 col-md-6 mb-4">
        <div class="product-card">
          <div id="carouselSeeds" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="images/seeds.jpg" class="d-block w-100" alt="Semences de qualité" style="height: 250px; object-fit: cover;">
              </div>
              <div class="carousel-item">
                <img src="images/seeds2.jpg" class="d-block w-100" alt="Variétés de semences" style="height: 250px; object-fit: cover;">
              </div>
              <div class="carousel-item">
                <img src="images/seeds3.jpg" class="d-block w-100" alt="Semences biologiques" style="height: 250px; object-fit: cover;">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselSeeds" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Précédent</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselSeeds" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Suivant</span>
            </button>
          </div>
          <div class="card-body">
            <h5 class="card-title">Semences Agricoles</h5>
            <p class="card-text">Découvrez notre gamme complète de semences de haute qualité pour des récoltes abondantes.</p>
            <div class="d-grid">
              <a href="ajouter_produit.php" class="btn btn-success">Voir les semences</a>
            </div>
          </div>
        </div>
      </div>

      <!-- Produit 2 : Outils -->
      <div class="col-lg-4 col-md-6 mb-4">
        <div class="product-card">
          <div id="carouselTools" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="images/tools.jpg" class="d-block w-100" alt="Outils agricoles" style="height: 250px; object-fit: cover;">
              </div>
              <div class="carousel-item">
                <img src="images/tools2.jpg" class="d-block w-100" alt="Équipement de qualité" style="height: 250px; object-fit: cover;">
              </div>
              <div class="carousel-item">
                <img src="images/tools3.jpg" class="d-block w-100" alt="Matériel professionnel" style="height: 250px; object-fit: cover;">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselTools" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Précédent</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselTools" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Suivant</span>
            </button>
          </div>
          <div class="card-body">
            <h5 class="card-title">Outils Agricoles</h5>
            <p class="card-text">Des outils robustes et ergonomiques pour faciliter tous vos travaux agricoles.</p>
            <div class="d-grid">
              <a href="ajouter_produit.php" class="btn btn-success">Découvrir les outils</a>
            </div>
          </div>
        </div>
      </div>

      <!-- Produit 3 : Équipements -->
      <div class="col-lg-4 col-md-6 mb-4">
        <div class="product-card">
          <div id="carouselTractor" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="images/tractor.jpg" class="d-block w-100" alt="Équipements modernes" style="height: 250px; object-fit: cover;">
              </div>
              <div class="carousel-item">
                <img src="images/tractor2.jpg" class="d-block w-100" alt="Machines agricoles" style="height: 250px; object-fit: cover;">
              </div>
              <div class="carousel-item">
                <img src="images/tractor3.jpg" class="d-block w-100" alt="Technologie agricole" style="height: 250px; object-fit: cover;">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselTractor" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Précédent</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselTractor" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Suivant</span>
            </button>
          </div>
          <div class="card-body">
            <h5 class="card-title">Équipements Modernes</h5>
            <p class="card-text">Des machines performantes et innovantes pour une agriculture compétitive et durable.</p>
            <div class="d-grid">
              <a href="ajouter_produit.php" class="btn btn-success">Explorer les équipements</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Section Statistiques -->
<section class="stats-section">
  <div class="container">
    <div class="row">
      <div class="col-md-3 col-6">
        <div class="stat-item">
          <div class="stat-number" data-count="1500">0</div>
          <div class="stat-label">Clients Satisfaits</div>
        </div>
      </div>
      <div class="col-md-3 col-6">
        <div class="stat-item">
          <div class="stat-number" data-count="2500">0</div>
          <div class="stat-label">Produits Distribués</div>
        </div>
      </div>
      <div class="col-md-3 col-6">
        <div class="stat-item">
          <div class="stat-number" data-count="5000">0</div>
          <div class="stat-label">Commandes Réalisées</div>
        </div>
      </div>
      <div class="col-md-3 col-6">
        <div class="stat-item">
          <div class="stat-number" data-count="8">0</div>
          <div class="stat-label">Années d'Expérience</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Section Actions Rapides -->
<section class="py-5">
  <div class="container">
    <h2 class="section-title">Actions Rapides</h2>
    <div class="row">
      <div class="col-lg-3 col-md-6 mb-4">
        <div class="quick-action">
          <div class="action-icon">
            <i class="fas fa-user-plus"></i>
          </div>
          <h4>Nouveau Client</h4>
          <p>Ajoutez un nouveau client à votre base de données</p>
          <a href="ajouter_client.php" class="btn btn-success">Ajouter</a>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 mb-4">
        <div class="quick-action">
          <div class="action-icon">
            <i class="fas fa-cube"></i>
          </div>
          <h4>Nouveau Produit</h4>
          <p>Enregistrez un nouveau produit dans l'inventaire</p>
          <a href="ajouter_produit.php" class="btn btn-success">Ajouter</a>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 mb-4">
        <div class="quick-action">
          <div class="action-icon">
            <i class="fas fa-cart-plus"></i>
          </div>
          <h4>Nouvelle Commande</h4>
          <p>Créez une nouvelle commande pour un client</p>
          <a href="ajouter_commandes.php" class="btn btn-success">Créer</a>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 mb-4">
        <div class="quick-action">
          <div class="action-icon">
            <i class="fas fa-chart-bar"></i>
          </div>
          <h4>Voir Statistiques</h4>
          <p>Consultez les statistiques et rapports de vente</p>
          <a href="#" class="btn btn-success">Voir</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Footer -->
<footer>
  <div class="container">
    <div class="row">
      <div class="col-lg-4 mb-4">
        <h4><i class="fas fa-seedling me-2"></i>COGEMOR</h4>
        <p>Votre partenaire de confiance en distribution de produits agricoles depuis 2015.</p>
        <div class="social-links">
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
          <a href="#"><i class="fab fa-linkedin-in"></i></a>
        </div>
      </div>
      <div class="col-lg-4 mb-4">
        <h4>Liens Rapides</h4>
        <ul class="list-unstyled">
          <li><a href="ajouter_client.php" class="text-white">Gestion Clients</a></li>
          <li><a href="ajouter_produit.php" class="text-white">Gestion Produits</a></li>
          <li><a href="ajouter_commandes.php" class="text-white">Gestion Commandes</a></li>
          <li><a href="contact.php" class="text-white">Contact</a></li>
        </ul>
      </div>
      <div class="col-lg-4 mb-4">
        <h4>Contactez-nous</h4>
        <p><i class="fas fa-map-marker-alt me-2"></i>Al Arouit, Nador, Maroc</p>
        <p><i class="fas fa-phone me-2"></i>05 36 36 38 35</p>
        <p><i class="fas fa-envelope me-2"></i>Chamllali@hotmail.fr</p>
      </div>
    </div>
    <hr>
    <div class="text-center">
      <p>&copy; 2023 COGEMOR - Tous droits réservés</p>
    </div>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // Animation des statistiques
  document.addEventListener('DOMContentLoaded', function() {
    const statElements = document.querySelectorAll('.stat-number');
    const options = {
      threshold: 0.5
    };
    
    const observer = new IntersectionObserver(function(entries) {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const element = entry.target;
          const finalValue = parseInt(element.getAttribute('data-count'));
          const duration = 2000;
          const step = 20;
          const increment = finalValue / (duration / step);
          let current = 0;
          
          const timer = setInterval(() => {
            current += increment;
            if (current >= finalValue) {
              element.textContent = finalValue + '+';
              clearInterval(timer);
            } else {
              element.textContent = Math.floor(current);
            }
          }, step);
          
          observer.unobserve(element);
        }
      });
    }, options);
    
    statElements.forEach(element => {
      observer.observe(element);
    });
  });
</script>
</body>
</html>