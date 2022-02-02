/**
 * Panel Scripts & Plugins
 */
/*require('./common');
require('jquery-ui-dist/jquery-ui');
/*require('./components/ControlSidebar');*/
/*require('./components/_ionRangeSlider');*/
/*require('./components/_select2');
 require('./components/_datetimepicker');
/*require('./components/_trumbowyg');*/
/*require('./components/_bootstrap-tagsinput');*/
/*require('./components/_fullcalendar');
require('./components/_responsiveTabs');
 require('./components/_todo');
 require('./components/_dropzone');
 require('./components/morrisCharts');
 require('./components/sparkLines');
 require('./components/echarts');
 require('./components/easyPieChart');
 require('./components/_JQVmap');
 require('./components/utils');
 require('./components/_colorpicker');
 require('./components/_toastr');
 require('./components/_stepper');*/
 // require('./components/_toastr');
 /*require('./components/_datatables');*/
 /*require('./components/floatCharts');*/
 /*require('./components/_validations');
 require('inputmask');*/

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
Vue.use(require('vue-moment'));

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('pagination', require('laravel-vue-pagination'));

Vue.component('example', require('./components/ExampleComponent.vue').default);
Vue.component('example-ar', require('./components/ExampleArComponent.vue').default);

Vue.component('badge', require('./components/badgeComponent.vue').default);
Vue.component('badge-mobile', require('./components/badgeMobileComponent.vue').default);

Vue.component('search-worker', require('./components/searchWorkerComponent.vue').default);
Vue.component('search-worker-ar', require('./components/searchWorkerComponentAr.vue').default);

Vue.component('search-job', require('./components/searchJobComponent.vue').default);
Vue.component('search-job-ar', require('./components/searchJobComponentAr.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
     el: '.not-fi-cation',
    data :{
      notifications:'',
        notifies:[]
    },
    created(){
      axios.get('https://crossedlink.com/notification/get').then(respnose=>{
        this.notifications = respnose.data;
      });

        var userId =$('meta[name="userId"]').attr('content');
        Echo.private('App.User.' + userId).notification((notification)=>{
            this.notifications.unshift(notification);
            document.getElementById('ChatAudio').play();

            Notification.requestPermission( permission => {
              let notifications = new Notification('Crossed Link', {
                body: notification.title, // content for the alert
                icon: "https://crossedlink.com/assets/images/logo-light.png" // optional image url
              });

              // link to page on clicking the notification
              notifications.onclick = () => {
                window.open(window.location.href);
              };
            });

      });
    },
});
const app2 = new Vue({
     el: '.not',
     data :{
      workers:null,
      paginate:null,
      paginate_job:null,
      jobs:null,
      key:0,
      category:0,
      check:[],
      gender:[],
      salary:[],
      education:[],
      type:[],
      expJob:[],
      updated_at:[],
      count:'',
      data:'',
      // extra:'',

      
      
    },
     created(){
        
        if ($('#request_country').length) {

            request_country =  $('#request_country').val() ;
             if (request_country !== null && request_country !== '') {
             request_country = JSON.parse(request_country);
             this.count = request_country.toString();
             // this.extra = JSON.parse(request_country);
         }
        }
        var cat = $('#request_cat').val();
         // console.log(request_country);
         if (cat !== null && cat !== '') {
             this.category = cat ;
         } 

        this.getexp();
        this.searchjobs();

     },
     methods:{
         submit() {
            let myForm = document.getElementById('candidate-form'); 
                 let formData = new FormData(myForm);

                 // need to convert it before using not with XMLHttpRequest
                 for (let [key, val] of formData.entries()) {
                   console.log(key,val);
                     if(key == 'data'){
                         
                          this.data = val;
                     }
                     if(key == 'category')
                     {

                          this.category = val;
                     }
                 }
                   this.count = this.data;
                 // if (this.extra !== '') {

                 //   this.count = this.extra +','+ this.data;
                 // }else{
                 //   this.count = this.data;

                 // }
                 // console.log(this.count);

                 this.getexp();
        },getData(page = 1){
             data = this.key;
           
                axios.get('https://crossedlink.com/workers/search/ajax?page=' + page).then(respnose=>{
                this.workers = JSON.parse(respnose.data.worker).data; //assign worker
                this.paginate = JSON.parse(respnose.data.worker); //assign worker
                console.log(this.workers);
            });
        },getJobs(event){
            axios.get('https://crossedlink.com/jobs/search/ajax').then(respnose=>{
                this.jobs = respnose.data.jobs.data; //assign jobs
                this.paginate = respnose.data.jobs; //assign jobs
                console.log(this.jobs);
            });
        },
        getexp(page=1,event){
            check = this.check;
            gender = this.gender;
            data = this.key;
            salary = this.salary;
            education = this.education;
            category = this.category;
            count = this.count;
            console.log(check);
          if(check.length > 0 || gender.length > 0 ||  data !== '' || category !== '' || salary.length  > 0 || education.length  > 0 || count.length > 0 ){
                    axios.get('https://crossedlink.com/workers/search/ajax?page='+page + '&experience='+check+'&gender='+gender+'&sorting='+data+'&salary='+salary+'&education='+education+'&category='+category+'&country='+count).then(respnose=>{
                      this.workers = JSON.parse(respnose.data.worker).data; //assign worker
                      this.paginate = JSON.parse(respnose.data.worker); //assign worker
                    console.log(this.paginate);
                });
          }
        }, searchjobs(page=1,event){
            expJob = this.expJob;
            gender = this.gender;
            salary = this.salary;
            type = this.type;
            updated_at = this.updated_at;
                axios.get('https://crossedlink.com/jobs/search/ajax?page='+page +'&experience='+expJob+'&gender='+gender+'&salary='+salary+'&type='+type+'&updated_at='+updated_at).then(respnose=>{
                this.jobs = respnose.data.jobs.data; //assign worker
                this.paginate_job = respnose.data.jobs; //assign jobs
            });
        }
     }
});
