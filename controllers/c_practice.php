<?php
class practice_controller extends base_controller {

	public function test_db() {


		/*
		# INSERT PRACTICE
		$q = 'INSERT INTO users
			SET first_name = "Albert",
			last_name = "Einstein"';
			
			echo $q;
			*/

			/*
			$q = 'UPDATE users
				SET email = "albert@aol.com"
				WHERE first_name = "Albert"';

			DB::instance(DB_NAME)->query($q);
			*/

			$new_user = Array(
				'first_name' => 'Albert',
				'last_name' => 'Einstein',
				'email' => 'albert@gmail.com'
				);

			/*
			DB::Instance(DB_NAME)->insert('users', $new_user);
			*/

			$_POST['first_name'] = 'Albert';

			$_POST = DB::instance(DB_NAME)->sanitize($_POST);

			$q = 'SELECT email
				FROM users
				WHERE first_name = "'.$_POST['first_name'].'"';

			echo DB::instance(DB_NAME)->select_field($q);

	}





	public function test1() {

		require(APP_PATH.'/libraries/Image.php');

		$imageObj = new Image('http://placekitten.com/500/500');

		$imageObj->resize(300,300);

		$imageObj->display();

	}

	public function test2() {

		# Static
		echo Time::now();
	}

}
?>