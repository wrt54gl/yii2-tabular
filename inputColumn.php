<?php
/**
 * Created by PhpStorm.
 * User: wendel
 * Date: 11/11/2014
 * Time: 9:21 AM
 */

namespace wrt\tabular;


use yii\grid\Column;

/**
 * Class inputColumn
 * @package wrt\tabular
 * @property TabularInput $grid
 */


class inputColumn extends Column{

    /**
     * @var string the attribute name associated with this column
     */
    public $attribute;

    /**
     * @var string the label for the column
     */
    public $label;

    /**
     * @var array these are the input widget options ie. $form->field(model, attribute)->textInput(widgetOptions)
     */
    public $widgetOptions=[];


    /**
     * @param mixed $model the data model
     * @param mixed $key the key associated with the data model
     * @param int $index the zero based index of the data model
     * @return string the input cell value
     */
    protected  function renderDataCellContent($model,$key,$index){
        $form=$this->grid->form;
        $postModel=$this->grid->postModel;
//        $field=$form->field($postModel, "[$index]$this->attribute");
//        $field->label(false);
        return $form->field($postModel, "[$index]$this->attribute",['labelOptions'=>['label'=>false]])->textInput($this->widgetOptions);

    }

    /**
     * @inheritdoc
     */
    protected  function renderHeaderCellContent (){
        if ($this->label!==null){
            return $this->label;
        }
        if ($this->attribute!==null){
            $model=$this->grid->filterModel;
            return $model->getAttributeLabel($this->attribute);
        }
        return parent::renderHeaderCell();
    }
} 