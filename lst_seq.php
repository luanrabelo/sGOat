<?php
include('conection.php');
$idProject   = $_GET["idProject"];
$ProjectName = $_GET["ProjectName"];

$verify 	= ("SELECT * FROM newprojects WHERE Id_Project = '$ProjectName'");
$qverify 	= mysqli_query($mysqli, $verify);
($line = $qverify->fetch_assoc());


$Projetos	  = ("SELECT * FROM projetos WHERE Project_Name = '$ProjectName' AND Project = '$idProject'");
$qry = mysqli_query($mysqli, $Projetos);
$T_Seq		  = mysqli_num_rows($qry);
($row = $qry->fetch_assoc());
?>
<!DOCTYPE html>
<html>
<head>
	<title>xmlBLASTparser&colon; a lightweight PHP library for parsing BLAST XML</title>
	<link rel="stylesheet" media="screen,print" type="text/css" href="css/blast.css"/>
	<style type= "text/css">
	table#definition, table#iteration, table#hlist, table#hits, table#statistics { border-collapse: collapse; align: center; }
	table#definition { width: 75%; }
	table#definition td { border: 1px solid #0055CC; padding: 5px; }
	table#definition td:nth-child(odd) { color: white; background: #0055CC; }
	table#iteration, table#hlist, table#hits { width: 90%; }
	table#iteration th { color: white; background: OrangeRed; border: 1px solid Red; padding: 2px; }
	table#iteration td { border: 1px solid Red; padding: 2px; }
	table#iteration tr:nth-child(odd) { background: PapayaWhip; }
	table#hlist th { color: White; background: Orange; border: 1px solid Orange; padding: 2px; }
	table#hlist td { border: 1px solid DarkOrange; padding: 2px; }
	table#hlist tr:nth-child(odd) { background: Cornsilk; }
	table#hits th { color: White; background: GoldenRod; border: 1px solid GoldenRod; padding: 2px; }
	table#hits td { border: 1px solid GoldenRod; padding: 2px; }
	table#hits tr:nth-child(odd) { background: LightGoldenRodYellow; }
	table#statistics { width: 300px; }
	table#statistics td { border: 1px solid Coral; padding: 2px; }
	table#statistics td:nth-child(odd) { color: white; background: Chocolate; }
	#ops {
		padding: 10px 10px 10px 10px; 
		font-family: "Helvetica";}
	#Sequences{
		font-family: Helvetica; 
		}
	#algfmt { line-height: 130%; }
		
th, td {border-bottom: 1px solid #ddd;}
td{height: 40px;}
th {text-align: left}
tr:hover {background-color: #f5f5f5;}
		
	</style>
</head>
<body>
<div id="Sequences">
<?php
$xml = simplexml_load_file($row['xml_File']) or die("Error: Cannot able to create object");
function def_split($x, $y) {
	$a = "&gt;" . $x . " " . $y;
	$a = preg_replace("/\>/", "&gt;", $a);
	$a = preg_replace("/ \&gt\;/", "<br/>&gt;", $a);
	return $a;
}
function def_trim($def) {
	$defn = preg_replace("/ \&gt\;/", ">", $def);
	$defn = explode('>', $defn);
	if (strlen($defn[0]) > 75) return substr($defn[0], 0, 75) . "...";
	else return $defn[0];
}
function fmtprint($length, $query_seq, $query_seq_from, $query_seq_to, $align_seq, $sbjct_seq, $sbjct_seq_from, $sbjct_seq_to) {
	$n = (int)($length / 60);
	$r = $length % 60;
	if ($r > 0) $t = $n + 1;
	else $t = $n;
	$j = 0;
	$xn = $query_seq_from;
	$an = $sbjct_seq_from;
	for ($i = 0; $i < $t; $i++) {
		$xs = substr($query_seq, 60*$i, 60);
		$xs = preg_replace("/-/", "", $xs);
		$yn = $xn + strlen($xs) - 1;
		printf("\nQuery  %-4d %s  %d", $xn, substr($query_seq, 60*$i, 60), $yn);
		$xn = $yn + 1;
		printf("\n            %s", substr($align_seq, 60*$i, 60));
		$ys = substr($sbjct_seq, 60*$i, 60);
		$ys = preg_replace("/-/", "", $ys);
		$bn = $an + strlen($ys) - 1;
		printf("\nSbjct  %-4d %s  %d\n", $an, substr($sbjct_seq, 60*$i, 60), $bn);
		$an = $bn + 1;
	}
}
function annotate($def) {
	$pn = preg_match_all('/\|pdb\|\K[^\|]*(?=\|)/', $def, $m);
	if ($pn > 0) {
		for ($i1 = 0; $i1 < $pn; $i1++) {
			$id[$i1] = $m[0][$i1];
		}
		$id = array_unique($id);
		$id = array_filter($id);
		$id = array_values($id);
		if (!empty($id)) {
			$n = count($id);
			for ($i1 = 0; $i1 < $n; $i1++) {
				$def = preg_replace("/$id[$i1]/", "<a href=\"http://www.rcsb.org/pdb/explore/explore.do?structureId=$id[$i1]\" id='ilnk' target='_blank'>". $id[$i1] . "</a>", $def);
			}
		}
	}
	$gn = preg_match_all('/gi\|\K[^\|]*(?=\|)/', $def, $m1);
	if ($gn > 0) {
		for ($i2 = 0; $i2 < $gn; $i2++) {
			$gid[$i2] = $m1[0][$i2];
		}
		$gid = array_unique($gid);
		$gid = array_filter($gid);
		$gid = array_values($gid);
		if (!empty($gid)) {
			$n1 = count($gid);
			for ($i2 = 0; $i2 < $n1; $i2++) {
				$def = preg_replace("/$gid[$i2]/", "<a href=\"https://www.ncbi.nlm.nih.gov/protein/$gid[$i2]\" id='ilnk' target='_blank'>". $gid[$i2] . "</a>", $def);
			}
		}
	}
	$gb = preg_match_all('/gb\|\K[^\|]*(?=\|)/', $def, $m2);
	if ($gb > 0) {
		for ($i3 = 0; $i3 < $gb; $i3++) {
			$gbid[$i3] = $m2[0][$i3];
		}
		$gbid = array_unique($gbid);
		$gbid = array_filter($gbid);
		$gbid = array_values($gbid);
		if (!empty($gbid)) {
			$n2 = count($gbid);
			for ($i3 = 0; $i3 < $n2; $i3++) {
				$def = preg_replace("/$gbid[$i3]/", "<a href=\"https://www.ncbi.nlm.nih.gov/nucleotide/$gbid[$i3]\" id='ilnk' target='_blank'>". $gbid[$i3] . "</a>", $def);
			}
		}
	}
	$rf = preg_match_all('/ref\|\K[^\|]*(?=\|)/', $def, $m3);
	if ($rf > 0) {
		for ($i4 = 0; $i4 < $rf; $i4++) {
			$rfid[$i4] = $m3[0][$i4];
		}
		$rfid = array_unique($rfid);
		$rfid = array_filter($rfid);
		$rfid = array_values($rfid);
		if (!empty($rfid)) {
			$n3 = count($rfid);
			for ($i4 = 0; $i4 < $n3; $i4++) {
				$def = preg_replace("/$rfid[$i4]/", "<a href=\"https://www.ncbi.nlm.nih.gov/nuccore/$rfid[$i4]\" id='ilnk' target='_blank'>". $rfid[$i4] . "</a>", $def);
			}
		}
	}
	$sp = preg_match_all('/sp\|\K[^\|]*(?=\|)/', $def, $m4);
	if ($sp > 0) {
		for ($i5 = 0; $i5 < $sp; $i5++) {
			$spid[$i5] = $m4[0][$i5];
		}
		$spid = array_unique($spid);
		$spid = array_filter($spid);
		$spid = array_values($spid);
		if (!empty($spid)) {
			$n4 = count($spid);
			for ($i5 = 0; $i5 < $n4; $i5++) {
				$def = preg_replace("/$spid[$i5]/", "<a href=\"http://www.uniprot.org/uniprot/" . array_shift(explode('.', $spid[$i5])) . "\" id='ilnk' target='_blank'>". $spid[$i5] . "</a>", $def);
			}
		}
	}
	return $def;
}
function evfmt($Hsp_evalue) {
		$x = (float)sprintf("%.1e", $Hsp_evalue);
		if (preg_match("/e-/i", $x)) {
			$y = explode("E-", $x);
			if ($y[1] < 10) return round($y[0]) . "e-0" . $y[1];
			else return round($y[0]) . "e-" . $y[1];
		} else {
			if (preg_match("/\./", $x)) {
				if ($x * 1000 < 1): return round($x * 10000) . "e-04";
				else: return $x; endif;
			} else
				return $x . ".0";
		}
	}

?>

<fieldset>
<legend>Definition</legend>
<table align="center">
<tbody>
<tr><td>Project    </td><td><?php echo($line["ProjectName"]);?></td></tr>
<tr><td>Program    </td><td><?php print $xml->report->Report->program; ?></td></tr>
<tr><td>Version    </td><td><?php print $xml->report->Report->version; ?></td></tr>
<tr><td>Reference  </td><td><?php print $xml->report->Report->reference; ?></td></tr>
<tr><td>Database   </td><td><?php print $xml->report->Report->{'search-target'}->Target->db; ?></td></tr>
<tr><td>Query ID   </td><td><?php print $xml->report->Report->results->Results->search->Search->{'query-id'}; ?></td></tr>
<tr><td>Length     </td><td><?php print $xml->report->Report->results->Results->search->Search->{'query-len'}; ?></td></tr>
<tr><td>Matrix     </td><td><?php print $xml->report->Report->params->Parameters->matrix; ?></td></tr>
<tr><td>E-value    </td><td><?php print $xml->report->Report->params->Parameters->expect; ?></td></tr>
<tr><td>Gap Open   </td><td><?php print $xml->report->Report->params->Parameters->{'gap-open'}; ?></td></tr>
<tr><td>Gap Ext.   </td><td><?php print $xml->report->Report->params->Parameters->{'gap-extend'}; ?></td></tr>
<tr><td>Filter     </td><td><?php print $xml->report->Report->params->Parameters->filter; ?></td></tr>
</tbody>
</table>
</fieldset>

<?php
if ($xml->report->Report->results->Results->search->Search->message == "No hits found"){
echo("<h1 align='center'>No hits found</h1>");
echo("<p align='center'><img src='img/bad.png' alt=''/><p>");
} else {
?>
<?php
foreach($xml->report->Report->results->Results->search->Search->hits->Hit->description->HitDescr as $itr) {
	$Iteration_iter_num = $itr->{'id'};
	$Iteration_query_ID = $itr->{'accession'};
	$Iteration_query_def = $itr->{'title'};
	$Iteration_query_len = $xml->report->Report->results->Results->search->Search->hits->Hit->len;?>
	<hr width="100%">
	<fieldset>
	<legend>Best Results</legend>	
	<table width="100%">
	<tr><td>Iteration Number: <b style="letter-spacing: 1.5px;"><?php $IntNum = def_split($Iteration_iter_num, $Iteration_query_def); print annotate($IntNum); ?></b></td></tr>
	<tr><td>Query ID:         <b style="letter-spacing: 1.5px;"><?php print $Iteration_query_ID;?></b></td></tr>
	<tr><td>Definition:       <b style="letter-spacing: 1.5px;"><?php print $Iteration_query_def; ?></b></td></tr>
	<tr><td>Length:           <b style="letter-spacing: 1.5px;"><?php print $Iteration_query_len; ?></b></td></tr>
	</table>
	</fieldset>
	<hr width="100%">
	</p>
	<table width="100%">
	<tbody>
	<tr align="center">
	<th colspan="2">Sequences producing significant alignments</th>
	<th align="center">Max score</th>
	<th align="center">e-Value</th>
	</tr>
<?php
foreach($xml->report->Report->results->Results->search->Search->hits->Hit as $lst) {
	$Hit_def	 = $lst->description->HitDescr->title;
	$Hit_accession	 = $lst->description->HitDescr->accession;
	$Hsp_bit_score	 = $lst->hsps->Hsp->{'bit-score'};
	$Hsp_evalue 	 = $lst->hsps->Hsp->evalue;
			?>
<tr>
	<td align="center"><?php print "<a href='#".$Hit_accession."'>".$Hit_accession."</a>"; ?></td>
	<td><?php print def_trim($Hit_def); ?></td>
	<td align="center"><?php print (int)$Hsp_bit_score; ?></td>
	<td align="center"><?php print evfmt($Hsp_evalue); ?></td>
</tr>
	<?php
	}
	?>
		</tbody>
	</table>
	</p>
<?php
	foreach($xml->report->Report->results->Results->search->Search->hits->Hit as $algn) {
		$Hit_num = $algn->num;
		$Hit_id = $algn->description->HitDescr->id;
		$Hit_def = $algn->Hit_def;
		$Hit_accession = $algn->description->HitDescr->accession;
		$Hit_len = $algn->len;
		$Hsp_num = $algn->hsps->Hsp->Hsp_num;
		$Hsp_bit_score = $algn->hsps->Hsp->{'bit-score'};
		$Hsp_score = $algn->hsps->Hsp->score;
		$Hsp_evalue = $algn->hsps->Hsp->evalue;
		$Hsp_query_from = $algn->hsps->Hsp->{'query-from'};
		$Hsp_query_to = $algn->hsps->Hsp->{'query-to'};
		$Hsp_hit_from = $algn->hsps->Hsp->{'hit-from'};
		$Hsp_hit_to = $algn->hsps->Hsp->{'hit-to'};
		$Hsp_query_frame = $algn->hsps->Hsp->{'query-frame'};
		$Hsp_hit_frame = $algn->hsps->Hsp->{'hit-frame'};
		$Hsp_identity = $algn->hsps->Hsp->{'identity'};
		$Hsp_positive = $algn->hsps->Hsp->{'positive'};
		$Hsp_gaps = $algn->hsps->Hsp->{'gaps'};
		$Hsp_align_len = $algn->hsps->Hsp->{'align-len'};
		$Hsp_qseq = $algn->hsps->Hsp->{'qseq'};
		$Hsp_midline = $algn->hsps->Hsp->{'midline'};
		$Hsp_hseq = $algn->hsps->Hsp->{'hseq'};
		$hit = $itr->Iteration_hits;
		?>
		<p id="ops">
		<table id="hits" align="center">
			<tbody>
				<tr><th><?php print "Hit Number: " . $Hit_num . ", Accession Number: <span id='" . $Hit_accession . "'>" . $Hit_accession; ?></span></th></tr>
				<tr><td><?php $sdef = def_split($Hit_id, $Hit_def); print annotate($sdef); ?></td></tr>
				<tr><td><?php print "Length = ". $Hit_len . ", Score =  " . (int)$Hsp_bit_score . " bits (" . $Hsp_score . "), Expect = " . evfmt($Hsp_evalue) . ",<br>Identities = " . $Hsp_identity . "/" . $Hsp_align_len . " (" . (int)(($Hsp_identity/$Hsp_align_len)*100) . "%), Positives = " . $Hsp_positive . "/" . $Hsp_align_len . " (" . (int)(($Hsp_positive/$Hsp_align_len)*100) . "%), Gaps = ". $Hsp_gaps . "/" . $Hsp_align_len . " (" . (int)(($Hsp_gaps/$Hsp_align_len)*100) . "%)"; ?></td></tr>
				<tr><td><pre id="algfmt"><?php fmtprint($Hsp_align_len, $Hsp_qseq, $Hsp_query_from, $Hsp_query_to, $Hsp_midline, $Hsp_hseq, $Hsp_hit_from, $Hsp_hit_to); ?></pre></td></tr>
			</tbody>
		</table>
		</p>
	<?php 
	}
	?>		
<table align="center" width="75%">
<tr><td align="center" colspan="2"><h2>Statistics</h2></td></tr>
<tr><td align="">Number of Sequences:</td><td><b><?php print $xml->report->Report->results->Results->search->Search->stat->Statistics->{'db-num'};?></b></td></tr>
<tr><td>Length of database:</td><td><b><?php print $xml->report->Report->results->Results->search->Search->stat->Statistics->{'db-len'}; ?></b></td></tr>
<tr><td>Length adjustment: </td><td><?php print $xml->report->Report->results->Results->search->Search->stat->Statistics->{'hsp-len'}; ?></td></tr>
<tr><td>Effective search space: </td><td><?php print $xml->report->Report->results->Results->search->Search->stat->Statistics->{'eff-space'}; ?></td></tr>
<tr><td>Kappa (&kappa;)</td><td><?php print $xml->report->Report->results->Results->search->Search->stat->Statistics->kappa; ?></td></tr>
<tr><td>Lambda (&lambda;)</td><td><?php print $xml->report->Report->results->Results->search->Search->stat->Statistics->lambda; ?></td></tr>
<tr><td>Entropy (H)</td><td><?php print $xml->report->Report->results->Results->search->Search->stat->Statistics->entropy; ?></td></tr>
<tr><td>Hits</td><td><?php $Number_Hits = $xml->report->Report->results->Results->search->Search->hits->Hit->count(); echo($Number_Hits); ?></td></tr>

	
<?php
}}
?>
</body>
</html>
