<?php
namespace App\Http\Controllers;use Illuminate\Http\Request;
use Socialite;
use App\Services\SocialGoogleAccountService;
use Auth;

class SocialAuthGoogleController extends Controller
{
  /**
   * Create a redirect method to google api.
   *
   * @return void
   */
    public function redirect($role)
    {
		session(['role' => $role]);
        return Socialite::driver('google')->redirect();
    }/**
     * Return a callback method from google api.
     *
     * @return callback URL from google
     */
   /* public function callback(SocialGoogleAccountService $service)
    {
        $user = $service->createOrGetUser(Socialite::driver('google')->user());
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
    
     public function callback(SocialGoogleAccountService $service)
    {
        $user = $service->createOrGetUser(Socialite::driver('google')->stateless()->user());
	   if(!empty($user)){
        Auth::login($user, true);
	   }
        return redirect()->to('/home');
    }
}