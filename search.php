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
				$pageSize = 20;
				$numResults = $resultsProvider->getNumResults($query);

				echo "<p class='resultsCount'>$numResults results found</p>";

				echo $resultsProvider->getResultsHTML($page, $pageSize, $query);
			?>
		</div>

		<div class="paginationContainer">
			
			<div class="pageButtons">
				
				<div class="pageNumberContainer">
					<img src="assets/images/pageStart.png">
				</div>

				<?php 

					$pagesToShow = 10;
					$numPages = ceil($numResults / $pageSize);
					$pagesLeft = min($pagesToShow, $numPages);

					$currentPage = $page - floor($pagesToShow/2);
					if($currentPage < 1) {
						$currentPage = 1;
					}

					if($currentPage + $pagesLeft > $numPages + 1) {
						$currentPage = $numPages + 1 - $pagesLeft;
					}

					while($pagesLeft != 0 && $currentPage <= $numPages) {

						if($currentPage == $page) {
							echo "<div class='pageNumberContainer'>
								<img src='assets/images/pageSelected.png'>
								<span class='pageNumber'>$currentPage</span>
							</div>";
						}
						else {
							echo "<div class='pageNumberContainer'>
								<a href='search.php?query=$query&type=$type&page=$currentPage'>
									<img src='assets/images/page.png'>
									<span class='pageNumber'>$currentPage</span>
								</a>
							</div>";
						}

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