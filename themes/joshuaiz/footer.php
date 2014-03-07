			

		</div>
	<div class="clearfix"></div>

		<?php // all js scripts are loaded in library/bones.php ?>
		<?php wp_footer(); ?>

<script>
jQuery(document).ready(function($){
	$('#sidebar1, #content, #secondary').equalHeightColumns(); 
});




jQuery(document).ready(function($){
   $('.entry-content p, h1').widowFix();
});

jQuery(document).ready(function($){
	$('.djgigs-table-trigger').click(function() {
		$('#sidebar1, #content, #secondary').equalHeightColumns();
	});
});

</script>
	
	</body>

</html>
