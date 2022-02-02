<style>
.success_message{ 
	color: green;
	font-size: 12px;
	text-align: center;
	margin-bottom: 10px;
}
</style>
  <div class="modal-dialog modal-md subs-modal mobile-modal">
      <input type="hidden" name="_token" id="mobile-csrf-token" value="{{ Session::token() }}" />
 
    <div class="modal-content">
	    <div class="modal-header md-header">
			<h4>{{trans('main.Verify Your Phone')}}</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			   </div>
			<div class="modal-body">
			 {{ csrf_field() }}     
			<div class="row phone_number_box">
             <div class="col-md-12 col-sm-12 pb-3 view-face"> 
			  <div class="form-group">
				<input type="text" name="phone_number" id="phone_number" class="form-control"  value="" placeholder="{{trans('main.Enter Phone Number to Verify')}}"  autofocus/>
				<div class="phone_number_error" style="color:red"></div>
				<p style="color:green"><i>{{trans('main.Note: Phone should be enter with country code like. eg: +1234567876')}} </i></p>
			  </div>
            <div class="clearfix"></div>			  
			  <div class="form-group" style="">
				<!--a href="#" > Subscribe Now </a-->
				<button type="button" class="btn btn-primary send_code_verification" data-user_id="{{$user->id}}" id="" style="float:right;">
				<i class="fa fa-spinner fa-spin verification_loader" style="display:none"></i> {{trans('main.Get OTP')}}</button>
			  </div>
			  </div>
		    </div>
			
			<div class="row code_verfication_box" style="display:none">
             <div class="col-md-12 col-sm-12 pb-3 view-face">  
               <div class="success_message"></div>			 
			  <div class="form-group">
			  
				<input type="text" name="verfication_code" id="verfication_code" class="form-control"  value="" placeholder="Enter Code here from your phone"/>
				<div class="error_message1" style="color:red;font-size:12px;"></div>
				<input type="hidden" name="phone_number_code_sent" id="phone_number_code_sent" class="form-control"  value=""/>
			  </div>
            <div class="clearfix"></div>			  
			  <div class="form-group" style="">
				<!--a href="#" > Subscribe Now </a-->
				<button type="button" class="btn btn-primary code_verification" data-user_id="{{$user->id}}" id="" style="float:right;">
				<i class="fa fa-spinner fa-spin code_verification_loader" style="display:none"></i> {{trans('main.Verify')}}</button>
			  </div>
			  </div>
		    </div>
		  </div>
    </div>
  </div>
  <script>
      $(document).ready(function(){
           $('.mobile-modal .close').click(function(){
            $('.phone_verfication_modal').modal('hide')
        });
       
        $('input[name="phone"], input[name="phone_number"]').on("input", function() {
            this.value = '+' + this.value.replace(/[\D]/g,'');
        });
        
        $('input[name="phone_no"]').on("input", function() {
            this.value = this.value.replace(/[\D]/g,'');
        });
    
      
    });
  </script>
  
  