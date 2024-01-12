<?php
    
	$kirby = kirby();
    $visitor = $kirby->visitor();
	$ip = $visitor->ip();
	$url = $kirby->site()->page()->url();
    
?>
Hello Company,

<?= $text ?>

Best regards,
<?= $sender ?>

Page URL: <?= $url ?>

<?php if($kirby->site()->senderIp()->isTrue()): ?>
Visitor IP: <?= $ip ?>
<?php endif ?>