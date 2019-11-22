<?php
require __DIR__ . '/vendor/autoload.php';

$i18n = new i18n('lang/lang_{LANGUAGE}.json', 'langcache/', 'de');
$i18n->init();

$version = RechnenWebzeugNet\ApplicationVersion::get();
$language = $i18n->getAppliedLang();

?>

<!DOCTYPE html>
<html>
  <head>
    <?php require_once('./includes/gtmHead.php'); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Meta information -->
    <title><?php echo L::imprint . " - " . L::domain; ?></title>
    <meta name="description" content="<?php echo L::startpage_description; ?>">
	<meta name="author" content="Klaus Hörmann-Engl<klaus@webzeug.net>">

    <!-- Header includes -->
    <?php require_once('./includes/headerIncludes.php'); ?>
  </head>
  <body>
    <?php require_once('./includes/gtmBody.php'); ?>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="jumbotron mt-5 text-center">
                    <h1>
                        <?php echo L::imprintpage_title; ?>
                    </h1>
                    
                </div>
            </div>
        </div>

        <?php //require_once('./includes/navbar.php'); ?>

        <?php require_once('./includes/footer.php'); ?>
    </div>
  </body>
</html>