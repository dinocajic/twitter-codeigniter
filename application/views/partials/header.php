<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<title>Dino Cajic: Twitter API Tutorial</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php echo link_tag('assets/css/stylesheet.css'); ?>
<?php echo link_tag('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'); ?>
<style>
    .mySlides {display: none}

    pre {
        font-family: monospace;
    }
</style>

<?php
if (isset($additional_headers)) {
    echo $additional_headers;
}
?>
<body>

<!-- Navbar -->
<div class="w3-top">
    <div class="w3-bar w3-black w3-card-2">
        <a class="w3-bar-item w3-button w3-padding-large w3-hide-medium w3-hide-large w3-right" href="javascript:void(0)" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
        <a href="<?php echo base_url(); ?>" class="w3-bar-item w3-button w3-padding-large">Home</a>
        <a href="<?php echo base_url(); ?>index.php#getting_started" class="w3-bar-item w3-button w3-padding-large w3-hide-small">Getting Started</a>
        <a href="<?php echo base_url(); ?>index.php#demo" class="w3-bar-item w3-button w3-padding-large w3-hide-small">Demo</a>
        <a href="http://dinocajic.com" class="w3-bar-item w3-button w3-padding-large w3-hide-small">Blog</a>
        <a href="http://dinocajic.xyz" class="w3-bar-item w3-button w3-padding-large w3-hide-small">Profile</a>
    </div>
</div>

<!-- Navbar on small screens -->
<div id="navDemo" class="w3-bar-block w3-black w3-hide w3-hide-large w3-hide-medium w3-top" style="margin-top:46px">
    <a href="<?php echo base_url(); ?>index.php#getting_started" class="w3-bar-item w3-button w3-padding-large">Getting Started</a>
    <a href="<?php echo base_url(); ?>index.php#demo" class="w3-bar-item w3-button w3-padding-large">Demo</a>
    <a href="http://dinocajic.com" class="w3-bar-item w3-button w3-padding-large">Blog</a>
    <a href="http://dinocajic.xyz" class="w3-bar-item w3-button w3-padding-large">Profile</a>
</div>