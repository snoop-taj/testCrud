<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $user_id
 * @property string $firstname
 * @property string $surname
 * @property string $password
 * @property integer $age
 * @property string $date_created
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
    public $newPassword;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}


	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('firstname, surname, newPassword, age', 'required'),
			array('age', 'numerical', 'integerOnly'=>true),
			array('firstname, surname', 'length', 'max'=>50),
			array('newPassword','length','min'=>8,'max'=>16,'allowEmpty'=>false,'on'=>'insert'),
                        array('newPassword','length','min'=>8,'max'=>16,'allowEmpty'=>true,'on'=>'update'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_id, firstname, surname, newPassword, age, date_created', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_id' => 'User',
			'firstname' => 'Firstname',
			'surname' => 'Surname',
			'newPassword' => 'Password',
			'age' => 'Age',
			'date_created' => 'Date Created',
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

		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('firstname',$this->firstname,true);
		$criteria->compare('surname',$this->surname,true);
		$criteria->compare('age',$this->age);
		$criteria->compare('date_created',$this->date_created,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
         public function beforeSave() {
                if (!empty($this->newPassword))
                        $this->password = hash('md5', $this->newPassword);
                return true;
        }
}