<?php

$quote = "";
$author = "";

$hostname='database';
$user = 'root';
$password = '1234';
$database = 'liviu_db';
$port = 3306;
$connection = new mysqli($hostname, $user, $password, $database, $port);

if ($connection->connect_error) {
    die('Connect Error (' . $connection->connect_errno . ') ' . $connection->connect_error);
}

$sql_query = "SELECT text,author FROM quotes ORDER BY RAND() LIMIT 1";
$query_result = $connection->query($sql_query);

if($query_result->num_rows > 0) {
	while($row = $query_result->fetch_assoc()) {
		$quote = $row["text"];
		$author = $row["author"];
	}
}

$connection->close();

?>
    <html>
        <head>
            <title>Quote App</title>
            <link rel ="stylesheet" href="stylesheets/quote.css" />
        </head>
		<body>
			<div id="main">
					<p class="paragraph">Quote Of The Day</p>
					<div class="grid" style="margin: 100px;">
						<div class="row" style="justify-content:center; padding: 20px 0px;">
							<div class="col" style="font-size: 40px; border-radius: 10px; margin: 0px 10px 0px 10px;">
							“<?php echo "$quote" ?>“
                                <br /> - <br />
                            <?php echo ($author == "" ? "No author": $author) ?>
							</div>
						</div>
					</div>
					<div class="grid" style="justify-content:center; align-items:center;">
						<button onclick="window.location.reload();">Show me another quote</button>
					</div>
			</div>
		</body>
	</html>
<?php