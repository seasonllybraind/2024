<a class="uk-logo" href="<?= $site->url() ?>" rel="home">
<?php if($logo = $site->logo()->toFile() or ($imageinverted = $site->logoInverted()->toFile())): ?>
    <?php if($logo = $site->logo()->toFile()): ?>
    <img data-src="<?= $logo->url() ?>" class="uk-visible@s" style="height:<?=$site->logoHeight()->isNotEmpty() ? $site->logoHeight()->html() . 'px' : '21px' ?>;" alt="<?= $site->title() ?>" data-width data-height uk-img>
    <?php if($logoMobile = $site->logoMobile()->toFile()): ?>
    <img data-src="<?= $logoMobile->url() ?>" class="uk-hidden@s" style="height:<?=$site->mobileLogoHeight()->isNotEmpty() ? $site->mobileLogoHeight()->html() . 'px' : '21px' ?>;" alt="<?= $site->title() ?>" data-width data-height uk-img>
    <?php else: ?>
    <img data-src="<?= $logo->url() ?>" class="uk-hidden@s" style="height:<?=$site->mobileLogoHeight()->isNotEmpty() ? $site->mobileLogoHeight()->html() . 'px' : '21px' ?>;" alt="<?= $site->title() ?>" data-width data-height uk-img>
    <?php endif ?>
    <?php endif ?>
    <?php if($logoinverted = $site->logoInverted()->toFile()): ?>
    <img data-src="<?= $logoinverted->url() ?>" class="uk-logo-inverse uk-visible@s" style="height:<?=$site->logoHeight()->isNotEmpty() ? $site->logoHeight()->html() . 'px' : '21px' ?>;" alt="<?= $site->title() ?>" data-width data-height uk-img>
    <?php if($logoMobileInverted = $site->logoMobileInverted()->toFile()): ?>
    <img data-src="<?= $logoMobileInverted->url() ?>" class="uk-logo-inverse uk-hidden@s" style="height:<?=$site->mobileLogoHeight()->isNotEmpty() ? $site->mobileLogoHeight()->html() . 'px' : '21px' ?>;" alt="<?= $site->title() ?>" data-width data-height uk-img>
    <?php else: ?>
    <img data-src="<?= $logoinverted->url() ?>" class="uk-logo-inverse uk-hidden@s" style="height:<?=$site->mobileLogoHeight()->isNotEmpty() ? $site->mobileLogoHeight()->html() . 'px' : '21px' ?>;" alt="<?= $site->title() ?>" data-width data-height uk-img>
    <?php endif ?>
    <?php endif ?>
<?php else: ?>
    <?= $site->title() ?>
<?php endif ?>
</a>