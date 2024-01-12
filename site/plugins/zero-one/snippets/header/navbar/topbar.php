<div id="topbar" class="uk-text-small uk-overflow-hidden">
  <div class="uk-container<?php e($site->navbarWidth() == "large", ' uk-container-large') ?><?php e($site->navbarWidth() == "expand", ' uk-container-expand') ?>">
    <div class="uk-flex uk-flex-between">
      <div class="uk-width-auto uk-text-left<?php e($site->topbarMobile() != "left" && $site->topbarTablet() != "left", ' uk-visible@s') ?><?php e($site->topbarMobile() != "left" && $site->topbarTablet() == "left", ' uk-visible@m') ?>"><?= h($site->topbarLeft(), true) ?></div>
      <div class="uk-width-auto uk-text-center<?php e($site->topbarMobile() != "center" && $site->topbarTablet() != "center", ' uk-visible@s') ?><?php e($site->topbarMobile() != "center" && $site->topbarTablet() == "center", ' uk-visible@m') ?>"><?= h($site->topbarCenter(), true) ?></div>
      <div class="uk-width-auto uk-text-right<?php e($site->topbarMobile() != "right" && $site->topbarTablet() != "right", ' uk-visible@s') ?><?php e($site->topbarMobile() != "right" && $site->topbarTablet() == "right", ' uk-visible@m') ?>"><?= h($site->topbarRight(), true) ?></div>
    </div>
  </div>
</div>