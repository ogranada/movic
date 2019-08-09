<?PHP
$render = function($data) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Index</title>
</head>
<body>
  <p>
    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illo alias mollitia porro,
  </p>
  <p>
    sint officia illum! Voluptate praesentium molestias dolorem enim atque ipsam maxime deleniti! Nobis nam harum qui laudantium delectus?
  </p>
  <p>
    <?php print_r($data) ?>
  </p>
</body>
</html>

<?PHP
};
return $render;
?>