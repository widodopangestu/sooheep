<?php 
class RegisterForm extends CFormModel
{
	public $username;
	public $password;
	public $retypePassword;
	public $email;
	
	public $firstName;
	public $midlleName;
	public $lastName;
	public $gender;
	public $birthDate;
	public $dayOf;
	public $monthOf;
	public $yearOf;
	
	public $country;
	public $state;
	public $city;
	
	public $typeInterest;
	public $interest;
	public $item_interest;
	
	
	public function rules()
	{
		return array(
			// username and password are required
			array('password, retypePassword, email, firstName, lastName, gender, birthDate, country, city,', 'required' , 'on' => 'step1'),
			array('email', 'checkemail' , 'on' => 'step1'),
			array('interest', 'required', 'on'=>'step2'),
			array('retypePassword', 'compare', 'compareAttribute' => 'password', 'on' => 'step1'),
			array('email', 'email', 'on' => 'step1'),
			array('password', 'length', 'min' => 6, 'on' => 'step1'),
			array('birthDate, dayOf, monthOf, yearOf', 'safe', 'on' => 'step1'),
			//array('username, firstName, lastName, middleName, gender, password, retypePassword, email, country, state, city, birthDate', 'safe'),
		);
	}
	
	public function beforeValidate(){
		if($this->scenario == 'step1'){
			$this->birthDate = $this->yearOf."-".$this->monthOf."-".$this->dayOf;
		}
		
		return true;
	}
	
	public function checkemail($attribute,$params){
		$cek = Users::model()->countByAttributes(array('email'=>$this->$attribute));
		if($cek > 0)
			$this->addError($attribute, 'Email has been registered');
	}
	
	public function saveUpdateInterest($id){
		$profile = Profile::model()->findByAttributes(array('id_user'=>$id));
		if($profile != null){
			$profile->id_user = $user->id_user;
			$profile->firstname = $this->firstName;
			$profile->middlename = $this->midlleName;
			$profile->lastname = $this->lastName; 
			$profile->gender = $this->gender;
			$profile->birth_date = $this->birthDate;
			$profile->id_country = $this->country;
			$profile->id_city = $this->city;
			$profile->uniqueid = sha1($this->email);
			$profile->save();
		}else{
		
		}
	}
	
	public function saveInterst(){
		$user = Users::model()->findByPk(Yii::app()->user->id['id']);
		$ex = $this->interest;
		if(count($ex) > 0){
			foreach ($ex as $in){
				$modelI = Interest::model()->findByPk($in);
				$modelUI = UserInterest::model()->findByAttributes(array('id_user'=>$user->id_user,'id_interest'=>$in));
				if($modelI != null && $modelUI == null){ 
					$interest = new UserInterest;
					$interest->id_user = $user->id_user;
					$interest->id_interest = $modelI->id_interest;
					$interest->save();
				}
			}
		}
		$user->activation = 1;
		$user->save();
		return true;
	}
	public function saveProfile(){
		$user = new Users;
		$user->email = strtolower($this->email);
		$user->password = md5($this->password);
		$user->hash = sha1($this->email);
		$user->id_roles = 3;
		if($user->save()){
			$profile = new Profile;
			$profile->id_user = $user->id_user;
			$profile->firstname = $this->firstName;
			$profile->middlename = $this->midlleName;
			$profile->lastname = $this->lastName; 
			$profile->gender = $this->gender;
			$profile->birth_date = $this->birthDate;
			$profile->id_country = $this->country;
			$profile->id_city = $this->city;
			$profile->uniqueid = $user->hash;
			$profile->save();
			
			return true; 
		}
		
		return false; 
	}
	
    public function attributeLabels() {
        return array(
        	'username' => 'Username',
        	'password' => 'Password',
        	'retypePassword' => 'Retype Your Password',
        	'email' => 'Email',
        	'country' => 'Country',
        	'state' => 'State',
        	'city' => 'City',
        	'yearOf' => 'Year Of Birth', 
        	'monthOf'=>'Month Of Birth', 
        	'dayOf'=>'Day of Birth',
        	'firstName' => 'First Name',
        	'lastName' => 'Last Name',
        	'midlleName' => 'Midlle Name',
        	'interest' => 'Interest',
        );
    } 
    
    public function getDataGender(){
    	return array(
    		'MALE' => 'Male',
    		'FEMALE' => 'Female'
    	);
    }
    
    public function getInputgender(){
    	switch ($this->gender){
    		case 'MALE' :
    			return 'Mr.';
    		break;
    		case 'FEMALE' :
    			return 'Mrs.';
    		break;
    	}
    }
    
    public function getCountry(){
    	return CHtml::listData(MasterCountry::model()->findAll(array('condition'=>'country_id = 107','order'=>'country_name ASC')),'country_id','country_name');
    }

    public function getDate(){
    	$data = array();
    	for($i=1;$i<=31;$i++){
    		$data[$i] = $i;
    	}    	
    	return $data;
    }
    
    public function getBulan($num, $country = "id"){
    	$num = $num - 1;
    	switch ($country){
    		case "id":
				$date = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
    			break;
    		case "en" :
    			$date = array("January","February","March","April","May","June","July","August","September","October","November","December");
    			break;
    		default:
    			$date = array("January","February","March","April","May","June","July","August","September","October","November","December");
    			break;		
    	}
    	
    	return $date[$num];
    	
    }

    public function getMonth(){
    	$data = array();
    	for($i=1;$i<=12;$i++){
    		$index = ($i < 10) ? "0".$i : $i;
    		$bulan = self::getBulan($i,"en"); 
    		$data[$index] = $bulan;
    	}    	
    	return $data;
    }
    
    public function getYear($diff = 0){
    	$data = array();
    	$now = intval(date("Y"))-$diff;
    	for($i=$now;$i>=$now-100;$i--){
    		$data[$i] = $i;
    	}    	
    	return $data;
    }
	

}	