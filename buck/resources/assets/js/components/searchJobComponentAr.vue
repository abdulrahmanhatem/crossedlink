<template>
<div class="row">
    <div class="col-lg-4 col-md-6 col-sm-12 mt-4 pt-2 job-card-container" v-for="job in jobs" v-if="job.state == 0">
        <div class="list-grid-item rounded">
            <div class="grid-item-content p-3">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item f-15">
                        <span class="badge badge-success">
                             {{job.job_type}}
                        </span>
                     </li>
                <span v-if="role == 0">
                            <!--if saved-->
                    <form action="#" @submit.prevent="favourite('#favourite'+job.id)" method="post" :id="'favourite'+job.id" class="dislike list-inline-item float-right" v-if="job.saved == 1" >
                        
                        <input type="hidden" name="saved_id" :value="job.id" >
                        <button class="non-button saved-btn" @click="favourite('#favourite'+job.id)"><i :class="'mdi mdi-heart grid-fev-icon active fav-'+job.id+'-delete'"></i></button>
                    
                    </form>
                    
                    <!--else-->
                    <form action="#" @submit.prevent="favourite('#favourite'+job.id)" method="post" :id="'favourite'+job.id" class="like list-inline-item float-right" v-else>
                        
                        <input type="hidden" name="saved_id" :value="job.id" >
                        <button name="create-fav" class="non-button feo" @click="favourite('#favourite'+job.id)" ><i class="mdi mdi-heart grid-fev-icon"></i></button>
                    
                    </form>
                </span>
                </ul>
                <a :href="'https://crossedlink.com/jobs/'+job.id">
                    <div class="grid-list-img mt-3">
                        <!--if-->
                            <img :src="'https://crossedlink.com/uploads/images/profile_images/'+job.profile_image" alt="" class="img-fluid d-block" v-if="job.profile_image !== null && job.profile_image !== ''">
                        <!--else-->
                            <img src="https://crossedlink.com/uploads/images/profile_images/default_company.jpg" alt="" class="img-fluid d-block" v-else>
                    </div>
                    <div class="grid-list-desc mt-3">
                        <h5 class="mb-1 text-dark">{{ job.title }}</h5>
                        <p class="text-muted f-14 mb-1 address">{{ job.address }}</p>
                            <p class="text-muted mb-1" v-if="job.salary_range !== null"> {{job.salary_range }}/شهر</p>
                        <p class="text-muted mb-1">
                            {{job.exp}}
                            الخبرة
                        </p>
                    </div>
                </a>
            </div>
                <div class="apply-button p-3 border-top" v-if="role == 0" >
                    <div class="job-detail rounded">
                        <form action="#" @submit.prevent="apply('#apply'+job.id)" :id="'apply'+job.id" class="unapply" v-if="job.applied == 1 && complete.length <= 0">
                            <input type="hidden" name="job_id" :value="job.id">
                            <!--<input type="submit" class="btn btn-primary btn-sm" value="Apply Now" >-->
                            <button  @click="apply('#apply'+job.id)" class="btn btn-primary btn-sm" >إلغاء التقديم</button>
                        </form>
                        <div v-else>
                            <form action="#" @submit.prevent="apply('#apply'+job.id)" :id="'apply'+job.id" class="apply" v-if="job.canApply == 1 && job.applied == 0 && complete.length <= 0">
                                <input type="hidden" name="job_id" :value="job.id">
                                <button  @click="apply('#apply'+job.id)" class="btn btn-primary btn-sm" >قدم الآن</button>
                            </form>
                            
                            <button type="button" class="btn btn-primary btn-sm" @click="toggle('#cant_apply' + job.id)" v-else>
                                قدم الآن
                            </button>

                        </div>
                    </div>
                </div>
        </div>
          <div class="modal" :id="'cant_apply' + job.id" v-if="role == 0">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">أكمل بياناتك أولا!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="close('#cant_apply' + job.id)">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        لا يمكنك التقدم للوظائف حتى تكمل معلومات ملفك الشخصي!
                        <hr>
                        <div class="clearfix"></div>
                        <span v-if="complete.length > 0">
                                <div class="text-danger" v-for="error in complete">{{ error }}</div>
                        </span>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary " @click="close('#cant_apply' + job.id)" data-dismiss="modal">إغلاق</button>
                    <a type="button" class="btn btn-primary" :href="'https://crossedlink.com/me'">ملفى</a>
                    </div>
                </div>
                </div>
            </div>  
    </div>
    <div v-else>
        <span class="m-5 empty-to-show box w-100">
                لا يوجد وظائف للعرض
                <a href= "https://crossedlink.com/post/job" v-if="role==2 || role == 1">انشر وظيفة</a>
        </span> 
    </div>
</div>
</template>

<script>

export default{
 
    props:['role','id','jobs','complete'],
    data(){
        return{
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        }
    },created()
       {
          // this.getData();
       },
       mounted(){

       },
    methods:{
      toggle(id){
          $(id).fadeIn();
        },
        close(id){

          $(id).fadeOut();
        },
        apply(id){
           if($(id).hasClass('apply')){
                  $.ajax({
                      type: "GET",
                      url: "https://crossedlink.com/operations/ajax/"+id,
                      data: $(id).serialize()+"&create-apply=''",
                      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

                      success: (response)=>{
                        console.log('done');
                          $(id).removeClass('apply').addClass('unapply');
                          $('.toast').fadeIn().removeClass('hide').addClass('show');
                          $('.toast').find(".message").text('تم التقديم على الوظيفة');
                          $(id).find("button").removeClass('btn-primary').addClass('btn-success').text('إلغاء التقديم');
                          setTimeout(function () {
                            $('.toast').fadeOut().removeClass('show').addClass('hide');
                        }, 5000);
                      }
                  });
              }else{
                  
              $.ajax({
                  type: "GET",
                  url: "https://crossedlink.com/operations/ajax",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                  data: $(id).serialize()+"&unapply-job=''",
                  success: (response)=>{
                    

                      $(id).removeClass('unapply').addClass('apply');
                      $(id).find("button").removeClass('btn-success').addClass('btn-primary').text('قدم الآن');
                      $('.toast').fadeIn().removeClass('hide').addClass('show');
                      $('.toast').find(".message").text('تم إلغاء التقديم على الوظيفة');
                      setTimeout(function () {
                        $('.toast').fadeOut().removeClass('show').addClass('hide');
                    }, 5000);
                  }
              });
            }  
        },favourite(id){
           if($(id).hasClass('dislike')){
                  $.ajax({
                      type: "GET",
                      url: "https://crossedlink.com/operations/ajax/"+id,
                      data: $(id).serialize()+"&_method=PUT&delete-saved-job=''",
                      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

                      success: (response)=>{
                  
                          $(id).removeClass('dislike').addClass('like');
                          $('.toast').fadeIn().removeClass('hide').addClass('show');
                          $('.toast').find(".message").text('إلغاء حفظ الوظيفة');
                          $(id).find("i").removeClass('active');
                          setTimeout(function () {
                            $('.toast').fadeOut().removeClass('show').addClass('hide');
                        }, 5000);
                      }
                  });
              }else{
              $.ajax({
                  type: "GET",
                  url: "https://crossedlink.com/operations/ajax",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                  data: $(id).serialize()+"&create-saved-job=''",
                  success: (response)=>{
                                      console.log($(id).serialize());

                    $(id).removeClass('like').addClass('dislike');
                      $('.toast').fadeIn().removeClass('hide').addClass('show');
                      $('.toast').find(".message").text('تم حفظ الوظيفة');
                      $(id).find("i").addClass('active');
    
                      setTimeout(function () {
                        $('.toast').fadeOut().removeClass('show').addClass('hide');
                    }, 5000);
                  }
              });
            }  
        }
        //   getData(){
        //         axios.get('https://crossedlink.com/jobs/search/ajax').then(respnose=>{
        //         this.jobs = respnose.data.jobs.data; //assign jobs
        //         console.log(this.jobs);
        //     });

        // }
    }
       
}
</script>
