<?php
require __DIR__ . '/vendor/autoload.php';

$i18n = new i18n('lang/lang_{LANGUAGE}.json', 'langcache/', 'de');
$i18n->init();

$version = RechnenWebzeugNet\ApplicationVersion::get();
$language = $i18n->getAppliedLang();

$inputElements = [
    'addition-amount'    => '<input type="number" min="1" max="100" class="form-control width-60" id="addition-amount" name="addition-amount" value="45" required>',
    'addition-resultMin' => '<input type="number" min="1" max="10000" class="form-control width-75" id="addition-resultMin" name="addition-resultMin" value="10" required>',
    'addition-resultMax' => '<input type="number" min="1" max="10000" class="form-control width-75" id="addition-resultMax" name="addition-resultMax" value="100" required>',

    'subtraction-amount'    => '<input type="number" min="1" max="100" class="form-control width-60" id="subtraction-amount" name="subtraction-amount" value="45" required>',
    'subtraction-resultMin' => '<input type="number" min="1" max="10000" class="form-control width-75" id="subtraction-resultMin" name="subtraction-resultMin" value="10" required>',
    'subtraction-resultMax' => '<input type="number" min="1" max="10000" class="form-control width-75" id="subtraction-resultMax" name="subtraction-resultMax" value="100" required>',

    'multiplication-amount'    => '<input type="number" min="1" max="100" class="form-control width-60" id="multiplication-amount" name="multiplication-amount" value="45" required>',
    'multiplication-factor1'   => '<input type="number" min="1" max="10000" class="form-control width-75" id="multiplication-factor1" name="multiplication-factor1" value="1" required>',
    'multiplication-factor2'   => '<input type="number" min="1" max="10000" class="form-control width-75" id="multiplication-factor2" name="multiplication-factor2" value="10" required>',

    'division-amount'    => '<input type="number" min="1" max="100" class="form-control width-60" id="division-amount" name="division-amount" value="45" required>',
    'division-factor1'   => '<input type="number" min="1" max="10000" class="form-control width-75" id="division-factor1" name="division-factor1" value="1" required>',
    'division-factor2'   => '<input type="number" min="1" max="10000" class="form-control width-75" id="division-factor2" name="division-factor2" value="10" required>',

    'mixed-amount'   => '<input type="number" min="1" max="10000" class="form-control width-75" id="mixed-amount" name="mixed-amount" value="45" required>',
];

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
    <title><?php echo L::appTitle . " - " . L::domain; ?></title>
    <meta name="description" content="<?php echo L::startpage_description; ?>">
	<meta name="author" content="Klaus Hörmann-Engl<klaus@webzeug.net>">

    <!-- Header includes -->
    <?php require_once('./includes/headerIncludes.php'); ?>
    <script src="assets/js/index.js"></script>
  </head>
  <body>
    <?php require_once('./includes/gtmBody.php'); ?>
    <div class="container">
        <div class="row mb-4">
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
        <div class="row mb-3">
            <!-- ADDITION -->
            <div class="col-12 col-md-6 col-lg-3 mb-3">
                <form action="generator.php" class="form-inline form-predefined addition">
                    <div class="card bg-primary text-white mb-3">
                        <div class="card-header">
                            <i class="fa fa-plus"></i> <strong><?php echo L::calculations_addition; ?></strong>
                        </div>
                        <div class="card-body">
                            <p class="card-test text-justify">
                                <?php echo sprintf(
                                    L::startpage_predefined_addition_introtext,
                                    $inputElements['addition-amount'],
                                    $inputElements['addition-resultMin'],
                                    $inputElements['addition-resultMax']
                                ); ?>
                            </p>
                            <input type="hidden" id="addition-type" name="addition-type" value="addition">
                            <input type="hidden" id="addition-cols" name="addition-cols" value="3">
                            <button type="submit" id="btn_addition" class="btn btn-secondary w-100">
                                <i class="fa fa-plus text-primary"></i> <?php echo L::createSheet; ?>
                            </button>
                        </div>
                        <div class="card-footer" style="display: none;">
                            <small class="text-white">
                                <i class="fa fa-trash-alt"></i>&nbsp;
                                <a href="#" class="text-white delete-localStorage" data-toggle="tooltip" data-placement="bottom" title="<?php echo L::deleteCookieInfo; ?>"><?php echo L::resetToDefault; ?></a>
                            </small>
                        </div>
                    </div>
                </form>
            </div>

            <!-- SUBTRAKTION -->
            <div class="col-12 col-md-6 col-lg-3 mb-3">
                <form action="generator.php" class="form-inline form-predefined subtraction">
                    <div class="card bg-danger text-white mb-3">
                        <div class="card-header">
                            <i class="fa fa-minus"></i> <strong><?php echo L::calculations_subtraction; ?></strong>
                        </div>
                        <div class="card-body">
                            <p class="card-test text-justify">
                                <?php echo sprintf(
                                    L::startpage_predefined_subtraction_introtext,
                                    $inputElements['subtraction-amount'],
                                    $inputElements['subtraction-resultMin'],
                                    $inputElements['subtraction-resultMax']
                                ); ?>
                            </p>
                            <input type="hidden" id="subtraction-type" name="subtraction-type" value="subtraction">
                            <input type="hidden" id="subtraction-cols" name="subtraction-cols" value="3">
                            <button type="submit" id="btn_subtraction" class="btn btn-secondary w-100">
                                <i class="fa fa-minus text-danger"></i> <?php echo L::createSheet; ?>
                            </button>
                        </div>
                        <div class="card-footer" style="display: none;">
                            <small class="text-white">
                                <i class="fa fa-trash-alt"></i>&nbsp;
                                <a href="#" class="text-white delete-localStorage" data-toggle="tooltip" data-placement="bottom" title="<?php echo L::deleteCookieInfo; ?>"><?php echo L::resetToDefault; ?></a>
                            </small>
                        </div>
                    </div>
                </form>
            </div>

            <!-- MULTIPLICATION -->
            <div class="col-12 col-md-6 col-lg-3 mb-3">
                <form action="generator.php" class="form-inline form-predefined multiplication">
                    <div class="card bg-success text-white mb-3">
                        <div class="card-header">
                            <i class="fa fa-times"></i> <strong><?php echo L::calculations_multiplication; ?></strong>
                        </div>
                        <div class="card-body">
                            <p class="card-test text-justify">
                                <?php echo sprintf(
                                    L::startpage_predefined_multiplication_introtext,
                                    $inputElements['multiplication-amount'],
                                    $inputElements['multiplication-factor1'],
                                    $inputElements['multiplication-factor2']
                                ); ?>
                            </p>
                            <input type="hidden" id="multiplication-type" name="multiplication-type" value="multiplication">
                            <input type="hidden" id="multiplication-cols" name="multiplication-cols" value="3">
                            <button type="submit" id="btn_multiplication" class="btn btn-secondary w-100">
                                <i class="fa fa-times text-success"></i> <?php echo L::createSheet; ?>
                            </button>
                        </div>
                        <div class="card-footer" style="display: none;">
                            <small class="text-white">
                                <i class="fa fa-trash-alt"></i>&nbsp;
                                <a href="#" class="text-white delete-localStorage" data-toggle="tooltip" data-placement="bottom" title="<?php echo L::deleteCookieInfo; ?>"><?php echo L::resetToDefault; ?></a>
                            </small>
                        </div>
                    </div>
                </form>
            </div>

            <!-- DIVISION -->
            <div class="col-12 col-md-6 col-lg-3">
                <form action="generator.php" class="form-inline form-predefined division">
                    <div class="card bg-warning text-white mb-3">
                        <div class="card-header">
                            <i class="fa fa-divide"></i> <strong><?php echo L::calculations_division; ?></strong>
                        </div>
                        <div class="card-body">
                            <p class="card-test text-justify">
                            <?php echo sprintf(
                                L::startpage_predefined_division_introtext,
                                $inputElements['division-amount'],
                                $inputElements['division-factor1'],
                                $inputElements['division-factor2']
                            ); ?>
                            </p>
                            <input type="hidden" id="division-type" name="division-type" value="division">
                            <input type="hidden" id="division-cols" name="division-cols" value="3">
                            <button type="submit" id="btn_division" class="btn btn-secondary w-100">
                                <i class="fa fa-divide text-warning"></i> <?php echo L::createSheet; ?>
                            </button>
                        </div>
                        <div class="card-footer" style="display: none;">
                            <small class="text-white">
                                <i class="fa fa-trash-alt"></i>&nbsp;
                                <a href="#" class="text-white delete-localStorage" data-toggle="tooltip" data-placement="bottom" title="<?php echo L::deleteCookieInfo; ?>"><?php echo L::resetToDefault; ?></a>
                            </small>
                        </div>
                    </div>
                </form>
            </div>

            <!-- MIXED -->
            <div class="col-12 col-md-6 col-lg-3">
                <form action="generator.php" class="form-predefined mixed">
                    <div class="card bg-info text-white mb-3">
                        <div class="card-header">
                            <i class="fas fa-blender"></i> <strong><?php echo L::calculations_mixed; ?></strong>
                        </div>
                        <div class="card-body ml-3">
                            <p class="card-test text-justify">
                                <?php echo sprintf(
                                    L::startpage_predefined_mixed_introtext,
                                    $inputElements['mixed-amount']
                                ); ?>
                                <br><br>
                                <input class="form-check-input" type="checkbox" value="addition-yes" id="mixed-addition" name="mixed-addition"><label class="form-check-label" for="mixedAddition"><?php echo L::calculations_addition; ?></label><br>
                                <input class="form-check-input" type="checkbox" value="subtraction-yes" id="mixed-subtraction" name="mixed-subtraction"><label class="form-check-label" for="mixedSubtraction"><?php echo L::calculations_subtraction; ?></label><br>
                                <input class="form-check-input" type="checkbox" value="multiplication-yes" id="mixed-multiplication" name="mixed-multiplication"><label class="form-check-label" for="mixedMultiplication"><?php echo L::calculations_multiplication; ?></label><br>
                                <input class="form-check-input" type="checkbox" value="division-yes" id="mixed-division" name="mixed-division"><label class="form-check-label" for="mixedDivision"><?php echo L::calculations_division; ?></label>
                            </p>
                            <input type="hidden" id="mixed-type" name="mixed-type" value="mixed">
                            <input type="hidden" id="mixed-cols" name="mixed-cols" value="3">
                            <!-- Addition -->
                            <input type="hidden" id="addition-resultMin" name="addition-resultMin" />
                            <input type="hidden" id="addition-resultMax" name="addition-resultMax" />
                            <!-- Subtraction -->
                            <input type="hidden" id="subtraction-resultMin" name="subtraction-resultMin" />
                            <input type="hidden" id="subtraction-resultMax" name="subtraction-resultMax" />
                            <!-- Multiplication -->
                            <input type="hidden" id="multiplication-factor1" name="multiplication-factor1" />
                            <input type="hidden" id="multiplication-factor2" name="multiplication-factor2" />
                            <!-- Division -->
                            <input type="hidden" id="division-factor1" name="division-factor1" />
                            <input type="hidden" id="division-factor2" name="division-factor2" />
                            <button type="submit" id="btn_mixed" class="btn btn-secondary w-1000">
                                <i class="fas fa-blender text-info"></i> <?php echo L::createSheet; ?>
                            </button>
                        </div>
                        <div class="card-footer" style="display: none;">
                            <small class="text-white">
                                <i class="fa fa-trash-alt"></i>&nbsp;
                                <a href="#" class="text-white delete-localStorage" data-toggle="tooltip" data-placement="bottom" title="<?php echo L::deleteCookieInfo; ?>"><?php echo L::resetToDefault; ?></a>
                            </small>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="jumbotron text-center">
                    <a class="btn btn-secondary" href="faq.php" role="button">
                        <i class="fa fa-question-circle"></i> <?php echo L::startpage_wannKnowMore; ?>
                    </a>
                </div>
            </div>
        </div>
        <?php require_once('./includes/footer.php'); ?>
    </div>
  </body>
</html>