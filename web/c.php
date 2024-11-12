<?php
var_dump($argv[1]); 
$a = 'awk简明教程 左耳朵耗子 engliish china';
preg_match_all('/[a-zA-Z]+/',$a,$m);
$b=preg_replace('/[a-zA-Z]+/','',$a);
$ka=mb_str_split(trim($b));
foreach($m[0] as $k=>$v){
	$ka[] = $v;
}
var_dump($b);
$aa = explode(' ',trim($b));
foreach($aa as $k=>$v){
	$c=mb_strlen($v)+1;
	var_dump($v);
	for($i=1;$i<$c;$i++){
    	   $g=mb_substr($v,0,$i);
	   if(!in_array($g,$ka)){
	      $ka[] = $g;
	   }	
	}
}
var_dump($ka);
$d = array();
$c = 0;
foreach($ka as $k=>$v){
	if(empty($v)){continue;}
	echo("grep '{$v}' {$argv[1]}|wc -l");	
	exec("grep '{$v}' {$argv[1]}|wc -l",$o,$n);	
        $d[$k]['name'] = $v;
	$ct = mb_strlen($v)+$o[$k];
	$d[$k]['count'] = $ct;
	$c = $c+$ct;
}

print_r($d);
print_r($c);
