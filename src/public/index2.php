<?php
require_once 'autoload.php';
$session = Session::getInstance();

$db = new Db_Connection("mysql:host=localhost;dbname=project", "project", "0000");

$request = new Request;
$manager = new Hero_Manager;

if($request->isPost()){
	$data = $request->getPost();
	$classHero = "Hero_" . $data['class'];
	if(!empty($data['hero'])){
		$hero = new $classHero($data['hero']);
		$session->hero = $hero;	
		$manager->save($hero);
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Hero</title>
</head>
<body>
	<div>
		<form method="POST">
			<label for="name"> Pseudo : <input id="name" type="text" name="hero"></label>
			<label for="class"> Classes : 
				<select name="class" id="class">
					<option>Rogue</option>
					<option>Tank</option>
					<option>Healer</option>
				</select>
			</label>
			<button type="submit">Lancer</button>
		</form>
		<?php 
			if(isset($session->hero)){
				$hero = $session->hero;
				echo $hero;
				$reflection = new ReflectionClass($hero);
				$reflectionMethods = $reflection->getMethods();
				foreach ($reflectionMethods as $reflectionMethod) {
					var_dump($reflectionMethod->getName());
					var_dump($reflectionMethod->isPublic());
				}
				
			}
		?>
	</div>
</body>
</html>
