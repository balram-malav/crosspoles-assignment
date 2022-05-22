<table class="table">
	<tr>
		<th>Namd</th>
		<th>Email</th>
		<th>Phone</th>
		<th>Description</th>
		<th>Image</th>
		<th>Role</th>
	</tr>
	@foreach($getEmployees as $getEmployee)
	<tr>
		
		<td>{{$getEmployee->name}}</td>
		<td>{{$getEmployee->email}}</td>
		<td>{{$getEmployee->phone}}</td>
		<td>{{$getEmployee->description}}</td>
		<td><img height="70px" width="70px" src="{{ url('/') }}//uploads/profile-image/{{$getEmployee->profile_image}}"></td>
		<td>{{getRoleName($getEmployee->role_id)}}</td>
		
	</tr>
	@endforeach
</table>