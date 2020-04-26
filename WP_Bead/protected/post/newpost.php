<?php if(!isset($_SESSION['permission']) || $_SESSION['permission'] < 1) : ?>
	<h1>Nincs jogod posztokat tenni az oldalra.</h1>
<?php else : ?>
<?php 
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addtema'])) {
		$postData = [
			'felh_nev' => $_POST['felh_nev'],
			'tema' => $_POST['tema'],
			'tema_szoveg' => $_POST['tema_szoveg'],
		];
		if(empty($postData['felh_nev']) || empty($postData['tema']) || empty($postData['tema_szoveg'])) {
			echo "Hiányzó adat(ok)!";
		}else {
			$query = "INSERT INTO posts (felh_nev, tema, tema_szoveg) VALUES (:felh_nev, :tema, :tema_szoveg)";
			$params = [
				':felh_nev' => $postData['felh_nev'],
				':tema' => $postData['tema'],
				':tema_szoveg' => $postData['tema_szoveg'],
			];
			require_once DATABASE_CONTROLLER;
			if(!executeDML($query, $params)) {
				echo "Hiba az adatbevitel során!";
			} header('Location: index.php');
		}
	}
	?>
<form method="post">
		<div class="form-row">
			<div class="form-group col-md-4">
				<label for="postfelhnev">Beceneved:</label>
				<input type="text" class="form-control" name="felh_nev">
			</div>
			<div class="form-group col-md-4">
				<label for="posttema">Poszt témája</label>
				<input type="text" class="form-control" name="tema">
			</div>
		</div>

		<div class="form-row">
			<div class="form-group col-md-12">
				<label for="posttemaszovege">Téma szövege:</label>
				<input type="text" class="form-control" name="tema_szoveg">
			</div>
			<button type="submit" class="btn btn-dark" name="addtema">Új téma hozzáadása</button>
		</div>
</form>
<?php endif; ?>