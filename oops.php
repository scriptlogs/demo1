<?php

class dad {
	public $accname;
	public $accno;
	
	//Encapsulation : to hide the data from outside of the class or wrapping up of data into a single unit. 
	//Use "private" keyword to protect. Use getter and setter functions to set and get the values of variabls
	private static $mob;
	
	//Overloading :__construct getting Overloading. It is sameas Polymorphysm
	// Polymorphysim : Ability to take more than 1 form. EX : "Principal<->Teacher<->Student"
	//Encapsulation : type of encapsulation -> when object is calling -> 'setter' accname,accno,mob by making an object
	public function __construct($accname,$accno,$mob){
		$this->accname = $accname;
		$this->accno = $accno;
		self::$mob = $mob;
	} 
	
	//Encapsulation :type of encapsulation -> when object is calling -> 'getter' accountName
	public function accountName(){
		return $this->accname;
	}
	
	public function accNo(){
		return $this->accno;
	}

	public static function mobile(){
		return self::$mob;
	}
}

//--------------- INHERITANCE -------------------
	//when a child accuries properties of parent class it is called INHERITANCE.
	// Extends keyword is used to extends the class 
		class child extends dad {
			
			private $saving;
			
			public function __construct($accname,$accno,$mob,$saving){
				parent::__construct($accname,$accno,$mob);
				$this->saving = $saving;
			}
			
			public function getaccname(){
				return $this->saving;
			}
			
		}

//--------------- INTERFACE -------------------
	//We cannot create any instance/object of it.
	//Every functions declare in interface should be define all functions in class which implements the Interface. 
	//All functions declare in it should be Public. 
	//1 Interface can extends another Interface by "extends" keyword
	//We cannot delcare Variables in it

		interface google{
			private function google_map();
		}

		interface street{
			
			public function street_map();
		}

		interface loadAllInterface extends google, street{
			
		}

		//class maps implements google, street
		class maps implements loadAllInterface{
			public function google_map(){
				echo 'map google';
			}
			public function street_map(){
				echo 'map street';
			}
			
		}

		$map = new maps();
		$map->google_map();
		echo '<br>';
		$map->street_map();
		
		
//--------------- ABSTRACT -------------------
	//It is like a class, but we cannot create any instance/object of it.
	//Every 'abstract functions' declare in 'Abstract class' should be define in class which extends the Abstract class. 
	//All Functions/Variables declare in it can be Public, Protected. 
	//We can delcare Variables and Body of functions in it
		abstract class Mobile{
			protect $model_no;
			public function set_model($model_no){
				$this->model_no = $model_no;
			}
			public function get_model(){
				return $this->model_no;
			}
			public abstract function calling();
		}
		
		class nokia extends Mobile{
			public function calling();
		}
		$nokia = new nokia();
		$nokia->set_model('NOKIA 5233');
		$nokia->get_model();

	
//--------------- trait -------------------
	//trait is like a class. 
	//We cannot make object/instance of class. 
	//We can delcalre or define function/variables.
	//We can use as many as trait we want by "use" keyword. EX: "use trait1,trait2;" 
		trait hello{
			public function sayhello(){
				echo 'hello-sayhello';
			}

		}

		trait bye{
			public function goodbye(){
				echo 'bye-goodbye';
			}

		}

		trait combineallTrait{
			use hello,bye; 
		}

		class chat extends child{
			use combineallTrait; // =  use hello,bye;
			public function start_chat(){
				echo "chat started";
			}
		}

		$obj = new chat('abc',1245,9090990909,200);

		echo '<br><b> Function calling of Parent class EX :</b>';
		echo $obj->accNo();

		echo '<br><b> Function calling to chat class EX :</b>';
		$obj->start_chat();

		echo '<br><b> Trait EX: </b>';
		$obj->goodbye();

		echo '<br><b> Static function calling of Parent class EX:</b>';
		echo chat::mobile();
		
		
//--------------- Overriding -------------------
	// It ovveride the function of parent class if we declare 'same function name' in child class.
	// To avoid that use 'parent::__construct();'
	class abc{
		public function __construct(){
			echo 'class abc construct';
		}
	}	
	
	class xyz extends abc{
		public function __construct(){
			//parent::__construct();// to use parent construct
			echo '<br>class xyz construct<br>';
		}
	}
	
	$abc = new xyz();
	var_dump($abc);
	
	
//--------------- TYPE HINTING -------------------
	//TYPE HINTING is Consistence and Secure
	
		//PHP 7.0
			function abc(array $a, int $b, string $c){
				print_r($a);
				
				echo '<br>';
				echo $b;
				
				echo '<br>';
				echo $c;
			}

			$a = array(1,2,2);
			$b = 1;
			$c = 'er';

			abc($a,$b,$c);
		

		
//------------------------------------------ EXAMPLE ALL IN ONE -------------------------------------------------

	//abstract class
	abstract class Mobile{
		
		protected $model_no;
		public function set_model($model_no){
			$this->model_no = $model_no;
		}
		public function get_model(){
			return $this->model_no;
		}
		
		public abstract function calling();
		
	}

	//trait
	trait voiceVideoCall{
		public function __construct(){
			echo 'voice and video call supported';
		}
	}

	trait voicecall{
		public function __construct(){
			echo 'voice call supported';
		}
	}

	//interface 
	interface service{
		public function serviceCenter();
	}



	class nokia extends Mobile implements service{
		use voiceVideoCall; // extends/use traits voiceVideoCall
		
		public function calling(){ //created because of abstract class
			
		} 
		public function serviceCenter(){ //created because of interface service
			echo 'nokia service center';
		}
	}

	class samsung extends Mobile{
		use voicecall;  // extends/use traits voicecall
		public function calling(){  //created because of abstract class
			
		}
		public function serviceCenter(){ //created because of interface service
			echo 'samsung service center';
		}
	}


	$nokia = new nokia();
	$nokia->set_model('NOKIA 5233');
	echo '<br>';
	echo $nokia->get_model();
	echo '<br>';
	echo $nokia->serviceCenter();
	echo '<br><br>';

	$samsung = new samsung();
	echo '<br>';
	$samsung->set_model('SAMSUNG 1122');
	echo $nokia->serviceCenter();
	echo '<br>';
	echo $samsung->get_model();