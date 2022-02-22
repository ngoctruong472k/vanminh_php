<HTML>
<HEAD>
<TITLE>Đang chuyển trang</TITLE>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="REFRESH" content="4; url='http://<?=$domain_url?>/<?=$page_transfer?>'">
<link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300italic,400italic,700italic,400,300,700&subset=latin,vietnamese' rel='stylesheet' type='text/css'>
<style>
  body{
    background: #999 url(http://<?=$domain_url?>/pattern.png) repeat left top;
    position: relative;
  }
  .transfer {
    width:400px;
    padding:10px 30px;
    border:1px solid #666;
    background:#FFF;
    box-sizing:border-box;
    text-align:center;
    margin:30px auto;
    border-radius:10px;
    -moz-border-radius:10px;
    -webkit-border-radius:10px;
    position: absolute;
    top: 50%;
    left: 50%;
    margin-left: -200px;
    margin-top: -160px;
  }
  .transfer h3{
    font-size:16px;
    color:#000;
    display:block;
    text-align:center;
    font-weight: normal;
    font-family: 'Roboto Condensed', sans-serif;
  }
  .transfer img {
    margin:50px auto 30px;
  }
  .transfer p, .transfer p a {
    font-size:14px;
    text-decoration:none;
    color:#F60;
  }
  .transfer p:hover {
    text-decoration:underline;
  }
</style>
</HEAD>
<BODY>
<div class="transfer">
    <img src="http://<?=$domain_url?>/images/loading_page.gif" />
    <h3><?=$showtext?></h3>
    <p>(<a href="http://<?=$domain_url?>/<?=$page_transfer?>">Click vào đây nếu bạn không muốn đợi lâu </a>)</p>
</div>
</BODY>
</HTML>