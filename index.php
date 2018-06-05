<?php

require('XLSXReader.php');

foreach(scandir('entrada') as $entrada){
	if(stripos($entrada,'xlsx')){
		$fichero = 'entrada/'.$entrada;
	}
}

$xlsx = new XLSXReader($fichero);
$tsv = "sku	price	minimum-seller-allowed-price	maximum-seller-allowed-price	quantity	fulfillment-channel	handling-time".PHP_EOL;

$sheets = $xlsx->getSheetNames();
$sheet = $xlsx->getSheetData($sheets[1]);
array_pop($sheet);

foreach ($sheet as $row) {
	$row[4] = ($row[4] > 0)?$row[4]:0;
	$tsv .= intval($row[17])."				".$row[4]."		".PHP_EOL;
}

file_put_contents('salida/actualizacion.csv',$tsv);

?>