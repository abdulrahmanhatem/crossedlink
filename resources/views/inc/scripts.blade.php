

<script src={{asset("/public/js/backend-app.js")}}></script>

@auth
    {!! Form::open(['action'=> ['ProfileController@last_seen', auth()->user()->id], 'method'=>'POST', 'enctype' =>'multipart/form-data', 'class' => 'd-none', 'id' => 'last_seen_form' ])!!}
        <input type="text" name="last_seen" hidden="hidden">
        {{-- {!! Form::hidden('_method', 'PUT')!!} --}}
    </form>
    <script type="text/javascript">
   /* $(document).ready(function(){
        

        $(document).on('click','body *, div *, section *, form *',function(){

            $("#last_seen_form").first().submit(function(e) {
                console.log($(this).serialize())
                e.preventDefault();
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: "{{asset('last_seen/'. auth()->user()->id)}}" ,
                    method:"POST",  
                    cache: false,
                    data: $(this).serialize(),                              
                    success: function(data){
                        if( data ) { 
                            console.log('Okay');
                        } 
                    },
                    error: function(jqXhr, json, errorThrown){ // this are default for ajax errors 
                    }
                });
            });

            $("#last_seen_form").submit();
          
        });
      
    }); */
    </script>
@endauth

<!--
--- Footer Part - Use Jquery anywhere at page.
--- http://writing.colin-gourlay.com/safely-using-ready-before-including-jquery/
-->
