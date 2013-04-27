<?php
defined('CODESAUR') || exit(1);

codesaur::instance()->controller->incScriptToHtml('https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js', '');
codesaur::instance()->controller->incScriptToHtml('thirdparty/flexSlider/jquery.flexslider.js');
?>
<script type="text/javascript">
$(window).load(function() {
  $('.flexslider').flexslider({
    animation: "fade"
  });
});
</script>
</div>
</body>
</html>