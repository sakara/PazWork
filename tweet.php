<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<html lang="en">
<head>

<!-- Basic
================================================== -->
<meta charset="utf-8">
<title>nginZ | Tweet</title>
<meta name="description" content="EngineZ | Tweet">
<meta name="author" content="Zlatan Vasović">
<meta name="keywords" content="zdroid, engine, z, enginez, net, nginz">

<!-- Mobile
================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- CSS
================================================== -->
<link rel="stylesheet" href="styles/styles.css">

<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!-- Favicons
================================================== -->
<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
<link rel="icon" href="img/favicon.ico" type="image/x-icon">
<link rel="apple-touch-icon" href="img/apple-touch-icon.png">
<link rel="apple-touch-icon" sizes="72x72" href="img/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="114x114" href="img/apple-touch-icon-114x114.png">
</head>

<!-- Page
================================================== -->
<body>
<div class="top"><strong>I'm top div class. I generated for notices, but you can use me for everything you want.</strong></div>
<nav><a href="/">Home</a>
<a href="tweet.php">Tweet</a>
<a href="projects.html">Projects</a>
<a href="about.html">About</a></nav>
<h1>Tweet</h1>

<p><strong>My latest tweet</strong></p>
<p><?php
$korisnicko_ime='ZXeDroid';
$format='xml';
$tweet=simplexml_load_file("http://api.twitter.com/1/statuses/user_timeline/{$korisnicko_ime}.{$format}");
echo "<p>";
echo $tweet->status[0]->text;
echo "</p><p><a href='https://twitter.com/ZXeDroid'>https://twitter.com/ZXeDroid</a></p>";
?>
</p>
<p><img src="https://twitter.com/images/resources/twitter-bird-white-on-blue.png" width="200" height="200" alt="Twitter"></p>
<footer>
<p>Created and designed by <a href="http://zdroidblog.info">ZDroid</a> @ 2013</p>
<p>Hosted on <a href="http://localhost">localhost</a></p>
</footer>
</body>
</html>
<!-- End of document
================================================== -->
