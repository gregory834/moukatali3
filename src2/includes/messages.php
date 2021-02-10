<?php if (isset($_SESSION['message'])) : ?>
      <div class="alert alert-success text-center" role="alert">
      	<p>
          <?php 
          	echo $_SESSION['message']; 
          	unset($_SESSION['message']);
          ?>
      	</p>
      </div>
<?php endif ?>