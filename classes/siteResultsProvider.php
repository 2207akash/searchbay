<?php 

class SiteResultsProvider {

	private $con;

	public function __construct($con) {
		$this->con = $con;
	}

	public function getNumResults($query) {

		$q = $this->con->prepare("SELECT COUNT(*) AS total FROM sites WHERE title LIKE :query OR url LIKE :query OR keywords LIKE :query OR description LIKE :query");

		$searchTerm = "%" . $query . "%";
		$q->bindParam(":query", $searchTerm);
		$q->execute();

		$row = $q->fetch(PDO::FETCH_ASSOC);
		return $row["total"];

	}

	public function getResultsHTML($page, $pageSize, $query) {

		$q = $this->con->prepare("SELECT * FROM sites WHERE title LIKE :query OR url LIKE :query OR keywords LIKE :query OR description LIKE :query ORDER BY clicks DESC");

		$searchTerm = "%" . $query . "%";
		$q->bindParam(":query", $searchTerm);
		$q->execute();

		$resultsHTML = "<div class='siteResults'>";

		while($row = $q->fetch(PDO::FETCH_ASSOC)) {
			$id = $row["id"];
			$url = $row["url"];
			$title = $row["title"];
			$description = $row["description"];

			$resultsHTML .= "<div class='resultsContainer'>

								<h3 class='title'>
									<a class='result' href='$url'>
										$title
									</a>
								</h3>

								<span class='url'>$url</span>
								<span class='description'>$description</span>

							</div>";
		}

		$resultsHTML .= "</div>";

		return $resultsHTML;
	}

}

?>