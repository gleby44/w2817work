<?php require_once ('templates/top.php');?>
	<div class="main">
		<?php if(isset($_GET['url'])){
			$url=$_GET['url'];
		}else{
			$url='index';
		} 
		$query="SELECT * FROM maintexts WHERE url='$url'";
		$agr=database($query);
		$tbl_maintexy=mysqli_fetch_array($agr);
		?>
	</div>

    <section class="py-5">
      <div class="container">
        <h1>
			<?php echo $tbl_maintexy['name']; ?>
		</h1>
        <p><?php echo $tbl_maintexy['text'];?></p>
      </div>
    </section>
	<?php require_once ('templates/bottom.php');?>