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
    <script src="external/sprintf.min.js"></script>
    <script src="assets/js/generator.js"></script>
    <script>
        var langSummary = "<?php echo L::generatorpage_summary; ?>";
        var langConfirm1 = "<?php echo L::generatorpage_confirm_1; ?>";
        var langConfirm2 = "<?php echo L::generatorpage_confirm_2; ?>";
    </script>
  </head>
  <body>
  <?php //require_once('./includes/gtmBody.php'); ?>
    <div class="container-fluid fixed-top bg-secondary">

        <!-- BUTTONS -->
        <div class="row d-print-none pt-3 pb-3">
            <div class="col-6 col-sm-6 col-md-3">
                <a href="#" id="print" class="btn btn-primary w-100">
                    <i class="fa fa-print"></i> <?php echo L::generatorpage_buttons_print; ?>
                </a>
            </div>
            <div class="col-6 col-sm-6 col-md-3">
                <a href="#" id="check1" class="btn btn-danger w-100 check">
                    <i class="fa fa-question-circle"></i> <?php echo L::generatorpage_buttons_check; ?>
                </a>
                <div class="form-check form-check-inline mt-2 ml-2">
                    <input class="form-check-input" type="checkbox" id="showResult" />
                    <label class="form-check-label text-white" for="showResult"><?php echo L::generatorpage_showResults; ?></label>
                </div>
            </div>
            <div class="col-6 col-sm-6 col-md-3">
                <a href="#" id="reload" class="btn btn-success w-100">
                    <i class="fa fa-sync-alt"></i> <?php echo L::generatorpage_buttons_regenerate; ?>
                </a>
            </div>
            <div class="col-6 col-sm-6 col-md-3">
                <a href="index.php" id="back" class="btn btn-info w-100">
                    <i class="fa fa-arrow-circle-left"></i> <?php echo L::generatorpage_buttons_return; ?>
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid mb-5">

        <!-- JUMBOTRON -->
        <div class="row mt-10">
            <div class="col">
                <div class="jumbotron">
                    <h1><?php echo call_user_func('L::calculations_' . $_GET['type']) ?></h1>
                    <p class="lead">
                        <?php echo $subtitle; ?>
                    </p>
                    <p class="lead" id="resultSummary"></p>
                </div>
            </div>
        </div>
        <div class="row">
            <?php 
            $rows = ceil(count($calculations) / $_GET['cols']);
            $lists = array_chunk($calculations, $rows);
            if (isset($_GET['resultMax'])) {
                $width = Utility::calculateWidthOfInput($_GET['resultMax']);
            } else if (isset($_GET['factor1'])) {
                $width = Utility::calculateWidthOfInput($_GET['factor1'] * $_GET['factor2']);
            }
            $counter = 0;

            $calcTemplate = "<div class='calculation' id='calc%d'><form><label>%s</label><input type='number' class='form-control input-result' style='width: %dpx'; data-result='%d'/><i class='fa fa-check fa-2x text-success ml-2' style='display:none;'></i><i class='fa fa-times fa-2x text-danger ml-2' style='display:none;'></i><span class='result ml-2 font-weight-bold' style='display: none;'>%d</span></form></div>";
            foreach ($lists as $column) {
                $cols = 12/$_GET['cols'];
                echo "<div class='col-xs-12 col-sm-6 col-md-" . $cols . "'>";
                foreach ($column as $item) {
                    $counter++;
                    $output = $item->getRenderOutput();
                    $label = Utility::addSpaceForSingleDigit($output['part1']) . " " . $output["operator"] . " " . Utility::addSpaceForSingleDigit($output['part2']) . " = ";
                    echo sprintf($calcTemplate, $counter, $label, intval($width), $output['result'], $output['result']);
                }
                echo "</div>";
            }
            ?>
        </div>
        <div class="row fixed-bottom pt-2 pr-3 pb-2 pl-3 d-print-none" id="progress-row">
            <div class="col">
                <div class="progress" style="height: 25px;">
                    <div class="progress-bar text-dark" id="progressbar" role="progressbar" style="width:0%;" data-valuenow="0" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                </div>
            </div>
        </div>
    </div>
  </body>
</html>