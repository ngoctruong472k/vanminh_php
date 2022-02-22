<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8">
<style>
#box_cont {
	margin: 0px;
	padding: 0px;
	font-size:20px;
	color:#323232;
	font-family:Arial, Helvetica, sans-serif;
	background: #999;
	line-height: 1;
}
#box_cont * {
	margin: 0px;
	padding: 0px;
	outline: none;
	list-style: none;
	text-decoration: none;
	font-size:20px;
	color:#323232;
	font-family:Arial, Helvetica, sans-serif;
}
 #box_cont h1, #box_cont h2{
	font-size:100px;
	color: #A05A00;
	text-shadow:1px 1px 0px #f2f2f2, 1px 2px 0px #b1b1b2;
	margin-bottom: 20px;
}
 #box_cont h2{
	font-size:35px;
	padding-bottom:20px;
	color:#323232;
}
#box_cont p{
	font-size:20px;
	color:#323232;
	padding-bottom:20px;
	line-height:25px;
}
#box_cont a{
	font-size:20px;
	color:#F60;
}
#box_cont a:hover{
	text-decoration:underline;
}
#box_cont {
	width:100%;
	height: auto;
	background:#FFF;
	padding:150px 50px;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
	border-radius: 10px;
	-webkit-border-radius: 10px;
	-moz-border-radius: 10px;
	margin: auto;
	-webkit-animation: rubberBand .5s;
	-moz-animation: rubberBand .5s;
	-o-animation: rubberBand .5s;
	animation: rubberBand .5s;
}
@-webkit-keyframes rubberBand{0%{-webkit-transform:scale3d(1,1,1);transform:scale3d(1,1,1)}30%{-webkit-transform:scale3d(1.25,.75,1);transform:scale3d(1.25,.75,1)}40%{-webkit-transform:scale3d(0.75,1.25,1);transform:scale3d(0.75,1.25,1)}50%{-webkit-transform:scale3d(1.15,.85,1);transform:scale3d(1.15,.85,1)}65%{-webkit-transform:scale3d(.95,1.05,1);transform:scale3d(.95,1.05,1)}75%{-webkit-transform:scale3d(1.05,.95,1);transform:scale3d(1.05,.95,1)}100%{-webkit-transform:scale3d(1,1,1);transform:scale3d(1,1,1)}}@keyframes rubberBand{0%{-webkit-transform:scale3d(1,1,1);transform:scale3d(1,1,1)}30%{-webkit-transform:scale3d(1.25,.75,1);transform:scale3d(1.25,.75,1)}40%{-webkit-transform:scale3d(0.75,1.25,1);transform:scale3d(0.75,1.25,1)}50%{-webkit-transform:scale3d(1.15,.85,1);transform:scale3d(1.15,.85,1)}65%{-webkit-transform:scale3d(.95,1.05,1);transform:scale3d(.95,1.05,1)}75%{-webkit-transform:scale3d(1.05,.95,1);transform:scale3d(1.05,.95,1)}100%{-webkit-transform:scale3d(1,1,1);transform:scale3d(1,1,1)}}
</style>
<title>404 - <?=_khongtimthayduonglink?></title>
<body>
<div id="box_cont"><center>
<h1>404 Page</h1>
<p><?=_trangcuabankhongtontai?></p>
<p><?=_bancothe?> <a href="javascript:history.go(-1)" title="<?=_quaylai?>"><?=_quaylai?></a>,
<?=_hoacve?> <a href="./"><?=_trangchu?></a> <?=_cuachungtoi?>.</p>
</center></div>
</body>
</html>