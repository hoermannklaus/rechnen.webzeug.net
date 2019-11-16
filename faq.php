<?php
require __DIR__ . '/vendor/autoload.php';

$i18n = new i18n('lang/lang_{LANGUAGE}.json', 'langcache/', 'de');
$i18n->init();

$version = RechnenWebzeugNet\ApplicationVersion::get();
$language = $i18n->getAppliedLang();

$faqs = [ 'one', 'two', 'three', 'four', 'five', 'six'];
?>

<!DOCTYPE html>
<html>
  <head>
    <?php require_once('./includes/gtmHead.php'); ?>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <title><?php echo L::faq_title . " - " . L::appTitle . " - " . L::domain; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
    <?php require_once('./includes/headerIncludes.php'); ?>
  </head>
  <body>
    <?php require_once('./includes/gtmBody.php'); ?>
    <div class="container">
        <div class="row mb-4">
            <div class="col">
                <!-- JUMBOTRON -->
                <div class="jumbotron mt-5 text-center">
                    <h1>
                        <?php echo L::faq_header; ?>
                    </h1>
                    <p>
                        <?php echo L::faq_introtext; ?>
                    </p>
                    <p>
                        <a href="index.php" class="btn btn-primary">
                            <i class="fa fa-arrow-circle-left"></i> <?php echo L::generatorpage_buttons_return; ?>
                        </a>
                    </p>
                </div>
                <!-- ACCORDION -->
                <div class="accordion" id="accordionFaq">
                    <?php $counter = 1; foreach ($faqs as $faq) { ?>
                    <div class="card">
                        <div class="card-header" id="heading<?php echo $faq; ?>">
                            <h2 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" id="faq-<?php echo $faq; ?>" data-target="#collapse<?php echo $faq; ?>" aria-expanded="false" aria-controls="collapse<?php echo $faq; ?>">
                                    <?php $question = "faq_".$faq."_question"; echo $counter . ". "; echo call_user_func('L::' . $question); ?>
                                </button>
                            </h2>
                        </div>
                        <div id="collapse<?php echo $faq; ?>" class="collapse" aria-labelledby="heading<?php echo $faq; ?>" data-parent="#accordionFaq">
                            <div class="card-body">
                                <?php $answer = "faq_".$faq."_answer"; echo call_user_func('L::' . $answer); ?>
                            </div>
                        </div>
                    </div>
                    <?php $counter++; } ?>
                </div>
            </div>
        </div>
        <?php require_once('./includes/footer.php'); ?>
    </div>
  </body>
</html>