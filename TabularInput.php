<?php
namespace wrt\tabular;

use Yii;
use yii\base\InvalidConfigException;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\StringHelper;
use yii\i18n\Formatter;
use yii\widgets;


class TabularInput extends GridView{

    /**
     * @var array options for FooTables
     *
        'fooTableOptions'=>[
            'columns'=>[
                2=>'phone',
                3=>'phone',
                4=>'phone,tablet',
                5=>'phone,tablet',
            ],
            'configuration'=>[
                'this is json encoded and passed directly to footables -- see footable documentation'
            ],
        ],
     */
    public $fooTableOptions;

    /**
     * @var ActiveRecord that will be used for posting the data.
     */
    public $postModel;

    /**
     * @var ActiveForm that will be posted.
     */
    public $form;

    /**
     * @var integer the min number of rows to be displayed.  0 if not set
     */
    public $minRows;

    /**
     * @var integer the max number of rows that can be created.  no limit if not set
     */
    public $maxRows;

    /**
     * @var array this will put an add new button at the bottom of the table
     */
    public $footerAddButton;

    /**
     * @var string the content of the footer button
     */
    private $footerButtonContent;

    /**
     * @var string will hold the markup for an entire row of the table with placeholders for the row index numbers.
     */
    private $tableRowMarkup;

    public function run(){

        TabularAsset::register($this->view);

        //Get rid of pagination.
        $this->dataProvider->pagination->pageSize=500000;

        //make sure we have a post model
        if (empty($this->postModel)){
            throw new InvalidConfigException("You need a postModel for the TabularInput widget");
        }

        if ($this->fooTableOptions){

            $this->tableOptions['class'].=' footable';

            /**
             * :TODO: Footables does not work with 2 header rows. So the filter is disabled if we use footables
             */
            $this->filterPosition=false;

            foreach ($this->fooTableOptions['columns'] as $column => $device){
                if(!empty($this->columns[$column-1])){
                    $this->columns[$column-1]->headerOptions['data']['hide']=$device;
                }else{
                    Yii::error('You have assigned Foo Table options to non-existent columns');
                }
            }

            $this->registerFooScript();
        }

        //if there are fewer rows that our $minRows then add some empty models
        if ($this->dataProvider->totalCount<$this->minRows){
            $nRowsToAdd=$this->minRows-$this->dataProvider->totalCount;
            for ($x=1;$x<=$nRowsToAdd;$x++){
                $className=$this->filterModel->className();
                $newModel=new $className;
                $newModels[]=$newModel;
            }
            $this->dataProvider->setModels($newModels);
        }

        if ($this->footerAddButton){
            $this->showFooter=true;
            if (empty($this->footerAddButton['options'])){
                $this->footerAddButton['options']=['class' => 'btn btn-primary','id'=>$this->id.'-addbutton-footer'];//StringHelper::basename($this->postModel->className()).'-tabular-addbutton'];
            }
            $this->footerButtonContent=Html::button($this->footerAddButton['label'],$this->footerAddButton['options']);
        }

        $this->tableRowMarkup=$this->renderTableRow($this->postModel,'key','1');

        Yii::info($this->tableRowMarkup);

        parent::run();


    }



    public function init(){
        parent::init();
    }

    protected function registerFooScript(){
        $configure = !empty($this->fooTableOptions['configuration'])?Json::encode($this->fooTableOptions):'';
        $this->view->registerJs("
            jQuery('#{$this->options['id']} table').footable({$configure});
        ");
    }

    public function renderTableFooter(){
        return '<tfoot><tr><td colspan="'.sizeof($this->columns).'">'.$this->footerButtonContent.'</td></tr></tfoot>';
    }

}