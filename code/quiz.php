<?php

//function divizori_proprii($numar) {
//
//    $divizori = array();
//    for($d=2;$d*$d <= $numar; $d++) {
//        if ($numar % $d == 0) {
//            $divizori[count($divizori)] = $d;
//            if($numar / $d  > $d) {
//                $divizori[count($divizori)] = floor($numar / $d);
//            }
//        }
//    }
//
//    sort($divizori);
//    return $divizori;
//}
//
//
//$a = 30;
//$b = 50;
//
//for($i=$a; $i<=$b; $i++) {
//
//    echo "Divizorii proprii ai lui $i sunt : ";
//
//    $div_proprii = divizori_proprii($i);
//
//    foreach ($div_proprii as $div) {
//    echo $div . " ";
//    }
//    echo " Numarul total de divizori proprii fiind " . count($div_proprii);
//
//    echo "<br />";
//
//}
//
//
//$div_prop =  divizori_proprii(30);
//
//
//foreach ($div_prop as $div) {
//    echo $div . " ";
//}



$hostname='database';
$user = 'root';
$password = '1234';
$database = 'liviu_db';
$port = 3306;
$connection = new mysqli($hostname, $user, $password, $database, $port);



//$QUERY_OPTIONS = [
//        "SELECT_QUIZZES_RANDOMLY" => false,
//        "SELECT_QUESTIONS_RANDOMLY" => true,
//        "SELECT_ANSWERS_RANDOMLY" => true
//];


if ($connection->connect_error) {
    die('Connect Error (' . $connection->connect_errno . ') ' . $connection->connect_error);
}

$quizzes = mysqli_query($connection,"SELECT * from quiz")->fetch_all(MYSQLI_ASSOC);

function getQuizQuestions($connection, $quizId) {

    $questions = mysqli_query(
            $connection,
            "SELECT * FROM question WHERE id_quiz=$quizId ORDER BY RAND()"
    )->fetch_all(MYSQLI_ASSOC);


    //Pentru fiecare intrebare vom avea nevoie si de variantele de raspuns
    //Pentru simplitate le vom stoca tot in array-ul de quiz-uri, creand in array-ul asociativ un
    // nou camp answer_options, care va fi un array indexant de contine toate var de raspuns


    for($i=0;$i<count($questions);$i++) {

        $questionId = $questions[$i]["id"];
        $answer_options = mysqli_query(
                $connection,
                "SELECT * FROM answer_option WHERE id_question=$questionId ORDER BY RAND()"
        )->fetch_all(MYSQLI_ASSOC);
        $questions[$i]["answer_options"] = $answer_options;
    }
    return $questions;

}

?>

<html>

  <head>
    <title> Quiz app </title>
    <link rel="stylesheet" href="stylesheets/quiz.css" />
  </head>

  <body>
      <?php
        if(!isset($_GET["id"])) {
            ?>
            <div id="main">
                <p class="welcome_message">Salut, iata cateva quiz-uri interesante pregatite pentru tine</p>
                <div class="grid">
                    <div class="row">
                        <?php
                            foreach($quizzes as $current_quiz) {
                                $current_id = $current_quiz["id"];
                                ?>
                                <div class="quiz_card col">
                                    <h3 class="quiz_title">
                                        <?php echo $current_quiz["description"] ?>
                                    </h3>
                                    <p class="quiz_topic">
                                        <?php echo $current_quiz["topic"] ?>
                                    </p>
                                    <a href=<?php echo "quiz.php?id=".$current_id?>>Rezolva quiz</a>
                                </div>
                                <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
            <?php
        }

        else {
            ?>
                <p>Acum vezi quiz-ul <?php echo $_GET["id"] ?></p>
                <?php
                    $questions = getQuizQuestions($connection, $_GET["id"]);
                    foreach($questions as $current_question) {
                        $answer_options = $current_question["answer_options"];
                        ?>
                        <div class="question_container">
                            <h4 class="question_title">
                                <?php echo $current_question["text"] ?>
                            </h4>

                            <div class="answer_options_container">
                                <?php
                                    foreach($answer_options as $j=>$answer_option) {
                                        ?>

                                            <div class="answer_option">
                                                <p><?php echo chr(ord('A')+$j) . "." . $answer_option["text"] ?></p>
                                            </div>

                                        <?php
                                    }
                                ?>
                            </div>

                        </div>
                        <?php
                    }
                ?>
            <?php
        }
      ?>
  </body>
</html>