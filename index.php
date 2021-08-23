<?php
if(!isset($_COOKIE['lang']) || $_COOKIE['lang'] == 'en') {
  header("Location: en/");
}else{
  header("Location: ar/");
}
?>