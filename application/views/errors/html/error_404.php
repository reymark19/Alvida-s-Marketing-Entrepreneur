<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>404 Page Not Found</title>
<style type="text/css">
body {
  display: inline-block;
  background: #00AFF9 url(https://cbwconline.com/IMG/Codepen/Unplugged.png) center/cover no-repeat;
  height: 100vh;
  margin: 0;
  color: white;
}

h1 {
  margin: .8em 3rem;
  font: 4em Roboto;
  font-family: roboto;
}

p {
  display: inline-block;
  margin: .2em 3rem;
  font: 2em Roboto;
}
</style>
</head>
<body>
	<h1>Whoops!</h1>
	<p>Something went wrong</p>
</body>
</html>

<script>
console.log('Heading: <?php echo $heading; ?>');
console.log('Message: <?php echo $message; ?>');
</script>