<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Latihan Kelas (Class)</title>
</head>

<body>
	<?php		
		class SuatuKelas {
			var $nama;
			
			function __constructor(){
				echo "Konstruktor dipanggil";
			}
			
			function __desctructor(){
				echo "Desktrutor dipanggil";
			}
			
			public function SuatuMetodePublic(){
				echo 'Suatu Metode Public dijalankan'.'<br />';
			}
			
			private function SuatuMetodePrivate(){
				echo 'Suatu Metode Private dijalankan'.'<br />';
			}
			
			protected function SuatuMetodeProtected(){
				echo 'Suatu Metode Protected dijalankan'.'<br />';
			}
			
			static function SuatuMetodeStatic(){
				echo 'Suatu Metode Static dijalankan'.'<br />';
			}
		}
	
		$kelas = new SuatuKelas();
		$kelas->SuatuMetodePublic();
		$kelas->SuatuMetodePrivate();
		$kelas->SuatuMetodeProtected();
		$kelas->SuatuMetodeStatic();
		SuatuKelas::SuatuMetodeStatic();
		
		
		//
		class Animal
		{
			function say(){
				echo 'I\'m animal'.'<br />';
			}			
		}
		
		class Cat extends Animal
		{
			function say(){
				echo 'I\'m Cat'.'<br />';
			}
		}
		
		class Dog extends Cat
		{
			final function say(){
				echo 'I\'m Dog'.'<br />';
			}			
		}
		
		$anim = new Animal();
		$cat = new Cat();
		$dog = new Dog();
		
		$anim->say();
		$cat->say();
		$dog->say();
	?>	
</body>
</html>