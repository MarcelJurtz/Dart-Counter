<!DOCTYPE html>
<html>
	<head>
		<title>Dart Fails</title>
		<meta charset="utf-8">
		<link href="stylesheet.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<?php
			$dbHost = 'localhost';
			$dbUser = 'root';
			$dbPassword = 'c16wi71ft';
			$dbTable = 'dartDB';

			$connection = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbTable);

			// Check if new Player was added
			if(isset($_POST['submitNew'])) {
				$newPlayer = $_POST['submitText'];

				$sql = "INSERT INTO stats(NAME, MISSES) VALUES('".$newPlayer."',0);";
				$res = mysqli_query($connection, $sql);

				if(!$res) {
					echo "<script>alert('Name bereits vorhanden!');</script>";
				}
			}

			// Checkl if Button was pressed
			else if(count($_POST) == 1) {
				$name = array_search('+',$_POST);
				$name = substr($name, 4);


				$sql = "UPDATE stats SET MISSES = MISSES + 1 WHERE NAME = '".$name."';";
				mysqli_query($connection, $sql);
			}


			$request = "SELECT * FROM stats ORDER BY NAME";

			$results = mysqli_query($connection, $request);

			mysqli_close($connection);

			$i = 0;
			$sum = 0;

			echo '<table>
				<thead>
					<tr>
						<td>Name</td>
						<td>Fails</td>
						<td>Betrag</td>
						<td></td>
					</tr>
				</thead>
				<tbody>';
			while($row = mysqli_fetch_assoc($results)) {
				if($i % 2 == 0) {
					// Even Row
					echo '<tr class="even">';
				} else {
					// Odd Row
					echo '<tr class="odd">';
				}

				$name = $row['NAME'];
				$fails = $row['MISSES'];
				$cash = $fails * 0.05;
				$sum += $cash;
				// Print Content
				echo '<td>' . $name . '</td>';
				echo '<td>' . $fails . '</td>';
				echo '<td>' . number_format($cash, 2, ",", ".") . ' €</td>';

				// Buttons to add / reduce
				echo '<td>
						<form action="index.php" method="POST">
							<input type="submit" value="+" class="plusButton" name=add_'.$name.' />
						</form>
					</td>';

				$i++;
				echo '</tr>';
			}
			echo '<tr>
					<td></td>
					<td></td>
					<td id="sumField">' . number_format($sum, 2, ",", ".") . ' €</td>
					<td></td>
				</tr>';
			echo '</tbody></table>';

			?>
			<form action="index.php" method="POST">
				<table>
					<tbody>
						<tr>
							<td>
								<input type="text" name="submitText" id="newPlayerText"/>
							</td>
							<td>
								<input type="submit" value="Hinzufügen" name="submitNew" id="newPlayerButton"/>
							</td>
						</tr>
					</tbody>
				</table>
			</form>
	</body>
</html>
