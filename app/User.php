<?php

namespace App;

use Cache;
use App\Structure;
use App\Traits\Boutique;
use Illuminate\Support\Facades\DB;
use App\Notifications\ResetPassword;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use Tymon\JWTAuth\Contracts\JWTSubject;


//use Cmgmyr\Messenger\Traits\Messagable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use Boutique;
    use HasRoles;
   // use Messagable;



    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'prenom', 'numero',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

      /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function profil()
    {
        return $this->hasOne(Profil::class);

    }


    public function avatar()
    {
         $photoDeBase = $this->photo;
            if (strpos($photoDeBase, 'default.jpg') !== false)
            {
                $avatar = (new \Laravolt\Avatar\Avatar)->create($this->userName(100))
                    ->setBackground('#FF5722')
                    ->setForeground('#001122')
                    ->toBase64();
            }
            else{
                $avatar = $this->photo;
            }  

            return $avatar;
    }


    /**
     * @param $id
     * @return string
     * retourne le dernier message de la conversation avec un utilisateur
     */


    public function dernierMessage($id)
    {
        $dernierMessage = DB::table('chats')
            ->where('emmeteur_id', $id)
            ->where('receveur_id', $this->id)
            ->orWhere('emmeteur_id', $this->id)
            ->where('receveur_id', $id)
            ->latest()
            ->first();

        if(isset($dernierMessage))
        {
            $dernier = str_limit($dernierMessage->message, 35);


            return $dernier;

        }
    }

    public function messageNouLu($id)
    {
         $message = DB::table('chats')
            ->where('emmeteur_id', $id)
            ->where('receveur_id', $this->id)
            ->where('read_at', null)
            ->get();

            if(isset($message)){
                $messageNouLus = count($message);

                return $messageNouLus;

            }
    }

    public function celuiAQuiJaiEnvoyePlusdeMessage($id)
    {
        //$compteurDeMessage = Chat::where('emmeteur_id', $this->id);
        //return
        
         $mesMessages = Chat::where('emmeteur_id', $this->id)
                        ->where('receveur_id', $id)
                        ->select('message')->get();

                        

            //return count(max($mesMessages));
    }

    public function array_u($tab) {
     
        foreach($tab as $k1=>$v1){
     
            foreach($tab as $k2=>$v2){
                 
                if($k2 != $k1){
     
                    if(array_values($v1) == array_values($v2)){
                    
                        count($tab[$k1]);
     
                    }
 
                }  
     
            }
     
        }
         
        return $tab;
                 
    }

    public function userNameEtMessages($nombreDeCaractere = 15, $id)
    {
        $prenom = $this->prenom;

        $nom = $this->name;

        $espace = " ";

        $nom_complet = str_limit($prenom.$espace.$nom, $nombreDeCaractere);

         $message = DB::table('chats')
            ->where('emmeteur_id', $id)
            ->where('receveur_id', $this->id)
            ->get();

            $messageNouLus = count($message);

        return $nom_complet.'    '.$messageNouLus;
    }






    public function userName($nombreDeCaractere = 15)
    {
        $prenom = $this->prenom;

        $nom = $this->name;

        $espace = " ";

        $nom_complet = str_limit($prenom.$espace.$nom, $nombreDeCaractere);

        return $nom_complet;
    }


    
    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->id);
    }
    
     public function chats()
     {
        return $this->hasMany(Chat::class);
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function structures()
    {
        return $this->belongsToMany(Structure::class);
    }
}
