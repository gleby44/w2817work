
    <footer class="py-5 bg-light">
      <div class="container">
        <p class="m-0 text-center text-gray">Copyright &copy; <?php echo $email ?></p>
      </div>
    </footer>
	
    
  
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendor/js/script.js"></script>
	<?php 
	if(!empty($scripts)){
		foreach($scripts as $script){
			?>
			<script src="<?php echo $script ?>"></script>
			<?
			
		}
	}
	?>

  </body>

</html>