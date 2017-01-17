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
			if(isset($_POST['newName'])) {
				echo $_POST['newName'];
			}

			// Checkl if Button was pressed
			else if(count($_POST) == 1) {
				$name = array_search('+',$_POST);
				$name = substr($name, 4,-1);


				$sql = "UPDATE stats SET MISSES = MISSES + 1 WHERE NAME = '".$name."';";
				mysqli_query($connection, $sql);
			}


			$request = "SELECT * FROM stats";

			$results = mysqli_query($connection, $request);

			mysqli_close($connection);

			$i = 0;

			echo '<table>
				<thead>
					<tr>
						<td>Name</td>
						<td>Fails</td>
						<td>Betrag in €</td>
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
				// Print Content
				echo '<td>' . $name . '</td>';
				echo '<td>' . $fails . '</td>';
				echo '<td>' . $cash . ' €</td>';

				// Buttons to add / reduce
				echo '<td>
						<form action="index.php" method="POST">
							<input type="submit" value="+" name=add_'.$name.'/>
						</form>
					</td>';
			
				$i++;
			}
			echo '</tbody>
				</table';
		?>
		<form action="index.php" method="POST">
			<input type="text" name="newName"></input>
			<input type="submit" name="submitNew" />
		</form>
	</body>
</html>
