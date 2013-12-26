<!DOCTYPE html>

<html>

<head>

	<title>Boston Gig Earnings Calculator</title> 

	<link rel="stylesheet" href="css/style.css" type="text/css">

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    <script src="js/action.js"></script> 

</head>

<body>
	<div class="footer">
		<h1><a>Where should my band play, and just how much can I make?</a></h1><br>

	</div>

	<div class="container">
		<h2>Want to know where to play in Boston? Pick an option below that best describes your group. You'll be offered several choices of Boston venues. Next, choose which venues you'd like to perform at, and the amount of members in your group. At bottom is the amount you can make from your show(s)</h2>
		<span class='cancun'>
		<button id='never_gigged'>Never Gigged</button>
		<button id='acoustic'>Acoustic Groups</button>
		<button id='cover_group'>Cover Groups</button>
		<button id='indie_havens'>Established Indie Bands</button>
		<button id='indie_labels'>Indie-Label Acts</button>
		<button id='major_labels'>Major-Label Acts</button>
		<button id='rock_stars'>Rock Stars</button>
		</span>

		<div id='greensquare' style="background:#98bf21;height:100px;width:100px;position:absolute;"></div>	

		<div class="infobox">
			<h2>Venues:</h2>
				<p id='obriens'><input type='checkbox' name='venues' value='100'>O'brien's Pub</p>
				<p id='midway'><input type='checkbox' name='venues' value='200'>Midway Cafe</p>
				<p id='church'><input type='checkbox' name='venues' value='300'>Church<br></p>
				<p id='great_scott'><input type='checkbox' name='venues' value='400'>Great Scott<br></p>
				<p id='club_passim'><input type='checkbox' name='venues' value='450'>Club Passim<br></p>
				<p id='lizard_lounge'><input type='checkbox' name='venues' value='500'>Lizard Lounge<br></p>
				<p id='lansdowne_pub'><input type='checkbox' name='venues' value='650'>Lansdowne Pub<br></p>
				<p id='tt_the_bears'><input type='checkbox' name='venues' value='750'>T.T the Bear's<br></p>
				<p id='middle_east_upstairs'><input type='checkbox' name='venues' value='1000'>Middle East Upstairs<br></p>
				<p id='brighton_music_hall'><input type='checkbox' name='venues' value='2500'>Brighton Music Hall<br></p>
				<p id='middle_east_downstairs'><input type='checkbox' name='venues' value='4000'>Middle East Downstairs<br></p>
				<p id='paradise_rock_club'><input type='checkbox' name='venues' value='5000'>Paradise Rock Club<br></p>
				<p id='sinclair'><input type='checkbox' name='venues' value='10000'>The Sinclair<br></p>
				<p id='house_of_blues'><input type='checkbox' name='venues' value='50000'>House of Blues<br></p>
				<p id='wang_theater'><input type='checkbox' name='venues' value='100000'>Wang Theater<br></p>
				<p id='bank_of_america_pavilion'><input type='checkbox' name='venues' value='500000'>Bank of America Pavilion<br></p>
				<p id='td_banknorth_garden'><input type='checkbox' name='venues' value='1000000'>TD BankNorth Garden<br></p>
		</div>	

		<div id='greensquare' style="background:#98bf21;height:100px;width:100px;position:absolute;"></div>	

		<div class='infobox'>
			<h3>How many members does your group have?</h3>
				<select id="member_count">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
					<option value="7">7</option>
					<option value="8">8</option>
					<option value="9">9</option>
					<option value="10">10</option>
				</select>
		</div>
		<br><br><br>
	</div>

	<div class="footer">
		<p2><span id="outcome"><p1>You'll make $<span id='output'></span> per group member</p1></span></p>
        
    </div>

	<script>

		$('button').click(calculate);
		$('input, select').change(calculate);
		
		function calculate() {

			var venues = $('input[name=venues]:checked');
			var members = $('#member_count').val();
			var total = 0;

			venues.each(function() {

				var earned = $(this).val();

				var profits = earned / members;

				total = total + profits;

			});

			$('#output').html(total);

		}	
		

	</script>

</body>

</html>