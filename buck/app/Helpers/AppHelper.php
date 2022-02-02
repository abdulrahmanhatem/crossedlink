<?php

namespace App\Helpers;
use Illuminate\Pagination\Paginator;

use Carbon\Carbon;
use App\User;
use App\Category;
use App\Country;
use App\state;
use App\City;
use App\Language;
use App\Package;
use App\Education;
use App\Skill;
use App\SavedJob;
use App\Experience;
use App\Social;
use App\Gallery;
use App\PricingRequest;
use App\JobRequest;
use App\Job;
use App\Review;
use App\UnlockWorker;
use App\FavWorker;
use App\EmailTemplate;
use App\Chat;
use Illuminate\Support\Facades\DB;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class AppHelper
{

  // club Ststem
  public static function users()
  {
    $users = User::all();
    return $users;
  }

  public static function userByID($id)
  {
    $user = User::where('id', $id)->get();
    return $user;
  }
    public static function userByIDFirst($id)
  {
    $user = User::where('id', $id)->first();
    return $user;
  }
  
  public static function checkUser($id)
  {
    $user = User::find($id);
    if($user){
      return true;
    }else{
      return false;
    }
  }

  public static function admins()
  {
    $admins = User::where('role', 3)->get();
    return $admins;
  }
  public static function employers()
  {
    $employers = User::where('role', 1)->orWhere('role', 2)->get();
    return $employers;
  }
  public static function companies()
  {
    $companies = User::where('role', 2)->get();
    return $companies;
  }
  public static function persons()
  {
    $companies = User::where('role', 1)->get();
    return $companies;
  }
  public static function workers()
  {
    $companies = User::where('role', 0)->get();
    return $companies;
  }

  public static function usersNames()
  {
    $users_id= [];
    $users_name= [];
    $recordedusers= User::all();
    $recordedusers = json_decode($recordedusers, true);
    foreach ($recordedusers as $key => $user) {
      array_push($users_id, $user['id']);
      if($user['role'] == 0){
        array_push($users_name, $user['name'] . ' Worker');
      }elseif($user['role'] == 1){
        array_push($users_name, $user['name']);
      }else{
        array_push($users_name, $user['company_name'] . ' Company');
      }
    }
    $users = array_combine($users_id, $users_name);
    asort($users);
    return $users;
  }

  public static function employersNames()
  {
    $employers_id= [];
    $employers_name= [];
    $recordedemployers= User::where('role', 1)->orwhere('role', 2)->get();
    $recordedemployers = json_decode($recordedemployers, true);
    foreach ($recordedemployers as $key => $employer) {
      array_push($employers_id, $employer['id']);
      if($employer['role'] == 1){
        array_push($employers_name, $employer['name']);
      }else{
        array_push($employers_name, $employer['company_name'] . ' Company');
      }
    }
    $employers = array_combine($employers_id, $employers_name);
    asort($employers);
    return $employers;
  }

  public static function workersNames()
  {
    $workers_id= [];
    $workers_name= [];
    $recordedworkers = User::where('role', 0)->get();
    $recordedworkers = json_decode($recordedworkers, true);
    foreach ($recordedworkers as $key => $worker) {
      array_push($workers_id, $worker['id']);
      array_push($workers_name, $worker['name']);
    }
    $workers = array_combine($workers_id, $workers_name);
    asort($workers);
    return $workers;
  }

  public static function canApply()
  {
    $workers_id= [];
    $workers_name= [];
    $recordedworkers = User::where('role', 0)->get();
    $recordedworkers = json_decode($recordedworkers, true);
    foreach ($recordedworkers as $key => $worker) {
      array_push($workers_id, $worker['id']);
      array_push($workers_name, $worker['name']);
    }
    $workers = array_combine($workers_id, $workers_name);
    asort($workers);
    return $workers;
  }

  public static function categories()
  {
    $categories = Category::all();
    return $categories;
  }
  public static function categotyByID($id)
  {
    $category = Category::find($id);
    return $category;
  }
  

  public static function companyCategories()
  {
    $categories = Category::where('role', 2)->inRandomOrder()->get();
    return $categories;
  }

  public static function companyCategories_ids()
  {
    $categories = Category::where('role', 2)->get();
    $categories = $categories->pluck('id');
    return $categories;
  }

  public static function personalCategories_ids()
  {
    $categories = Category::where('role', 1)->get();
    $categories = $categories->pluck('id');
    return $categories;
  }

  public static function companyWorkers()
  {
    $user_ids= [];
    $categories = Category::where('role', 2)->get();
    $categories = json_decode($categories, true);
    $workers = User::where('role', 0)->get();
    $workers = json_decode($workers, true);
    foreach ($categories as $key => $category) {
      foreach ($workers as $key => $worker) {
        if($worker['category_id'] == $category['id']){
          array_push($user_ids, $worker['id']);
        }
      }
    }
    $workers = User::whereIn('id',$user_ids)->paginate(15);
    return $workers;
  }
  public static function personalWorkers()
  {
    $user_ids= [];
    $categories = Category::where('role', 1)->get();
    $categories = json_decode($categories, true);
    $workers = User::where('role', 0)->get();
    $workers = json_decode($workers, true);
    foreach ($categories as $key => $category) {
      foreach ($workers as $key => $worker) {
        if($worker['category_id'] == $category['id']){
          array_push($user_ids, $worker['id']);
        }
      }
    }
    $workers = User::whereIn('id',$user_ids)->paginate(15);
    return $workers;
  }

  public static function PersonalCategories()
  {
    $categories = Category::where('role', 1)->inRandomOrder()->get();
    return $categories;
  }

    public static function categoriesShow()
  {
    $categories = Category::where('icon', '!=', '')->inRandomOrder()->get();
    return $categories;
  }

  public static function companyCategoriesShow()
  {
    $categories = Category::whereIn('role', [2, 3])->where('icon', '!=', '')->inRandomOrder()->get();
    return $categories;
  }

  public static function personalCategoriesShow()
  {
    $categories = Category::whereIn('role', [1, 3])->where('icon', '!=', '')->inRandomOrder()->get();
    return $categories;
  }
  
  public static function categoriesNames()
  {
    $categories_id= [];
    $categories_name= [];
    $recordedcategories = Category::all();
    $recordedcategories = json_decode($recordedcategories, true);
    foreach ($recordedcategories as $key => $category) {
      array_push($categories_id, $category['id']);
      if (app()->getLocale() == 'ar') {
        array_push($categories_name, $category['name_ar']);
      }else{
        array_push($categories_name, $category['name']);
      }
    }
    $categories = array_combine($categories_id, $categories_name);
    asort($categories);
    return $categories;
  }

  public static function companies_categories()
  {
    $categories_id= ['all'];
    if (app()->getLocale() == 'ar') {
      $categories_name= ['كل الفئات'];
    }else{
      $categories_name= ['All Categories'];
    }
    
    $recordedcategories = Category::whereIn('role', [2, 3])->get();
    $recordedcategories = json_decode($recordedcategories, true);
    if(app()->getLocale()== 'en'){
      foreach ($recordedcategories as $key => $category) {
        array_push($categories_id, $category['id']);
        array_push($categories_name, $category['name']);
      }
      }elseif(app()->getLocale()== 'ar'){
        foreach ($recordedcategories as $key => $category) {
          array_push($categories_id, $category['id']);
          array_push($categories_name, $category['name_ar']);
        }
    }
    
    $categories = array_combine($categories_id, $categories_name);
    asort($categories);
    return $categories;
  }

  public static function personal_categories()
  {
    $categories_id= ['all'];
    $categories_name= ['All Categories'];
    $recordedcategories = Category::whereIn('role', [1, 3])->get();
    $recordedcategories = json_decode($recordedcategories, true);
    if(app()->getLocale()== 'en'){
      foreach ($recordedcategories as $key => $category) {
        array_push($categories_id, $category['id']);
        array_push($categories_name, $category['name']);
      }
      }elseif(app()->getLocale()== 'ar'){
        foreach ($recordedcategories as $key => $category) {
          array_push($categories_id, $category['id']);
          array_push($categories_name, $category['name_ar']);
        }
    }
    $categories = array_combine($categories_id, $categories_name);
    asort($categories);
    return $categories;
  }
  

  public static function countriesNames()
  {
    $countries_id= [];
    $countries_name= [];
    $recordedCountries = Country::all();
    $recordedCountries = json_decode($recordedCountries, true);
    foreach ($recordedCountries as $key => $country) {
      array_push($countries_id, $country['name']);
      array_push($countries_name, Self::getCountryByKey($country['name']));
    }
    $countries = array_combine($countries_id, $countries_name);
    asort($countries);
    return $countries;
  }
  

  public static function employersCountries()
  {
    $countries = Country::where('role', 1)->get();
    return $countries;
  }

  public static function employers_countries()
  {
    $countries_id= [];
    $countries_name= [];
    $recordedCountries = Country::where('role', 1)->get();
    $recordedCountries = json_decode($recordedCountries, true);
    foreach ($recordedCountries as $key => $country) {
      array_push($countries_id, $country['name']);
      array_push($countries_name, Self::getCountryByKey($country['name']));
    }
    $countries = array_combine($countries_id, $countries_name);
    asort($countries);
    return $countries;
  }

  public static function workers_countries()
  {
    $countries_id= ['all'];
    $countries_name= ['All Countries'];
    $recordedCountries = Country::where('role', 0)->get();
    $recordedCountries = json_decode($recordedCountries, true);
    foreach ($recordedCountries as $key => $country) {
      array_push($countries_id, $country['name']);
      array_push($countries_name, Self::getCountryByKey($country['name']));
    }
    $countries = array_combine($countries_id, $countries_name);
    
    return $countries;
  }

  

  public static function workers_nationalities()
  {
    $nationalities_id= [];
    $nationalities_name= [];
    $recordedNationalities = Country::where('role', 0)->get();
    $recordedNationalities = json_decode($recordedNationalities, true);
    foreach ($recordedNationalities as $key => $nationality) {
      array_push($nationalities_id, $nationality['name']);
      array_push($nationalities_name, Self::getNationalityByKey($nationality['name']));
    }
    $nationalities = array_combine($nationalities_id, $nationalities_name);
    asort($nationalities);
    return $nationalities;
  }


  public static function countryCities($key)
  {
    $cities_id= [];
    $cities_name= [];
    $cities = City::where('country_id', $key)->get();
    $cities = json_decode($cities, true);
    foreach ($cities as $key => $city) {
      array_push($cities_id, $city['id']);
      array_push($cities_name, $city['name']);
    }
    $cities = array_combine($cities_id, $cities_name);
    asort($cities);
    return $cities;
  }

  public static function packages()
  {
    $packages = Package::all();
    return $packages;
  }

  public static function companies_packages()
  {
    $packages_id= [];
    $packages_name= [];
    $recordedPackages = Package::where('role', 0)->get();
    $recordedPackages = json_decode($recordedPackages, true);
    foreach ($recordedPackages as $key => $country) {
      array_push($packages_id, $country['id']);
      array_push($packages_name, $country['name']);
    }
    $packages = array_combine($packages_id, $packages_name);
    asort($packages);
    return $packages;
  }

  public static function personal_packages()
  {
    $packages_id= [];
    $packages_name= [];
    $recordedPackages = Package::where('role', 1)->get();
    $recordedPackages = json_decode($recordedPackages, true);
    foreach ($recordedPackages as $key => $country) {
      array_push($packages_id, $country['id']);
      array_push($packages_name, $country['name']);
    }
    $packages = array_combine($packages_id, $packages_name);
    asort($packages);
    return $packages;
  }

  public static function packagesNames()
  {
    $packages_id= [];
    $packages_name= [];
    $recordedPackages = Package::whereIn('role', [0,1])->get();
    $recordedPackages = json_decode($recordedPackages, true);
    foreach ($recordedPackages as $key => $country) {
      array_push($packages_id, $country['id']);
      array_push($packages_name, $country['name']);
    }
    $packages = array_combine($packages_id, $packages_name);
    asort($packages);
    return $packages;
  }

  public static function JobsNames()
  {
    $jobs_id= [];
    $jobs_name= [];
    $recordedjobs = Job::all();
    $recordedjobs = json_decode($recordedjobs, true);
    foreach ($recordedjobs as $key => $job) {
      array_push($jobs_id, $job['id']);
      array_push($jobs_name, $job['title']);
    }
    $jobs = array_combine($jobs_id, $jobs_name);
    asort($jobs);
    return $jobs;
  }
  
   public static function jobByID($id)
  {
    $job = Job::where('id', $id)->get();
    return $job;
  }


  public static function savedJobsByUser($id)
  {
    $jobs = [];
    $saved = SavedJob::where('user_id', $id)->get();
    $saved = json_decode($saved, true);
    foreach ($saved as $key => $job) {
      array_push($jobs, $job['saved_id']);
    }
    $jobs = Job::find($jobs);
    return $jobs;
  }

  

  public static function applysByUser($id)
  {
    $jobs = [];
    $applies = JobRequest::where('worker_id', $id)->get();
    $applies = json_decode($applies, true);
    foreach ($applies as $key => $job) {
      array_push($jobs, $job['job_id']);
    }
    $jobs = Job::find($jobs);
    return $jobs;
  }

  public static function applysByUserCheck($id)
  {
    $apply = JobRequest::where('worker_id', auth()->user()->id)->where('job_id', $id)->get();
    if(count($apply) > 0){
      return true;
    }else{
      return false;
    }
  }

  public static function selectedCountryCheck($country_key, $option)
  {
    foreach (Self::countries() as $key => $country){
      foreach ($selceted_country as $k => $c){
       
      }
    }  
    $ids_array = [];
    $ids_before =  str_replace('[',"",$ids) ;
    $ids_before =  str_replace(']',"",$ids_before) ;
    $ids_before = explode(",", str_replace('"',"",$ids_before)) ;
    foreach ($ids_before as $key => $id) {
      if ($option == $id) {
        return true;
      }
    }
  

    $countries = [];
    foreach (Self::countries() as $key => $country){
      foreach ($selceted_country as $k => $c){
       
      }
    }  

    if ($c == $key){
      return true;
    }else{
      return false;
    }
  }


  public static function savedJobCheck($id)
  {
    $saved = SavedJob::where('user_id', auth()->user()->id)->where('saved_id', $id)->get();
    if(count($saved) > 0){
      return true;
    }else{
      return false;
    }
  }

  public static function WorkersRequestsByEmployerID($id)
  {
    $workers = [];
    $requests = []; 
    $jobs = Job::where('employer_id', $id)->where('state', 0)->get();
    $jobs = json_decode($jobs, true);
    foreach ($jobs as $key => $job) {
      array_push($jobs, $job['id']);
    }
    $requests = JobRequest::where('job_id', $jobs)->where('state', 0)->get();
    $requests = json_decode($requests, true);

    foreach ($requests as $key => $request) {
      array_push($workers, $request['worker_id']);
    }

    $workers = User::find($workers);
    return $workers;
  }

  public static function test($id)
  {
    $workers = [];
    $requests = []; 
    $jobs = Job::where('employer_id', $id)->where('state', 0)->get();
    foreach ($jobs as $key => $job) {
      $request = $job->requests;
      array_push($requests, $request);
    }

    
    /*foreach ($requests as $key => $request) {
      array_push($workers, $request['worker_id']);
    }*/

    $workers = User::find($workers);
    return $requests;
  }
  


  public static function reviewsforEmployer($id)
  {
    $reviews = Review::where('to_id', $id)->get();
    return $reviews;
  }

  /*public static function categoriesJobs($id)
  {
    
    $jobs = Job::where('category_id', $id)->get();
    return $jobs;
  }*/

  public static function categoriesJobs($ids)
  {
    $ids_array = [];
    $ids_before =  str_replace('[',"",$ids) ;
    $ids_before =  str_replace(']',"",$ids_before) ;
    $ids_before = explode(",", str_replace('"',"",$ids_before)) ;
    foreach ($ids_before as $key => $id) {
      array_push($ids_array, $id);
    }
    $jobs = Job::whereIn('category_id', $ids_array)->inRandomOrder()->get();
    return $jobs;
  }

  public static function userCats($ids)
  {
    $ids_array = [];
    $ids_before =  str_replace('[',"",$ids) ;
    $ids_before =  str_replace(']',"",$ids_before) ;
    $ids_before = explode(",", str_replace('"',"",$ids_before)) ;
    foreach ($ids_before as $key => $id) {
      array_push($ids_array, $id);
    }
    return $ids_array;
  }

  public static function getCategoryName($id)
  {
    $category = Category::find($id);
    if($category){
      if(app()->getLocale()== 'en'){
        return $category->name;
      }elseif(app()->getLocale()== 'ar'){
        return $category->name_ar;
      }
    }
  }




  public static function userCatCheck($ids, $option)
  {
    $ids_array = [];
    $ids_before =  str_replace('[',"",$ids) ;
    $ids_before =  str_replace(']',"",$ids_before) ;
    $ids_before = explode(",", str_replace('"',"",$ids_before)) ;
    foreach ($ids_before as $key => $id) {
      if ($option == $id) {
        return true;
      }
    }
  }

  public static function categoriesJobsSearch($ids)
  {
    $ids_array = [];
    $ids_before =  str_replace('[',"",$ids) ;
    $ids_before =  str_replace(']',"",$ids_before) ;
    $ids_before = explode(",", str_replace('"',"",$ids_before)) ;
    foreach ($ids_before as $key => $id) {
      array_push($ids_array, $id);
    }
    $jobs = Job::whereIn('category_id', $ids_array);
    return $jobs;
  }

  public static function jobsByCategory($ids)
  {
   
    $jobs = Job::where('category_id', $ids)->get();
    return $jobs;
  }

  
  public static function categoriesWorkersSearch()
  {
    $categories_ids=[];
    $workers_categories_ids =[];
    $workers = User::where('role', 0)->get();
    $workers = json_decode($workers, true);
    $workers_ids = [];

    if(auth()->user()->role == 2){
      foreach (Self::companyCategories_ids() as $key => $value) {

        foreach ($workers as $w) {
          $w_ids = $w['category_id'];
          $w_ids =  str_replace('[',"",$w['category_id']) ;
          $w_ids =  str_replace(']',"",$w_ids) ;
          $w_ids = explode(",", str_replace('"',"",$w_ids)) ;
    
          foreach ($w_ids as $k => $id) {
            if ($value == $id) {
              array_push($workers_ids, $w['id']);
            }
          }
        }
      }
    }
    
    if(auth()->user()->role == 1){
      foreach (Self::personalCategories_ids() as $key => $value) {

        foreach ($workers as $w) {
          $w_ids = $w['category_id'];
          $w_ids =  str_replace('[',"",$w['category_id']) ;
          $w_ids =  str_replace(']',"",$w_ids) ;
          $w_ids = explode(",", str_replace('"',"",$w_ids)) ;
          
          foreach ($w_ids as $k => $id) {
          
            if ($value == $id) {
              array_push($workers_ids, $w['id']);
            }
          }
        }
      }
    }
    
    $workers = User::whereIn( 'id',$workers_ids);
    
    return $workers;
  }

  public static function unlocklist()
  {
    $unlock = UnlockWorker::where('employer_id', auth()->user()->id)->get();
    return $unlock;
  }

  

  public static function categoriesWorkersSearchGet()
  {
    $categories_ids=[];
    
    $workers_categories_ids =[];
    $workers = User::where('role', 0)->get();
    $workers = json_decode($workers, true);
    $workers_ids = [];

    if(auth()->user()->role == 2){
      foreach (Self::companyCategories_ids() as $key => $value) {

        foreach ($workers as $w) {
          $w_ids = $w['category_id'];
          $w_ids =  str_replace('[',"",$w['category_id']) ;
          $w_ids =  str_replace(']',"",$w_ids) ;
          $w_ids = explode(",", str_replace('"',"",$w_ids)) ;
    
          foreach ($w_ids as $k => $id) {
            if ($value == $k) {
              array_push($workers_ids, $w['id']);
            }
          }
        }
      } 
    }

    
    if(auth()->user()->role == 1){
      foreach (Self::personalCategories_ids() as $key => $value) {

        foreach ($workers as $w) {
          $w_ids = $w['category_id'];
          $w_ids =  str_replace('[',"",$w['category_id']) ;
          $w_ids =  str_replace(']',"",$w_ids) ;
          $w_ids = explode(",", str_replace('"',"",$w_ids)) ;
    
          foreach ($w_ids as $k => $id) {
            if ($value == $k) {
              array_push($workers_ids, $w['id']);
            }
          }
        }
      }
    }
    
    $workers = User::whereIn( 'id',$workers_ids)->inRandomOrder()->get();
    
    return $workers;
  }

  public static function categoriesWorkersSearchByOne($cat)
  {
    $categories_ids=[];
    $workers_categories_ids =[];
    $workers = User::where('role', 0)->get();
    $workers = json_decode($workers, true);
    $workers_ids = [];

      foreach ($workers as $w) {
        $w_ids = $w['category_id'];
        $w_ids =  str_replace('[',"",$w['category_id']) ;
        $w_ids =  str_replace(']',"",$w_ids) ;
        $w_ids = explode(",", str_replace('"',"",$w_ids)) ;
  
        foreach ($w_ids as $k => $id) {
         
          /*array_diff_key();*/
          if ($cat == $id) {
            /*array_diff($workers_ids, [$w['id']]);*/
            array_push($workers_ids, $w['id']);
          }
        }
      }
    
    $workers = User::whereIn( 'id',$workers_ids);
   
    return $workers;
  }

  public static function PricingRequesAll()
  {
    $packages = PricingRequest::all();
    return $packages;
  }

  public static function PricingRequesPending()
  {
    $requests = PricingRequest::where('state', 0)->get();
    return $requests;
  }

  public static function jobs()
  {
    $jobs = Job::all();
    return $jobs;
  }

  public static function jobRequestsAll()
  {
    $requests = JobRequest::all();
    return $requests;
  }

  public static function reviews()
  {
    $reviews = Review::all();
    return $reviews;
  }

  /*public static function cities()
  {
    $cities = City::all();
    return $cities;
  }*/
  

  public static function educations()
  {
    $educations = Education::all();
    return $educations;
  }

  public static function skills()
  {
    $skills = Skill::all();
    return $skills;
  }

  public static function experiencesAll()
  {
    $experiences = Experience::all();
    return $experiences;
  }

  public static function socials()
  {
    $socials = Social::all();
    return $socials;
  }

  public static function savedJobs()
  {
    $savedJobs = SavedJob::all();
    return $savedJobs;
  }

  public static function usersByEducationalLevel( $levels){
    $users = [];
    
    $educations = Education::whereIn('level', $levels)->get();
    $educations = json_decode($educations, true);
    $users_id = []; 
    
    foreach($educations as $education){
      foreach ($levels as $key => $level) {
        if($education['level'] == $level){
          array_push($users_id, $education['user_id']);
        }
      }
    }

    $users = User::whereIn('id', $users_id)->get();      
    return $users;
  }

  /*public static function usersBySkill($skill){
    $users = [];
    $skills = Skill::where('name', $skill)->get();
    $skills = json_decode($skills, true);
    $users_id = []; 

    foreach($skills as $skill){
      if($skill['name'] == $skill){
        array_push($users_id, $skill['user_id']);
      }
    }
    $users = User::find($users_id);
    return $users;
  }*/

  public static function usersBySkill($level){
    $users = [];
    $educations = Skill::where('name', $level)->get();
    $educations = json_decode($educations, true);
    $users_id = []; 

    foreach($educations as $education){
      if($education['name'] == $level){
        array_push($users_id, $education['user_id']);
      }
    }
    $users = User::find($users_id);
    return $users;
  }

  public static function unblockList($id){
    $users = [];
    $unblock = UnlockWorker::where('employer_id', $id)->get();
    $unblock = json_decode($unblock, true);
    $users_id = []; 

    foreach($unblock as $req){
        array_push($users_id, $req['worker_id']);
    }
    $users = User::whereIn('id',$users_id)->orderBy('created_at', 'DESC')->paginate(15);
    return $users;
  }

  public static function favList($id){
    $users = [];
    $unblock = FavWorker::where('employer_id', $id)->get();
    $unblock = json_decode($unblock, true);
    $users_id = []; 

    foreach($unblock as $req){
        array_push($users_id, $req['worker_id']);
    }
    $users = User::whereIn('id',$users_id)->orderBy('created_at', 'DESC')->paginate(15);
    return $users;
  }

  public static function unlockCheck($id){
    $unlocked = UnlockWorker::where('employer_id', auth()->user()->id)->where('worker_id', $id)->first();
    if($unlocked){
      return true;
    }else{
      return false;
    }
  }

  public static function favCheck($id){
    $unlocked = FavWorker::where('employer_id', auth()->user()->id)->where('worker_id', $id)->first();
    if($unlocked){
      return true;
    }else{
      return false;
    }
  }

  public static function myPackage(){
    $pricing = PricingRequest::where('user_id', auth()->user()->id)->where('state', 1)->whereIn('role', [1,2])->first();
    $pricing = json_decode($pricing, true);
    $myPackage_id = [];
    if(!empty($pricing) ){
      array_push($myPackage_id, $pricing['package_id']);
      $myPackage = Package::find($myPackage_id);
      return $myPackage;
    }else{
      return [];
    }
  }

  public static function myExtentions(){
    $pricing = PricingRequest::where('user_id', auth()->user()->id)->where('state', 1)->whereIn('role', [3,4])->get();
    $pricing = json_decode($pricing, true);
    $myPackages_id = [];
    
    if(!empty($pricing) ){
      foreach ($pricing  as $key => $ex) {
        array_push($myPackages_id, $ex['package_id']);
      }
      
      $myPackage = Package::find($myPackages_id);
      return $myPackage;
    }else{
      return [];
    }
  }

  public static function userPackage($id){
    $pricing = PricingRequest::where('user_id', $id)->where('state', 1)->first();
    $pricing = json_decode($pricing, true);
    $myPackage_id = [];
    if(!empty($pricing) ){
      array_push($myPackage_id, $pricing['package_id']);
      $myPackage = Package::find($myPackage_id);
      return $myPackage;
    }else{
      return [];
    }
  }

  public static function requestsNotifications()
  {
    $notes = [];
    $applied = [];
    $jobs = [];
    $opened_jobs = Job::where('employer_id', auth()->user()->id)->where('state', 0)->orderBy('created_at', 'DESC')->get();
    $opened_jobs = json_decode($opened_jobs, true);
    foreach($opened_jobs as $job){
      $apply = JobRequest::where('job_id', $job['id'])->get();
      array_push($notes, $apply);
    }
    return $notes;
  }

  public static function pricingNotifications()
  {
    $notes = [];
    $pricing = PricingRequest::where('user_id',  auth()->user()->id)->where('state', 1)->whereIn('role', [1,2])->get();
    return $pricing;
  }

  public static function pricingExtentions()
  {
    $extentions = PricingRequest::where('user_id',  auth()->user()->id)->where('state', 1)->whereIn('role', [3,4])->get();
    return $extentions;
  }

  public static function workerNotifications()
  {
    $apply = JobRequest::where('worker_id', auth()->user()->id)->get();
    return $apply;
  }

  public static function workerRequests()
  {
    $apply = JobRequest::where('worker_id', auth()->user()->id)->get();
    return $apply;
  }

  public static function galleryByUser($id)
  {
    $gallery = Gallery::where('user_id', $id)->orderBy('created_at', 'desc')->get();
    return $gallery;
  }

  

  public static function chatList()
  {
    $chats = Chat::where('sender_id', auth()->user()->id)->orWhere('reciever_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();
    $chats = json_decode($chats, true);
    $members = [];
    
    if($chats){
    foreach ($chats as $chat) {
        if (auth()->user()->role == 1 || auth()->user()->role == 2) {
            
          if($chat['sender_id'] != auth()->user()->id ){
              
            if (Self::unlockCheck($chat['sender_id'])) {
                // dd(auth()->user()->role);
                $user = User::find($chat['sender_id']);
                if($user){
                    array_push($members, User::find($chat['sender_id']) );
                }
            }
          }
          if($chat['reciever_id'] != auth()->user()->id){
              
            if (Self::unlockCheck($chat['reciever_id'])) {
                $user = User::find($chat['reciever_id']);
                if($user){
                    array_push($members, User::find($chat['reciever_id']) );
                }
            }
          }
        }else{
          if($chat['sender_id'] != auth()->user()->id ){
               $user = User::find($chat['sender_id']);
                if($user){
                    array_push($members, User::find($chat['sender_id']) );
                }
          }
          if($chat['reciever_id'] != auth()->user()->id){
                $user = User::find($chat['reciever_id']);
                if($user){
                    array_push($members, User::find($chat['reciever_id']) );
                }
          }
        }
        
      }
    }
    $members  = array_unique($members);
    return $members;
  }

  public static function chatListCheck($id)
  {
    $chats = Chat::where([['sender_id', auth()->user()->id], ['reciever_id', $id]])->orWhere([['sender_id', $id], ['reciever_id', auth()->user()->id]])->get();
    if(count($chats) > 0){
      return true;
    }else{
      return false;
    }
  }

  public static function chatUserbyChat($id)
  {
    $chat = Chat::find($id);
    if($chat->sender_id != auth()->user()->id ){
      return $chat->sender_id;
    }
    if($chat->reciever_id != auth()->user()->id ){
      return $chat->reciever_id;
      
    }
  }

  public static function chatbyUser($id)
  {
    $chats = Chat::where([['sender_id', auth()->user()->id], ['reciever_id', $id]])->orWhere([['sender_id', $id], ['reciever_id', auth()->user()->id]])->get();
    
    return $chats;
  }

  public static function JobReqList()
  {
    $oJops = [];
    $reqWorkers = [];
    $pricing = PricingRequest::where('user_id', auth()->user()->id)->where('state', 1)->get();
    $opened_jobs = Job::where('employer_id', auth()->user()->id)->where('state', 0)->get();
    $opened_jobs = json_decode($opened_jobs, true);

    foreach($opened_jobs as $job) {

      array_push($oJops, $job['id']);
      $reqs = JobRequest::where('job_id', $job['id'])->get();
      foreach($reqs as $req) {
        array_push($reqWorkers, $req['worker_id']);
      }
    }
    return User::find($reqWorkers);
  }

  public static function pendingGov()
  {
    $pendingsW = [];
    $workers = User::where('role', 0)->get();
    $workers = json_decode($workers, true);

    foreach($workers as $w) {
      if ($w['gov_id'] != null) {
        if ($w['gov_id'] != 'verified'){
          array_push($pendingsW, $w['id']);
        }
      }
    }
    return User::find($pendingsW);
  }
  

    // Friendship System Functions
    /*public static function friends($id)
    {
        $friends = [];
        $to_friends = Friend::select('friend_id')->where([['user_id', '=', $id], ['friend_id', '!=', $id],['accept', '=', 1]])->get();
        $from_friends = Friend::select('user_id')->where([['user_id', '!=', $id], ['friend_id', '=', $id], ['accept', '=', 1]])->get();

        $to_friends = json_decode($to_friends, true);
        $from_friends = json_decode($from_friends, true);
        $blocked = Self::blocked($id);
        $all = array_merge($to_friends,$from_friends);
        foreach($all as $friend) {
            foreach($friend as $friend_id) {
                array_push($friends, $friend_id);
            }
        }
        $friends = array_diff($friends,$blocked);
        return $friends;
    }

    public static function blocked($id)
    {
        $blocked = [];
        $to_friends = Friend::select('friend_id')->where([['user_id', '=', $id], ['friend_id', '!=', $id],['accept', '=', 2]])->get();
        $from_friends = Friend::select('user_id')->where([['user_id', '!=', $id], ['friend_id', '=', $id], ['accept', '=', 2]])->get();

        $to_friends = json_decode($to_friends, true);
        $from_friends = json_decode($from_friends, true);
        $all = array_merge($to_friends,$from_friends);

        foreach($all as $friend) {
            foreach($friend as $friend_id) {
                array_push($blocked, $friend_id);
            }
        }
        return  $blocked;
    }

    public static function fromFriends()
    {
        $id = auth()->user()->id;
        $friends = [];
        $from_friends = Friend::select('user_id')->where([['user_id', '!=', $id], ['friend_id', '=', $id], ['accept', '=', 0]])->get();
        $from_friends = json_decode($from_friends, true);
        foreach($from_friends as $friend) {
            foreach($friend as $friend_id) {
                array_push($friends, $friend_id);
            }
        }
        $friends = User::find($friends);
        return $friends;
    }

    public static function toFriends()
    {
        $id = auth()->user()->id;
        $friends = [];
        $to_friends = Friend::select('friend_id')->where([['friend_id', '!=', $id], ['user_id', '=', $id], ['accept', '=', 0]])->get();
        $to_friends = json_decode($to_friends, true);
        foreach($to_friends as $friend) {
            foreach($friend as $friend_id) {
                array_push($friends, $friend_id);
            }
        }
        $friends = User::find($friends);
        return $friends;
    }

    public static function row_friend($id)
    {
        $row_friend = Friend::where([['friend_id', '=',  $id], ['user_id', '=', auth()->user()->id], ['accept', '=', 1]])->orWhere([['friend_id', '=', auth()->user()->id], ['user_id', '=', $id], ['accept', '=', 1]])->get();

        return $row_friend;
    }

    public static function row_sent($id)
    {
        $row_sent = Friend::where([['friend_id', '=',  $id], ['user_id', '=', auth()->user()->id], ['accept', '=', 0]])->get();

        return $row_sent;
    }

    public static function row_accept($id)
    {
        $row_accept = Friend::where([['friend_id', '=',  auth()->user()->id], ['user_id', '=', $id], ['accept', '=', 0]])->get();

        return $row_accept;
    }

    public static function mutual($id)
    {
        $mutual = [];
        $myfriends_id = [];
        $myfriend_friends_id = [];
        $myfriends = Self::friends(auth()->user()->id);
        $myfriend_friends = Self::friends($id);

        $myfriends = Self::friends(auth()->user()->id);
        foreach($myfriends as $friend){
            array_push($myfriends_id, $friend['id']);
        }

        $myfriend_friends = Self::friends($id);
        foreach($myfriend_friends as $friend){
            array_push($myfriend_friends_id, $friend['id']);
        }

        $mutual = array_intersect($myfriends_id,$myfriend_friends_id);
        $mutual = User::find($mutual);
        return $mutual;
    }

    public static function mayKnow()
    {
        $mayknow = User::where('id', '!=', auth()->user()->id)->get();
        $myfriend_friends = [];
        $myfriends = Self::friends(auth()->user()->id);
        if(!empty($myfriends)){
          $tofriends = Self::toFriends();
          $tofriends = json_decode($tofriends, true);
          foreach($myfriends as $friend){
            $f = Self::friends($friend);
              foreach($f as $ff){
                if($ff != auth()->user()->id && !in_array($ff, $myfriends ) && !in_array($ff, $tofriends )){
                  array_push($myfriend_friends, $ff);
                }
              }
          }
          $mayknow= User::find($myfriend_friends)->random(20);
        }
        return $mayknow;
    }

    public static function friendsItems()
    {
      $items = [];
      $myfriends = Self::friends(auth()->user()->id);
      if(!empty($myfriends)){
        $myfriends = Self::friends(auth()->user()->id);
        $myfriends_items = [];
        foreach($myfriends as $friend){
          $items = User::find($friend)->items;
          $items = json_decode($items, true);
            foreach($items as $item){
                array_push($myfriends_items, $item['id']);
            }
        }
        $items = Item::find($myfriends_items)->random(5);
      }
      
      return $items;
    }

    public static function friendsComments()
    {
      $comments = [];
      $myfriends = Self::friends(auth()->user()->id);
      $myfriends_comments = [];
      if(!empty($myfriends)){
        foreach($myfriends as $friend){
          $comments = Comment::where('user_id',$friend)->get();
          $comments = json_decode($comments, true);
            foreach($comments as $comment){
                array_push($myfriends_comments, $comment['id']);
            }
        }
        $comments = Comment::find($myfriends_comments)->random(4);
      }
      return $comments;
    }

    public static function homePosts()
    {
      $posts = Post::whereIn('user_id', array_merge(\Helper::friends(auth()->user()->id), array(auth()->user()->id)))->orderBy('created_at', 'desc')->paginate(10);
      return $posts;
    }



    public static function messegers()
    {
        $id = auth()->user()->id;
        $messegers_id = [];
        $messegers = [];
        $ma = Messenger::select(['user_id', 'friend_id'])->where('friend_id', $id)->orWhere('user_id',  $id)->orderBy('created_at', 'desc')->get();
        $ma = json_decode($ma, true);
        foreach($ma as $m){
            if($m['user_id'] != $id ){
                array_push($messegers_id, $m['user_id']);
            }
            if($m['friend_id'] != $id ){
                array_push($messegers_id, $m['friend_id']);
            }
        }
        foreach(array_unique($messegers_id) as $messeger){
            foreach(self::userById($messeger) as $messeger){
                array_push($messegers, $messeger);
            }
        }
        return $messegers;
    }

    public static function messegerMesseges($id)
    {
        $messeges = Messenger::where([['user_id', '=', $id], ['friend_id', '=', auth()->user()->id]])->orWhere([['friend_id', '=', $id], ['user_id', '=', auth()->user()->id]])->orderBy('created_at', 'asc')->get();
        return $messeges;
    }

    public static function seen($id)
    {
      $messeges = [];
      $seen = Messenger::where([['friend_id', '=', auth()->user()->id], ['user_id', '=', $id]])->orderBy('created_at', 'asc')->get();
      $seen = json_decode($seen, true);
      foreach($seen as $m){
              array_push($messeges, $m['id']);
      }
        return $messeges;
    }


    public static function notification()
    {
        $id = auth()->user()->id;
        $likes = Like::where([['to_user_id', '=', $id]])->orderBy('created_at', 'desc')->get();
        $comments = Comment::where([['to_user_id', '=', $id]])->orderBy('created_at', 'desc')->get();
        $likes = json_decode($likes);
        $comments = json_decode($comments);
        $l = (array) $likes;
        $c = (array) $comments;
        $n = [];
        foreach ($l as $ll){
            array_push($n,['user_id' => $ll->user_id,'post_id' =>$ll->post_id,'created_at' =>$ll->created_at, 'action' =>'like']);
        }
        foreach ($c as $cc){
            array_push($n,['user_id' => $cc->user_id,'post_id' =>$cc->post_id,'created_at' =>$cc->created_at, 'action' =>'comment']);
        }

        $keys = array_column($n, 'created_at');

        array_multisort($keys, SORT_DESC, $n);
        return $n;
    }

    public static function postById($id)
    {
        $post = Post::where([['id', '=', $id]])->get();
        return $post;
    }

    public static function userById($id)
    {
        $user = User::where([['id', '=', $id]])->get();
        return $user;
    }*/

    public static function checkImg($path)
    {
        if (file_exists('uploads/images/'.$path) || 'uploads/images/'.$path == !null)
        {
            echo url('uploads/images/'.$path);
        }
        else
        {
          $no_image = 'no_image.jpg';
          if(strpos($path, 'profile_image') !== false) {
              $no_image = 'default_company.jpg';
          }
          echo preg_replace('#[^/]*$#', '', url('uploads/images/'.$path)).$no_image;
        }
    }



    public static function since($obj)
    {
        $time  = $obj;
        $now    = date('Y-m-d H:i:s');
        $dt = $time->diff($now);
       

        if(app()->getLocale()== 'en'){
          $number= '';
          $unit = '';
          if($dt->y > 0){
            $number = $dt->y;
            $unit = 'years';
            if($dt->y == 1){
              $unit = 'year';
            }
          }else if ($dt->m > 0){
            $number = $dt->m;
            $unit = "months";
            if($dt->m == 1){
              $unit = 'month';
            }
          }else if ($dt->d > 0){
            $number = $dt->d;
            $unit = "days";
            if($dt->d == 1){
              $unit = 'day';
            }
          }else if ($dt->h > 0){
            $number = $dt->h;
            $unit = "hours";
            if($dt->h == 1){
              $unit = 'hour';
            }
          }else if ($dt->i > 0){
            $number = $dt->i;
            $unit = "min";
            if($dt->i == 1){
              $unit = 'mins';
            }
          }else if ($dt->s > 0){
            $number = $dt->s;
            $unit = "second";
            if($dt->s == 1){
              $unit = 'seconds';
            }
          }
        }elseif(app()->getLocale()== 'ar'){
          $number= '1';
          $unit = 'ثانية';
          if($dt->y > 0){
            $number = $dt->y;
            $unit = 'سنة';
            if($dt->y == 1){
              $unit = 'سنة';
            }
            if($dt->y == 2){
              $unit = 'سنتين';
            }
            if(in_array($dt->y, [3,4,5,6,7,8,9,10]) ){
              $unit = 'سنوات';
            }
          }else if ($dt->m > 0){
            $number = $dt->m;
            $unit = "شهر";
            if($dt->m == 1){
              $unit = 'شهر';
            }
            if($dt->m == 2){
              $unit = 'شهرين';
            }
            if(in_array($dt->m, [3,4,5,6,7,8,9,10]) ){
              $unit = 'أشهر';
            }
          }else if ($dt->d > 0){
            $number = $dt->d;
            $unit = "يوم";
            if($dt->d == 1){
              $unit = 'يوم';
            }
            if($dt->d == 2){
              $unit = 'يومين';
            }
            if(in_array($dt->d, [3,4,5,6,7,8,9,10]) ){
              $unit = 'أيام';
            }
          }else if ($dt->h > 0){
            $number = $dt->h;
            $unit = "ساعة";
            if($dt->h == 1){
              $unit = 'ساعة';
            }
            if($dt->h == 2){
              $unit = 'ساعتين';
            }
            if(in_array($dt->h, [3,4,5,6,7,8,9,10]) ){
              $unit = 'ساعات';
            }
          }else if ($dt->i > 0){
            $number = $dt->i;
            $unit = "دقيقة";
            if($dt->i == 1){
              $unit = 'دقيقة';
            }
            if($dt->i == 2){
              $unit = 'دقيقتين';
            }
            if(in_array($dt->i, [3,4,5,6,7,8,9,10]) ){
              $unit = 'دقائق';
            }
          }else if ($dt->s > 0){
            $number = $dt->s;
            $unit = "ثانية";
            if($dt->s == 1){
              $unit = 'ثانية';
            }
            if($dt->s == 2){
              $unit = 'ثانيتين';
            }
            if(in_array($dt->s, [3,4,5,6,7,8,9,10]) ){
              $unit = 'ثوان';
            }
          }
        }

        $since = $number.' ' . $unit;
        return $since;
    }

    public static function privacy()
    {
      
      $privacy = array(
          '0' => 'Public',
          '1' => 'Friends',
          '2' => 'OnlyMe'
      );
      return $privacy;
    }

    public static function allow_comments()
    {
      $allow_comments = array(
          '0' => 'Allow',
          '1' => 'Prevent'
      );
      return $allow_comments;
    }

    public static function job_type()
    {
      if(app()->getLocale()== 'en'){
        $job_type = array(
          '0' => 'Full Time',
          '1' => 'Part Time',
          '2' => 'Freelancer',
        );
      }elseif(app()->getLocale()== 'ar'){
        $job_type = array(
          '0' => 'دوام كامل',
          '1' => 'نصف دوام',
          '2' => 'عمل عن بعد',
        );
      }
      return $job_type;
    }

    public static function postedDate()
    {
      if(app()->getLocale()== 'en'){
        $date = array(
            '0' => 'Last Hour',
            '1' => 'Last 24 hours',
            '2' => 'Last 7 days',
            '3' => 'Last 14 days',
            '4' => 'Last 30 days',
            '5' => 'Last 6 Months',
        );
      }elseif(app()->getLocale()== 'ar'){
        $date = array(
          '0' => 'خلال ساعة',
          '1' => 'خلال 24 ساعة',
          '2' => 'خلال 7 أيام',
          '3' => 'خلال 14 يوم',
          '4' => 'خلال 30 يوم',
          '5' => 'خلال 6 أشهر',
      );
      }
      return $date;
    }

    public static function skill()
    {
      $skills = array(
          '0' => 'Communication',
          '1' => 'Teamwork',
          '2' => 'Problem Solving',
          '3' => 'Learning',
          '4' => 'Self Management',
          '5' => 'Drive',
      );
      return $skills;
    }

    public static function skillByKey($key)
    {
      $name = '';
      $skills = Self::skill();

      foreach($skills as $k => $skill){
        if($key == $k){
          return $skill;
        }
      }
    }



    public static function experience()
    {
      if(app()->getLocale()== 'en'){
        $experience = array(
          '0' => '1 Year',
          '1' => '2 Years',
          '2' => '3 Years',
          '3' => '4 Years',
          '4' => '5 Years',
          '5' => '6 Years',
          '6' => '7 Years',
          '7' => '8 Years',
          '8' => '9 Years',
          '9' => '10 Years & more',
      );
      }elseif(app()->getLocale()== 'ar'){
        $experience = array(
          '0' => 'سنة',
          '1' => 'سنتان',
          '2' => '3 سنوات',
          '3' => '4 سنوات',
          '4' => '5 سنوات',
          '5' => '6 سنوات',
          '6' => '7 سنوات',
          '7' => '8 سنوات',
          '8' => '9 سنوات',
          '9' => '10 سنوات وأكثر',
      );
      }
      
      return $experience;
    }
    public static function getExperience($key)
    {
      
      if(app()->getLocale()== 'en'){
        $experience = array(
          '0' => '1 Year',
          '1' => '2 Years',
          '2' => '3 Years',
          '3' => '4 Years',
          '4' => '5 Years',
          '5' => '6 Years',
          '6' => '7 Years',
          '7' => '8 Years',
          '8' => '9 Years',
          '9' => '10 Years & more',
        );
      }elseif(app()->getLocale()== 'ar'){
        $experience = array(
          '0' => 'سنة',
          '1' => 'سنتان',
          '2' => '3 سنوات',
          '3' => '4 سنوات',
          '4' => '5 سنوات',
          '5' => '6 سنوات',
          '6' => '7 سنوات',
          '7' => '8 سنوات',
          '8' => '9 سنوات',
          '9' => '10 سنوات وأكثر',
        );
      }
      foreach ($experience as $k => $value) {
        if($key == $k){
          return $value;
        }
      }
    }
    public static function experienceRange()
    {
      if(app()->getLocale()== 'en'){
        $experience = array(
          '1' => '1 Year - 3 Years',
          '2' => '4 Years - 6 Years',
          '3' => '7 Years - 10 years',
          '4' => '10 Years & more',
      );
      }elseif(app()->getLocale()== 'ar'){
        $experience = array(
          '1' => 'سنة - 3 سنوات',
          '2' => '4 سنوات - 6 سنوات',
          '3' => '7 سنوات - عشر سنوات',
          '4' => 'عشر سنوات وأكثر',
      );
      }
      
      return $experience;
    }

    

    public static function salaryRange()
    {
      if(app()->getLocale()== 'en'){
        $range = array(
          '0' => 'SAR 1000 - SAR 1500',
          '1' => 'SAR 1500 - SAR 2000',
          '2' => 'SAR 2000 - SAR 2500',
          '3' => 'SAR 2500 - SAR 3000',
          '4' => 'SAR 3000 - SAR 3500',
          '5' => 'SAR 3500 - SAR 4000',
          '6' => 'SAR 4000 - SAR 4500',
          '7' => 'SAR 4500 - SAR 5000',
          '8' => 'SAR 5000 - SAR 6000',
          '9' => 'SAR 6000 & more',
        );
      }elseif(app()->getLocale()== 'ar'){
        $range = array(
          '0' => '1000 ريال - 1500 ريال',
          '1' => '1500 ريال - 2000 ريال',
          '2' => '2000 ريال - 2500 ريال',
          '3' => '2500 ريال - 3000 ريال',
          '4' => '3000 ريال - 3500 ريال',
          '5' => '3500 ريال - 4000 ريال',
          '6' => '4000 ريال - 4500 ريال',
          '7' => '4500 ريال - 5000 ريال',
          '8' => '5000 ريال - 6000 ريال',
          '9' => '6000 ريال وأكثر',
        );
      }
      return $range;
    }

    public static function minimalSalary()
    {
      if(app()->getLocale()== 'en'){
        $salary = array(
          '1' => 'SAR 1000',
          '2' => 'SAR 1500',
          '3' => 'SAR 2000',
          '4' => 'SAR 2500',
          '5' => 'SAR 3000',
          '6' => 'SAR 3500',
          '7' => 'SAR 4000',
          '8' => 'SAR 4500',
          '9' => 'SAR 5000',
          '10' => 'SAR 6000 & more',
      );
      }elseif(app()->getLocale()== 'ar'){
        $salary = array(
          '1' => '1000 ريال',
          '2' => '1500 ريال',
          '3' => '2000 ريال',
          '4' => '2500 ريال',
          '5' => '3000 ريال',
          '6' => '3500 ريال',
          '7' => '4000 ريال',
          '8' => '4500 ريال',
          '9' => '5000 ريال',
          '10' => '6000 ريال وأكثر',
      );
      }
      
      return $salary;
    }

    public static function getSalaryRange($key)
    {
      
      if(app()->getLocale()== 'en'){
        $range = array(
          '0' => 'SAR 1000 - SAR 1500',
          '1' => 'SAR 1500 - SAR 2000',
          '2' => 'SAR 2000 - SAR 2500',
          '3' => 'SAR 2500 - SAR 3000',
          '4' => 'SAR 3000 - SAR 3500',
          '5' => 'SAR 3500 - SAR 4000',
          '6' => 'SAR 4000 - SAR 4500',
          '7' => 'SAR 4500 - SAR 5000',
          '8' => 'SAR 5000 - SAR 6000',
          '9' => 'SAR 6000 & more',
      );
      }elseif(app()->getLocale()== 'ar'){
        $range = array(
          '0' => '1000 ريال - 1500 ريال',
          '1' => '1500 ريال - 2000 ريال',
          '2' => '2000 ريال - 2500 ريال',
          '3' => '2500 ريال - 3000 ريال',
          '4' => '3000 ريال - 3500 ريال',
          '5' => '3500 ريال - 4000 ريال',
          '6' => '4000 ريال - 4500 ريال',
          '7' => '4500 ريال - 5000 ريال',
          '8' => '5000 ريال - 6000 ريال',
          '9' => '6000 ريال وأكثر',
        );
      }
      foreach ($range as $k => $value) {
        if($key == $k){
          return $value;
        }
      }
    }

    public static function legal()
    {
      if(app()->getLocale()== 'en'){
        $range = array(
          '0' => 'Have a Residence',
          '1' => 'Guaranteeing transfer',
          '2' => 'New',
      );
      }elseif(app()->getLocale()== 'ar'){
        $range = array(
          '0' => 'مقيم',
          '1' => 'نقل كفالة',
          '2' => 'جديد',
        );
      }
      return $range;
    }


    public static function educationalLevel()
    {
      if(app()->getLocale()== 'en'){
        $level = array(
          '0' => 'Bechlores Degree ',
          '1' => 'High School',
          '2' => 'vocational',
          '3' => 'Diploma',
        );
      }elseif(app()->getLocale()== 'ar'){
        $level = array(
          '0' => 'بكالريوس',
          '1' => 'ثانوية',
          '2' => 'تدريب ',
          '3' => 'دبلوم',
        );
      }
      
      return $level;
    }

    public static function educationaGrade()
    {

      $grade = array(
        '0' => 'Excellent (85% - 100%)',
        '1' => 'Very Good (75% - 85%)',
        '2' => 'Good  (65% - 75%)',
        '3' => 'Fair (50% - 65%)',
        '4' => 'Not specified',
      );
      return $grade;
    }

    public static function skillType()
    {
      $grade = array(
        '0' => 'Soft Skills',
        '1' => 'Technical',
      );
      return $grade;
    }

    public static function gender()
    {
      if(app()->getLocale()== 'en'){
        $gender = array(
          '1' => 'Male', 
          '2' => 'Female', 
          '3' => 'Male Or Female', 
      );
      }elseif(app()->getLocale()== 'ar'){
        $gender = array(
          '1' => 'ذكر', 
          '2' => 'أنثى', 
          '3' => 'ذكر أو أنثى', 
      );
      }
     
      return $gender;
    }
    public static function CheckGender($g)
    {
      if(app()->getLocale()== 'en'){
        $gender = array(
          '1' => 'Male', 
          '2' => 'Female', 
          '3' => 'Male Or Female', 
      );
      }elseif(app()->getLocale()== 'ar'){
        $gender = array(
          '1' => 'ذكر', 
          '2' => 'أنثى', 
          '3' => 'ذكر أو أنثى', 
      );
      }
      foreach ($gender as $key => $gen) {
       if($key == $g){
        return $gen;
       }
      }
    }


    public static function married()
    {
      if(app()->getLocale()== 'en'){
        $married = array(
          '1' => 'Single', 
          '2' => 'Married',  
      );
      }elseif(app()->getLocale()== 'ar'){
        $married = array(
          '1' => 'أعزب', 
          '2' => 'متزوج',  
      );
      }
      return $married;
    }

    public static function languageLevel()
    {
      if(app()->getLocale()== 'en'){
        $levels = array(
          '0' => 'Beginner',
          '1' => 'Intermediate',  
          '2' => 'Advanced',
          '3' => 'Fluent', 
          '4' => 'Native', 
      );
      }elseif(app()->getLocale()== 'ar'){
        $levels = array(
          '0' => 'مبتدأ',
          '1' => 'متوسط',  
          '2' => 'متقدم',
          '3' => 'أتحدث بطلاقة', 
          '4' => 'اللغة الأم', 
      );
      }
      return $levels;
    }

    public static function rating()
    {
      if(app()->getLocale()== 'en'){
        $rating = array(
          '0' => 'Very Bad',
          '1' => 'Bad',
          '2' => 'Not Bad',
          '3' => 'Good',
          '4' => 'Excllent',
      );
      }elseif(app()->getLocale()== 'ar'){
        $rating = array(
          '0' => 'سئ جدا',
          '1' => 'مقبول',
          '2' => 'جيد',
          '3' => 'جيد جدا',
          '4' => 'ممتاز',
      );
      }
      return $rating;
    }

    public static function religions()
    {
      if(app()->getLocale()== 'en'){
        $religion = array(
          '1' => 'Muslim',
          '2' => 'Christian',
          '3' => 'Other',
      );
      }elseif(app()->getLocale()== 'ar'){
        $religion = array(
          '1' => 'مسلم',
          '2' => 'مسيحي',
          '3' => 'غير ذلك',
      );
      }
      return $religion;
    }

    public static function religionByKey($key){
      $religions = [];

      foreach (Self::religions() as $ckey => $name) {
        if($key == $ckey){
          array_push($religions, $name);
        }
      }
      foreach ($religions as $key => $name) {
        return $name;
      }
    }

    public static function ratingByKey($key)
    {
      $name = '';
      $ratings = Self::rating();

      foreach($ratings as $k => $rating){
        if($key == $k){
          return $rating;
        }
      }
    }

    public static function sorting()
    {
      if(app()->getLocale()== 'en'){
        $sorting = array(
          '0' => 'Nothing',
          '1' => 'Name',
          '2' => 'Experience',
          '3' => 'Low Salary',
          '4' => 'Height Salary',
        );
      }elseif(app()->getLocale()== 'ar'){
        $sorting = array(
          '0' => 'ترتيب',
          '1' => 'الإسم',
          '2' => 'سنوات الخبرة',
          '3' => 'أقل راتب',
          '4' => 'أعلى راتب',
        );
      }
      return $sorting;
    }

    public static function countries()
    {
      $countries_keys = [];
      $countries_names = [];

      $countries = Country::orderBy('name', 'asc')->get();
      $countries_array = json_decode($countries, true);

      $countries_ar_path =  base_path().'/resources/views/pockets/countries_ar.json';
      $countries_ar_array = json_decode(file_get_contents($countries_ar_path));
      //Countries Keys Array
      foreach($countries_array as $key => $country){
        foreach ($countries_ar_array as $k => $country_ar) {
          if (strtoupper($country['code']) == $k ) {
            if(app()->getLocale() == 'ar'){
              array_push($countries_keys, $k);
              array_push($countries_names, $country_ar);
            }else{
              array_push($countries_keys, strtoupper($country['code']));
              array_push($countries_names, $country['name']);
            }
          }
        }
        
      }
      $countries = array_combine($countries_keys, $countries_names);
      asort($countries);
      
      return $countries;
    }

    public static function countriesID()
    {
      $countries = Country::orderBy('name', 'asc');
      $countries = (array) $countries->pluck('name', 'id');
      $countries = array_shift($countries);
      
      return $countries;
    }

    

    public static function states()
    {
      $states = State::orderBy('name', 'asc');
      $states = (array) $states->pluck('name', 'id');
      $states = array_shift($states);
      
      return $states;
    }

    public static function cities()
    {
      $cities = City::orderBy('name', 'asc')->get();
      $cities = (array) $cities->pluck('name', 'id');
      $cities = array_shift($cities);
      
      return $cities;
    }

    

    /*public static function countries()
    {
      $countries = [];
      $countries_keys = [];
      $countries_names = [];
      $countries_path =  base_path().'/resources/views/pockets/countries.json';
      $countries_array = json_decode(file_get_contents($countries_path), true);

      //Countries Keys Array
      foreach($countries_array as $key => $country){
        array_push($countries_keys, $key);
      }
      //Countries Names Array
      foreach($countries_array as $key => $country){
        array_push($countries_names, $country['name']);
      }

      $countries = array_combine($countries_keys, $countries_names);
      asort($countries);
      return $countries;
    }*/

   
   public static function nationalities()
    {
      $nationalities = [];
      $nationalities_keys = [];
      $nationalities_names = [];
      $nationalities_ar_names = [];
      $nationalities_path =  base_path().'/resources/views/pockets/nationalities.json';
      $nationalities_array = json_decode(file_get_contents($nationalities_path), true);

      $nationalities_ar_path =  base_path().'/resources/views/pockets/nationalities_ar.json';
      $nationalities_ar_array = json_decode(file_get_contents($nationalities_ar_path), true);

      //Countries Names Array
      foreach($nationalities_array as $key => $nationality){
        foreach ($nationalities_ar_array as $k => $value) {
          if ($k == $nationality['nationality']) {
            if (app()->getLocale() == 'ar') {
              array_push($nationalities_keys, $nationality['alpha_2_code']);
              array_push($nationalities_names, $value);
            }else{
              array_push($nationalities_keys, $nationality['alpha_2_code']);
              array_push($nationalities_names, $nationality['nationality']);
            }
          }
        }
      }
      $nationalities = array_combine($nationalities_keys, $nationalities_names);
      asort($nationalities);
      return $nationalities;
    }


    public static function nationalityByKey($key)
    {
      $name = '';
      $nationalities = Self::nationalities();

      foreach($nationalities as $k => $nationality){
        if($key == $k){
          return $nationality;
        }
      }
    }

    public static function hashString($string)
    {
      $string = str_replace(' ', '', $string);
      $string = $string[0]. '***'. substr($string, -1);
      $string = utf8_encode($string);
    //   dd($string);
      return $string;
    } 

    public static function languages()
    {
      $languages = [];
      $languages_keys = [];
      $languages_names = [];
      $languages_path =  base_path().'/resources/views/pockets/languages.json';
      $languages_array = json_decode(file_get_contents($languages_path), true);

      $languages_ar_path =  base_path().'/resources/views/pockets/languages_ar.json';
      $languages_ar_array = json_decode(file_get_contents($languages_ar_path), true);

      //Countries Keys Array
      foreach($languages_array as $key => $language){

        foreach($languages_ar_array as $k => $l){
          if ($l['code'] == $key ) {
            if(app()->getLocale() == 'ar'){
              array_push($languages_keys, $key);
              array_push($languages_names, $l['ar_name']);
            }else{
              array_push($languages_keys, $key);
              array_push($languages_names, $language['name']);
            }
          }
        }
      }

      $languages = array_combine($languages_keys, $languages_names);
      asort($languages);
      return $languages;
    }

    public static function languageByKey($key)
    {
      $name = '';
      $languages = Self::languages();

      foreach($languages as $k => $language){
        if($key == $k){
          return $language;
        }
      }
    }

    public static function getAge($birth)
    {
        return Carbon::parse($birth)->diff(Carbon::now())->format('%y years');
    }

    public static function getCountryByKey($key){
      $countries = Self::countries();
      
      foreach ($countries as $keyc => $country) {
        if($keyc == $key){
          return str_replace('string',"",$country); ;
          
        }
      }
    }

    public static function getCountryByID($id){
      $countries = Self::countries();
      
      foreach ($countries as $keyc => $country) {
        if($keyc == $id){
          return str_replace('string',"",$country); ;
          
        }
      }
    }

    public static function countryCodes()
    {
      $countries = [];
      $countries_keys = [];
      $countries_names = [];
      $countries_path =  base_path().'/resources/views/pockets/countries.json';
      $countries_array = json_decode(file_get_contents($countries_path), true);

      $countries_ar_path =  base_path().'/resources/views/pockets/countries_ar.json';
      $countries_ar_array = json_decode(file_get_contents($countries_ar_path));

      //Countries Keys Array
      foreach($countries_array as $key => $country){
        foreach ($countries_ar_array as $k => $country_ar) {
          if ($key == $k ) {
            if(app()->getLocale() == 'ar'){
              array_push($countries_keys, $country['phone']);
              array_push($countries_names, $country_ar);
            }else{
              array_push($countries_keys, $country['phone']);
              array_push($countries_names, $country['name']);
            }
          }
        }
      }
      $countries_codes = array_combine($countries_keys, $countries_names);
      asort($countries_codes);


      return $countries_codes;
    }
    

    public static function getCityByID($id){
      $city = City::where('id', $id)->first();
      if($city){
        if (app()->getLocale() == 'ar') {
          if ($city->name_ar) {
            return $city->name_ar;
          }else{
            return $city->name;
          }
        }else{
            return $city->name;
        }
      }
    }

    public static function getNationalityByKey($key){
      $nationality = [];

      foreach (Self::nationalities() as $ckey => $name) {
        if($key == $ckey){
          array_push($nationality, $name);
        }
      }
      foreach ($nationality as $key => $name) {
        return $name;
      }
    }

   

    public static function currency()
    {
      $cuurency =  base_path().'/resources/views/pockets/currency.json';
      $cuurency = json_decode(file_get_contents($cuurency), true);
      return $cuurency;
    }

    public static function phone_prefix()
    {
      $phone_prefixes =  base_path().'/resources/views/pockets/phone_prefix.json';
      $phone_prefixes = json_decode(file_get_contents($phone_prefixes), true);
      return $phone_prefixes;
    }

    public static function flags()
    {
      $flags =  file_get_contents(base_path().'/resources/views/pockets/flags.php');
      return $flags;
    }

    public static function MDI()
    {
      $icons = [];
      $icons_names = [];
      $icons_shapes= [];
      $icons_path =  base_path().'/resources/views/pockets/mdi.json';
      $icons_array = json_decode(file_get_contents($icons_path), true);

      
      //Icons Names Array
      foreach($icons_array as $key => $icon){
        array_push($icons_names, $icon['name']);
      }

      //Icons Shapes Array
      foreach($icons_array as $key => $icon){
        array_push($icons_shapes, '<i class="mdi mdi-'.$icon['name'].'"></i>');
      }

      $icons = array_combine($icons_names, $icons_shapes);
      return $icons;
    }
    
    public static function fontAwesome()
    {
      $icons = [];
      $icons_path =  base_path().'/resources/views/pockets/fontawesome.json';
      $icons_array = json_decode(file_get_contents($icons_path), true);
      
      foreach($icons_array as $key => $icon){
        foreach($icon['icons'] as $k => $i){
          array_push($icons, $i);
        }
      }

      return array_unique($icons);
    }



    public static function getSkills($skills)
    {
      return  explode(',', $skills);
    }

    public static function getMonthNameYear($date)
    {
      return date('F, Y', strtotime($date)); //June, 2017
    }

    public static function canJobApply()
    {
      $worker = User::where('role', 0)->where('id',auth()->user()->id)->get();
      $education = Education::where('user_id', auth()->user()->id)->get();
      $skills = Skill::where('user_id', auth()->user()->id)->get();
      $languages = Language::where('user_id', auth()->user()->id)->get();
      $socials = Social::where('user_id', auth()->user()->id)->get();
      $experiences = Experience::where('user_id', auth()->user()->id)->get();
      foreach ($worker as $key => $w) {
        if( !count($education) == 0 && !count($skills) == 0 && !count($languages) == 0 && !count($experiences) == 0 && !empty($w->average_salary) && !empty($w->nationality) && !count($socials) == 0 && !empty($w->first_name) && !empty($w->middle_name) && !empty($w->category_id) && !empty($w->address) && !empty($w->city) && !empty($w->country) && !empty($w->experience)){
          return true;
        }else{
          return false;
        }
      }
    }

    public static function completeProfile()
    {
      $errors = [];
      $worker = User::where('role', 0)->where('id',auth()->user()->id)->get();
      $education = Education::where('user_id', auth()->user()->id)->get();
      $skills = Skill::where('user_id', auth()->user()->id)->get();
      $languages = Language::where('user_id', auth()->user()->id)->get();
      $socials = Social::where('user_id', auth()->user()->id)->get();
      $experiences = Experience::where('user_id', auth()->user()->id)->get();

      if(app()->getLocale()== 'en'){
        foreach ($worker as $key => $w) {
          if(count($education) == 0){
            array_push( $errors, '- Your Education Informations');
          }
          if(empty($skills) ||count($skills) == 0){
            array_push( $errors, '- Your Skills');
          }
          if(count($languages) == 0){
            array_push( $errors, '- Your Languages');
          }
          if(empty($w->average_salary)){
            array_push( $errors, '- Your Salary');
          }
          if(empty($w->nationality)){
            array_push( $errors, '- Your Nationality');
          }
          if(empty($w->first_name)){
            array_push( $errors, '- Your First Name');
          }
          if(empty($w->middle_name)){
            array_push( $errors, '- Your Last Name');
          }
          if(empty($w->category_id)){
            array_push( $errors, '- Your Job Role');
          }
          if(empty($w->address)){
            array_push( $errors, '- Your Address');
          }
          if(empty($w->city)){
            array_push( $errors, '- Your City');
          }
          /*if(empty($w->state)){
            array_push( $errors, '- Your State Informations');
          }*/
          if(empty($w->experience)){
            array_push( $errors, '- Your Experience years');
          }
          if(empty($w->country)){
            array_push( $errors, '- Your Country');
          }
        //   if(count($socials) == 0){
        //     array_push( $errors, '- Your Socials Media accounts');
        //   }
          if(count($experiences) == 0){
            array_push( $errors, '- Your Experiences Informations');
          }
        }
      }elseif(app()->getLocale()== 'ar'){
        foreach ($worker as $key => $w) {
          if(count($education) == 0){
            array_push( $errors, '- تفاصيل دراستك');
          }
          if(empty($skills) ||count($skills) == 0){
            array_push( $errors, '- مهاراتك');
          }
          if(count($languages) == 0){
            array_push( $errors, '- اللغات التي تجيدها');
          }
          if(empty($w->average_salary)){
            array_push( $errors, '- راتبك الشهري');
          }
          if(empty($w->nationality)){
            array_push( $errors, '- الجنسية');
          }
          if(empty($w->first_name)){
            array_push( $errors, '- الإسم الأول');
          }
          if(empty($w->middle_name)){
            array_push( $errors, '- الإسم الثاني');
          }
          if(empty($w->category_id)){
            array_push( $errors, '- المجال الوظيفي');
          }
          if(empty($w->address)){
            array_push( $errors, '- العنوان');
          }
          if(empty($w->city)){
            array_push( $errors, '- المدينة');
          }
          /*if(empty($w->state)){
            array_push( $errors, '- Your State Informations');
          }*/
          if(empty($w->experience)){
            array_push( $errors, '- سنوات الخبرة');
          }
          if(empty($w->country)){
            array_push( $errors, '- الجنسية');
          }
        //   if(count($socials) == 0){
        //     array_push( $errors, '- حسابات التواصل الإجتماعي');
        //   }
          if(count($experiences) == 0){
            array_push( $errors, '- خبراتك');
          }
        }
      }
      
      return $errors;
    }

  public static function completeProfileVue()
    {
      $errors = [];
      $worker = User::where('role', 0)->where('id',auth()->user()->id)->get();
      $education = Education::where('user_id', auth()->user()->id)->get();
      $skills = Skill::where('user_id', auth()->user()->id)->get();
      $languages = Language::where('user_id', auth()->user()->id)->get();
      $socials = Social::where('user_id', auth()->user()->id)->get();
      $experiences = Experience::where('user_id', auth()->user()->id)->get();

      if(app()->getLocale()== 'en'){
        foreach ($worker as $key => $w) {
          if(count($education) == 0){
            array_push( $errors, '- Your Education Informations');
          }
          if(empty($skills) ||count($skills) == 0){
            array_push( $errors, '- Your Skills');
          }
          if(count($languages) == 0){
            array_push( $errors, '- Your Languages');
          }
          if(empty($w->average_salary)){
            array_push( $errors, '- Your Salary');
          }
          if(empty($w->nationality)){
            array_push( $errors, '- Your Nationality');
          }
          if(empty($w->first_name)){
            array_push( $errors, '- Your First Name');
          }
          if(empty($w->middle_name)){
            array_push( $errors, '- Your Last Name');
          }
          if(empty($w->category_id)){
            array_push( $errors, '- Your Job Role');
          }
          if(empty($w->address)){
            array_push( $errors, '- Your Address');
          }
          if(empty($w->city)){
            array_push( $errors, '- Your City');
          }
          /*if(empty($w->state)){
            array_push( $errors, '- Your State Informations');
          }*/
          if(empty($w->experience)){
            array_push( $errors, '- Your Experience years');
          }
          if(empty($w->country)){
            array_push( $errors, '- Your Country');
          }
          if(count($socials) == 0){
            array_push( $errors, '- Your Socials Media accounts');
          }
          if(count($experiences) == 0){
            array_push( $errors, '- Your Experiences Informations');
          }
        }
      }elseif(app()->getLocale()== 'ar'){
        foreach ($worker as $key => $w) {
          if(count($education) == 0){
            array_push( $errors, '- تفاصيل دراستك');
          }
          if(empty($skills) ||count($skills) == 0){
            array_push( $errors, '- مهاراتك');
          }
          if(count($languages) == 0){
            array_push( $errors, '- اللغات التي تجيدها');
          }
          if(empty($w->average_salary)){
            array_push( $errors, '- راتبك الشهري');
          }
          if(empty($w->nationality)){
            array_push( $errors, '- الجنسية');
          }
          if(empty($w->first_name)){
            array_push( $errors, '- الإسم الأول');
          }
          if(empty($w->middle_name)){
            array_push( $errors, '- الإسم الثاني');
          }
          if(empty($w->category_id)){
            array_push( $errors, '- المجال الوظيفي');
          }
          if(empty($w->address)){
            array_push( $errors, '- العنوان');
          }
          if(empty($w->city)){
            array_push( $errors, '- المدينة');
          }
          /*if(empty($w->state)){
            array_push( $errors, '- Your State Informations');
          }*/
          if(empty($w->experience)){
            array_push( $errors, '- سنوات الخبرة');
          }
          if(empty($w->country)){
            array_push( $errors, '- الجنسية');
          }
          if(count($socials) == 0){
            array_push( $errors, '- حسابات التواصل الإجتماعي');
          }
          if(count($experiences) == 0){
            array_push( $errors, '- خبراتك');
          }
        }
      }
      return $errors;
    }



    public static function operatingHours()
    {
      if(app()->getLocale()== 'en'){
        $hours = array(
          '1' => '1 AM',
          '2' => '2 AM',
          '3' => '3 AM',
          '4' => '4 AM',
          '5' => '5 AM',
          '6' => '6 AM',
          '7' => '7 AM',
          '8' => '8 AM',
          '9' => '9 AM',
          '10' => '10 AM',
          '11' => '11 AM',
          '12' => '12 AM',
          '13' => '1 PM',
          '14' => '2 PM',
          '15' => '3 PM',
          '16' => '4 PM',
          '17' => '5 PM',
          '18' => '6 PM',
          '19' => '7 PM',
          '20' => '8 PM',
          '21' => '9 PM',
          '22' => '10 PM',
          '23' => '11 PM',
          '24' => '12 PM',
        );
      }elseif(app()->getLocale()== 'ar'){
        $hours = array(
          '1' => '1 صباحاً',
          '2' => '2 صباحاً',
          '3' => '3 صباحاً',
          '4' => '4 صباحاً',
          '5' => '5 صباحاً',
          '6' => '6 صباحاً',
          '7' => '7 صباحاً',
          '8' => '8 صباحاً',
          '9' => '9 صباحاً',
          '10' => '10 صباحاً',
          '11' => '11 صباحاً',
          '12' => '12 صباحاً',
          '13' => '1 مساءَ',
          '14' => '2 مساءَ',
          '15' => '3 مساءَ',
          '16' => '4 مساءَ',
          '17' => '5 مساءَ',
          '18' => '6 مساءَ',
          '19' => '7 مساءَ',
          '20' => '8 مساءَ',
          '21' => '9 مساءَ',
          '22' => '10 مساءَ',
          '23' => '11 مساءَ',
          '24' => '12 مساءَ',
        );
      }
      return $hours;
    }
    
    public static function operatingHoursCheck($h)
    {
      
      foreach (Self::operatingHours() as $key => $value) {
       if($key == $h){
        return $value;
       }
      }
    }

    public static function signed_up()
    {
      $worker = User::where('role', 0)->where('id',auth()->user()->id)->get();

      foreach ($worker as $key => $w) {
        if(empty($w->category_id)){
          return redirect('/interests');
        }elseif(empty($w->experience)){
          return redirect('/interests');
        }elseif(empty($w->average_salary)){
          return redirect('/interests');
        }elseif(empty($w->first_name)){
          return redirect('/general');
        }elseif(empty($w->middle_name)){
          return redirect('/general');
        }elseif(empty($w->nationality)){
          return redirect('/general');
        }elseif(empty($w->birth)){
          return redirect('/general');
        }elseif(empty($w->gender)){
          return redirect('/general');
        }elseif(empty($w->country)){
          return redirect('/general');
        }elseif(empty($w->city)){
          return redirect('/general');
        }elseif(empty($w->phone)){
          return redirect('/general');
        }else{
        }
      }
    }
    

//EMAIL SEND 
 public static function send_email($to='',$subject='',$message='',$from='',$fromname=''){
  try { 
      $mail = new PHPMailer();
      $mail->isSMTP(); 
      $mail->CharSet = "utf-8"; 

  
      $mail->SMTPAuth = true;
        $mail->Host = "mail.crossedlink.com";
      //$mail->Port =587;
      $mail->Port =465;
      $mail->SMTPSecure = 'ssl';   
      //$mail->SMTPSecure = 'tls';   
      $mail->Username = "notifications@crossedlink.com";
      $mail->Password = "R)YFld5&&zfC"; 

      if($from!='')
       $mail->From = $from;
         else
       $mail->From = 'noreply@crossedlink.com' ;
     
      if($fromname!='')
       $mail->FromName = $fromname;
         else
       $mail->FromName = 'crossedlink';
      if(is_array($to)){
        foreach($to as $to_add){
          $mail->AddAddress($to_add);                  // name is optional
        }
      }else{
        $mail->AddAddress($to);
      }
      //$mail->AddAddress($to);
      $mail->IsHTML(true);
      $mail->Subject = $subject;
      $mail->Body = $message;
      $mail->SMTPOptions= array(
      'ssl' => array(
      'verify_peer' => false,
      'verify_peer_name' => false,
      'allow_self_signed' => true
      )
      );

      $mail->send();
      return true ;
      dd($mail->send());
    }catch (phpmailerException $e) {
        dd($e);
    } catch (Exception $e) {
        dd($e);
    }
     return false ;
   }

   
    public static function getToken()
  {
      $length =20;
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet.= "0123456789";
        $max = strlen($codeAlphabet); 

        for ($i=0; $i < $length; $i++) {
            $token .= $codeAlphabet[rand(0, $max-1)];
        }

        return $token;
  }
  
  public static function emailtemplates()
  {
    $emailtemplates = EmailTemplate::all();
    return $emailtemplates;
  }
    
    

    /*public static function emoji()
    {
      $emoji=  base_path().'/resources/views/pockets/emoji.json';
      $emoji = json_decode(file_get_contents($emoji), true);
      $emoji = new Paginator($emoji, 77);
      return $emoji;
    }*/
    
    public static function CVCheck($cv)
    {
        $file= base_path(). '/uploads/files/cv/'. $cv;
        
        $headers = array(
            'Content-Type: application/pdf',
            'Content-Type: image/png',
            'Content-Type: image/jpg'
        );
        if($cv){
           if (file_exists($file)) {
            return true;
            }else{
                return false;
            } 
        }else{
           return false; 
        }
        
    }
    
    public static function packageReqCheck()
    {
        $requested = PricingRequest::where('user_id', auth()->user()->id)->whereIn('role', [1,2])->where('state', 0)->first();
        if ($requested) {
            return true;
        }else{
            return false;
        }
    }

    public static function packageApprovedCheck()
    {
        $approved = PricingRequest::where('user_id', auth()->user()->id)->whereIn('role', [1,2])->where('state', 1)->get();
        if ($approved) {
          return true;
        }else{
          return false;
        }
    }


    public static function extReqCheck()
    {
      $exRequested = PricingRequest::where('user_id', auth()->user()->id)->whereIn('role', [3,4])->where('state', 0)->first();
        if ($requested) {
            return true;
        }else{
            return false;
        }
    }


    public static function extApprovedCheck()
    {
      $exRequested = PricingRequest::where('user_id', auth()->user()->id)->whereIn('role', [3,4])->where('state', 1)->first();
        if ($approved) {
          return true;
        }else{
          return false;
        }
    }
    
    public static function visitorWorkers()
    {
      $workers_array = [];
      $workers = User::where('role', 0)->get();
      $workers = json_decode($workers, true);
      foreach ($workers as $key => $w) {
        $education = Education::where('user_id', $w['id'])->get();
        $skills = Skill::where('user_id',  $w['id'])->get();
        $languages = Language::where('user_id',  $w['id'])->get();
        $socials = Social::where('user_id',  $w['id'])->get();
        $experiences = Experience::where('user_id',  $w['id'])->get();

        if(!empty($w['nationality'])  && !empty($w['first_name'])  && !empty($w['middle_name'])  && !empty($w['category_id']) ){
          array_push( $workers_array, $w['id']);
        }
      }
      $workers = User::find($workers_array);
      return $workers ;
    }


    public static function visitorJobs()
    {
      $jobs = Job::inRandomOrder()->get();
      return $jobs;
    }
}
