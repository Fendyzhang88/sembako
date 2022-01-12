<?php 
function idr($nilai, $pecahan = 0) { 
  if($nilai < 0){
    $nilai = abs($nilai);
    return "(Rp.".number_format(floatval($nilai), $pecahan, ',', '.').")"; 
  }else{
    return "Rp.".number_format(floatval($nilai), $pecahan, ',', '.'); 
  }
  
}

function sgd($nilai, $pecahan = 2) { 
  if($nilai < 0){
    $nilai = abs($nilai);
    return "($.".number_format(floatval($nilai), $pecahan, ',', '.').")"; 
  }else{
    return "$.".number_format(floatval($nilai), $pecahan, ',', '.'); 
  }
}

function myr($nilai, $pecahan = 2) { 
  if($nilai < 0){
    $nilai = abs($nilai);
    return "(RM.".number_format(floatval($nilai), $pecahan, ',', '.').")"; 
  }else{
    return "RM.".number_format(floatval($nilai), $pecahan, ',', '.'); 
  }
}

function bilangan($nilai, $pecahan = 0) { 
  return number_format(floatval($nilai), $pecahan, ',', '.'); 
}
?>