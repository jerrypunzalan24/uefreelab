
<head>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel ='stylesheet' href = "{{ asset("semantic/semantic.min.css" )}}"/>
	<link rel ='stylesheet' href = "{{ asset('font-awesome-4.7.0/css/font-awesome.min.css'  )}}"/>
  <link rel ='stylesheet' href = "{{ asset('assets/css/datatables.css'  )}}"/>
  <link rel ='stylesheet' href = "{{ asset('assets/css/dataTables.semanticui.min.css'  )}}"/>
  <link rel ='stylesheet' href = "{{ asset('assets/css/jquery.datetimepicker.min.css'  )}}"/>
  <link rel ='stylesheet' href = "{{ asset('assets/css/jquery.datetimepicker.css'  )}}"/>
<style>
body{
	font-size:1.20em;
	text-rendering: optimizeLegibility;
}
.item{
	font-size:1.15em;
}
body{
	background-image: url({{ asset("assets/img/bg.jpg")}});
	background-size:100%;
	background-attachment: fixed;
}a{
	color:inherit;
	text-decoration:none;
}
a:hover{
	color:inherit;
}
#color-overlay {
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	background-color: #2D9659;
	z-index:-1;
	/*background-color: #EC9CFF;*/
	/*	background-color: #FF768F;*/
	opacity: 0.3;
	position:fixed;
}
</style>
</head>