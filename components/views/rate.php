<?php

use elephantsGroup\starRating\assets\RatingAsset;
use yii\web\View;

RatingAsset::register($this);
$module = \Yii::$app->getModule('rating');
?>
<div class="row" id="star-rating<?= $item ?>" >
    <?php for ($i = $min_num; $i <= $max_num; $i++ ):?>
        <input type="radio" class="rating" id="star-rating<?= $item ?>" <?= ($i <= $rate_num) ? 'checked' : '' ?> value="<?= $i ?>"  />
    <?php endfor;?>
</div>

<?php
$script = "$(function(){\$('#star-rating$item').rating(function(vote, event){
        post_rate('" . Yii::getAlias('@web') . "/star-rating/ajax/vote', '" . Yii::$app->request->csrfToken . "', $service, $item, vote);
    }, 3);
});";
$this->registerJs($script, View::POS_END);
?>