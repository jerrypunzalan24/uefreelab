
<head>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel ='stylesheet' href = "{{ asset("semantic/semantic.min.css" )}}"/>
	<link rel ='stylesheet' href = "{{ asset('font-awesome-4.7.0/css/font-awesome.min.css'  )}}"/>
  <link rel ='stylesheet' href = "{{ asset('assets/css/datatables.css'  )}}"/>
  <link rel ='stylesheet' href = "{{ asset('assets/css/dataTables.semanticui.min.css'  )}}"/>
  <link rel ='stylesheet' href = "{{ asset('assets/css/jquery.datetimepicker.min.css'  )}}"/>
  <link rel ='stylesheet' href = "{{ asset('assets/css/jquery.datetimepicker.css'  )}}"/>
  <link rel ='stylesheet' href = "{{ asset('assets/js/timepicker/jquery.timepicker.css'  )}}"/>
<style>
.quantity::-webkit-inner-spin-button, 
.quantity::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
}
.ui.form .field.error input[type=number].trans,.ui.form .field.error input[type=text].trans{
  border-color:red;
  background:rgba(0,0,0,0.5);
  color:white;
}

.ui.form .field.error input[type=number].trans:focus,.ui.form .field.error  input[type=text].trans:focus{
  border-color:red;
  background:rgba(0,0,0,0.5);
  color:white;
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
@font-face{
  font-family:Bebas;
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
	background-image: url({{ asset("assets/img/1.jpg")}});
	background-size:100%;
	background-attachment: fixed;
}a{
	color:inherit;
	text-decoration:none;
}
a:hover{
	color:inherit;
}
.trans{
  background:black;
}
.ui.form input.trans{
  background:rgba(0,0,0,0.5);
  color:white;
}
.ui.form input.trans:focus{
  background:rgba(0,0,0,0.5);
  color:white;
}
#color-overlay {
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	background: linear-gradient(-90deg, violet, green);
	z-index:-1;
	/*background-color: #EC9CFF;*/
	/*	background-color: #FF768F;*/
	opacity: 0.6;
	position:fixed;
}
</style>
</head>