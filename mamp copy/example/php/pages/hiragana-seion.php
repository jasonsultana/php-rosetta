<div>
	<div class="table-responsive">
	  <table class="table phonics-table">
	  	<!--
	  	<tr>
	  		<td><a class = 'sound'></a></td>
	  		<td><a class = 'sound'></a></td>
	  		<td><<a class = 'sound'></a>/td>
	  		<td><a class = 'sound'></a></td>
	  		<td><a class = 'sound'></a></td>
	  	</tr>
	  -->
	  	<tr>
	  		<td><a class = 'sound'>あ</a></td>
	  		<td><a class = 'sound'>い</a></td>
	  		<td><a class = 'sound'>う</a></td>
	  		<td><a class = 'sound'>え</a></td>
	  		<td><a class = 'sound'>お</a></td>
	  	</tr>

	  	<tr>
	  		<td><a class = 'sound'>か</a></td>
	  		<td><a class = 'sound'>き</a></td>
	  		<td><a class = 'sound'>く</a></td>
	  		<td><a class = 'sound'>け</a></td>
	  		<td><a class = 'sound'>こ</a></td>
	  	</tr>

	  	<tr>
	  		<td><a class = 'sound'>さ</a></td>
	  		<td><a class = 'sound'>し</a></td>
	  		<td><a class = 'sound'>す</a></td>
	  		<td><a class = 'sound'>せ</a></td>
	  		<td><a class = 'sound'>そ</a></td>
	  	</tr>

	  	<tr>
	  		<td><a class = 'sound'>た</a></td>
	  		<td><a class = 'sound'>ち</a></td>
	  		<td><a class = 'sound'>つ</a></td>
	  		<td><a class = 'sound'>て</a></td>
	  		<td><a class = 'sound'>と</a></td>
	  	</tr>

	  	<tr>
	  		<td><a class = 'sound'>な</a></td>
	  		<td><a class = 'sound'>に</a></td>
	  		<td><a class = 'sound'>ぬ</a></td>
	  		<td><a class = 'sound'>ね</a></td>
	  		<td><a class = 'sound'>の</a></td>
	  	</tr>

	  	<tr>
	  		<td><a class = 'sound'>は</a></td>
	  		<td><a class = 'sound'>ひ</a></td>
	  		<td><a class = 'sound'>ふ</a></td>
	  		<td><a class = 'sound'>へ</a></td>
	  		<td><a class = 'sound'>ほ</a></td>
	  	</tr>

	  	<tr>
	  		<td><a class = 'sound'>ま</a></td>
	  		<td><a class = 'sound'>み</a></td>
	  		<td><a class = 'sound'>む</a></td>
	  		<td><a class = 'sound'>め</a></td>
	  		<td><a class = 'sound'>も</a></td>
	  	</tr>

	  	<tr>
	  		<td><a class = 'sound'>や</a></td>
	  		<td><a class = 'sound'></a></td>
	  		<td><a class = 'sound'>ゆ</a></td>
	  		<td><a class = 'sound'></a></td>
	  		<td><a class = 'sound'>よ</a></td>
	  	</tr>

	  	<tr>
	  		<td><a class = 'sound'>ら</a></td>
	  		<td><a class = 'sound'>り</a></td>
	  		<td><a class = 'sound'>る</a></td>
	  		<td><a class = 'sound'>れ</a></td>
	  		<td><a class = 'sound'>ろ</a></td>
	  	</tr>

	  	<tr>
	  		<td><a class = 'sound'>わ</a></td>
	  		<td><a class = 'sound'></a></td>
	  		<td><a class = 'sound'></a></td>
	  		<td><a class = 'sound'></a></td>
	  		<td><a class = 'sound'>を</a></td>
	  	</tr>

	  	<tr>
	  		<td><a class = 'sound'>ん</a></td>
	  		<td><a class = 'sound'></a></td>
	  		<td><a class = 'sound'></a></td>
	  		<td><a class = 'sound'></a></td>
	  		<td><a class = 'sound'></a></td>
	  	</tr>
	  </table>
	</div>
</div>

<script>
	window.onload = function() {
		$(".sound").click(function() {
			var contents = $(this).html();
			var audio = new Audio('sounds/phonics/' + contents + '.mp3'); //mp3 is supported on all platforms
			audio.play();
		});
	}
</script>