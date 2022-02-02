<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\Services\SocialFacebookAccountService;
use App\Providers\RouteServiceProvider;
use Auth;
class SocialAuthFacebookController extends Controller
{
  /**
   * Create a redirect method to facebook api.
   *
   * @return void
   */
    public function redirect($role)
    {
		session(['role' => $role]);
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Return a callback method from facebook api.
     *
     * @return callback URL from facebook
     */
   /* public function callback(SocialFacebookAccountService $service)
    {
        $user = $service->createOrGetUser(Socialite::driver('facebook')->stateless()->user());
		
	
        auth()->login($user);
        $url = url('/home');
		?>
			<script>
			        base_url = "<?php echo $url ; ?>";
				    window.opener.location = base_url;
				    window.close();
			</script>
	<?php 			
        //return redirect()->to('/home');
    } */    
     
   public function callback(SocialFacebookAccountService $service)
    {
        $user = $service->createOrGetUser(Socialite::driver('facebook')->stateless()->user());
	   if(!empty($user)){
        Auth::login($user, true);
	   }
        return redirect()->to('/home');
    }
}