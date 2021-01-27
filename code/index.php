<!DOCTYPE html>
<html lang="ro">
	<head>
		<title>Liviu's Awesome Web Page</title>
		<link rel="stylesheet" href="stylesheets/main.css" />
	</head>
	<body>
		<div id="main">

				<img id="logo_image" src="res/img/web_logo.png" height="150px" width="150px" alt="" />
					<p class="paragraph">Hello :)</p>
					<p class="paragraph">Aceasta este o aplicatie web gazduita pe un server Apache pe care ruleaza PHP</p>
					<p class="paragraph">Iata cateva lucruri interesante</p>
				<div class="grid">
					<div class="row">
						<div id="quote_app_button" class="col" style="background-color: #28a745;">
							<p>Citate</p>

							<span style="font-size: 12px; margin: 10px">
								Aplicatia afiseaza cate un citat motivational care iti poate face ziua mai buna decat era inainte sa dai click.
								Citatul este ales aleator dintr-o baza de date ce contine mai multe citate
							</span>
						</div>
						<div id="db_app_button" class="col" style="background-color: #28a745;">
							    Gestionare BD
								<span style="font-size: 12px; margin: 10px">
									Aplicatia permite vizualizarea datelor dintr-o baza de date si permite interogarea
									acesteia prin executarea unor interogari SQL. Puteti privi aceasta aplicatie ca pe un
                                    mic PhpMyAdmin(mult mai smecher, desi PhpMyAdmin are ceva mai multe feature-uri)
								</span>
						</div>
                        <div id="quiz_app_button" class="col" style="background-color: #28a745;">
                            <p>Quiz</p>

                            <span style="font-size: 12px; margin: 10px">
								Aplicatia contine un quiz cu cateva intrebari de tip "grila".Fiecare intrebare are mai multe variante de raspuns,
								dintre care una singura este corecta
							</span>
                        </div>
					</div>
				</div>
		</div>
        <script src="js/index.js"></script>
	</body>
</html>

