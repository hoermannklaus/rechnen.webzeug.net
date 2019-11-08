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
    <title><?php echo L::domain . " - " . L::appTitle; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
    <link rel="stylesheet" href="assets/css/style.css" type="text/css">
    <link rel="stylesheet" href="vendor/twbs/bootstrap/dist/css/bootstrap.css" type="text/css">
    <script src="external/jquery/jquery-3.4.1.min.js"></script>
    <script src="vendor/twbs/bootstrap/dist/js/bootstrap.js"></script>
    <script src="external/fontawesome5/all.js"></script>
  </head>
  <body>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="jumbotron mt-5 text-center">
                    <h1>
                        <?php echo L::startpage_header; ?>
                    </h1>
                    <p>
                        <?php echo L::startpage_introtext; ?>
                    </p>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- ADDITION -->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card bg-primary text-white mb-3">
                    <div class="card-header">
                        <i class="fa fa-plus"></i> <strong><?php echo L::calculations_addition; ?></strong>
                    </div>
                    <div class="card-body">
                        <p class="card-test"><?php echo L::startpage_predefined_addition_introtext; ?></p>
                        <a href="generator.php?type=addition&amount=45&resultMin=10&resultMax=100&cols=3" class="btn btn-secondary">
                            <i class="fa fa-plus text-primary"></i> <?php echo L::createSheet; ?>
                        </a>
                    </div>
                    <div class="card-footer">
                        <small class="text-white"><strong><?php echo L::example; ?>:</strong> 34 + 38 = </small>
                    </div>
                </div>
            </div>

            <!-- SUBTRAKTION -->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card bg-danger text-white mb-3">
                    <div class="card-header">
                        <i class="fa fa-minus"></i> <strong><?php echo L::calculations_subtraction; ?></strong>
                    </div>
                    <div class="card-body">
                        <p class="card-test"><?php echo L::startpage_predefined_subtraction_introtext; ?></p>
                        <a href="generator.php?type=subtraction&amount=45&resultMin=10&resultMax=100&cols=3" class="btn btn-secondary">
                            <i class="fa fa-minus text-danger"></i> <?php echo L::createSheet; ?>
                        </a>
                    </div>
                    <div class="card-footer">
                        <small class="text-white"><strong><?php echo L::example; ?>:</strong> 85 - 27 = </small>
                    </div>
                </div>
            </div>

            <!-- MULTIPLICATION -->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card bg-success text-white mb-3">
                    <div class="card-header">
                        <i class="fa fa-times"></i> <strong><?php echo L::calculations_multiplication; ?></strong>
                    </div>
                    <div class="card-body">
                        <p class="card-test"><?php echo L::startpage_predefined_multiplication_introtext; ?></p>
                        <a href="generator.php?type=multiplication&amount=45&factor1=1&factor2=10&cols=3" class="btn btn-secondary">
                            <i class="fa fa-times text-success"></i> <?php echo L::createSheet; ?>
                        </a>
                    </div>
                    <div class="card-footer">
                        <small class="text-white"><strong><?php echo L::example; ?>:</strong> 7 * 5 = </small>
                    </div>
                </div>
            </div>

            <!-- DIVISION -->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card bg-warning text-white mb-3">
                    <div class="card-header">
                        <i class="fa fa-divide"></i> <strong><?php echo L::calculations_division; ?></strong>
                    </div>
                    <div class="card-body">
                        <p class="card-test"><?php echo L::startpage_predefined_division_introtext; ?></p>
                        <a href="generator.php?type=division&amount=45&factor1=1&factor2=10&cols=3" class="btn btn-secondary">
                            <i class="fa fa-divide text-warning"></i> <?php echo L::createSheet; ?>
                        </a>
                    </div>
                    <div class="card-footer">
                        <small class="text-white"><strong><?php echo L::example; ?>:</strong> 48 : 6 = </small>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="jumbotron text-center">
                    <a class="btn btn-secondary" href="help.php" role="button">
                        <i class="fa fa-question-circle"></i> <?php echo L::startpage_wannKnowMore; ?>
                    </a>
                </div>
            </div>
        </div>
        <?php require_once('./assets/partials/imprint.php'); ?>
    </div>
  </body>
</html>