<?php

namespace App\Http\Controllers;

include '../../../vendor/autoload.php';

use MiladRahimi\Jwt\Generator;
use MiladRahimi\Jwt\Parser;
use MiladRahimi\Jwt\Cryptography\Algorithms\Hmac\HS256;
use Illuminate\Http\Request;


class ADemployees extends Controller
{
    public function AddEmployee(){
        $jwt_key_employees = "12345678901234567890123456789012";

        $signer = new HS256($jwt_key_employees);

        if(!isset($_COOKIE["access_token"])) {
            // redirect to login page
            $result["error"] = "User not logged in.";
            header('Content-Type: application/json');
            echo json_encode($result);
            die();
        } else {
            // check if the token inside the cookie is valid
            // Parse the token
            try {
                $parser = new Parser($signer);
                $claims = $parser->parse($_COOKIE["access_token"]);

                // check if user has permission to do this
                if(!in_array("CN=Supervisors,OU=TEST,DC=test,DC=local", $claims["groups"])) {
                    // token not valid
                    $result["error"] = "Permission denied!";
                    header('Content-Type: application/json');
                    echo json_encode($result);
                    die();
                }

            } catch(Exception $e) {
                // token not valid
                $result["error"] = "User not logged in.";
                header('Content-Type: application/json');
                echo json_encode($result);
                die();
            }
        }

        $username = "api";
        $password = "1;Azerty";

        $ldapconfig['host'] = '10.128.63.131';
        $ldapconfig['port'] = '389';
        $ldapconfig['basedn'] = 'OU=TEST,DC=test,DC=local';
        $ldapconn=ldap_connect($ldapconfig['host'], $ldapconfig['port']) or die("Could not connect to LDAP server.");
        ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3) or die ("Could not set ldap protocol");
        ldap_set_option($ldapconn, LDAP_OPT_REFERRALS, 0) or die ("Could not set option referrals");

        $ldaprdn = "CN=".$username.",".$ldapconfig['basedn'];

        if ($ldapconn) {
            $ldapbind = ldap_bind($ldapconn, $ldaprdn, $password) or die("Couldn't bind to AD!");
        }

// dn of the user
        $dn = ",OU=TEST,DC=test,DC=local";

        $enteredlastname = $_GET["employeeLastName"];
        $enteredfirstname = $_GET["employeeFirstName"];

        if(!isset($enteredfirstname)) {
            $result["error"] = "First name not set.";
            header('Content-Type: application/json');
            echo json_encode($result);
            die();
        }

        if(!isset($enteredlastname)) {
            $result["error"] = "Last name not set.";
            header('Content-Type: application/json');
            echo json_encode($result);
            die();
        }

        $lastname = str_replace(' ','',$enteredlastname);
        $firstname = str_replace(' ','',$enteredfirstname);



        $values["sn"][0] = $firstname;
        $values["givenname"][0] = $lastname;

//$values["objectclass"] = "person";
        $values["objectclass"][0] = "top";
        $values["objectclass"][1] = "person";
        $values["objectclass"][2] = "organizationalPerson";
        $values["objectclass"][3] = "user";

// strip out all whitespace
        $newAccount = preg_replace('/\s*/', '', $firstname.".".$lastname);
// convert the string to all lowercase
        $newAccount = strtolower($newAccount);

        $result["newUser"] = $newAccount;

        $values["sAMAccountName"][0] = $firstname.".".$lastname;
        $values["displayname"][0] = $firstname.".".$lastname;
        $values["userPrincipalName"][0] = $firstname.".".$lastname."@test.local";
//$values["useraccountcontrol"] = 512;
//$values["unicodepwd"] = "1;Azerty";


// modify values and check for errors
        if(isset($values) && !ldap_add($ldapconn, "CN=".$firstname.$lastname.$dn, $values)) {
            $result["error"] = ldap_error($ldapconn);
            header('Content-Type: application/json');
            echo json_encode($result);
            die();
        }

// user is created but not actived yet
        $filter="(&(objectClass=user)(sAMAccountName=".$values["sAMAccountName"][0]."))";
        $justthese = array("dn", "useraccountcontrol");
        $sr=ldap_search($ldapconn, "CN=".$firstname.$lastname.$dn, $filter, $justthese);
        $info = ldap_get_entries($ldapconn, $sr);

        if($info["count"] > 0) {

            // https://forums.phpfreaks.com/topic/129205-solved-disabling-account-using-ldap-and-php/
            $ac = $info[0]["useraccountcontrol"][0];
            $disable=($ac |  2); // set all bits plus bit 1 (=dec2)
            $enable =($ac & ~2); // set all bits minus bit 1 (=dec2)

            $values["useraccountcontrol"][0] = $enable;

            // modify values and check for errors
            if(isset($values) && !ldap_modify($ldapconn, $info[0]["dn"], $values)) {
                $result["error"] = ldap_error($ldapconn);
                header('Content-Type: application/json');
                echo json_encode($result);
                die();
            } else {
                $result["success"] = True;
            }

        } else {
            // token not valid
            $result["error"] = "User not found.";
            header('Content-Type: application/json');
            echo json_encode($result);
            die();
        }


        $result["success"] = True;


        header('Content-Type: application/json');
        echo json_encode($result);

        ldap_unbind($ldapconn);


    }
    public function DisableEmployee(){
        $jwt_key_employees = "12345678901234567890123456789012";
        $signer = new HS256($jwt_key_employees);

        if(!isset($_COOKIE["access_token"])) {
            // redirect to login page
            $result["error"] = "User not logged in.";
            header('Content-Type: application/json');
            echo json_encode($result);
            die();
        } else {
            // check if the token inside the cookie is valid
            // Parse the token
            try {
                $parser = new Parser($signer);
                $claims = $parser->parse($_COOKIE["access_token"]);

                // check if user has permission to do this
                if(!in_array("CN=Supervisors,OU=TEST,DC=test,DC=local", $claims["groups"])) {
                    // token not valid
                    $result["error"] = "Permission denied!";
                    header('Content-Type: application/json');
                    echo json_encode($result);
                    die();
                }

            } catch(Exception $e) {
                // token not valid
                $result["error"] = "User not logged in.";
                header('Content-Type: application/json');
                echo json_encode($result);
                die();
            }
        }

        $username = "api";
        $password = "1;Azerty";

        $ldapconfig['host'] = '10.128.63.131';
        $ldapconfig['port'] = '389';
        $ldapconfig['basedn'] = 'OU=TEST,DC=test,DC=local';
        $ldapconn=ldap_connect($ldapconfig['host'], $ldapconfig['port']) or die("Could not connect to LDAP server.");
        ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3) or die ("Could not set ldap protocol");
        ldap_set_option($ldapconn, LDAP_OPT_REFERRALS, 0) or die ("Could not set option referrals");

        $ldaprdn = "CN=".$username.",".$ldapconfig['basedn'];

        if ($ldapconn) {
            $ldapbind = ldap_bind($ldapconn, $ldaprdn, $password) or die("Couldn't bind to AD!");
        }

        $dn = "OU=TEST,DC=test,DC=local";

        $id = $_GET["id"];

        if(!isset($id)) {
            // token not valid
            $result["error"] = "ID not set.";
            header('Content-Type: application/json');
            echo json_encode($result);
            die();
        }

        $enabled = intval($_GET["enabled"]);

        if(!isset($_GET["enabled"])) {
            // token not valid
            $result["error"] = "Enabled not set.";
            header('Content-Type: application/json');
            echo json_encode($result);
            die();
        }




        $filter="(&(objectClass=user)(employeeID=".$id."))";
        $justthese = array("dn", "useraccountcontrol");
        $sr=ldap_search($ldapconn, $dn, $filter, $justthese);
        $info = ldap_get_entries($ldapconn, $sr);

        if($info["count"] > 0) {

            $ac = $info[0]["useraccountcontrol"][0];
            $disable=($ac |  2); // set all bits plus bit 1 (=dec2)
            $enable =($ac & ~2); // set all bits minus bit 1 (=dec2)

            $values["useraccountcontrol"][0] = $enabled == 1 ? $enable : $disable;

            // modify values and check for errors
            if(isset($values) && !ldap_modify($ldapconn, $info[0]["dn"], $values)) {
                $result["error"] = ldap_error($ldapconn);
                header('Content-Type: application/json');
                echo json_encode($result);
                die();
            } else {
                $result["success"] = True;
            }

        } else {
            // token not valid
            $result["error"] = "User not found.";
            header('Content-Type: application/json');
            echo json_encode($result);
            die();
        }



        header('Content-Type: application/json');
        echo json_encode($result);

        ldap_free_result($sr);
        ldap_unbind($ldapconn);

    }

    public function CustomEmployees() {
        $jwt_key_employees = "12345678901234567890123456789012";

        $signer = new HS256($jwt_key_employees);

//        if(!isset($_COOKIE["access_token"])) {
//            // redirect to login page
//            $result["error"] = "User not logged in.";
//            header('Content-Type: application/json');
//            echo json_encode($result);
//            die();
        //       } else {
        // check if the token inside the cookie is valid
        // Parse the token
//            try {
        //               $parser = new Parser($signer);
//                $claims = $parser->parse($_COOKIE["access_token"]);
        //           } catch(Exception $e) {
        //               // token not valid
        //               $result["error"] = "User not logged in.";
        //               header('Content-Type: application/json');
        //             echo json_encode($result);
//                die();
        //           }
        //       }

        $ldapconfig['host'] = '10.128.63.131';
        $ldapconfig['port'] = '389';
        $ldapconfig['basedn'] = 'OU=TEST,DC=test,DC=local';
        $ldapconn=ldap_connect($ldapconfig['host'], $ldapconfig['port']) or die("Could not connect to LDAP server.");
        ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3) or die ("Could not set ldap protocol");
        ldap_set_option($ldapconn, LDAP_OPT_REFERRALS, 0) or die ("Could not set option referrals");

        $username = "api";
        $password = "1;Azerty";



        $ldaprdn = "CN=".$username.",".$ldapconfig['basedn'];

        if ($ldapconn) {
            $ldapbind = ldap_bind($ldapconn, $ldaprdn, $password) or die("Couldn't bind to AD!");
        }

//$dn = $ldapconfig['basedn'];
        $dn = "DC=test,DC=local";
        $filter="(&(objectClass=user)(EmployeeID=*))";
        $justthese = array("dn", "objectGUID", "sAMAccountName", "givenname", "mail", "postaladdress", "sn", "whenCreated", "whenChanged", "mobile", "employeeID", "department", "memberOf", "useraccountcontrol");
        $sr=ldap_search($ldapconn, $dn, $filter, $justthese);
        $info = ldap_get_entries($ldapconn, $sr);



//print_r($info);

        $allResults = [];



        for ($i=0; $i < $info["count"]; $i++) {

            $result["id"] = null;
            $result["dn"] = "";
            $result["guid"] = "";
            $result["username"] = "";
            $result["employeeMailAddress"] = "";
            //$result["employeeAddress"] = "";
            $result["employeeLastName"] = "";
            $result["employeeFirstName"] = "";
            $result["employeePhoneNumber"] = "";
            $result["employeeDepartment"] = "";
            $result["memberOf"] = [];
            $result["enabled"] = null;
            $result["created_at"] = "";
            $result["updated_at"] = "";

            if(isset($info[$i]["dn"]))
                $result["dn"] = $info[$i]["dn"];
            if(isset($info[$i]["objectguid"][0]))
                $result["guid"] = bin2hex($info[$i]["objectguid"][0]);
            if(isset($info[$i]["samaccountname"][0]))
                $result["username"] = $info[$i]["samaccountname"][0];
            if(isset($info[$i]["mail"][0]))
                $result["employeeMailAddress"] = $info[$i]["mail"][0];
            /*if(isset($info[$i]["postaladdress"][0]))
                $result["employeeAddress"] = $info[$i]["postaladdress"][0];*/
            if(isset($info[$i]["sn"][0]))
                $result["employeeLastName"] = $info[$i]["sn"][0];
            if(isset($info[$i]["givenname"][0]))
                $result["employeeFirstName"] = $info[$i]["givenname"][0];
            if(isset($info[$i]["whencreated"][0])) {
                $result["created_at"] = $info[$i]["whencreated"][0];
                $result["created_at"] = substr_replace($result["created_at"], '-', 4, 0);
                $result["created_at"] = substr_replace($result["created_at"], '-', 7, 0);
                $result["created_at"] = substr_replace($result["created_at"], ' ', 10, 0);
                $result["created_at"] = substr_replace($result["created_at"], ':', 13, 0);
                $result["created_at"] = substr_replace($result["created_at"], ':', 16, 0);
            }
            if(isset($info[$i]["whenchanged"][0])) {
                $result["updated_at"] = $info[$i]["whenchanged"][0];
                $result["updated_at"] = substr_replace($result["updated_at"], '-', 4, 0);
                $result["updated_at"] = substr_replace($result["updated_at"], '-', 7, 0);
                $result["updated_at"] = substr_replace($result["updated_at"], ' ', 10, 0);
                $result["updated_at"] = substr_replace($result["updated_at"], ':', 13, 0);
                $result["updated_at"] = substr_replace($result["updated_at"], ':', 16, 0);
            }
            if(isset($info[$i]["mobile"][0]))
                $result["employeePhoneNumber"] = $info[$i]["mobile"][0];
            if(isset($info[$i]["employeeid"][0]))
                $result["id"] = intval($info[$i]["employeeid"][0]);
            if(isset($info[$i]["department"][0]))
                $result["employeeDepartment"] = $info[$i]["department"][0];
            if(isset($info[$i]["memberof"])) {
                $result["memberOf"] = array_values($info[$i]["memberof"]);
                array_shift($result["memberOf"]);
            }
            if(isset($info[$i]["useraccountcontrol"][0])) {
                $ac = $info[$i]["useraccountcontrol"][0];
                $result["enabled"] = ($ac & 2) == 2 ? 0 : 1;
            }


            array_push($allResults, $result);
        }

        header('Content-Type: application/json');
        sort($allResults);

        $EmployeeId = $_GET["id"];
        if ($EmployeeId!==null){
            if ($EmployeeId!==''){
                echo json_encode($allResults[$EmployeeId -1]);
            }
            else{
                //if the result is empty
                return 'not found';
            }
        }else{
            echo json_encode($allResults);
        }



        ldap_free_result($sr);
        ldap_unbind($ldapconn);
    }
}
