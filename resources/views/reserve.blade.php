
@include ("navbar")
<div id = 'color-overlay'>
	
</div>
@include ("styles")
<html>
<div class ='ui container' style='padding-top:75px'>
	@include ("modals")
	<div class ='ui card' style ='opacity:0.9;display:none;width:100%'>
		<div class ='content header' align ='center'>
			Available schedule this <strong>{{ $currenttime }}</strong>
		</div>
		<div class ='card-body' align ='center'>
			<div class ='ui centered grid'>
				@foreach($results as $result)
				<div class ='five wide column'>
					<div class ='ui card'>
						<div class ='content'>
							<p style ='text-align:center'>
								<i class ='fa fa-tv' style = 'font-size:12.25em;padding:15px;'></i>
								<p id ='labname'style ='position:absolute;top:50;left:65;font-size:5em'>{{$result->lab_name}}</p>
							</p>
							<button  class ='ui fluid positive button check' value = '{{ $result->lab_id }}'>Check availability
							</button>
						</div>
					</div>
				</div>
				@endforeach

			</div>

		</div>
	</div>
</div>


</html>
@include ("scripts")
<script>
	$(document).ready(function(){
		$('div.card').fadeIn(800)
		$('.check').click(function(e){
			e.preventDefault()
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			var labname = $(this).closest('div.content').find('#labname').html()
			$.ajax({
				url: '/uefreelab/public/getschedule',
				type:'POST',
				data:{
					lab_id: $(this).attr('value')
				},
				success:function(html){
					console.log(html)
					$('tbody').empty()
					html.forEach(function(e){
						var status = (e['status']==0)?"Available":"Not available"
						var color = (e['status']==0)? "positive":"negative"
						var disabled = (e['status']==0)?"" :"disabled"
						if(e['lab_capacity'] - e['reserve_count'] > 0){
							$.ajax({
								type:"POST",
								url:"/uefreelab/public/getterminals",
								data:{id: e['lab_id'], reserved_lab_id: e['reserved_lab_id']},
								success:function(html){
									$('tbody').append(`
										<tr class ='${color}'>
										<td>${e['time_in']}</td>
										<td>${e['time_out']}</td>
										<td>${status}</td>
										<td>${e['schedule']}</td>
										<td>${e['lab_capacity'] - e['reserve_count']}</td>
										<td class ='center aligned'><form method ='post'>
										<select class ='ui dropdown' style ='margin-right:10px'name ='terminal'>
										${html}
										</select>	
										<input type ='hidden' name ='_token' value = '${$('meta[name=csrf-token]').attr('content')}'
										<input type ='hidden' name ='lab_id' value = '${e['lab_id']}'>
										<input type ='hidden' name ='reserved_lab_id' value ='${e['reserved_lab_id']}'>
										<input type ='hidden' name = 'timein' value = '${e['time_in']}'>
										<input type ='hidden' name = 'timeout' value = '${e['time_out']}'>
										<button type ='submit' ${disabled} name ='submit' class ='ui primary button'>Occupy</button>
										</form></td>
										</tr>`)
								},
								error:function(html){
									console.log(html)
								}
							})
						}
					
				})
					$('#roomsModal').modal('show');
					$('.modal-title').html(`Assigned schedule for ${labname}`)
				},
				error:function(html){
					console.log(html)
				}
			})
		})
	})
</script>
