<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
        <style>
            body {
                font-family: 'Nunito';
            }
        </style>
   <script type="text/javascript">
    var SITE_URL = {!! json_encode(url('/')) !!}
  </script>        
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            <form action="" method="POST" id="employeeform" enctype="multipart/form-data">
                @csrf
            <div class="row" style="margin-left: 20px;">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12 mt-3">
                         {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control', 'required' => 'required')) !!}
                         <span id="name_error" style="display: none; color: red"></span>
                        </div>
                        <div class="col-md-12 mt-3">
                             {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control' ,'required' => 'required')) !!}
                             <span id="email_error" style="display: none; color: red"></span>
                        </div>
                        <div class="col-md-12 mt-3"> 
                            {!! Form::text('phone', null, array('placeholder' => 'Phone Number','class' => 'form-control', 'required' => 'required')) !!}
                             <span id="phone_error" style="display: none; color: red"></span>
                          </div>
                        <div class="col-md-12 mt-3">
                            {!! Form::text('description', null, array('placeholder' => 'Description','class' => 'form-control', 'required' => 'required')) !!}
                            <span id="description_error" style="display: none; color: red"></span>
                        </div>
                        <div class="col-md-12 mt-3">
                          {!! Form::select('roles[]', $roles,[], array('class' => 'form-control select2')) !!}
                       </div>
                        <div class="col-md-12 mt-3">
                          <!-- {!! Form::file('uploadFile',array('class' => 'form-control')) !!} -->
                          <input type="file" name="image">
                           <span id="uploadFile_error" style="display: none;color: red"></span>
                       </div> 
                       <div class="col-md-12 mt-3">
                        <button type="submit" class="btn btn-primary employeeSubmit"><i class="uil uil-file-alt mr-1"></i> Save</button></div>  
                         <span id="success_message" style="display: none;color: green" class="mt-4">Record save successfully</span>    
                  </div>
               </div>
               <div class="col-md-6">
                 <div id="employ_list">
                   <div class="loader" style="display: none;"><img src="https://tenor.com/view/loader-gif-7427055"></div>
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
                 </div>
               </div>
            </div>
            </form>
        </div>

<script>
  $(document).ready(function(){
    $('#employeeform').submit(function(e){ 
      e.preventDefault();
    
      $('.loader').show();
    var form= $("#employeeform");
      // alert('hii');

      $.ajax({
          type: "POST",
          url: SITE_URL + "/ajax/save-employ",
          data: new FormData(this),

            contentType: false,

            processData: false,

            cache: false,
          success: function (data) {
            //console.log(data);
              if(data.status==400)
             {
                 $.each(data.error,function(key,value){
                  if(key=='name')
                  {
                    $('#name_error').css({'display':'block'});
                    $('#name_error').html(value);
                    $("#name_error").addClass('input_error');
                  }
                  if(key=='email')
                  {
                    $('#email_error').css({'display':'block'});
                    $('#email_error').html(value);
                    $("#email_error").addClass('input_error');
                  } 
                  if(key=='phone')
                  {
                    $('#phone_error').css({'display':'block'});
                    $('#phone_error').html(value);
                    $("#phone_error").addClass('input_error');
                  }
                  if(key=='description')
                  {
                    $('#description_error').css({'display':'block'});
                    $('#description_error').html(value);
                    $("#description_error").addClass('input_error');
                  } 
                  if(key=='image')
                  {
                    $('#uploadFile_error').css({'display':'block'});
                    $('#uploadFile_error').html(value);
                    $("#uploadFile_error").addClass('input_error');
                  }
                });
             }else{
                     $('#success_message').css({'display':'block'});
                     $('#employ_list').empty();
                     $('#employ_list').html(data.bladeview);
                     $('.loader').hide();
                  
                   
                   
             }
          

             }
        });
    });
});
</script>        
    </body>
</html>
