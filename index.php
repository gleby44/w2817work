<?php require_once ('templates/top.php');?>
<?php require_once ('templates/carousel.php');?>
    <header>
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
        
		  <?php
		  $i=0;
		  $val=$arr1[$i];
		  foreach($arr as $key=>$value){?>
          <div class="carousel-item <?php if($i==0){
			  echo 'active';}?>" style="background-image: url('<?php echo $key?>')">
            <div class="carousel-caption d-none d-md-block">
              <h3><?php echo $value?></h3>
              <p class="slogan"><?php echo $arr1[$i] ?></p>
            </div>
          </div>
		  <?php 
		  $i++;
		  } ?>
          
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </header>
    <section class="py-5">
	<?php 
		$query="SELECT * FROM catalogs WHERE type='card'";
		$adr=database($query);
		?>
      <div class="container">
        <?php
        $query="SELECT * FROM catalogs WHERE type='card'";
        $adr=database($query)
		?>
        <div class="row text-center">
        <?php while($tbl_category=mysqli_fetch_array($adr)){?>

              <div class="col-lg-3 col-md-6 mb-4">
                  <div class="card">
                      <img class="card-img-top" src="http://placehold.it/500x325" alt="">
                      <div class="card-body">
                          <h4 class="card-title"><?php echo $tbl_category['name']?></h4>
                      </div>
                      <div class="card-footer">
                          <a href="catalog.php?id=<?php echo $tbl_category['id']?>" class="btn btn-primary">Перейти к каталогу</a>
                      </div>
                  </div>
              </div>
        <?php }?>
        </div>
      </div>
    </section>
	<?php require_once ('templates/bottom.php');?>