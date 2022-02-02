<?php 
namespace App\Services;
use App\SocialFacebookAccount;
use App\User;
use Laravel\Socialite\Contracts\User as ProviderUser;

class SocialFacebookAccountService
{
    public function createOrGetUser(ProviderUser $providerUser)
    {
        $account = SocialFacebookAccount::whereProvider('facebook')
            ->whereProviderUserId($providerUser->getId())
            ->first();
        if ($account) {
            return $account->user;
        } else {

            $account = new SocialFacebookAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => 'facebook'
            ]);

            $user = User::whereEmail($providerUser->getEmail())->first();

            if (!$user) {
                $name = $providerUser->getName();
                $name = explode(' ', $name);
                $first_name = array_shift($name);
                $middle_name = array_pop($name);
                $user = User::create([
                    'email' => $providerUser->getEmail(),
                    'name' => $providerUser->getName(),
                    'first_name' => $first_name,
                    'middle_name' => $middle_name,
                    'password' => md5(rand(1,10000)),
					'role' => session('role'),
                ]);
            }

            $account->user()->associate($user);
            $account->save();

            return $user;
        }
    }
}