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
	$page = isset($_GET["page"]) ? $_GET["page"] : 1;
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
				$pageLimit = 20;
				$numResults = $resultsProvider->getNumResults($query);

				echo "<p class='resultsCount'>$numResults results found</p>";

				echo $resultsProvider->getResultsHTML($page, $pageLimit, $query);
			?>
		</div>

		<div class="paginationContainer">
			
			<div class="pageButtons">
				
				<div class="pageNumberContainer">
					<img src="assets/images/pageStart.png">
				</div>

				<?php 

					$currentPage = 1;
					$pagesLeft = 10;

					while($pagesLeft != 0) {
						echo "<div class='pageNumberContainer'>
								<img src='assets/images/page.png'>
								<span class='pageNumber'>$currentPage</span>
							</div>";

						$currentPage++;
						$pagesLeft--;
					}

				?>

				<div class="pageNumberContainer">
					<img src="assets/images/pageEnd.png">
				</div>

			</div>

		</div>

	</div>

</body>
</html>