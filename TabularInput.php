<?php

/* @var $view yii\web\View */
namespace wrt\tabular;

use yii\base\Widget;
use yii\helpers\Html;

class TabularInput extends  Widget {

    public $message;
    public $view;

    public function init(){
        parent::init();


    }

    public function run(){
        TabularAsset::register($this->view);
        $table='
<table class="footable table table-striped table-bordered">
  <thead>
    <tr>
      <th>Name</th>
      <th data-hide="phone">Phone</th>
      <th data-hide="phone,tablet">Email</th>
    </tr>
  </thead>
  <tbody>
    <tr>
        <td>
            Wendel Toews
        </td>
        <td>
            324237
        </td>
        <td>
            we@kdljf.kdjf
        </td>
    </tr>
  </tbody>
</table>';




        return $table;
    }

} 