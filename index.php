<?php
	include_once('resources/init.php');

	$per_page = 6;

	$num_results = count_names();
	$pages = ceil($num_results / $per_page);

	$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
	$start = ($page - 1) * $per_page;

	$names = get_names($start, $per_page);

	if (isset($_POST['name'])) {
		$errors = array();

		$name = trim($_POST['name']);
		
		if (empty($name)) {
			$errors[] = "You need to supply a name.";
		} else if (strlen($name) > 255) {
			$errors[] = "The name cannot be longer than 255 characters.";
		}

		if (empty($errors))	{
			add_name($name);

			header("Location: index.php");
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Pagination</title>
</head>
<body>
	<h1>Add a user</h1>

	<!-- errors -->
	<?php
		if (isset($errors) && !empty($errors)) {
			echo "<ul><li>", implode('</li><li>', $errors), "</li></ul>";
		}
	?>

	<!-- add name -->
	<form action="" method="post">
		<label for="name">Name</label>
		<input type="text" name="name" autofocus="autofocus" />
		<input type="submit" value="Add Name" />
	</form>
	<hr>

	<!-- display names -->
	<?php
		foreach ($names as $name) {
	?>
		<p><?= $name['name']; ?> - <a href="delete_name.php?id=<?= $name['id']; ?>&num_results=<?= $num_results ?>&page=<?= $page ?>">Delete</a></p>
	<?php
		}

	// pagination menu
		if ($pages >= 1 && $page <= $pages) {
			for ($x = 1; $x <= $pages; $x++) {
	?>
		<a href="?page=<?= $x ?>"><?= ($x == $page) ? "<strong>". $x ."</strong>" : $x; ?></a>
	<?php
			}
		}
	?>
</body>
</html>