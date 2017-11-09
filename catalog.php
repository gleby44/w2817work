<?php require_once ('templates/top.php');?>
	<div class="main">
		<?php if(isset($_GET['id'])){
			$id=(int)$_GET['id'];
		}else{
			$id=0;
		} 
		?>
	</div>

    <section class="py-5">
      <div class="container">
	   <?php
        $query="SELECT * FROM products WHERE catalog_id='$id'";
		$adr=database($query);
        $adr=mysqli_query($db_con,$query);
		?>
        <div class="row text-center">
        <?php while($tbl_category=mysqli_fetch_array($adr)){?>

              <div class="col-lg-3 col-md-6 mb-4">
                  <div class="card">
                      <img class="card-img-top" src="<?php echo '/vendor/uploads/'.$tbl_category['picture'] ?>" alt="">
                      <div class="card-body">
                          <h4 class="card-title"><?php echo $tbl_category['name']?></h4>
						  <p><?php echo $tbl_category['body'] ?></p>
                      </div>
                      <div class="card-footer">
                          <a href="#" class="btn btn-primary"><?php echo $tbl_category['price']?></a>
                      </div>
                  </div>
              </div>
        <?php }?>
        </div>
      </div>
    </section>
	<?php require_once ('templates/bottom.php');?>