<template>
 <div class="body">
                <div class="note-item dropdown-item d-inline-block"  v-if="notifications.length > 0" v-for="notification in notifications">
                    <div v-if="notification.data.worker">
                        <a :href="'https://crossedlink.com/profiles/'+ notification.data.worker.id" class="ml-1" v-on:click="markAsRead(notification)">
                            
                            <img  :src="'https://crossedlink.com/uploads/images/profile_images/'+ notification.data.worker.profile_image" alt="" class="img-fluid employer-avatar" v-if="notification.data.worker.profile_image !== '' && notification.data.worker.profile_image !== null">
                            <img src="https://crossedlink.com/uploads/images/profile_images/default.jpg"  alt="" class="img-fluid employer-avatar" v-else>

                            <div class="d-inline-block ml-1">{{notification.data.worker.name}}</div>
                        </a>
                        طلب عمل   لوظيفة
                        <a class="" :href="'https://crossedlink.com/jobs/'+notification.data.job.id" v-on:click="markAsRead(notification)">
                                {{notification.data.job.title}}
                        </a>
                        <small class="float-right">{{notification.created_at | moment}}</small>
                    </div>
                    <div v-if="notification.data.user">
                        <a :href="'https://crossedlink.com/profiles/'+ notification.data.user.id" class="ml-1" v-on:click="markAsRead(notification)">
                                <img  :src="'https://crossedlink.com/uploads/images/profile_images/'+ notification.data.user.profile_image" alt="" class="img-fluid employer-avatar" v-if="notification.data.user.profile_image !== '' && notification.data.user.profile_image !== null ">
                            <img src="https://crossedlink.com/uploads/images/profile_images/default.jpg"  alt="" class="img-fluid employer-avatar" v-else>
                            <div class="d-inline-block ml-1"> قام {{notification.data.user.name}} بزيارة ملفك الشخصى .</div>
                        </a>
                        <small class="float-right">{{notification.created_at | moment}}</small>
                    </div>
                    
                     <div v-if="notification.data.chat">
                        <a href="https://crossedlink.com/chat" class="ml-1" v-on:click="markAsRead(notification)">
                                <img  :src="'https://crossedlink.com/uploads/images/profile_images/'+ notification.data.chat.profile_image" alt="" class="img-fluid employer-avatar" v-if="notification.data.chat.profile_image !== '' && notification.data.chat.profile_image !== null ">
                            <img src="https://crossedlink.com/uploads/images/profile_images/default.jpg"  alt="" class="img-fluid employer-avatar" v-else>
                            <div class="d-inline-block ml-1">لديك رسالة جديدة من : {{notification.data.chat.name}} </div>
                        </a>
                        <small class="float-right">{{notification.created_at | moment}}</small>
                    </div>
                    
                     <div v-if="notification.data.jobs">
                        <a :href="'https://crossedlink.com/jobs/'+ notification.data.jobs.id" class="ml-1" v-on:click="markAsRead(notification)">
                            <div class="d-inline-block ml-1">تم نشر وظيفة جديدة   {{notification.data.jobs.title}} . </div>
                        </a>
                        <small class="float-right">{{notification.created_at | moment}}</small>
                    </div>
                </div>
                <a class="dropdown-item" v-else>
                    لا توجد اشعارات للعررض
                </a> 
</div> 
</template>

<script>
import moment from 'moment';

    export default{
       props:['notifications','notifies'],
       filters: {
          moment: function (date) {
            moment.locale('ar');
            return moment(date).fromNow();
          }
        },
        created(){
          console.log(this.notifications);  
        },
       methods:{
            markAsRead:function(notification){
                var data = {

                    id: notification.id
                };

                axios.post('https://crossedlink.com/notification/read',data).then(response=>{
                    console.log(response);
                });
            }
       ,
    }
}
</script>
