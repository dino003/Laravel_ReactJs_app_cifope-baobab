

<style type="text/css">
	.progress-example {
    display: table;
}

.progress-example div {
    display: table-row;
}

label,
progress {
    display: inline-block;
    -webkit-appearance :progress-bar;
    box-sizing: border-box;
    height: 1em;
    width: 10em;
    vertical-align: -0,2em;
    -webkit-writing-mode=horizontal-tb;
    
}


label {
    padding-right: 10px;
    text-align: right;
}

</style>
<?php
function formatBytes($bytes, $precision = 2) {
    if ($bytes > pow(1024,3)) return round($bytes / pow(1024,3), $precision)."GB";
    else if ($bytes > pow(1024,2)) return round($bytes / pow(1024,2), $precision)."MB";
    else if ($bytes > 1024) return round($bytes / 1024, $precision)."KB";
    else return ($bytes)."B";
}
   $resultat=100000000 - $total;
 ?>
<div class="row">
	<div class="col-md-3"></div>
	<div class="col-md-1">
		<img src="{{asset('assets/disque2.png')}}" width="50">
	</div>
	<div class="col-md-6">
	<div class="progress-example">
    <div>
        <font size="1">{{formatBytes($resultat)}} libre sur {{formatBytes(100000000)}}</font> 
        <progress id="file" name="file" max="100000000" value="{{$total}}">
          
        </progress>
       
    </div>
    
</div>

	</div>
</div>


