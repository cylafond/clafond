<!DOCTYPE html>
<html lang="zxx">

<head>
  <?php include('./partials/_head.php') ?>
  <title>World Time</title>
</head>

<body>
  <!--Début php -->

  <!--Début html -->
  <div class="container-scroller">
    <div class="main-panel">
      <!-- partial:partials/_navbar.html -->
      <?php
      include('./partials/_navbar.php');
      ?>
      <?php
      $apiKey = '709e0fca642d4892b27aa3442e9a6d94';
      $lang = 'fr';
      $page = 1;
      $url = 'http://newsapi.org/v2/everything?q=arts&apiKey=' . $apiKey . '&page=' . $page . '&language=' . $lang . '&pageSize=20';

      // ----------------------------------------------------------------------
      // REMPLACER file_get_contents($url) par function loadJson($url)
      // ATTENTION Utiliser HTTP et non HTTPS !
      //$response = file_get_contents($url);
      include 'function_curl.php';
      $response = loadJson($url);
      // ----------------------------------------------------------------------

      // Now decode the JSON using json_decode():
      $json = json_decode($response, true);
      ?>
      <!--CONTENU -->
      <div class="content-wrapper">
        <div class="container">

          <!-- Premiere row 1 nouvelles gauche 3 nouvelles droites -->
          <div class="row" data-aos="fade-up">
            <?php $article = $json['articles'][0] ?>
            <!--Gauche -->
            <div class="col-xl-8 stretch-card grid-margin">
              <div class="position-relative bg">
                <img src="<?php echo $article['urlToImage'] ?>" alt="banner" class="img-fluid gradient" />
                <div class="banner-content">
                  <div class="badge badge-danger fs-12 font-weight-bold mb-3">
                    À la une
                  </div>
                  <h1 class="mb-0">ARTS ET DIVERTISSEMENT</h1>
                  <a class="top" href="<?php echo $article['url'] ?>">
                    <h1 class="mb-2">
                      <?php echo $article['title'] ?>
                    </h1>
                  </a>
                  <div class="fs-12">
                    <span class="mr-2">Photo </span>Il y a 10 Minutes
                  </div>
                </div>
              </div>
            </div>

            <!-- droite -->
            <div class="col-xl-4 stretch-card grid-margin">
              <div class="card bg-dark text-white">
                <div class="card-body">
                  <h2>Dernières Nouvelles</h2>


                  <?php for ($index = 1; $index < 4; $index++) {
                    $article = $json['articles'][$index] ?>
                    <div class="d-flex border-bottom-blue pt-3 pb-4 align-items-center justify-content-between">
                      <div class="pr-3">
                        <a class="lastnews" href="<?php echo $article['url'] ?>">
                          <h5><?php echo $article['title'] ?></h5>
                        </a>
                        <div class="fs-12">
                          <span class="mr-2">Photo </span>Il y a 10 minutes
                        </div>
                      </div>
                      <div class="rotate-img">
                        <img src="<?php echo $article['urlToImage'] ?>" alt="thumb" class="img-fluid img-lg" />
                      </div>
                    </div>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>


          <div class="row" data-aos="fade-up">
            <!--Catégories gauche-->
            <div class="col-lg-3 stretch-card grid-margin">
              <div class="card">
                <div class="card-body">
                  <h2>Catégorie</h2>
                  <ul class="vertical-menu">
                    <li><a href="page.php?q=cinéma">Cinéma</a></li>
                    <li><a href="page.php?q=théâtre">Théâtre</a></li>
                    <li><a href="page.php?q=photographie">Photographie</a></li>
                    <li><a href="page.php?q=littérature">Littérature</a></li>
                    <li><a href="page.php?q=musique">Musique</a></li>
                  </ul>
                </div>
              </div>
            </div>

            <!-- nouvelles a la une droite-->
            <div class="col-lg-9 stretch-card grid-margin">
              <div class="card">
                <div class="card-body">


                  <?php for ($index = 4; $index < 7; $index++) {
                    $article = $json['articles'][$index] ?>
                    <div class="row">
                      <div class="col-sm-4 grid-margin">
                        <div class="position-relative">
                          <div class="rotate-img">
                            <img src="<?php echo $article['urlToImage'] ?>" alt="thumb" class="img-fluid" />
                          </div>
                          <div class="badge-positioned">
                            <span class="badge badge-danger font-weight-bold">A la une</span>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-8  grid-margin">
                        <a href="<?php echo $article['url'] ?>">
                          <h5><?php echo $article['title'] ?></h5>
                        </a>
                        <div class="fs-13 mb-2">
                          <span class="mr-2">Photo </span>Il y a 10 minutes
                        </div>
                        <p class="mb-0 overflow">
                          <?php echo $article['description'] ?>
                        </p>
                      </div>
                    </div>
                  <?php } ?>

                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
      <!-- CONTENU ends -->

      <!-- partial:partials/_footer.html -->
      <?php
      include('./partials/_footer.php')
      ?>

    </div>
  </div>
  <!--inclusion JS -->
  <?php
  include("./partials/_jsinclude.php")
  ?>

</body>

</html>