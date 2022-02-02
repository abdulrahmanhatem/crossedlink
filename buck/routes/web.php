<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Visitor Routes



Route::get('/clear', function() {

   Artisan::call('cache:clear');
   Artisan::call('config:clear');
   Artisan::call('config:cache');
   Artisan::call('view:clear');

   return "Cleared!";

});

Route::get('lang/{lang}', 'Controller@lang');

Route::group(['middleware' => 'lang'], function(){
    
    Route::group(['middleware' => ['auth']], function($router){
    // Admins Routes
    $router->group(['middleware' => ['checkrole']], function($router){
        Route::group(['prefix' => 'dashboard'], function(){
            Route::get('/', 'DashboardController@index');
            Route::get('/admins/search', 'AdminController@search');
            Route::resource('/admins', 'AdminController');
            Route::get('/companies/search', 'CompanyController@search');
            Route::resource('/companies', 'CompanyController');
            Route::get('/personal/search', 'PersonController@search');
            Route::resource('/personal', 'PersonController');
            Route::get('/workers/search', 'WorkerController@search');
            Route::resource('/workers', 'WorkerController');
            Route::get('/cities/search', 'CityController@search');
            Route::resource('/cities', 'CityController');
            

            Route::resource('/pricing/requests', 'PricingRequestController');
            Route::get('/jobs/search', 'JobController@search');
            Route::resource('/jobs', 'JobController');
            Route::resource('/job/requests', 'JobRequestController');
            Route::resource('/saved/jobs', 'SavedJobController');
            Route::resource('/email-templates', 'EmailController');
            Route::get('/getuser/{id}', 'EmailController@getEmails');
            Route::get('/email-offer-notification', 'EmailController@email_offer_notification');
            Route::post('/send-email-offer-notification', 'EmailController@send_email_offer_notification');
            
            
            Route::get('/govIDs', 'WorkerController@gov');
            Route::get('/categories/search', 'CategoryController@search');
            Route::get('/categories/companies', 'CategoryController@companies');
            Route::get('/categories/personal', 'CategoryController@personal');
            
            Route::resource('/categories', 'CategoryController');

            Route::get('/packages/companies', 'PackageController@companies');
            Route::get('/packages/personal', 'PackageController@personal');
            Route::get('/packages/create/extention', 'PackageController@createExtention');
            Route::get('/packages/rec/{id}', 'PackageController@rec');
            Route::resource('/packages', 'PackageController');

            Route::get('/cobones/generate', 'CoboneController@generate');

            Route::resource('/cobones', 'CoboneController');

            Route::get('/countries/search', 'CountryController@search');
            Route::get('/countries/employers', 'CountryController@employers');
            Route::get('/countries/workers', 'CountryController@workers');
            Route::resource('/countries', 'CountryController');
            
        });
    });
});

    Auth::routes();
    Route::get('/employer/register', '\App\Http\Controllers\Auth\RegisterController@employer');
    Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

    // get cites ajax request 
	Route::get('/get/cites/{country}', 'ProfileController@getCites');
	
	//FACEBOOK LOGIN 
	Route::get('/redirect/{role}', 'SocialAuthFacebookController@redirect');
    Route::get('/callback', 'SocialAuthFacebookController@callback');
	
	//GOOGLE LOGIN 
	Route::get('/redirectg/{role}', 'SocialAuthGoogleController@redirect');
	Route::get('/callbackg', 'SocialAuthGoogleController@callback');
	
	//TWITTER  LOGIN 
	Route::get('/twitter/redirect/{role}', 'SocialAuthTwitterController@redirect');
	Route::get('twitter/callback', 'SocialAuthTwitterController@callback');
	
    Route::get('verify/email/{token}', 'VisitorController@verifyEmail');
    
    Route::get('candidate/{id}', 'VisitorController@candidate');
    Route::get('job-details/{id}', 'VisitorController@job');

    
    Route::get('/about', function(){
        return view('about');
    });
    Route::get('/services', function(){
        return view('services');
    });
    Route::get('/خدمة-معروفة', 'VisitorController@known');
    Route::get('/contact', function(){
        return view('contact');
    });
    Route::get('/policy', function(){
        return view('policy');
    });

    Route::post('/contact', 'VisitorController@contact');
    
    Route::get('me', 'ProfileController@viewAs');

   


    Route::group(['middleware' => ['auth']], function($router){
        
        Route::group(['middleware' => 'cors'], function () {

            // notification
            Route::get('notification/get','ProfileController@get_notify');
            Route::post('notification/read','ProfileController@read');
        });

        Route::get('chat/{id}', 'ChatController@showByUser');
        Route::resource('chat', 'ChatController');
        Route::get('download/{id}', 'ChatController@download');

        Route::group(['middleware' => ['employer']], function($router){
            /*Route::get('checkout/success', 'EmployerClientController@checkout');*/
            Route::get('checkout', 'EmployerClientController@checkout');

        });
        Route::get('settings', 'ProfileController@settings');
        Route::get('profiles/{id}/edit/branch', 'ProfileController@editBranch');
        /*Route::get('profiles/{id}/edit/experience', 'ProfileController@editExperience');
        Route::get('profiles/{id}/edit/education', 'ProfileController@editEducation');
        Route::get('profiles/{id}/edit/skills', 'ProfileController@editskills');
        Route::get('profiles/{id}/edit/languages', 'ProfileController@editLanguages');
        Route::get('profiles/{id}/edit/social', 'ProfileController@editSocial');
        Route::get('profiles/{id}/edit/gallery', 'ProfileController@editGallery');*/

        Route::resource('profiles', 'ProfileController');
		
		//Added for email and phone verification 
		Route::get('verify-email', 'ProfileController@SendVerifyEmailLink');
		Route::post('send_phone_code', 'ProfileController@sendPhoneVerificationCode');
		Route::post('OpenPhoneVerificationModal', 'ProfileController@OpenPhoneVerificationModal');
		Route::post('verify_phone_code', 'ProfileController@verifyPhoneCode');
        


        // Emloyers Routes
        Route::get('post/job', 'EmployerClientController@createJob');
        Route::post('post/job', 'EmployerClientController@postJob');
        Route::get('post/job/{id}/edit', 'EmployerClientController@editJob');
        Route::put('post/job/{id}/edit', 'EmployerClientController@updateJob');
        Route::delete('post/job/{id}', 'EmployerClientController@destroyJob');
        

        Route::get('workers', 'EmployerClientController@workers');
        Route::post('workers', 'EmployerClientController@profileView');
        Route::get('packages', 'EmployerClientController@packages');
        Route::post('packages', 'EmployerClientController@pricing_request');
        
        // eng.abdelrahman working here :)
        Route::resource('search/workers', 'SearchWorkerController');
        Route::post('search/workers', 'ajaxController@request');
        Route::get('jobs/search/ajax', 'ajaxController@jobs');
        Route::get('workers/search/ajax', 'ajaxController@workers');
        Route::get('operations/ajax/{id?}', 'ajaxController@accept');
        
        
        Route::get('us', 'EmployerClientController@viewAs');
        Route::get('myPackage', 'EmployerClientController@myPackage');
        Route::get('unlock', 'EmployerClientController@unlockList');
        Route::get('favorite', 'EmployerClientController@favList');

        // Workers Routes
        Route::resource('search/jobs', 'SearchJobController'); // edited
        Route::get('saved-jobs', 'WorkerClientController@saved_jobs');
        Route::get('apply-jobs', 'WorkerClientController@apply_jobs');
        Route::get('jobs', 'WorkerClientController@jobs');
        Route::get('jobs/{id}', 'WorkerClientController@job');
        Route::get('interests', 'WorkerClientController@interests');
        Route::get('general', 'WorkerClientController@general');
        Route::get('professional', 'WorkerClientController@professional');
        Route::get('download/docs/{id}', 'WorkerClientController@download_job');
        Route::get('download/cv/{id}', 'WorkerClientController@download');
        
        // General Routes
        Route::group(['middleware' => ['completedWorker']], function($router){
            Route::get('/', function(){
                return view('index');
            });
            Route::get('/home', function(){
                return view('index');
            });
            Route::get('jobs', 'WorkerClientController@jobs');
            Route::get('jobs/{id}', 'WorkerClientController@job');
            Route::resource('search/jobs', 'SearchJobController');
        });
        
    });
    Route::get('/', function(){
    return view('index');
    });
    Route::get('/home', function(){
        return view('index');
    });
    
    Route::fallback(function () {
        return view('errors.404');
    });
});    

