<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<?php
	include 'definitions.php';
?>
</head>
<body>
<h1>Termination Competition 2018</h1>
<?php
	$competition = [
		"Termination of Rewriting" => [
			"TRS Standard" =>
				[ "type" => "termination", "job" => 30034 ],
			"TRS Standard Certified" =>
				[ "type" => "termination", "job" => 30038 ],
			"SRS Standard" =>
				[ "type" => "termination", "job" => 30035 ],
			"SRS Standard Certified" =>
				[ "type" => "termination", "job" => 30039 ],
			"TRS Relative" =>
				[ "type" => "termination", "job" => 30036 ],
			"TRS Relative Certified" =>
				[ "type" => "termination", "job" => 30040 ],
			"SRS Relative" =>
				[ "type" => "termination", "job" => 30037 ],
			"SRS Relative Certified" =>
				[ "type" => "termination", "job" => 30041 ],
			"TRS Equational" =>
				[ "type" => "termination", "job" => 30042 ],
			"TRS Equational Certified" =>
				[ "type" => "termination", "job" => 30043 ],
			"TRS Conditional" =>
				[ "type" => "termination", "job" => 30044 ],
			"TRS Context Sensitive" =>
				[ "type" => "termination", "job" => 30045 ],
			"TRS Innermost" =>
				[ "type" => "termination", "job" => 30046 ],
			"HRS (union beta)" =>
				[ "type" => "termination", "job" => 30047 ],
		],
	 	"Termination of Programs" => [
			"C" =>
				[ "type" => "termination", "job" => 30048 ],
			"C Integer" =>
				[ "type" => "termination", "job" => 30049 ],
			"Integer Transition Systems" =>
				[ "type" => "termination", "job" => 30050 ],
			"Integer TRS Innermost" =>
				[ "type" => "termination", "job" => 30051 ],
			
		],
		"Complexity Analysis" => [
			"ITS Complexity" =>
				[ "type" => "complexity", "job" => 30054 ],
			"C Integer Programs Complexity" =>
				[ "type" => "complexity", "job" => 30055 ],
			"Runtime Complexity Full Rewriting" =>
				[ "type" => "complexity", "job" => 30091 ],
			"Runtime Complexity Innermost Rewriting" =>
				[ "type" => "complexity", "job" => 30092 ],
			"Runtime Complexity Innermost Rewriting Certified" =>
				[ "type" => "complexity", "job" => 30094 ],
		],
	];

	foreach( array_keys($competition) as $mcatname ) {
	echo "<h2>$mcatname</h2>\n";
	$mcat = $competition[$mcatname];
	$table = [];
	$tools = [];
	echo "<table>\n";
	echo " <tr><th>category<th>id<th class=ranking>ranking\n";
	foreach( array_keys($mcat) as $catname ) {
		$job = $mcat[$catname]["job"];
		$type = $mcat[$catname]["type"];
		$row = [];
		$fname = jobid2scorefile($job); 
		if( file_exists($fname) ) {
			$file = new SplFileObject($fname);
			$file->setFlags( SplFileObject::READ_CSV );
			foreach( $file as $line ) {
				if( !is_null($line[0]) ) {
					$row[$line[0]] = [ "id" => $line[1], "score" => $line[2] ];
					$tools[$line[0]] = true;
				}
			}
		}
		arsort($row);
		echo " <tr class=complete>\n";
		echo "  <td class=category><a href='$type.php?id=$job'>$catname</a>\n";
		echo "  <td><a class=starexecid href='".jobid2url($job)."'>$job</a>\n  ";
		echo "  <td class=ranking>";
		foreach( array_keys($row) as $tool) {
			$score = $row[$tool]["score"];
			$id = $row[$tool]["id"];
			$url = solverid2url($id);
			echo "   <a class=solver href='$url'>$tool</a>\n";
			echo "   <span class=score>$score</span>;\n";
		}
		echo "\n";
	}
	echo "</table>";
	}

?>


</body>
</html>