<?php
/**
 * Created by PhpStorm.
 * User: wendel
 * Date: 04/11/2014
 * Time: 11:43 AM
 */

namespace wrt\tabular;

use \yii;

class TabularAsset extends yii\web\AssetBundle {
    public $sourcePath = '@vendor';

    public $js =[
        'fooplugins/footable/js/footable.js',
        'wrt54gl/yii2-tabular/js/TabularInput.js',
    ];

    public $css=[
        'fooplugins/footable/css/footable.core.css',
    ];
    public $depends =[
        'yii\web\JqueryAsset',
    ];
} 