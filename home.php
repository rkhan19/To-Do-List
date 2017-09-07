<?php

	$db = mysqli_connect('localhost', 'root', '', 'todo');

	if(isset($_POST['submit'])) {
		$task = $_POST['task'];

		mysqli_query($db, "INSERT INTO entries (task) VALUES ('$task')");
		header('location: home.php');
		
	}

	if (isset($_GET['deleteFunc'])) {
		$id = $_GET['deleteFunc'];
		mysqli_query($db, "DELETE FROM entries WHERE id = $id");
		header('location: home.php');
	}

	$entries = mysqli_query($db, "SELECT * FROM entries");

?>


<!DOCTYPE html>
<html>
<head>
	<title>Todo List</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
		<div class = "heading">
				<h2>Todo list</h2>
		</div>

		<form method="POST" action="home.php">

			<button type="submit" name="submit"> Add </button>
			<input type="text" name="task">
		</form>

	<table>
		<tbody>
		<?php while ($row = mysqli_fetch_array($entries)){ ?>
			<tr>
				<td class="delete">
					<a href="home.php?deleteFunc= <?php echo $row['id']; ?>"> remove</a>
				</td>
				<td class="task"><?php echo $row['task']; ?></td>

			</tr>
		<?php } ?>
		</tbody>
	</table>
</body>
</html>