<?php 

$zip = new ZipArchive;
$files = scandir(getcwd());
$key = array_search('.zip', $files);

if (isset($_POST['unzip_path'])) {

  echo $_POST['unzip_path'];

  if (!empty($_POST["unzip_path"])) {
    $unzip_path = $_POST["unzip_path"];
  } else {
    $unzip_path = getcwd();
  }
	
	$messages = [];
	
	foreach ($files as $file) {
		if (pathinfo($file, PATHINFO_EXTENSION) == 'zip') {
			$res = $zip->open($file);
			if ($res === TRUE) {
				$zip->extractTo($unzip_path);
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
    <style type="text/css">
      html {
        tab-size: 2;
        -moz-tab-size: 2;
      } 
    </style>
		<div class="container">
			<div class="col-sm-6 col-sm-offset-3">
	       			
      <img src="logo.png" style="margin-top: -10px; margin-left: -5px;"></img>
        <h2>unzipper</h2>
				<p>place files you want to unzip in the unzipper directory. large files may take a while.</p>
			<form action=""  method="POST">
          <div class="form-group">
            <label for="unzip_path ">unzip path</label>
            <input type="text" class="form-control" id="unzip_path" name="unzip_path" placeholder="unzips in the cwd if empty">
          </div>

				<button type="submit" name="unzip" value="unzip" class="btn btn-default">cue the bass</button>
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
