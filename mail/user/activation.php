<?php
use yii\helpers\Url;
?>
Please click on following link to active your snippets.ir account:
<br>
<?=Url::toRoute(['user/activation', 'token' => $model->auth_key], true);?>
