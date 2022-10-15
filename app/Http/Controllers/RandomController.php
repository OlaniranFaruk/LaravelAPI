<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



class RandomController extends Controller
{
    public function CustomDepartment(){
        $username = "api";
        $password = "1;Azerty";

        $ldapconfig['host'] = '10.128.63.131';//CHANGE THIS TO THE CORRECT LDAP SERVER
        $ldapconfig['port'] = '389';
        $ldapconfig['basedn'] = 'OU=TEST,DC=test,DC=local';//CHANGE THIS TO THE CORRECT BASE DN
        $ldapconn=ldap_connect($ldapconfig['host'], $ldapconfig['port']) or die("Could not connect to LDAP server.");

        ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3) or die ("Could not set ldap protocol");
        ldap_set_option($ldapconn, LDAP_OPT_REFERRALS, 0) or die ("Could not set option referrals");

        $ldaprdn = "CN=".$username.",".$ldapconfig['basedn'];

        if ($ldapconn) {
            $ldapbind = ldap_bind($ldapconn, $ldaprdn, $password)  or die("Couldn't bind to AD!");
        }

//$dn = $ldapconfig['basedn'];
        $dn = "OU=TEST,DC=test,DC=local";
        $filter="(ObjectClass=group)";
        $attribute = array("dn","cn","objectGUID","objectClass");
//$filter = '(&(objectCategory=person)(objectClass=user))';
//$justthese = array('objectGUID', 'department');
        //$sr=ldap_search($ldapconn, $dn, $filter, $justthese);
        $sr=ldap_search($ldapconn, $dn, $filter, $attribute);
        $info = ldap_get_entries($ldapconn, $sr);

        $result = array();
        //print_r($info);
        for ($i=0; $i < $info["count"]; $i++) {
            if(isset($info[$i]["cn"][0]) && isset($info[$i]["objectclass"][0])) {
                $department["name"] = $info[$i]["cn"][0];
                $department["guid"] = bin2hex($info[$i]["objectguid"][0]);
                array_push($result, $department);
            }
        }



        header('Content-Type: application/json');
        echo json_encode($result);

        ldap_free_result($sr);
        ldap_unbind($ldapconn);
    }
    public function CustomOU(){
        $username = "api";
        $password = "1;Azerty";

        $ldapconfig['host'] = '10.128.63.131';//CHANGE THIS TO THE CORRECT LDAP SERVER
        $ldapconfig['port'] = '389';
        $ldapconfig['basedn'] = 'OU=TEST,DC=test,DC=local';//CHANGE THIS TO THE CORRECT BASE DN
        $ldapconn=ldap_connect($ldapconfig['host'], $ldapconfig['port']) or die("Could not connect to LDAP server.");

        ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3) or die ("Could not set ldap protocol");
        ldap_set_option($ldapconn, LDAP_OPT_REFERRALS, 0) or die ("Could not set option referrals");

        $ldaprdn = "CN=".$username.",".$ldapconfig['basedn'];

        if ($ldapconn) {
            $ldapbind = ldap_bind($ldapconn, $ldaprdn, $password)  or die("Couldn't bind to AD!");
        }

//$dn = $ldapconfig['basedn'];
        $dn = "DC=test,DC=local";
        $filter="(objectClass=organizationalunit)";
        $justthese = array("dn", "ou");
        $sr=ldap_search($ldapconn, $dn, $filter, $justthese);
        $info = ldap_get_entries($ldapconn, $sr);

        for ($i=0; $i < $info["count"]; $i++) {
            echo $info[$i]["dn"]."<br>";
        }

        ldap_free_result($sr);
        ldap_unbind($ldapconn);

    }

    public function CustomUsers(){
        $username = "api";
        $password = "1;Azerty";

        $ldapconfig['host'] = '10.128.63.131';//CHANGE THIS TO THE CORRECT LDAP SERVER
        $ldapconfig['port'] = '389';
        $ldapconfig['basedn'] = 'OU=TEST,DC=test,DC=local';//CHANGE THIS TO THE CORRECT BASE DN
        $ldapconn=ldap_connect($ldapconfig['host'], $ldapconfig['port']) or die("Could not connect to LDAP server.");

        ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3) or die ("Could not set ldap protocol");
        ldap_set_option($ldapconn, LDAP_OPT_REFERRALS, 0) or die ("Could not set option referrals");

        $ldaprdn = "CN=".$username.",".$ldapconfig['basedn'];

        if ($ldapconn) {
            $ldapbind = ldap_bind($ldapconn, $ldaprdn, $password)  or die("Couldn't bind to AD!");
        }

//$dn = $ldapconfig['basedn'];
        $dn = "DC=test,DC=local";
        $filter="(objectClass=user)";
        $justthese = array("dn", "objectGUID", "displayname", "givenname", "mail", "physicaldeliveryofficename", "postaladdress", "sn", "surname");
        $sr=ldap_search($ldapconn, $dn, $filter, $justthese);
        $info = ldap_get_entries($ldapconn, $sr);

        header('Content-Type: application/json');

       // print_r($info);

        for ($i=0; $i < $info["count"]; $i++) {
            echo $info[$i]["dn"]."<br>";
        }


        ldap_free_result($sr);
        ldap_unbind($ldapconn);
    }


}
