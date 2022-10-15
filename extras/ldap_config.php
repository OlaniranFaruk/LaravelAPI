<?php

$ldapconfig['host'] = '10.128.63.131';
$ldapconfig['port'] = '389';
$ldapconfig['basedn'] = 'OU=TEST,DC=test,DC=local';
$ldapconn=ldap_connect($ldapconfig['host'], $ldapconfig['port']) or die("Could not connect to LDAP server.");
ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3) or die ("Could not set ldap protocol");
ldap_set_option($ldapconn, LDAP_OPT_REFERRALS, 0) or die ("Could not set option referrals");