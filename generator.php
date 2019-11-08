<?php
require __DIR__ . '/vendor/autoload.php';

use RechnenWebzeugNet\CalcGenerator;

$i18n = new i18n('lang/lang_{LANGUAGE}.json', 'langcache/', 'de');
$i18n->init();

$generator = new CalcGenerator();
$calculations = [];
switch ($_GET['type']) {
    case 'addition':
        $title = ucfirst(sprintf(L::generatorpage_sheetTitle_addition, $_GET['resultMin'], $_GET['resultMax']));
        $calculations = $generator->generateAdditions($_GET['amount'], $_GET['resultMin'], $_GET['resultMax']);
        break;
    case 'subtraction':
    $title = ucfirst(sprintf(L::generatorpage_sheetTitle_subtraction, $_GET['resultMin'], $_GET['resultMax']));
        $calculations = $generator->generateSubtractions($_GET['amount'], $_GET['resultMin'], $_GET['resultMax']);
        break;
    case 'multiplication':
        $title = ucfirst(sprintf(L::generatorpage_sheetTitle_multiplication, $_GET['factor1'], $_GET['factor2']));
        $calculations = $generator->generateMultiplications($_GET['amount'], $_GET['factor1'], $_GET['factor2']);
        break;
    case 'division':
        $title = ucfirst(L::generatorpage_sheetTitle_division);
        $calculations = $generator->generateDivisions($_GET['amount'], $_GET['factor1'], $_GET['factor2']);
        break;
    case 'mixedequal':
        $title = ucfirst(L::generatorpage_sheetTitle_mixedequal);
        $calculations = $generator->generateMixedEqual($_GET['amount'], $_GET['resultMin'], $_GET['resultMax'], $_GET['factor1'], $_GET['factor2']);
        break;
    default:
        break;
}

function addSpaceForSingleDigit(int $number) {
    if ($number < 10) {
        return "<span style='opacity:0;'>0</span>" . $number;
    } else {
        return $number;
    }
}
?>

<!DOCTYPE html>
<html>
  <head>
    <?php require_once('./includes/gtmHead.php'); ?>
    <meta charset="UTF-8">
    <title><?php echo L::appTitle; ?> - <?php echo L::generatorpage_title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
    <?php require_once('./includes/headerIncludes.php'); ?>
  </head>
  <body>
  <?php require_once('./includes/gtmBody.php'); ?>
    <div class="container-fluid">
        <div class="row d-print-none mt-5">
            <div class="col">
                <p>
                    <a href="#" id="print" class="btn btn-primary">
                        <i class="fa fa-print"></i> <?php echo L::generatorpage_buttons_print; ?>
                    </a>
                </p>
                <p>
                    <a href="index.php" class="btn btn-secondary">
                        <i class="fa fa-arrow-circle-left"></i> <?php echo L::generatorpage_buttons_return; ?>
                    </a>
                </p>
                <p>
                    <a href="#" id="reload" class="btn btn-success">
                        <i class="fa fa-sync-alt"></i> <?php echo L::generatorpage_buttons_regenerate; ?>
                    </a>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="jumbotron mt-5">
                    <h1><?php echo $title; ?></h1>
                    <p class="lead">
                        <?php echo $_GET['amount']; ?> <?php echo L::calculations_multiple; ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <?php 
            $rows = ceil(count($calculations) / $_GET['cols']);
            $lists = array_chunk($calculations, $rows);
            foreach ($lists as $column) {
                $cols = 12/$_GET['cols'];
                echo "<div class='col-xs-12 col-sm-6 col-md-" . $cols . "'>";
                foreach ($column as $item) {
                    $output = $item->getRenderOutput();
                    echo 
                        "<div>" . 
                        "<p class='h2'>" . 
                        addSpaceForSingleDigit($output['part1']) . 
                        " " . 
                        $output['operator'] . 
                        " " . 
                        addSpaceForSingleDigit($output['part2']) . 
                        " = <span class='result'/>" . 
                        "</p>" .
                        "</div>";
                }
                echo "</div>";
            }
            ?>
        </div>
    </div>
  </body>
</html>