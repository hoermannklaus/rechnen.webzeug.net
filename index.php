<?php
require __DIR__ . '/vendor/autoload.php';

$i18n = new i18n('lang/lang_{LANGUAGE}.json', 'langcache/', 'de');
$i18n->init();

$version = RechnenWebzeugNet\ApplicationVersion::get();
$language = $i18n->getAppliedLang();

$inputElements = [
    'amount'    => '<input type="number" min="1" max="100" class="form-control width-60" id="amount" name="amount" value="45" required>',
    'minResult' => '<input type="number" min="1" max="10000" class="form-control width-75" id="resultMin" name="resultMin" value="10" required>',
    'maxResult' => '<input type="number" min="1" max="10000" class="form-control width-75" id="resultMax" name="resultMax" value="100" required>',
    'factor1'   => '<input type="number" min="1" max="10000" class="form-control width-75" id="factor1" name="factor1" value="1" required>',
    'factor2'   => '<input type="number" min="1" max="10000" class="form-control width-75" id="factor2" name="factor2" value="10" required>',
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
                <form action="generator.php" class="form-inline form-predefined addition" data-cookiename="addition">
                    <div class="card bg-primary text-white mb-3">
                        <div class="card-header">
                            <i class="fa fa-plus"></i> <strong><?php echo L::calculations_addition; ?></strong>
                        </div>
                        <div class="card-body">
                            <p class="card-test text-justify">
                                <?php echo sprintf(L::startpage_predefined_addition_introtext, $inputElements['amount'], $inputElements['minResult'], $inputElements['maxResult']); ?>
                            </p>
                            <input type="hidden" id="type" name="type" value="addition">
                            <input type="hidden" id="cols" name="cols" value="3">
                            <button type="submit" id="btn_addition" class="btn btn-secondary w-100">
                                <i class="fa fa-plus text-primary"></i> <?php echo L::createSheet; ?>
                            </button>
                        </div>
                        <div class="card-footer" style="display: none;">
                            <small class="text-white">
                                <i class="fa fa-trash-alt"></i>&nbsp;
                                <a href="#" class="text-white delete-cookie" data-toggle="tooltip" data-placement="bottom" title="<?php echo L::deleteCookieInfo; ?>"><?php echo L::resetToDefault; ?></a>
                            </small>
                        </div>
                    </div>
                </form>
            </div>

            <!-- SUBTRAKTION -->
            <div class="col-12 col-md-6 col-lg-3 mb-3">
                <form action="generator.php" class="form-inline form-predefined subtraction" data-cookiename="subtraction">
                    <div class="card bg-danger text-white mb-3">
                        <div class="card-header">
                            <i class="fa fa-minus"></i> <strong><?php echo L::calculations_subtraction; ?></strong>
                        </div>
                        <div class="card-body">
                            <p class="card-test text-justify">
                                <?php echo sprintf(L::startpage_predefined_subtraction_introtext, $inputElements['amount'], $inputElements['minResult'], $inputElements['maxResult']); ?>
                            </p>
                            <input type="hidden" id="type" name="type" value="subtraction">
                            <input type="hidden" id="cols" name="cols" value="3">
                            <button type="submit" id="btn_subtraction" class="btn btn-secondary w-100">
                                <i class="fa fa-minus text-danger"></i> <?php echo L::createSheet; ?>
                            </button>
                        </div>
                        <div class="card-footer" style="display: none;">
                            <small class="text-white">
                                <i class="fa fa-trash-alt"></i>&nbsp;
                                <a href="#" class="text-white delete-cookie" data-toggle="tooltip" data-placement="bottom" title="<?php echo L::deleteCookieInfo; ?>"><?php echo L::resetToDefault; ?></a>
                            </small>
                        </div>
                    </div>
                </form>
            </div>

            <!-- MULTIPLICATION -->
            <div class="col-12 col-md-6 col-lg-3 mb-3">
                <form action="generator.php" class="form-inline form-predefined multiplication" data-cookiename="multiplication">
                    <div class="card bg-success text-white mb-3">
                        <div class="card-header">
                            <i class="fa fa-times"></i> <strong><?php echo L::calculations_multiplication; ?></strong>
                        </div>
                        <div class="card-body">
                            <p class="card-test text-justify">
                                <?php echo sprintf(L::startpage_predefined_multiplication_introtext, $inputElements['amount'], $inputElements['factor1'], $inputElements['factor2']); ?>
                            </p>
                            <input type="hidden" id="type" name="type" value="multiplication">
                            <input type="hidden" id="cols" name="cols" value="3">
                            <button type="submit" id="btn_multiplication" class="btn btn-secondary w-100">
                                <i class="fa fa-times text-success"></i> <?php echo L::createSheet; ?>
                            </button>
                        </div>
                        <div class="card-footer" style="display: none;">
                            <small class="text-white">
                                <i class="fa fa-trash-alt"></i>&nbsp;
                                <a href="#" class="text-white delete-cookie" data-toggle="tooltip" data-placement="bottom" title="<?php echo L::deleteCookieInfo; ?>"><?php echo L::resetToDefault; ?></a>
                            </small>
                        </div>
                    </div>
                </form>
            </div>

            <!-- DIVISION -->
            <div class="col-12 col-md-6 col-lg-3">
                <form action="generator.php" class="form-inline form-predefined division" data-cookiename="division">
                    <div class="card bg-warning text-white mb-3">
                        <div class="card-header">
                            <i class="fa fa-divide"></i> <strong><?php echo L::calculations_division; ?></strong>
                        </div>
                        <div class="card-body">
                            <p class="card-test text-justify">
                            <?php echo sprintf(L::startpage_predefined_division_introtext, $inputElements['amount'], $inputElements['factor1'], $inputElements['factor2']); ?>
                            </p>
                            <input type="hidden" id="type" name="type" value="division">
                            <input type="hidden" id="cols" name="cols" value="3">
                            <button type="submit" id="btn_division" class="btn btn-secondary w-100">
                                <i class="fa fa-divide text-warning"></i> <?php echo L::createSheet; ?>
                            </button>
                        </div>
                        <div class="card-footer" style="display: none;">
                            <small class="text-white">
                                <i class="fa fa-trash-alt"></i>&nbsp;
                                <a href="#" class="text-white delete-cookie" data-toggle="tooltip" data-placement="bottom" title="<?php echo L::deleteCookieInfo; ?>"><?php echo L::resetToDefault; ?></a>
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