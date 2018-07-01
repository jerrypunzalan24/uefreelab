
<head>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel ='stylesheet' href = "{{ asset("semantic/semantic.min.css" )}}"/>
	<link rel ='stylesheet' href = "{{ asset('font-awesome-4.7.0/css/font-awesome.min.css'  )}}"/>
  <link rel ='stylesheet' href = "{{ asset('assets/css/datatables.css'  )}}"/>
  <link rel ='stylesheet' href = "{{ asset('assets/css/dataTables.semanticui.min.css'  )}}"/>
  <link rel ='stylesheet' href = "{{ asset('assets/css/jquery.datetimepicker.min.css'  )}}"/>
  <link rel ='stylesheet' href = "{{ asset('assets/css/jquery.datetimepicker.css'  )}}"/>
<style>
.quantity::-webkit-inner-spin-button, 
.quantity::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
}
body{
	font-size:1.20em;
	text-rendering: optimizeLegibility;
}
.item{
	font-size:1.15em;
}
@font-face{
font-family:Roboto;
src:url({{asset('fonts/Roboto-Regular.ttf')}});
}
td, th{
  font-family:Roboto;
}
::-webkit-input-placeholder { /* Chrome/Opera/Safari */
  font-family:Roboto;
}
::-moz-placeholder { /* Firefox 19+ */
 font-family:Roboto;
}
:-ms-input-placeholder { /* IE 10+ */
 font-family:Roboto;
}
:-moz-placeholder { /* Firefox 18- */
 font-family:Roboto;
}
*{
  font-family:Roboto;
}
.ui.button{
  font-family:Roboto;
}
a{
  font-family:Roboto;
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