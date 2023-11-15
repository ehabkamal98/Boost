<?php
	$db = new SQLite3("Boost.db");
	$db->exec("CREATE TABLE Boost(id INTEGER PRIMARY KEY, VehicleModel TEXT, VehicleMake TEXT, VehicleYear TEXT, VehicleNumberofSeats INTEGER)");
	$number_of_random_rows = 150;

	$VehicleModels = [ "Starlet Glanza GT Turbo", "MR2 GT-S", "Supra", "Skyline", "180SX", "PAO", "Prelude" ];
	$VehicleMakes = [ "Toyota", "Nissan", "Honda", "Suzuki", "Lexus", "Acura", "Mazda" ];
	$VehicleYears = [ 1960, 1961, 1962, 1963, 1964, 1965, 1966 ];
	$VehicleNumberofSeats = [ 1, 2, 3, 4, 5, 6 ];
	$rows = array();
	for( $i = 1; $i <= $number_of_random_rows; $i++ )
	{
		$rows[] = [
			"VehicleModel" => $VehicleModels[ rand(0, 5) ],
			"VehicleMake" => $VehicleMakes[ rand(0, 5) ],
			"VehicleYear" => $VehicleYears[ rand(0, 5) ],
			"VehicleNumberofSeats" => $VehicleNumberofSeats[ rand(0, 5) ]
		];
	}
	foreach( $rows as $row )
	{
		$VehicleModel = $row["VehicleModel"];
		$VehicleMake = $row["VehicleMake"];
		$VehicleYear = $row["VehicleYear"];
		$VehicleNumberofSeats = $row["VehicleNumberofSeats"];
		$db->exec("INSERT INTO Boost(VehicleModel, VehicleMake, VehicleYear, VehicleNumberofSeats ) VALUES('$VehicleModel', '$VehicleMake', $VehicleYear, $VehicleNumberofSeats)");	
	}
?>