<?php 
	$output = [];
	// $db = new SQLite3("Boost.db");
	$db = new PDO("sqlite:Boost.db");
	// please note that this file you can use once to add database file and some dummy data
	// include("database.php");
	
	$s_model = isset($_GET["VehicleModel"]) && trim( $_GET["VehicleModel"] ) ;
	$s_make = isset($_GET["VehicleMake"]) && trim( $_GET["VehicleMake"] ) ;
	$s_year = isset($_GET["VehicleYear"]) && trim( $_GET["VehicleYear"] ) ;
	$s_seats = isset($_GET["VehicleNumberofSeats"]) && trim( $_GET["VehicleNumberofSeats"] ) ;

	$VehicleModel = $_GET["VehicleModel"];
	$VehicleMake = $_GET["VehicleMake"];
	$VehicleYear = $_GET["VehicleYear"];
	$VehicleNumberofSeats = $_GET["VehicleNumberofSeats"];
	
	$query = "SELECT * FROM Boost";
	if( $s_model || $s_make || $s_year || $s_seats )
	{
		$query .= " WHERE ";
		if( $s_model ) { $query .= "VehicleModel = '$VehicleModel' AND "; }
		if( $s_make ) { $query .= "VehicleMake = '$VehicleMake' AND "; }
		if( $s_year ) { $query .= "VehicleYear = '$VehicleYear' AND "; }
		if( $s_seats ) { $query .= "VehicleNumberofSeats = '$VehicleNumberofSeats' AND "; }

		$query = rtrim( $query, " AND " );
	}

	$res = $db->query("$query");
	while($row = $res->fetch(PDO::FETCH_ASSOC)) { $output[] = true ? $row : (object) $row; }
?>

<!DOCTYPE html>
<html lang=en>
    <head>
        <meta charset="utf-8">
        <title>Search</title>
        <link href="Search.css" rel="stylesheet">
    </head>
    <body>
        <nav class="navbar">
            <a class="nav-logo">Boost</a>
            <ul>
                <li><a href="loginPage.html">Home</a></li>
                <li><a href="About.html">About</a></li>
                <li><a href="Contact.html">Contact</a></li>
                <li><a href="Search.html">Search</a></li>
            </ul>
        </nav>
		<div class="absolute">
			<table class="table">
				<thead>
					<tr>
						<th> # </th>
						<th> Model </th>
						<th> Make </th>
						<th> Year </th>
						<th> Number of Seats </th>
					</tr>
				</thead>
				<tbody>
					<?php if( count( $output ) ) : ?>
						<?php foreach( $output as $index => $row ) : ?>
							<tr>
								<td> <?=($index+1);?> </td>
								<td> <?=($row["VehicleModel"]);?> </td>
								<td> <?=($row["VehicleMake"]);?> </td>
								<td> <?=($row["VehicleYear"]);?> </td>
								<td> <?=($row["VehicleNumberofSeats"]);?> </td>
							</tr>
						<?php endforeach; ?>
					<?php else : ?>
						<tr>
							<td colspan="5" class="center-align"> No records found matching your inputs </td>
						</tr>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
        <div class="absolute">
            <form action="Search.php" method="get">
                <label for="cars">Choose Vehicle Model:</label>
                <select name="VehicleModel" id="VehicleModel">
                    <option value=""></option>
                    <option value="Starlet Glanza GT Turbo">Starlet Glanza GT Turbo</option>
                    <option value="MR2 GT-S">MR2 GT-S</option>
                    <option value="Supra">Supra</option>
                    <option value="Skyline">Skyline</option>
                    <option value="180SX">180SX</option>
                    <option value="PAO">PAO</option>
                    <option value="Prelude">Prelude</option>
                </select>
                <label for="colors">Choose Vehicle Make:</label>
                <select name="VehicleMake" id="VehicleMake">
                    <option value=""></option>
                    <option value="Toyota">Toyota</option>
                    <option value="Nissan">Nissan</option>
                    <option value="Honda">Honda</option>
                    <option value="Suzuki">Suzuki</option>
                    <option value="Lexus">Lexus</option>
                    <option value="Acura">Acura</option>
                    <option value="Mazda">Mazda</option>
                </select>
                <label for="Year">Choose Year:</label>
                <select name="VehicleYear" id="VehicleYear">
                    <option value=""></option>
                    <option value="1960">1960</option>
                    <option value="1961">1961</option>
                    <option value="1962">1962</option>
                    <option value="1963">1963</option>
                    <option value="1964">1964</option>
                    <option value="1965">1965</option>
                    <option value="1966">1966</option>
                </select>
                <label for="Seats">Choose Number of Seats:</label>
                <select name="VehicleNumberofSeats" id="VehicleNumberofSeats">
                    <option value=""></option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                </select>
                <br><br>
                <input type="submit" value="Search">
            </form>
        </div>
    </body>
	<script>
		(function() {
			<?php if( $s_model ) : ?> document.getElementById("VehicleModel").value = "<?=$VehicleModel;?>";  <?php endif; ?>
			<?php if( $s_make ) : ?>  document.getElementById("VehicleMake").value = "<?=$VehicleMake;?>"; <?php endif; ?>
			<?php if( $s_year ) : ?>  document.getElementById("VehicleYear").value = "<?=$VehicleYear;?>"; <?php endif; ?>
			<?php if( $s_seats ) : ?> document.getElementById("VehicleNumberofSeats").value = "<?=$VehicleNumberofSeats;?>";  <?php endif; ?>
		})();
	</script>
</html>