@include ("styles")
<div class="ui top fixed menu" style ='margin-bottom:50px; margin-top:0px;'>
	<div class ='header item'>
		Welcome
	</div>

	<div class ='right menu'>
		@if (isset($navbar))
		<a class ='ui item' href = '/uefreelab/public/'>Home</a>
		@elseif (isset($home))
		<a class ='ui item' href ='login'><i class ='user icon'></i>Admin</a>
		@elseif (isset($role))
		<a class ='ui item' href = '/uefreelab/public/dashboard/logout'>Logout</a>
		@elseif (isset($terminal))
		<a class ='ui item'><b>{{$terminal}}</b></a>
		@endif
	</div>

</div>