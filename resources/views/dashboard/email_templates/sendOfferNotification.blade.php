@include('inc.header')


<div class="page has-sidebar-left  height-full company-crete">
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-database"></i>
                        Send Email Offer Notification
                    </h4>
                </div>
            </div>
            <div class="row justify-content-between">
                <ul class="nav nav-material nav-material-white responsive-tab" id="v-pills-tab" role="tablist">
                    <li>
                        <a class="nav-link active"  href="{{url('dashboard/email-offer-notificaton')}}"><i class="icon icon-home2"></i>Send Email Offer Notification</a>
                    </li>
                    
                </ul>
            </div>
        </div>
    </header>
    <div class="container-fluid animatedParent animateOnce">
        <div class="animated fadeInUpShort">
            <div class="row my-3">
                <div class="col-md-7  offset-md-2">
                    {!! Form::open(['url' => 'dashboard/send-email-offer-notification', 'method'=>'POST', 'enctype' =>'multipart/form-data', ' novalidate', 'class' => 'needs-validation'])!!}
                        <div class="card no-b  no-r">
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <h5 class="card-title">About Email Notification</h5>
                                        <div class="form-row mt-1">
                                            <div class="form-group col-12 m-0">
                                                
                                                {!! Form::label('role', 'Role', ['class' => 'col-form-label s-12'], false) !!}
                                                {!! Form::select('role', [0 => 'Workers', 1 => 'Personal', 2 => 'Companies'], '',  ['class' => "form-control r-0 light s-12", 'placeholder' => 'Role', 'id' => 'role', 'required' => 'required'])!!}
                                            
                                                <div class="valid-feedback">
                                                    Looks Good
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please select a Role
                                                </div>
                                            </div>
                                            <div class="form-group col-12 m-0">
                                                
                                                {!! Form::label('emails', 'Emails', ['class' => 'col-form-label s-12'], false) !!}
 
                                                <select id="emails" class="form-control  r-0 light s-12" name="emails[]" multiple required="required">
                                                          <!-- <option data-display="Select">Nothing</option>
														<option value="1">Some option</option>
														<option value="2">Another option</option>
														<option value="3">A disabled option</option>
														<option value="4">Potato</option> -->
                                              </select> 
                
                                                <div class="valid-feedback">
                                                    Looks Good
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please select a Valid User
                                                </div>
                                            </div>
                                            <div class="form-group col-12 m-0">
                                                
                                                {!! Form::label('template', 'Email Template', ['class' => 'col-form-label s-12'], false) !!}
                                                <select class="form-control  r-0 light s-12" name="template" required="
                                                required">
                                                <option value="">Select Template</option>
                                                @foreach ($template as $value)
                                                <option value="{{ $value->id }}"> 
                                                 {{ $value->title }} 
                                               </option>
                                               @endforeach    
                                              </select> 
                
                                                <div class="valid-feedback">
                                                    Looks Good
                                                </div>
                                                <div class="invalid-feedback">
                                                    Please select an email template
                                                </div>
                                            </div>
                                            
                                        </div>   
                                       
                                    </div>
                                </div>
                            </div>
                        <hr>
                        <div class="card-body">
                            {!! Form::submit('Send Email', ['class' => "btn btn-primary btn-lg"]) !!}
                        </div>
                    </div>
                {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        
    $('#role').on('change', function() {
        var roleID = $(this).val();
            if(roleID) {
            $.ajax({
                url: "{{url('/dashboard/getuser/')}}/"+encodeURI(roleID),
                type: "GET",
                dataType: "json",
                success:function(data) {
                    /*alert(JSON.stringify(data));*/
                $('#emails').empty();
                $.each(data, function(key, value) {
                    var optionName = '';
                    if(value.name){
                        optionName = value.email;
                    }else{
                        optionName = value.email;
                    }
                    $('#emails').append('<option value="'+ value.email +'">'+ optionName +'</option>');
                    });
                }
            });
            }else{
            $('#emails').empty();
              }
           });
        });
    </script>
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();

</script>

@include('inc.right-sidebar')
</div>

<script src={{asset("public/js/app.js")}}></script>
<script>
$(document).ready(function() {
    $('select').select2({
	minimumResultsForSearch: -1,
	width: '100%',
	});
});
</script>
</body>
</html>

