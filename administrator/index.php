<?php
//header('Location: login.html');
if(isset($_POST['submit'])){
    var_dump($_POST['djuro']);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
    <script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
						
</head>
<body>
    <form action="index.php" method="post">
    <textarea name="djuro" id="djuro" cols="30" rows="10"></textarea>
    <button name="submit" type="submit">Pošalji</button>
    </form>
</body>
</html>