<?php

// cridentials for api admin user
$username = "api";
$password = "1;Azerty";

include realpath('ldap_config.php');

global $ldapconn, $ldapconfig;

$ldaprdn = "CN=".$username.",".$ldapconfig['basedn'];

if ($ldapconn) {
    $ldapbind = ldap_bind($ldapconn, $ldaprdn, $password) or die("Couldn't bind to AD!");
}
