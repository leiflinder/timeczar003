  <!-- Fixed navbar -->
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Fixed navbar</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <!-- <a class="nav-link" href="#">Link</a> -->
          </li>
          <li class="nav-item">
            <!-- <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a> -->
          </li>
        </ul>
        <div>
          <?php
        $checker = new user_checker();
                  if($checker->logged_in()!==1){ ?>    
                    <a href="<?php print($home_url);?>home.php?page=login&page_title=Login">
                    <button type="button" class="btn btn-primary">
                      Login
                    </button>
                    </a>
                    <a href="<?php print($home_url);?>home.php?page=register2&page_title=Register">
                    <button type="button" class="btn btn-primary">
                      register
                    </button>
                    </a>
                    <?php
            }else{
            ?>
            <a href="<?php print($home_url);?>bounce.logout.php">
            <button type="button" class="btn btn-primary">
              Log Out
            </button>
            </a>
            <?php
            }
            ?>
        </div>
      </div>
    </div>
  </nav>
