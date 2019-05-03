<script type="text/javascript">
	$(document).ready(function(){
		var user_[@id] = $('#user_[@id]').text();
		var intials_[@id] = $('#user_[@id]').text().charAt(0).toUpperCase();
		var intials2_[@id] = $('#user2_[@id]').text().charAt(0).toUpperCase();
		var profileImage_[@id] = $('#user_img_[@id]').text(intials_[@id]+intials2_[@id]);
	});
</script>
	<div class="col-md-4 col-sm-6">
		<div class="team__item">
		
			<div id="user_img_[@id]" class="profileImage team__img"></div>
			<div class="team__info">
			<h4 id="user_[@id]">[@fname] <span id="user2_[@id]">[@lname]</span></h4>
			<small>[#lang_exchange_from] [@efrom] [#lang_small_to] [@eto]</small>
	
			<p>"[@feedback]"</p>
			<br>
			</div>
		</div>
	</div>