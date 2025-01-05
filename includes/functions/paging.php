<style>
.pagin {
padding: 10px 0;
font:bold 11px/30px arial, serif;
}
.pagin * {
padding: 2px 6px;
color:#0A7EC5;
margin: 2px;
border-radius:3px;
}
.pagin a {
		border:solid 1px #8DC5E6;
		text-decoration:none;
		background:#F8FCFF;
		padding:6px 7px 5px;
}

.pagin span, a:hover, .pagin a:active,.pagin span.current {
		color:#FFFFFF;
		background:-moz-linear-gradient(top,#B4F6FF 1px,#63D0FE 1px,#58B0E7);
		    
}
.pagin span,.current{
	padding:8px 7px 7px;
}
.content{
	padding:10px;
	font:bold 12px/30px gegoria,arial,serif;
	border:1px dashed #0686A1;
	border-radius:5px;
	background:-moz-linear-gradient(top,#E2EEF0 1px,#CDE5EA 1px,#E2EEF0);
	margin-bottom:10px;
	text-align:left;
	line-height:20px;
}
.outer_div{
	margin:auto;
	width:600px;
}
#loader{
	position: absolute;
	text-align: center;
	top: 75px;
	width: 100%;
	display:none;
}

</style>
<?php
function paginate($reload, $page, $tpages, $adjacents) {
	$prevlabel = "&lsaquo; Prev";
	$nextlabel = "Next &rsaquo;";
	$out = '<div class="pagin green">';

	

	if($page==1) {
		$out.= "<span>$prevlabel</span>";
	} else if($page==2) {
		$out.= "<a href='".$reload."page=".($page-1)."'>$prevlabel</a>";
	}else {
		$out.= "<a href='".$reload."page=".($page-1)."'>$prevlabel</a>";

	}
	
	
	if($page>($adjacents+1)) {
		$out.= "<a href='".$reload."page=1'>1</a>";
	}
	
	if($page>($adjacents+2)) {
		$out.= "...\n";
	}

	

	$pmin = ($page>$adjacents) ? ($page-$adjacents) : 1;
	$pmax = ($page<($tpages-$adjacents)) ? ($page+$adjacents) : $tpages;
	for($i=$pmin; $i<=$pmax; $i++) {
		if($i==$page) {
			$out.= "<span>$i</span>";
		}else if($i==1) {
			$out.= "<a href='".$reload."page=$i'>$i</a>";
		}else {
			$out.= "<a href='".$reload."page=$i'>$i</a>";
		}
	}

	

	if($page<($tpages-$adjacents-1)) {
		$out.= "...\n";
	}

	

	if($page<($tpages-$adjacents)) {
		$out.= "<a href='".$reload."page=$tpages'>$tpages</a>";
	}

	

	if($page<$tpages) {
		$out.= "<a href='".$reload."page=".($page+1)."'>$nextlabel</a>";
	}else {
		$out.= "<span>$nextlabel</span>";
	}
	$out.= "</div>";
	return $out;
}
?>