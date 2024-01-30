<?php
include("Article.php");

$ref=$_GET["ref"];
Article::supprimerArticle($ref);

//retourner à la page "view_article.php" après suppression

header('Location:View_article.php');

?>