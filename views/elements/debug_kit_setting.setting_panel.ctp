<?php if(!empty($cakeEnvMode)): ?>
<div class="debug-info">
<h2>Cake Env Mode</h2>
  <?php echo $toolbar->makeNeatArray($cakeEnvMode); ?>
</div>
<?php endif; ?>

<div class="debug-info">
<h2>Defines</h2>
  <?php echo $toolbar->makeNeatArray($defines); ?>
</div>

<div class="debug-info">
<h2>Servers</h2>
  <?php echo $toolbar->makeNeatArray($servers); ?>
</div>

<div class="debug-info">
<h2>Extensions</h2>
  <?php echo $toolbar->makeNeatArray($extensions); ?>
</div>

<div class="debug-info">
<h2>Database</h2>
  <?php echo $toolbar->makeNeatArray($dbConfigs); ?>
</div>