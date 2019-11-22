<?php
require __DIR__ . '/vendor/autoload.php';

use RechnenWebzeugNet\CalcGenerator;
use RechnenWebzeugNet\Utility;

$i18n = new i18n('lang/lang_{LANGUAGE}.json', 'langcache/', 'de');
$i18n->init();

$generator = new CalcGenerator();
$calculations = [];
switch ($_GET['type']) {
    case 'addition':
        $subtitle = ucfirst(sprintf(L::generatorpage_sheetTitle_addition, $_GET['amount'], $_GET['resultMin'], $_GET['resultMax']));
        $calculations = $generator->generateAdditions($_GET['amount'], $_GET['resultMin'], $_GET['resultMax']);
        $favicon = "favicon_addition";
        break;
    case 'subtraction':
        $subtitle = ucfirst(sprintf(L::generatorpage_sheetTitle_subtraction, $_GET['amount'], $_GET['resultMin'], $_GET['resultMax']));
        $calculations = $generator->generateSubtractions($_GET['amount'], $_GET['resultMin'], $_GET['resultMax']);
        $favicon = "favicon_subtraction";
        break;
    case 'multiplication':
        $subtitle = ucfirst(sprintf(L::generatorpage_sheetTitle_multiplication, $_GET['amount'], $_GET['factor1'], $_GET['factor2']));
        $calculations = $generator->generateMultiplications($_GET['amount'], $_GET['factor1'], $_GET['factor2']);
        $favicon = "favicon_multiplication";
        break;
    case 'division':
        $subtitle = ucfirst(sprintf(L::generatorpage_sheetTitle_division, $_GET['amount'], $_GET['factor1'], $_GET['factor2']));
        $calculations = $generator->generateDivisions($_GET['amount'], $_GET['factor1'], $_GET['factor2']);
        $favicon = "favicon_division";
        break;
    case 'mixedequal':
        $subtitle = ucfirst(L::generatorpage_sheetTitle_mixedequal);
        $calculations = $generator->generateMixedEqual($_GET['amount'], $_GET['resultMin'], $_GET['resultMax'], $_GET['factor1'], $_GET['factor2']);
        $favicon = "favicon";
        break;
    default:
        break;
}

?>

<!DOCTYPE html>
<html>
  <head>
    <?php //require_once('./includes/gtmHead.php'); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">

    <!-- Favicons -->
    <link rel="shortcut icon" href="<?php echo $favicon; ?>.ico" type="image/x-icon">
    <link rel="icon" href="<?php echo $favicon; ?>.ico" type="image/x-icon">

    <!-- Meta informationen -->
    <title><?php echo L::appTitle . " - " . L::domain; ?></title>
    <meta name="description" content="<?php echo L::generatorpage_description; ?>">
	<meta name="author" content="Klaus Hörmann-Engl<klaus@webzeug.net>">

    <!-- Header includes -->
    <?php require_once('./includes/headerIncludes.php'); ?>
    <script src="assets/js/generator.js"></script>
  </head>
  <body>
  <?php //require_once('./includes/gtmBody.php'); ?>
    <div class="container-fluid">

        <!-- BUTTONS -->
        <div class="row d-print-none mt-2">
            <div class="col-12 col-sm-6 col-md-5 col-lg-4">
                <a href="#" id="print" class="btn btn-primary mr-5 mb-2 w-100">
                    <i class="fa fa-print"></i> <?php echo L::generatorpage_buttons_print; ?>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-6 col-md-5 col-lg-4">
                <a href="index.php" id="back" class="btn btn-secondary mr-5 mb-2 w-100">
                    <i class="fa fa-arrow-circle-left"></i> <?php echo L::generatorpage_buttons_return; ?>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-6 col-md-5 col-lg-4">
                <a href="#" id="reload" class="btn btn-success mr-5 mb-2 w-100">
                    <i class="fa fa-sync-alt"></i> <?php echo L::generatorpage_buttons_regenerate; ?>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-6 col-md-5 col-lg-4">
                <a href="#" id="check" class="btn btn-danger w-100">
                    <i class="fa fa-question-circle"></i> <?php echo L::generatorpage_buttons_check; ?>
                </a>
            </div>
        </div>

        <!-- JUMBOTRON -->
        <div class="row mt-2">
            <div class="col">
                <div class="jumbotron">
                    <h1><?php echo call_user_func('L::calculations_' . $_GET['type']) ?></h1>
                    <p class="lead">
                        <?php echo $subtitle; ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <?php 
            $rows = ceil(count($calculations) / $_GET['cols']);
            $lists = array_chunk($calculations, $rows);

            $width = Utility::calculateWidthOfInput($_GET['resultMax']);

            $calcTemplate = "<div class='calculation'><form><label>%s</label><input class='form-control' style='width: %dpx'; data-result='%d'/></form></div>";
            foreach ($lists as $column) {
                $cols = 12/$_GET['cols'];
                echo "<div class='col-xs-12 col-sm-6 col-md-" . $cols . "'>";
                foreach ($column as $item) {
                    $output = $item->getRenderOutput();
                    $label = Utility::addSpaceForSingleDigit($output['part1']) . " " . $output["operator"] . " " . Utility::addSpaceForSingleDigit($output['part2']) . " = ";
                    echo sprintf($calcTemplate, $label, intval($width), $output['result']);
                }
                echo "</div>";
            }
            ?>
        </div>
    </div>
  </body>
</html>