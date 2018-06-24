@include ("navbar")

<!--
University of the East Freelab System
Developed by: UE CCSS R&D Unit
Lead developer: Jeremiah F. Punzalan
-->
<div id = 'color-overlay'>
	
</div>
@include ("styles")
<div class ='ui container' style='padding-top:100px'>
	<div class ='ui grid' style ='display:none'>
		<div class ='eight wide column' style ='width:100%;padding-right:0px' >
			<div class ='ui card' style ='background-color:rgba(0,0,0,0.5); border-color: #686116; color:#CAC0A7; width:80%;margin:auto;border-radius:0;margin-right:0px;' onload = 'sameheight()'id ='leftdesc'>
				<div class ='content' style ='margin-top:50px'>
					<h1 style ='font-size:2.5em'>University of the East </h1>
					<h2 style ='margin-top:0px'>Free lab system</h2>
					<p style ='text-align:justify;padding-top:30px;bottom:20%;position:absolute' >Developed by UE CCSS R&D	</p>
				</div>
			</div>
		</div>
		<div class ='eight wide column' style ='padding-left:0px'>
			<div class ='ui card' style ='opacity:0.90; width:80%;margin:auto;margin-left:0px;' id = 'rightdesc'>
				<div class="content" style ='background-color: #EDEDED'>
					<div class="header">Student Information</div>
				</div>
				<div class ='content'>
					@if (session('error')!==null)
					<div class="ui error message" style ='font-size:0.9em'>
						<i class ='close icon'></i>
						<div class="header" >Error</div> Student {{session('error')}} is already inside the lab
					</div>
					@endif
					<form method ='post' class ='ui large form'>
						@csrf
						<div class ='two fields'>
							<div class ='field '  style ='padding-right:0px'>
								<label>Firstname</label>
								<input type ='text'  name ='fname' placeholder = 'First Name' />
								<p id = 'error' style ='color:red'></p>
							</div>
							<div class ='field' style ='padding-right:0px'>
								<label>Lastname</label>
								<input type ='text' placeholder = 'Last name' name ='lname'/>
								<p id = 'error' style ='color:red'></p>
							</div>
						</div>
						<div class ='field' style ='padding-right:0px'>
							<label>Student number</label>
							<input type ='number'  name ='studentnumber' placeholder = 'Student number'/>
							<p id = 'error'style ='color:red'></p>
						</div>
						<div class ='two fields'>
							<div class ='field' style ='padding-right:0px'>
								<label>Course</label>
								<input type ='text'  name ='course' placeholder = 'Course'/>
								<p id = 'error'style ='color:red'></p>
							</div>
							<div class ='field'>
								<label>Subject assigned</label>
								<input type ='text' name ='subject' placeholder ='Use subject code'>
							</div>
						</div>
						<div class ='field'>
							<input type ='submit' class ='ui button positive fluid' name ='btnSubmit' value = 'Check schedules'/>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>		
</div>
</div>
@include ("scripts")
<script>
	$(document).ready(function(){
		$('.ui.grid').fadeIn()
		$('#leftdesc').css('height',$('#rightdesc').height())
		$('.message .close').click(function(){
			$(this).closest('.message').hide()		
			$('#leftdesc').css('height',$('#rightdesc').height())

		})
		$('form input').change(function(){
			if($(this).val() != ''){
				$(this).closest('div.field').removeClass('error')
			// $(this).closest('div.field').children().last().remove()
		}
	})
		$('form').submit(function(e){
			var valid = true
			$('form input').each(function(){
				if($(this).val() == ''){
					valid = false
					$(this).closest('div.field').addClass('error')
				// if($(this).attr('name') != 'timein'){
				// 	$(this).closest('div.field').append(`    <div class="ui pointing red basic label">
				// 		Please enter a value
				// 		</div>`)		
				// }
				// else{
				// 	$(this).closest('div.field').append(`    <div class="ui left pointing red basic label">
				// 		Please enter a value
				// 		</div>`)		
				// }
			}
		})
			if(!valid){
				e.preventDefault()
			}
		})
	})
</script>