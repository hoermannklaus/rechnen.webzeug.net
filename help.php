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
    <meta charset="UTF-8">
    <title><?php echo L::helppage_title . " - " . L::appTitle . " - " . L::domain; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
    <?php require_once('./includes/headerIncludes.php'); ?>
  </head>
  <body>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="jumbotron mt-5 text-center">
                    <h1>
                        <?php echo L::helppage_header; ?>
                    </h1>
                    <p>
                        <?php echo L::helppage_introtext; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
  </body>
</html>