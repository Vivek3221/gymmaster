<!DOCTYPE html>
<html lang="en">
<head>
<title>Student's Siteaa</title>
<meta charset="utf-8">

 <?= $this->Html->css('reset.css') ?>
 <?= $this->Html->css('style.css') ?>
 <?= $this->Html->script('jquery-1.4.2.min.js') ?>
 <?= $this->Html->script('cufon-yui.js') ?>
<?= $this->Html->script('cufon-replace.js') ?>
<?= $this->Html->script('Myriad_Pro_300.font.js') ?>
 <?= $this->Html->script('Myriad_Pro_400.font.js') ?>
<?= $this->Html->script('script.js') ?>
<!--[if lt IE 7]>
<link rel="stylesheet" href="css/ie6.css" type="text/css" media="screen">
<script type="text/javascript" src="js/ie_png.js"></script>
<script type="text/javascript">ie_png.fix('.png, footer, header nav ul li a, .nav-bg, .list li img');</script>
<![endif]-->
<!--[if lt IE 9]><script type="text/javascript" src="js/html5.js"></script><![endif]-->
</head>
<body id="page1">
<!-- START PAGE SOURCE -->
<div class="wrap">
  <header>
    <div class="container">
      <h1><a href="#">Student's sitaae</a></h1>
      <nav>
        <ul>
          <li class="current"><a href="index.html" class="m1">Home Page</a></li>
          <li><a href="about-us.html" class="m2">About Us</a></li>
          <li><a href="articles.html" class="m3">Our Articles</a></li>
          <li><a href="contact-us.html" class="m4">Contact Us</a></li>
          <li class="last"><a href="sitemap.html" class="m5">Sitemap</a></li>
        </ul>
      </nav>
      <form action="#" id="search-form">
        <fieldset>
          <div class="rowElem">
            <input type="text">
            <a href="#">Search</a></div>
        </fieldset>
      </form>
    </div>
  </header>
    
     <?= $this->Flash->render() ?>
    <div class="container clearfix">
        <?= $this->fetch('content') ?>
        <?= $this->element('footer') ?>
    </div>
   
    
<script type="text/javascript"> Cufon.now(); </script>
</body>
</html>