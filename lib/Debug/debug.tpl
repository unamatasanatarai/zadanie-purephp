<style type="text/css">
.d-debug{
	display:block;
	border:1px solid #aaa;
	border-left:10px solid #F28500;
	font-family:Monaco,sans-serif;
	text-align: left !important;
	background-image: -webkit-gradient(linear,left top,left bottom,color-stop(0, #e0e0e0),color-stop(0.5, #fff));
	background-image: -moz-linear-gradient(center top,#e0e0e0 0,#fff 20px);
	font-size:11px;
	margin:15px;
}
.d-debug .d-header{
	color:#4467aa;
	border-bottom:1px dashed #aaa;
	padding:4px 4px 2px 10px;
}
.d-debug .d-content{
	word-wrap:break-word;
	padding:5px 4px 4px 20px;
	line-height:1.5em;
	white-space: pre;
}
</style>
<div class="d-debug">
	<div class="d-header"><strong><?php echo $title; ?></strong> [<?php echo $line; ?>]</div>
	<div class="d-content"><?php echo $content; ?></div>
</div>