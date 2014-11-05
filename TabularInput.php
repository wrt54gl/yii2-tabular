<?php
/**
 * Created by PhpStorm.
 * User: wendel
 * Date: 04/11/2014
 * Time: 11:52 AM
 */

/* @var $view yii\web\View */
namespace wrt54gl\tabular;

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
      <td>Bob Builder</td>
      <td>555-12345</td>
      <td>bob@home.com</td>
    </tr>
    <tr>
      <td>Bridget Jones</td>
      <td>544-776655</td>
      <td>bjones@mysite.com</td>
    </tr>
    <tr>
      <td><input type="text">  </td>
      <td>555-99911</td>
      <td><input type="button">cruise1@crazy.com</td>
    </tr>
  </tbody>
</table>';


        return $table;
    }

} 