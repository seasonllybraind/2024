<?php 
    $img            = $page->metaFile()->isNotEmpty() ? $page->metaFile()->toFile()->crop(1200, 630, 'top') : ($page->template() == "article" ? ($page->cover()->toFile() ? $page->cover()->toFile()->crop(1200, 630) : kirby()->site()->metaFile()->toFile() ) : kirby()->site()->metaFile()->toFile());
    $desc           = $page->metaDescription()->isNotEmpty() ? $page->metaDescription()->kt()->inline() : ($page->template() == "article" ? ($page->desc()->isNotEmpty() ? $page->desc()->kt()->inline() : kirby()->site()->metaDescription()->kt()->inline()) : kirby()->site()->metaDescription()->kt()->inline());
    $companyType    = $site->companyType()->isTrue() ? 'Person' : 'Organization';
?>
<?php if($page->template() == "article"): ?>
<script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Article",
    "headline": "<?= $page->title() ?>",
    "description": "<?= $desc ?>",
    "image": "<?= $img->url() ?>",  
    "author": {
      "@type": "Person",
      "name": "<?= $author ?>"
    },  
    "publisher": {
      "@type": "<?= $companyType ?>",
      "name": "<?= $site->title() ?>"
    },
    "datePublished": "<?= $page->date()->toDate('Y-m-d') ?>"
  }
</script>
<?php elseif($page->isHomePage()): ?>
<script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "<?= $companyType ?>",
  <?php if($site->companyAddress()->isTrue()): ?>
    "address": {
        "@type": "PostalAddress",
        "addressLocality": "<?= $site->companyLocality() ?>",
        "postalCode": "<?= $site->companyPostal() ?>",
        "streetAddress": "<?= $site->companyStreet() ?>"
      },
  <?php endif ?>
    "name": "<?= $site->companyName()->or($site->title()) ?>",
  <?php if($site->companyEmail()->isNotEmpty()): ?>
  "email": "<?= $site->companyEmail() ?>",
  <?php endif ?>
  <?php if($site->companyPhone()->isNotEmpty()): ?>"telephone": "<?= $site->companyPhone() ?>",
  <?php endif ?>
  <?php if($logo = $site->logo()->toFile()): ?>"logo": "<?= $logo->url() ?>",
  <?php endif ?>
    "url": "<?= $site->url() ?>"
  }
  </script>
<?php else: ?>
<script type="application/ld+json">
  {
    "@context": "https://schema.org/",
    "@type": "WebPage",
    "name": "<?= $page->title() ?>"
  }
</script>
<?php endif ?>