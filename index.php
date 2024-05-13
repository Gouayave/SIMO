<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="">
		<script src="p5.min.js"></script>
		<style>

			.square {
				width: 50px;
				height: 50px;
				margin: 5px;
				display: inline-block;
				border: 1px solid black;
			}
		</style>
	</head>
	<body>
		<h2>
			<label for="session_id_select">Session</label>
			<select id="session_id_select" onchange="change_session()" >
			  <option value="" selected="selected" >-----</option>
			  <?php
			    foreach(glob(dirname(__FILE__) . '\data\*') as $filename){
			       $filename = basename($filename);
			       echo "<option value='" . $filename . "'>". substr($filename,5,4)."</option>";
			    }
			?>

			</select>
		</h2>
		<script type="text/javascript">
			var size = 0;
			var numberOfShots = 0;
			var shotResults = [];


			function change_session() {
				window.size = min(windowWidth, windowHeight);
				createCanvas(size, size);
				draw_background();
				fill_select_ids_session();
			}

			function setup() {
				window.size = min(windowWidth, windowHeight);
				createCanvas(size, size);
				draw_background();
			}

			function draw_background() {
				background(200, 0, 0);

				color(255, 0, 0);
				strokeWeight(4);

				fill(255, 255, 255);
				circle(size / 2, size / 2, size * 0.93); //mini cercle
				circle(size / 2, size / 2, size * 0.91); //cercle 1
				circle(size / 2, size / 2, size * 0.75); //cercle 2
				circle(size / 2, size / 2, size * 0.59); //cercle 3
				circle(size / 2, size / 2, size * 0.43); //cercle 4
				fill(255, 0, 0);
				circle(size / 2, size / 2, size * 0.21); //cercle 5
				fill(255, 255, 255);
				circle(size / 2, size / 2, size * 0.09); //mini cercle 2
				circle(size / 2, size / 2, size * 0.07); //cercle 6

				stroke(255);
				fill(0);
				textAlign(CENTER, CENTER);
				textStyle(BOLD);
				textSize(size * 0.04);
				text('6', size / 2, size / 2);
				text('5', size / 2, size * 0.43);
				text('4', size / 2, size * 0.35);
				text('3', size / 2, size * 0.25);
				text('2', size / 2, size * 0.17);
				text('1', size / 2, size * 0.09);

			}

			function fill_select_ids_session() {

				fill(255, 255, 0); // Couleur jaune
				stroke(0); // Couleur noire du contour
				strokeWeight(1);

				let session_id_selected = document.getElementById("session_id_select");
				console.log(session_id_selected.value);

				loadTable('data/'+session_id_selected.value, 'csv', 'header',function (table) {
					table.getRows().forEach((item, i) => {
						console.log(item);
						let x = item.getNum("x");
						let y = item.getNum("y");
						let xCoord = (window.size / 2) + (x * (window.size / (2 * 100)));
						let yCoord = (window.size / 2) - (y * (window.size / (2 * 100)));
						console.log(xCoord, yCoord);
						let pointSize = size * 0.05; // Taille des points jaunes
						circle(xCoord, yCoord, pointSize);
					});

				});


			}



		</script>

	</body>
</html>
