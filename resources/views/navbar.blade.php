@include ("styles")
<div class="ui top fixed menu" style ='margin-bottom:50px; margin-top:0px;'>
	<div class ='header item'>
		University of the East Freelab System
	</div>

	<div class ='right menu'>
		@if (isset($navbar))
		<a class ='ui item' href = '/index/'>Home</a>
		@elseif (isset($home))
		<a class ='ui item' href ='/login'><i class ='user icon'></i>Admin</a>
		@elseif (isset($login))
		<a class ='ui item' href = '/dashboard/logout'>Logout</a>
		@endif
	</div>

</div>