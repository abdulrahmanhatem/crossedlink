
<script src="{{asset('assets/js/jquery.min.js')}}" ></script>
<script src="{{ asset('public/vue/js/app.js') }}" ></script>

<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}" ></script>
<script src="{{asset('assets/js/jquery.easing.min.js')}}" ></script>
<script src="{{asset('assets/js/plugins.js')}}" ></script>

<!-- Data Picker -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr" ></script>
<!-- selectize js -->
<script src="{{asset('assets/js/selectize.min.js')}}" ></script>
<script src="{{asset('assets/js/jquery.nice-select.min.js')}}" ></script>
{{--
<script src="{{asset('assets/js/owl.carousel.min.js')}}" ></script>
--}}

<script src="{{asset('assets/js/custom.js')}}" ></script>
<!-- Type aheaed -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput-angular.min.js" type="text/javascript" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js" type="text/javascript" ></script>


<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js" ></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js" ></script>


<!-- Bootstrap Multi Select -->
<script src="{{asset('assets/js/bootstrap-multiselect.js')}}" ></script>


<!-- Application Scripts -->
<script src="{{asset('assets/js/app.js')}}" ></script>
<script src="{{asset('assets/js/home.js')}}" ></script>



@if (Config::get('app.locale') == 'ar')
<script type="text/javascript">

    $(document).ready(function() {
        $.fn.selectpicker.Constructor.DEFAULTS.noneSelectedText = 'لم يتم الإختيار';
        $('#countries').multiselect(
            {
                enableFiltering: true,
                enableCaseInsensitiveFiltering: true,
                filterPlaceholder: 'إختر الدول',
                nonSelectedText: 'لم يتم الإختيار!',
                buttonText: function(options, select) {
                    if (options.length === 0) {
                        return 'الدول';
                    }
                    else if (options.length > 3) {
                        return 'أكثر من ثلاث دول!';
                    }
                    else {
                        var labels = [];
                        options.each(function() {
                            if ($(this).attr('label') !== undefined) {
                                labels.push($(this).attr('label'));
                            }
                            else {
                                labels.push($(this).html());
                            }
                        });
                        return labels.join(', ') + '';
                    }
                }
            }
           
        );
    });
    
    $(document).ready(function() {
        $('#example-getting-started').multiselect(
            {
                enableFiltering: true,
                enableCaseInsensitiveFiltering: true,
                nonSelectedText: 'لم يتم الإختيار!',
                filterPlaceholder: 'اختر الدور الوظيفي الخاص بك',
                onChange: function(option, checked) {
                    // Get selected options.
                    var selectedOptions = $('#example-getting-started option:selected');
    
                    if (selectedOptions.length >= 3) {
                        // Disable all other checkboxes.
                        var nonSelectedOptions = $('#example-getting-started option').filter(function() {
                            return !$(this).is(':selected');
                        });
    
                        nonSelectedOptions.each(function() {
                            var input = $('input[value="' + $(this).val() + '"]');
                            input.prop('disabled', true);
                            input.parent('li').addClass('disabled');
                        });
                    }
                    else {
                        // Enable all checkboxes.
                        $('#example-getting-started option').each(function() {
                            var input = $('input[value="' + $(this).val() + '"]');
                            input.prop('disabled', false);
                            input.parent('li').addClass('disabled');
                        });
                    }
                }
            }
        );
        $('#example-getting-started').on('change',function(){
            console.log($('#example-getting-started .active').val());
        });
        
    });
    
    
</script>
@else 
<script type="text/javascript">
    $(document).ready(function() {
        $('#countries').multiselect(
            {
                enableFiltering: true,
                enableCaseInsensitiveFiltering: true,
                filterPlaceholder: 'Search for Countries...',
                buttonText: function(options, select) {
                    if (options.length === 0) {
                        return 'Countries...';
                    }
                    else if (options.length > 3) {
                        return 'More than 3!';
                    }
                    else {
                        var labels = [];
                        options.each(function() {
                            if ($(this).attr('label') !== undefined) {
                                labels.push($(this).attr('label'));
                            }
                            else {
                                labels.push($(this).html());
                            }
                        });
                        return labels.join(', ') + '';
                    }
                }
            }
        );
    });
    
    $(document).ready(function() {
        $('#example-getting-started').multiselect(
            {
                enableFiltering: true,
                enableCaseInsensitiveFiltering: true,
                nonSelectedText: 'Select Your job Role',
                filterPlaceholder: 'Select Your job Role',
                onChange: function(option, checked) {
                    // Get selected options.
                    var selectedOptions = $('#example-getting-started option:selected');
    
                    if (selectedOptions.length >= 3) {
                        // Disable all other checkboxes.
                        var nonSelectedOptions = $('#example-getting-started option').filter(function() {
                            return !$(this).is(':selected');
                        });
    
                        nonSelectedOptions.each(function() {
                            var input = $('input[value="' + $(this).val() + '"]');
                            input.prop('disabled', true);
                            input.parent('li').addClass('disabled');
                        });
                    }
                    else {
                        // Enable all checkboxes.
                        $('#example-getting-started option').each(function() {
                            var input = $('input[value="' + $(this).val() + '"]');
                            input.prop('disabled', false);
                            input.parent('li').addClass('disabled');
                        });
                    }
                }
            }
        );
        $('#example-getting-started').on('change',function(){
            console.log($('#example-getting-started .active').val());
        });
        
    });
    
</script>

@endif

<script type="text/javascript">
    $(document).ready(function() {
        $('#example-getting-started').multiselect({
           
        });
        });
        if (Notification.permission === "granted") {
    // If it's okay let's create a notification
                $('.notify').hide();
  }
      function notifyMe() {
      
  // Let's check if the browser supports notifications
  if (!("Notification" in window)) {
    alert("This browser does not support desktop notification");
  }

  // Let's check whether notification permissions have already been granted
  else if (Notification.permission === "granted") {
    // If it's okay let's create a notification
                $('.notify').hide();
  }

  // Otherwise, we need to ask the user for permission
  else if (Notification.permission !== "denied") {
    Notification.requestPermission().then(function (permission) {
      // If the user accepts, let's create a notification
      if (permission !== "granted") {
                 alert("You can allow notifications from browser permissons ");
      }
    });
  }else{

                 alert("You can allow notifications from browser permissons ");
      
  }

  // At last, if the user has denied notifications, and you 
  // want to be respectful there is no need to bother them any more.
}

</script>

<script type="text/javascript">
    // Get the reference to the input field
    var elt = $('#txtSkills'); 
    $('.toast').toast('show');
    
    /*var skills = new Bloodhound({
          datumTokenizer: Bloodhound.tokenizers.obj.whitespace('id'),
          queryTokenizer: Bloodhound.tokenizers.whitespace,
          remote: {
                  url: '{!!url("/")!!}' + '/api/find?keyword=%QUERY%',
                 wildcard: '%QUERY%',                
          }
    });
    skills.initialize();*/
</script>
<script type="text/javascript">
    var _smartsupp = _smartsupp || {};
    _smartsupp.key = '052ef1bc9a4c828cf72705ce223b756bca5d9934';
    window.smartsupp||(function(d) {
      var s,c,o=smartsupp=function(){ o._.push(arguments)};o._=[];
      s=d.getElementsByTagName('script')[0];c=d.createElement('script');
      c.type='text/javascript';c.charset='utf-8';c.async=true;
      c.src='https://www.smartsuppchat.com/loader.js?';s.parentNode.insertBefore(c,s);
    })(document);
</script>
<!--
--- Footer Part - Use Jquery anywhere at page.
--- http://writing.colin-gourlay.com/safely-using-ready-before-including-jquery/
-->

@auth
    {!! Form::open(['action'=> ['ProfileController@last_seen', auth()->user()->id], 'method'=>'POST', 'enctype' =>'multipart/form-data', 'class' => 'd-none', 'id' => 'last_seen_form' ])!!}
        <input type="text" name="last_seen" hidden="hidden">
        {{-- {!! Form::hidden('_method', 'PUT')!!} --}}
    </form>
    <script type="text/javascript">
        // $(document).ready(function(){
        //     $('div').click(function(){
        //         console.log('Helooo');
        //         $("#last_seen_form").submit(function(e) {
        //             var $this = $(this);
        //             e.preventDefault();
        //             $.ajax({
        //                 headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        //                 url: "{{asset('last_seen/'. auth()->user()->id)}}" ,
        //                 method:"POST",  
        //                 data: $this.serialize(),  
        //                 cache: false,    
        //                 async: false,                        
        //                 success: function(data){
        //                     console.log('Success ' + $this);
        //                 },
        //                 error: function(jqXhr, json, errorThrown){ // this are default for ajax errors 
        //                 }
        //             });
        //         });
        //         $("#last_seen_form").submit();
        //     });
        // }); 
    </script>
@endauth