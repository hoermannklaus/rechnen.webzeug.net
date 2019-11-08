<?php
require __DIR__ . '/vendor/autoload.php';

use RechnenWebzeugNet\CalcGenerator;

$i18n = new i18n('lang/lang_{LANGUAGE}.json', 'langcache/', 'de');
$i18n->init();

$params = $_GET;
$amount = $params['amount'];
$generator = new CalcGenerator($amount);
$calculations = [];
switch ($params['type']) {
    case 'addition':
        $title = ucfirst(sprintf(L::generatorpage_sheetTitle_addition, $params['resultMin'], $params['resultMax']));
        $calculations = $generator->generateAdditions($params['resultMin'], $params['resultMax']);
        break;
    case 'subtraction':
    $title = ucfirst(sprintf(L::generatorpage_sheetTitle_subtraction, $params['resultMin'], $params['resultMax']));
        $calculations = $generator->generateSubtractions($params['resultMin'], $params['resultMax']);
        break;
    case 'multiplication':
        $title = ucfirst(sprintf(L::generatorpage_sheetTitle_multiplication, $params['factor1'], $params['factor2']));
        $calculations = $generator->generateMultiplications($params['factor1'], $params['factor2']);
        break;
    case 'division':
        $title = ucfirst(L::generatorpage_sheetTitle_division);
        $calculations = $generator->generateDivisions($params['factor1'], $params['factor2']);
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
    <meta charset="UTF-8">
    <title><?php echo L::appTitle; ?> - <?php echo L::generatorpage_title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
    <link rel="stylesheet" href="assets/css/style.css" type="text/css">
    <link rel="stylesheet" href="vendor/twbs/bootstrap/dist/css/bootstrap.css" type="text/css">
    <script src="vendor/components/jquery/jquery.js"></script>
    <script src="vendor/twbs/bootstrap/dist/js/bootstrap.js"></script>
    <script src="external/fontawesome5/all.js"></script>
    <script src="assets/js/generator.js"></script>
  </head>
  <body>
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
                        <?php echo $amount; ?> <?php echo L::calculations_multiple; ?>
                </div>
            </div>
        </div>
        <div class="row">
            <?php 
            $rows = ceil(count($calculations) / $params['cols']);
            $lists = array_chunk($calculations, $rows);
            foreach ($lists as $column) {
                $cols = 12/$params['cols'];
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