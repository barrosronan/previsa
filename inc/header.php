<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="theme-color" content="<?= THEME_COLOR ?>">
        <link rel="icon" href="<?= SITE_URL ?>/imagens/logo.png" />
        
        
        <link rel="stylesheet" href="<?= SITE_URL ?>/js/jquery-ui-1.12.1/jquery-ui.css">
        <link rel="stylesheet" href="<?= SITE_URL ?>/js/jquery-ui-1.12.1/jquery-ui.structure.css">
        <link rel="stylesheet" href="<?= SITE_URL ?>/js/jquery-ui-1.12.1/jquery-ui.theme.css">
        <link rel="stylesheet" href="<?= SITE_URL ?>/css/booster.css">

        <?= $seo->getLink(); ?>

    </head>
    <body>
        <nav class="nav nav-dark">
            <div class="logo">
                <a href="#">Logo</a>
            </div>
            <div class="menu">
                <label for="my-menu">
                    <span></span>
                </label>
            </div>
            <input type="checkbox" id="my-menu" class="my-menu">
            <ul class="nav-bar">
                <li class="nav-item"><a href="<?=SITE_URL?>/_view/funcionario" class="nav-link">Funcionarios</a></li>
            </ul>
        </nav>

