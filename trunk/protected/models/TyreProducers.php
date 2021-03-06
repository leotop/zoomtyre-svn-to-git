<?php

/**
 * This is the model class for table "itm_tyre_producers".
 *
 * The followings are the available columns in table 'itm_tyre_producers':
 * @property string $id
 * @property string $title
 * @property string $alias
 * @property string $logo
 * @property string $description
 * @property string $description_marked
 */
class TyreProducers extends CActiveRecord
{
	protected 
	$images = array(
		'logo' => array(
			'field' => 'logo',
			'filename' => '%alias%',
			'alt' => 'Производитель шин %title%',
			'title' => '%title%', 
			'addWatermark' => false,
			'bg' => '#FFFFFF',
			'file_type' => 'jpg',
			'sizes' => array(
				'small'=>array(21,21),
				'normal'=>array(150,100),
				'big'=>array(250,187),
			),
		),
	);
	
	/**
	 * Returns a list of behaviors that this model should behave as.
	 * @return array of behavior configurations indexed by behavior names
	 */
	public function behaviors(){
		return array(
			'ImageManageBehavior' => array(
				'class' => 'ImageManageBehavior',
				'conf' => $this->images,
			),
		);
	}
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return TyreProducers the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'itm_tyre_producers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, alias', 'required'),
			array('title, logo', 'length', 'max'=>255),
			array('alias', 'length', 'max'=>45),
			array('description, description_marked', 'safe'),
			array('alias', 'unique'),
			#array('logo', 'required'),
			array('logo', 'file', 'types'=>'jpg, gif, png, jpeg', 'maxSize' => 10490000, 'allowEmpty'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, alias, logo, description, description_marked', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'tyres' => array(self::HAS_MANY, 'Tyre', 'producer_id'),
		);
	}

	public function scopes(){
		$db = $this->getDbConnection();
		$alias = $db->quoteColumnName($this->getTableAlias());
		return array(
			'alphabetically' => array( 'order' => $alias.'.title', ),
		);
	}
	
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Название',
			'alias' => 'Псевдоним',
			'logo' => 'Логотип',
			'description' => 'Описание',
			'description_marked' => 'Описание',
			'tyres' => 'Шины',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('alias',$this->alias,true);
		$criteria->compare('logo',$this->logo,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('description_marked',$this->description_marked,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
			'sort' => array(
				'defaultOrder'=>array(
					'title'=>'asc',
				),
			),
		));
	}
	
	public function afterDelete(){
		#$this->deleteImage('logo_delete', $this->logo_sizes);

		return parent::afterDelete();
	}
	
	public function beforeSave(){
		$this->alias = EString::strtolower($this->alias);
		
		if($this->description) {
			Yii::import('ext.mardown.*');
			$md = new EMarkdown;
			$this->description_marked = $md->transform($this->description);
		}

		return parent::beforeSave();
	}
}