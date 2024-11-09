<?php  

require_once 'dbConfig.php';
require_once 'models.php';


if (isset($_POST['insertGameDevBtn'])) {
	$insertUser = insertNewGameDev($pdo,$_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['phonenumber'], $_POST['role'], $_POST['games_worked_on'], $_POST['skills'], $_POST['portfolio']);

	if ($insertUser) {
		$_SESSION['message'] = "Successfully inserted!";
		header("Location: ../index.php");
	}
}


if (isset($_POST['editGameDevBtn'])) {
	$editUser = editGameDev($pdo,$_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['phonenumber'], $_POST['role'], $_POST['games_worked_on'], $_POST['skills'], $_POST['portfolio'], $_GET['developer_id']);

	if ($editUser) {
		$_SESSION['message'] = "Successfully edited!";
		header("Location: ../index.php");
	}
}

if (isset($_POST['deleteGameDevBtn'])) {
	$deleteUser = deleteGameDev($pdo,$_GET['developer_id']);

	if ($deleteUser) {
		$_SESSION['message'] = "Successfully deleted!";
		header("Location: ../index.php");
	}
}

if (isset($_GET['searchBtn'])) {
	$searchForAUser = searchForAGameDev($pdo, $_GET['searchInput']);
	foreach ($searchForAUser as $row) {
		echo "<tr> 
				<td>{$row['developer_id']}</td>
				<td>{$row['first_name']}</td>
				<td>{$row['last_name']}</td>
				<td>{$row['email']}</td>
				<td>{$row['phonenumber']}</td>
				<td>{$row['role']}</td>
				<td>{$row['games_worked_on']}</td>
				<td>{$row['skills']}</td>
				<td>{$row['portfolio']}</td>
			  </tr>";
	}
}

?>