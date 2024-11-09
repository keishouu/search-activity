<?php  

require_once 'dbConfig.php';

function getAllGameDevs($pdo) {
	$sql = "SELECT * FROM game_developers 
			ORDER BY firstname ASC";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();
	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function getUserByDeveloper_id($pdo, $developer_id) {
	$sql = "SELECT * from game_developers WHERE developer_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$developer_id]);

	if ($executeQuery) {
		return $stmt->fetch();
	}
}

function searchForAGameDev($pdo, $searchQuery) {
	
	$sql = "SELECT * FROM game_developers WHERE 
			CONCAT(firstname,lastname,email,phonenumber,
				role,games_worked_on,skills,portfolio,date_added) 
			LIKE ?";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute(["%".$searchQuery."%"]);
	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}



function insertNewGameDev($pdo, $firstname, $lastname, $email, 
	$phonenumber, $role, $games_worked_on, $skills, $portfolio) {

	$sql = "INSERT INTO game_developers 
			(
				firstname,
				lastname,
				email,
				phonenumber,
                role,
                games_worked_on,
                skills,
                portfolio
			)
			VALUES (?,?,?,?,?,?,?,?)
			";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([
		$firstname, $lastname, $email, 
		$phonenumber, $role, $games_worked_on, 
		$skills, $portfolio,
	]);

	if ($executeQuery) {
		return true;
	}

}

function editGameDev($pdo, $firstname, $lastname, $email, $phonenumber, 
	$role, $games_worked_on, $skills, $portfolio, $developer_id) {

	$sql = "UPDATE game_developers
				SET firstname = ?,
					lastname = ?,
					email = ?,
					phonenumber = ?,
					role = ?,
					games_worked_on = ?,
					skills = ?,
					portfolio = ?
				WHERE developer_id = ? 
			";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$firstname, $lastname, $email, $phonenumber, 
		$role, $games_worked_on, $skills,$portfolio, $developer_id]);

	if ($executeQuery) {
		return true;
	}

}


function deleteGameDev($pdo, $developer_id) {
	$sql = "DELETE FROM game_developers 
			WHERE developer_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$developer_id]);

	if ($executeQuery) {
		return true;
	}
}




?>