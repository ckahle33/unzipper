<?php 

// $unzip = $_POST['unzip'];
$zip = new ZipArchive;
$files = scandir(getcwd());
$key = array_search('.zip', $files);

if (isset($_REQUEST['unzip'])) {
	
	$messages = [];
	
	foreach ($files as $file) {
		if (pathinfo($file, PATHINFO_EXTENSION) == 'zip') {
			$res = $zip->open($file);
			if ($res === TRUE) {
				$zip->extractTo(getcwd());
				$zip->close();
				array_push($messages, $file);
			} 
		} 
	}
}

?>


<html>
	<head>
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
	</head>
	<body>

		<div class="container">
			<div class="col-sm-6 col-sm-offset-3">
				<h2>unzipper...</h2>
				<p>place files you want to unzip in the zipper directory</p>
			<form action=""  method="POST">
				<button type="submit" name="unzip" value="unzip" class="btn btn-default">Unzip!!!</button>
			</form>		
			<ul style="margin-left: 0; padding-left: 0; list-style-type: none;">	
				<?php 
				if (isset($messages) && !empty($messages)) {
					foreach ($messages as $key => $message) {
						echo "<li class='alert alert-success'>" . $message . " successfully unzipped" . "</li>"; 
					} 	
				}	elseif (isset($messages) && empty($messages)) {
					echo "<li class='alert alert-danger'>" . 'No zip files found!' . "</li>"; 
				}?>
			</ul>
			</div>
		</div>

	</body>
</html>