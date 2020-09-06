<?php 
	if(isset($_GET["query"]))
		$query = $_GET["query"];
	else
		exit("Empty search");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Searchbay</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>

	<div class="wrapper">

		<div class="header">
			
			<div class="headerContent">
				
				<div class="logoContainer">
					<a href="index.php">
						<img src="assets/images/logo.png">
					</a>
				</div>

				<div class="searchContainer">
					
					<form action="search.php" method="GET">
						
						<div class="searchBarContainer">
							<input class="searchBox" type="text" name="query">
							<button class="searchButton">
								<img src="assets/images/icons/search.png">
							</button>
						</div>

					</form>

				</div>

			</div>

			<div class="tabsContainer">
					
				<ul class="tabList">
					<li>
						<a href='<?php echo "search.php?query=$query&type=web"; ?>'>Web</a>
					</li>
					<li>
						<a href='<?php echo "search.php?query=$query&type=images"; ?>'>Images</a>
					</li>
				</ul>

			</div>

		</div>

	</div>

</body>
</html>