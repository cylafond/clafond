<!DOCTYPE html>
<html lang="zxx">

<head>
  <?php include('./partials/_head.php') ?>
  <title>World Time</title>

</head>

<body>

  <div class="container-scroller">
    <div class="main-panel">
      <!-- partial:../partials/_navbar.html -->
      <?php
      include('./partials/_navbar.php');

      $q = $_GET['q'];
      $cat = $q;

      $apiKey = '709e0fca642d4892b27aa3442e9a6d94';
      $lang = 'fr';
      $page = 1;

      # Pagination
      if ((isset($_REQUEST['page'])) && (!empty($_REQUEST['page']))) {
        $page = $_GET['page'];
      } else {
        $page = 1;
      }

      $next = $page + 1;
      if ($next > 5) {
        $page = 5;
      }

      $back = 1;
      if ($page > 1) {
        $back = $page - 1;
      } else {
        $page = 1;
      }

      if ($page == 5) {
        $pagination = <<<EOT
        <h3 class="center">Pages</h3>
        <div class="page5" id="page">
        <a href='page.php?q=$cat&page=$back'>Précédent</a>
        <p>$page</p>
       </div>
      EOT;
      } elseif ($page == 1) {
        $pagination = <<<EOT
        <h3 class="center">Pages</h3>
        <div class="page1" id="page">
        <p>$page</p> 
        <a href='page.php?q=$cat&page=$next'>Suivant</a>
       </div>
      EOT;
      } else {
        $pagination = <<<EOT
        <h3 class="center">Pages</h3>
        <div class="page" id="page">
        <a href='page.php?q=$cat&page=$back'>Précédent</a>
        <p>$page</p>
        <a href='page.php?q=$cat&page=$next'>Suivant</a>
       </div>
      EOT;
      }

      $url = 'http://newsapi.org/v2/everything?q=' . $q . '&apiKey=' . $apiKey . '&page=' . $page . '&language=' . $lang . '&pageSize=20';

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

      <div class=" content-wrapper">
        <div class="container">
          <div class="col-sm-12">
            <div class="card" data-aos="fade-up">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-12">
                    <h1 class="font-weight-600 mb-4">
                      <?php echo ucfirst($q) ?>
                    </h1>
                  </div>
                </div>
                <div class="row">
                  <!-- toutes les nouvelles -->
                  <div class="col-lg-8">

                    <?php
                    $len = count($json['articles']);

                    for ($index = 6; $index < 12; $index++) {
                      $article = $json['articles'][$index] ?>
                      <div class="row">
                        <div class="col-sm-4 grid-margin">
                          <div class="rotate-img">
                            <img src="<?php echo $article['urlToImage'] ?>" onerror="this.src='assets/images/art_1.png'" class="img-fluid" />
                          </div>
                        </div>
                        <div class="col-sm-8 grid-margin">
                          <a href="<?php echo $article['url'] ?>">
                            <h2 class="font-weight-600 mb-2">
                              <?php echo $article['title'] ?>
                            </h2>
                          </a>
                          <p class="fs-13 text-muted mb-0">
                            <span class="mr-2">Photo </span>Il y a 10 minutes
                          </p>
                          <p class="fs-15 overflow">
                            <?php echo $article['description'] ?>
                          </p>
                        </div>
                      </div>
                    <?php } ?>

                    <!-- pagination -->

                    <?php
                    echo $pagination;
                    ?>

                  </div>
                  <div class="col-lg-4">
                    <h2 class="mb-4 text-primary font-weight-600">
                      Dernières Nouvelles
                    </h2>
                    <!--dernière nouvelles-->
                    <?php for ($index = 0; $index < 3; $index++) {
                      $article = $json['articles'][$index] ?>
                      <div class="row">
                        <div class="col-sm-12">
                          <div class="border-bottom pb-4 pt-4">
                            <div class="row">
                              <div class="col-sm-8">
                                <a href="<?php echo $article['url'] ?>">
                                  <h5 class="font-weight-600 mb-1">
                                    <?php echo $article['title'] ?>
                                  </h5>
                                </a>
                                <p class="fs-13 text-muted mb-0">
                                  <span class="mr-2">Photo </span>Il y a 10 minutes
                                </p>
                              </div>
                              <div class="col-sm-4">
                                <div class="rotate-img">
                                  <img src="<?php echo $article['urlToImage'] ?>" alt="banner" class="img-fluid" />
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php } ?>

                    <!--Trending-->
                    <div class="trending">
                      <h2 class="mb-4 text-primary font-weight-600">
                        Populaires
                      </h2>
                      <?php for ($index = 3; $index < 6; $index++) {
                        $article = $json['articles'][$index] ?>
                        <div class="mb-4">
                          <div class="rotate-img">
                            <img src="<?php echo $article['urlToImage'] ?>" alt="banner" class="img-fluid" />
                          </div>
                          <a href="<?php echo $article['url'] ?>">
                            <h3 class="mt-3 font-weight-600">
                              <?php echo $article['title'] ?>
                            </h3>
                          </a>
                          <p class="fs-13 text-muted mb-0">
                            <span class="mr-2">Photo </span>Il y a 10 minutes
                          </p>
                        </div>
                      <?php } ?>

                    </div>
                  </div>
                </div>


              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
    <!-- main-panel ends -->
    <!-- container-scroller ends -->

    <!-- partial:../partials/_footer.html -->
    <?php
    include('./partials/_footer.php');
    ?>
    <!-- partial -->
  </div>
  </div>
  <!--inclusion JS -->
  <?php
  include("./partials/_jsinclude.php")
  ?>
</body>

</html>