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
    public $sourcePath = '@vendor/wrt54gl/yii2-tabular';

    public $js =[
        'FooTable/js/footable.js',
        'js/TabularInput.js',
    ];

    public $css=[
        'FooTable/css/footable.core.css',
    ];
    public $depends =[
        'yii\web\JqueryAsset',
    ];
} 