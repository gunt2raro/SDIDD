<?php

class SolrClass
{
	public $_properties = array();

	public function __get($property_name) {

	if (property_exists($this, $property_name)) { return $this->$property_name; } else if (isset($_properties[$property_name])) { return $_properties[$property_name]; }

	   return null;

	}
}

$xml = simplexml_load_file( $_SERVER['DOCUMENT_ROOT']."/Index_system/Helpers/serverSolr_conf.xml" );

$server = $xml->connection->server;
$username = $xml->connection->username;
$password = $xml->connection->password;
$port = $xml->connection->port;


/* Domain name of the Solr server */
define('SOLR_SERVER_HOSTNAME', $server);

/* Whether or not to run in secure mode */
define('SOLR_SECURE', true);

/* HTTP Port to connection */
define('SOLR_SERVER_PORT', ((SOLR_SECURE) ? $port : $port));

/* HTTP Basic Authentication Username */
define('SOLR_SERVER_USERNAME', $username);

/* HTTP Basic Authentication password */
define('SOLR_SERVER_PASSWORD', $password);

/* HTTP connection timeout */
/* This is maximum time in seconds allowed for the http data transfer operation. Default value is 30 seconds */
define('SOLR_SERVER_TIMEOUT', 10);

/* File name to a PEM-formatted private key + private certificate (concatenated in that order) */
define('SOLR_SSL_CERT', 'certs/combo.pem');

/* File name to a PEM-formatted private certificate only */
define('SOLR_SSL_CERT_ONLY', 'certs/solr.crt');

/* File name to a PEM-formatted private key */
define('SOLR_SSL_KEY', 'certs/solr.key');

/* Password for PEM-formatted private key file */
define('SOLR_SSL_KEYPASSWORD', 'StrongAndSecurePassword');

/* Name of file holding one or more CA certificates to verify peer with*/
define('SOLR_SSL_CAINFO', 'certs/cacert.crt');

/* Name of directory holding multiple CA certificates to verify peer with */
define('SOLR_SSL_CAPATH', 'certs/');

?>
