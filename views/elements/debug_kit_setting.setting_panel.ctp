<script type="text/javascript" charset="utf-8">
if (typeof(jQuery) != 'function' && typeof(jQuery) != 'object') {
  document.write('<sc'+'ript src="<?php echo $html->url('/debug_kit_setting/js/jquery-1.3.2.min.js'); ?>" type="text/javascript"></sc'+'ript>');
}
</script>
<script src="<?php echo $html->url('/debug_kit_setting/js/jquery.keyinterval.js'); ?>" type="text/javascript"></script>
<script src="<?php echo $html->url('/debug_kit_setting/js/jquery.search.js'); ?>" type="text/javascript"></script>
<script type="text/javascript" charset="utf-8">
(function($) {
  $(function(){
    var $debug_kit_setting_cake_env = $('#debug_kit_setting_cake_env_define, #debug_kit_setting_cake_env_servers'),
        $debug_kit_setting_expandable = $('.expandable', $debug_kit_setting_cake_env);
    $debug_kit_setting_expandable.each(function(){
      var $this = $(this),
          $title = $('strong:first', $this);

      $this.click(function(){
        if ( $this.hasClass('expanded') === false ) {
          var $lines = $('ul.neat-array.depth-1 li', $this);
          $('<input type="text" name="jquery.search" value="" style="margin: 5px;" />').appendTo($title).click(function(){return false;}).search({
            lines: $lines
          });
          $lines.click(function(){return false;});
        }
        if ( $this.hasClass('expanded') === true ) {
          $('input', $title).remove();
          $('ul.neat-array.depth-1 li', $this).css('display', '');
        }
      });
    });
  });
})(jQuery);
</script>

<?php if(!empty($cakeEnvMode)): ?>
<div class="debug-info">
<h2>Cake Env Mode</h2>
  <?php echo $toolbar->makeNeatArray($cakeEnvMode); ?>
</div>
<?php endif; ?>

<div class="debug-info" id="debug_kit_setting_cake_env_define">
<h2>Defines</h2>
  <?php echo $toolbar->makeNeatArray($defines); ?>
</div>

<div class="debug-info" id="debug_kit_setting_cake_env_servers">
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