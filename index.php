<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="styles.css">
	<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>
<body>

	<?php if (isset($_SESSION['message'])) { ?>
		<h1 style="color: green; text-align: center; background-color: ghostwhite; border-style: solid;">	
			<?php echo $_SESSION['message']; ?>
		</h1>
	<?php } unset($_SESSION['message']); ?>

	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="GET">
		<input type="text" name="searchInput" placeholder="Search here">
		<input type="submit" name="searchBtn">
	</form>

	<p><a href="index.php">Clear Search Query</a></p>
	<p><a href="insert.php">Insert New User</a></p>

	<table style="width:100%; margin-top: 20px;">
		<tr>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email</th>
			<th>Phone Number</th>
			<th>Role</th>
			<th>Games</th>
			<th>Skills</th>
			<th>Portfolio</th>
			<th>Date Added</th>
			<th>Action</th>
		</tr>

		<?php if (!isset($_GET['searchBtn'])) { ?>
			<?php $getAllGameDevs = getAllGameDevs($pdo); ?>
				<?php foreach ($getAllGameDevs as $row) { ?>
					<tr>
						<td><?php echo $row['firstname']; ?></td>
						<td><?php echo $row['lastname']; ?></td>
						<td><?php echo $row['email']; ?></td>
						<td><?php echo $row['phonenumber']; ?></td>
						<td><?php echo $row['role']; ?></td>
						<td><?php echo $row['games_worked_on']; ?></td>
						<td><?php echo $row['skills']; ?></td>
						<td><?php echo $row['portfolio']; ?></td>
						<td><?php echo $row['date_added']; ?></td>
						<td>
							<a href="edit.php?developer_id=<?php echo $row['developer_id']; ?>">Edit</a>
							<a href="delete.php?developer_id=<?php echo $row['developer_id']; ?>">Delete</a>
						</td>
					</tr>
			<?php } ?>
			
		<?php } else { ?>
			<?php $searchForAGameDev =  searchForAGameDev($pdo, $_GET['searchInput']); ?>
				<?php foreach ($searchForAGameDev as $row) { ?>
					<tr>
						<td><?php echo $row['firstname']; ?></td>
						<td><?php echo $row['lastname']; ?></td>
						<td><?php echo $row['email']; ?></td>
						<td><?php echo $row['phonenumber']; ?></td>
						<td><?php echo $row['role']; ?></td>
						<td><?php echo $row['games_worked_on']; ?></td>
						<td><?php echo $row['skills']; ?></td>
						<td><?php echo $row['portfolio']; ?></td>
						<td><?php echo $row['date_added']; ?></td>
						<td>
							<a href="edit.php?developer_id=<?php echo $row['developer_id']; ?>">Edit</a>
							<a href="delete.php?developer_id=<?php echo $row['developer_id']; ?>">Delete</a>
						</td>
					</tr>
				<?php } ?>
		<?php } ?>	
		
	</table>
</body>
</html>