<?php 
	include("config.php");
	include("classes/siteResultsProvider.php");

	if(isset($_GET["query"])) {
		$query = $_GET["query"];
	}
	else {
		exit("Empty search");
	}

	$type = isset($_GET["type"]) ? $_GET["type"] : "web";
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
							<input class="searchBox" type="text" name="query" value="<?php echo $query; ?>">
							<button class="searchButton">
								<img src="assets/images/icons/search.png">
							</button>
						</div>

					</form>

				</div>

			</div>

			<div class="tabsContainer">
					
				<ul class="tabList">
					<li class="<?php echo $type == 'web' ? 'active' : '' ?>">
						<a href='<?php echo "search.php?query=$query&type=web"; ?>'>Web</a>
					</li>
					<li class="<?php echo $type == 'images' ? 'active' : '' ?>">
						<a href='<?php echo "search.php?query=$query&type=images"; ?>'>Images</a>
					</li>
				</ul>

			</div>

		</div>

		<div class="mainResultsSection">
			<?php 

				$resultsProvider = new siteResultsProvider($con);
				$numResults = $resultsProvider->getNumResults($query);

				echo "<p class='resultsCount'>$numResults results found</p>";

				echo $resultsProvider->getResultsHTML(1, 20, $query);
			?>
		</div>

	</div>

</body>
</html>