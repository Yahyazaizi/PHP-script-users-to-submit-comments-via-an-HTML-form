<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    fieldset {
      background: url(jo.jpg);
      color: white;
    }
  </style>
</head>

<body>
  <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
    <fieldset>
      <legend>Details</legend>
      <label for="Name">Name</label><input type="text" name="name" id=""><br>
      <label for="Eamil">Email</label><input type="text" name="email" id=""><br>
      <label for="comantaire">Vos Commentaires:</label><br>
      <textarea name="comm" id="" cols="30" rows="10"></textarea>
      <input type="submit" value="Envoyer" name="Envoyer">
      <input type="submit" value="Afficher" name="Afficher">
      <fieldset>
  </form>

  <?php

  if (isset($_POST["Envoyer"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $commentDate = date("Y-m-d H:i:s");
    

    SaveCommantaire($name, $email, $commentDate);
  } else if (isset($_POST["Afficher"])) {

    affiche5Comments();
  }
  function SaveCommantaire($name, $email, $date)
  {


    $file = fopen("test.txt", "a");
    $commentNumber = count(file("test.txt"));
    $commentNumber++;
    fwrite($file, $commentNumber . "/" . $name . "/" . $email . "/" . $date . PHP_EOL);


    fclose($file);
  }
  function parseCommentLine($line)
  {
    $info = [];

    $number = substr($line, 0, strpos($line, "/"));
    array_push($info, $number);
    $line = str_replace($number . "/", "", $line);


    $name = substr($line, 0, strpos($line, "/"));
    array_push($info, $name);
    $line = str_replace($name . "/", "", $line);

    $email = substr($line, 0, strpos($line, "/"));
    array_push($info, $email);
    $line = str_replace($email . "/", "", $line);

    $date = $line;
    array_push($info, $date);

    return $info;
  }

  function affiche5Comments()
  {
    $file = fopen("test.txt", "r");
    for ($i = 0; $i < count(file("test.txt")); $i++) {
      $get=fgets($file);
      if ($i >= (count(file("test.txt")) - 5)) {
        $CommentaireInfo = parseCommentLine($get);
        echo '  <table border><tr><td>comment Num :' . $CommentaireInfo[0] . '</td><td>comment Name : ' . $CommentaireInfo[1] . ' </td><td> comment Mail :  ' . $CommentaireInfo[2] . '  </td><td> comment Date : ' . $CommentaireInfo[3] . ' </td></tr></table>        ';
      }
    }
    fclose($file);
  }

  ?>
</body>

</html>