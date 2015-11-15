<?php 


function altertBoxSuccess(){
?>
<?php if (isset($_GET["alertMessage"])): ?>

<div data-alert class="alert-box <?php echo $_GET["alertMessageType"] ?> radius">
  <?php echo $_GET["alertMessage"] ?>
  <a href="#" class="close">&times;</a>
</div>

<?php endif ?>

<?php
}

add_action('foundationpress_before_content', 'altertBoxSuccess');
