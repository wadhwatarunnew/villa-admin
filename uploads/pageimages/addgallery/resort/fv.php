<?php
$SubHeaderTitle = isset($SubHeaderTitle) ? $SubHeaderTitle : '';
$SubHeaderBackUrl = isset($SubHeaderBackUrl) ? $SubHeaderBackUrl : '';
$SubHeaderBackLabel = isset($SubHeaderBackLabel) ? $SubHeaderBackLabel : 'Back';

if ($SubHeaderTitle === '' && $SubHeaderBackUrl === '') {
    return;
}
?>
<div class="app-subheader mb-30">
    <h2 class="app-subheader-title"><?php echo htmlspecialchars($SubHeaderTitle, ENT_QUOTES, 'UTF-8'); ?></h2>
    <?php if ($SubHeaderBackUrl !== '') { ?>
        <a href="<?php echo htmlspecialchars($SubHeaderBackUrl, ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-outline-secondary btn-sm app-subheader-back">
            <i class="feather icon-arrow-left"></i> <?php echo htmlspecialchars($SubHeaderBackLabel, ENT_QUOTES, 'UTF-8'); ?>
        </a>
    <?php } ?>
</div>
