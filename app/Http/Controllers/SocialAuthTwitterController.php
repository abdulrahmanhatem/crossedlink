<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\Services\SocialTwitterAccountService;
use Auth;
class SocialAuthTwitterController extends Controller
{
  /**
   * Create a redirect method to twitter api.
   *
   * @return void
   */
    public function redirect($role)
    {   
	    session(['role' => $role]);
        return Socialite::driver('twitter')->redirect();
    }

    /**
     * Return a callback method from twitter api.
     *
     * @return callback URL from twitter
     */
  /*  public function callback(SocialTwitterAccountService $service)
    {
		
        $user = $service->createOrGetUser(Socialite::driver('twitter')->user());
        auth()->login($user);
         $url = url('/home');
		?>
			<script>
			        base_url = "<?php echo $url ; ?>";
				    window.opener.location = base_url;
				    window.close();
			</script>
	<?php	
       // return redirect()->to('/home');
    } */
    
     public function callback(SocialTwitterAccountService $service)
    {
		
        $user = $service->createOrGetUser(Socialite::driver('twitter')->user());
	   if(!empty($user)){
        Auth::login($user, true);
	   }
        return redirect()->to('/home');
    }
    
    
}