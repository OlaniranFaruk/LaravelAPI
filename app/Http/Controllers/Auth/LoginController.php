<?php
declare(strict_types=1);
namespace App\Http\Controllers\Auth;
use DateTimeImmutable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


error_reporting(0);
use Firebase\JWT\JWT;
use MiladRahimi\Jwt\Generator;
use MiladRahimi\Jwt\Parser;
use MiladRahimi\Jwt\Cryptography\Algorithms\Hmac\HS256;

//require_once('../vendor/autoload.php');
require __DIR__ . '/../../../../vendor/autoload.php';

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    public function CustomLogin(Request $request){

        $result = array();
        $result["login"] = false;


        //$this->validateLogin($request);

        if(!isset($_POST['username']) || strlen($_POST['username']) == 0) {
            $result["error"] = "Username not set";
            header('Content-Type: application/json');
            echo json_encode($result);
            die();
        }

        if(!isset($_POST['password']) || strlen($_POST['password']) == 0) {
            $result["error"] = "Password not set";
            header('Content-Type: application/json');
            echo json_encode($result);
            die();
        }

        $ldapuser  = $_POST['username'];
        $ldappass = $_POST['password'];



        $ldapconfig['host'] = '10.128.63.131';
        $ldapconfig['port'] = 389;
        $ldapconfig['basedn'] = 'OU=TEST,DC=test,DC=local';
        $ldapconn=ldap_connect($ldapconfig['host'], $ldapconfig['port']) or die("Could not connect to LDAP server.");

        ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3) or die ("Could not set ldap protocol");
        ldap_set_option($ldapconn, LDAP_OPT_REFERRALS, 0) or die ("Could not set option referrals");

        $ldaprdn = "CN=".$ldapuser.",".$ldapconfig['basedn'];

        $result["dn"] = "";
        $result["guid"] = "";

        if ($ldapconn) {

            if (@ldap_bind($ldapconn, $ldaprdn, $ldappass)) {


               // $response_array['success'] = "$ldapuser has been successfully authenticated";

                $filter="(objectClass=user)";
                $justthese = array("dn", "objectGUID");
                $sr=ldap_search($ldapconn, $ldaprdn, $filter, $justthese);
                $info = ldap_get_entries($ldapconn, $sr);

                if(isset($info[0]["dn"]))
                    $result["dn"] = $info[0]["dn"];
                if(isset($info[0]["objectguid"][0]))
                    $result["guid"] = bin2hex($info[0]["objectguid"][0]);

                // Use HS256 to generate and parse tokens
                $signer = new HS256('12345678901234567890123456789012'); // secret key

                // Generate a token with a payload
                $generator = new Generator($signer);
                $jwt = $generator->generate(['guid' => $result["guid"], 'username' => $ldapuser, 'dn' => $result["dn"],'role' => 'admin']);

                // set cookie with expication of one hour
                setcookie("access_token", $jwt, time()+3600, "/", "10.128.30.7", false, true); // temporary fix
                //setcookie("access_token", $jwt, time()+3600, "/", "10.128.30.7", true, true);
                $result["username"] = $ldapuser;
                $result["login"] = true;
            } else {
                // user not authenticated
                $result["error"] = "User not authenticated";
            }
        }
        header('Content-Type: application/json');
        echo json_encode($result);
    }
    public function CustomLogout(){
        setcookie("access_token", "", time()-3600, "/", "", false, true);
    }
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
