<?php
ob_start();
?>

<p>URL inexistant</p>

<?php
$titre = "Page Introuvable";
$titre_secondaire = "Page Introuvable";
$content = ob_get_clean();
require "view/template.php";
?>