<template>
<div>
    <div class="mt-4 p-3 card-view" v-for="worker in workers" v-if="workers.length > 0">
        <div class="row position-relative">
            <span v-if="worker.UnlockWorker == 1" v-for="req in unlock">
                    <span class="unlocked-badge"  v-if="req.worker_id == worker.id ">فتح الملف</span>
            </span>
            <div class="col-md-9">
                <div class="float-left mr-4 img-cont">
                        <img :src="'https://crossedlink.com/uploads/images/profile_images/'+worker.profile_image" alt="" class="d-block rounded" height="90" width="92" v-if="worker.profile_image !== null && worker.profile_image !== ''">
                        
                        <img src="https://crossedlink.com/uploads/images/profile_images/default.jpg" alt="" class="d-block rounded" height="90" width="92" v-else>
                </div>
                <div class="candidates-list-desc overflow-hidden job-single-meta  pt-2">
                    
                        <h5 class="mb-2 name" v-if="worker.UnlockWorker == 1">
                            <div>
                                <a :href="'https://crossedlink.com/profiles/'+worker.id" class="text-dark">{{worker.name}}</a>
                            </div>
                        </h5>
                        <h5 class="mb-2 name" v-else>
                            <div>
                                <a :href="'https://crossedlink.com/profiles/'+worker.id" class="text-dark">{{worker.name}}</a>
                            </div>
                        </h5>
                    
                    <ul class="list-unstyled">
                            <li class="text-muted" v-if="worker.category !== null" >
                                <i class="mdi mdi-account mr-1"></i>
                                    {{worker.category.name}}
                            </li>
                            <li class="text-muted" v-if="worker.city_name !== null || worker.country_name !== null">
                                <i class="mdi mdi-map-marker mr-1"></i>
                                <span v-if="worker.city_name !== null">
                                            {{worker.city_name}} ,  
                                </span>
                                <span v-if="worker.country_name !== null">
                                    
                                    {{ worker.country_name}}
                                </span>
                            </li>

                                    <li class="text-muted" v-for="(sale, index) in salary" v-if="worker.average_salary !== null && worker.average_salary == index+1">
                                        <i class="mdi mdi-currency-usd mr-1"></i>
                                        {{ sale }}/شهر
                                    </li>
                                <li class="text-muted" v-for="(exp , index) in experience" v-if="worker.experience == index+1 && worker.experience !== null" >
                                    <i class="far fa-briefcase mr-1"></i>
                                    {{ exp }}
                                </li>
                            <li class="text-muted about" v-if="worker.about !== null && worker.about !== '' ">{{ worker.about }}</li>
                    </ul>
                    <span v-if="worker.skill.length > 0">
                        <span class="text-muted">المهارات:</span>
                        <span class="skill" v-for="skill in worker.skill">{{ skill }}</span>
                    </span>
                </div>
            </div>
           <div class="col-md-3">
                <div class="candidates-list-fav-btn text-right">
                    <div class="fav-icon">
                        
                            <form @submit.prevent="" :id="'favourite'+worker.id" class="dislike" v-if="worker.favourite == 1" >
                                <input type="hidden" name="worker_id" :value="worker.id">   
                                <button class="non-button saved-btn"  @click="favourite('#favourite'+worker.id,worker.id)"><i :class="'fas fa-star fav-saved fav-'+worker.id+'-delete'"></i></button>
                            </form>
                                 <form  @submit.prevent="" :id="'favourite'+worker.id" class="like" v-else >
                                    <input type="hidden" name="worker_id" :value="worker.id">   
                                     
                                    <button name="create-fav" class="non-button feo" @click="favourite('#favourite'+worker.id,worker.id)" ><i class="fas fa-star"></i></button>
                                </form>
                        
                </div>
                
                    <div class="candidates-listing-btn mt-1" v-if="role == 1 || role == 2">
                        <a :href="'https://crossedlink.com/profiles/'+worker.id" class="btn btn-sm text-green btn-card-option" v-if="worker.UnlockWorker == 1">
                            مشاهدة
                        </a>
                        <span v-else>
                            
                        <a :href="'https://crossedlink.com/profiles/'+worker.id" class="btn btn-sm mb-1 text-green btn-card-option with-unlock" >
                            مشاهدة
                        </a>
                            <form action="https://crossedlink.com/profiles" method="post" class="w-100" enctype="multipart/form-data">
                            <input type="hidden" name="worker_id" :value="worker.id">
                            <input type="hidden" name="_token" :value="csrf">
                            <input type="submit" value=" الملف" class="btn text-red btn-sm btn-card-option" name="create-unlock">
                            </form>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div v-else>
         <span class="m-5 empty-to-show box">لا يوجد مرشحين للعرض</span>
    </div>
    </div>
</template>

<script>

export default{
    props:['unlock','role','workers','user_id'],
       
     data(){
      return {
            // workers:null, //assign worker
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            salary : [
                '1000 ريال - 1500 ريال',
                '1500 ريال - 2000 ريال',
                '2000 ريال - 2500 ريال',
                '2500 ريال - 3000 ريال',
                '3000 ريال - 3500 ريال',
                '3500 ريال - 4000 ريال',
                '4000 ريال - 4500 ريال',
                '4500 ريال - 5000 ريال',
                '5000 ريال - 6000 ريال',
                '6000 ريال وأكثر',
            ],
            experience : [
                'سنة',
                'سنتان',
                '3 سنوات',
                '4 سنوات',
                '5 سنوات',
                '6 سنوات',
                '7 سنوات',
                '8 سنوات',
                '9 سنوات',
                '10 سنوات وأكثر',
            ]
        }
      },
       created()
       {
        //   this.getData();
       },
       methods:{
      favourite(id,worker_id){
            console.log(worker_id);
            if($(id).hasClass('dislike')){
                      $.ajax({
                          type: "POST",
                          url: "https://crossedlink.com/profiles/"+this.user_id,
                          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                          data: "worker_id="+worker_id+"&_method=PUT&delete-fav=''",
                          success: (response)=>{
                              $(id).removeClass('dislike').addClass('like');
                              $('.toast').fadeIn().removeClass('hide').addClass('show');
                              $('.toast').find(".message").text('تم حذف المرشح من المفضلة!');
                              $(id).find("i").removeClass('fav-saved');
                              setTimeout(function () {
                                $('.toast').fadeOut().removeClass('show').addClass('hide');
                            }, 5000);
                          }
                      });
                  }else{
                  $.ajax({
                      type: "POST",
                      url: "https://crossedlink.com/profiles",
                      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                      data: "worker_id="+worker_id+"&create-fav=''",
                      success: (response)=>{
                        $(id).removeClass('like').addClass('dislike');
                          $('.toast').fadeIn().removeClass('hide').addClass('show');
                          $('.toast').find(".message").text('تم إضافة المرشح للمفضلة');
                          $(id).find("i").addClass('fav-saved');
        
                          setTimeout(function () {
                            $('.toast').fadeOut().removeClass('show').addClass('hide');
                        }, 5000);
                      }
                  });
                }
            }
    }
}
</script>
