<?php

/**
 * Validate Email Addresses Via SMTP
 * This queries the SMTP server to see if the email address is accepted.
 *
 * @copyright http://creativecommons.org/licenses/by/2.0/ - Please keep this comment intact
 * @author gabe@fijiwebdesign.com
 * @contributers adnan@barakatdesigns.net
 *
 * @version 0.1a
 */
class SMTP_validateEmail
{
 /**
  * PHP Socket resource to remote MTA
  *
  * @var resource
  */
    public $sock;

 /**
  * Current User being validated
  */
    public $user;
 /**
  * Current domain where user is being validated
  */
    public $domain;
 /**
  * List of domains to validate users on
  */
    public $domains;
 /**
  * SMTP Port
  */
    public $port = 25;
 /**
  * Maximum Connection Time to an MTA
  */
    public $max_conn_time = 30;
 /**
  * Maximum time to read from socket
  */
    public $max_read_time = 5;

 /**
  * username of sender
  */
    public $from_user = 'user';
 /**
  * Host Name of sender
  */
    public $from_domain = 'localhost';

 /**
  * Nameservers to use when make DNS query for MX entries
  *
  * @var Array
  */
    public $nameservers = [
    '192.168.0.1',
    ];

    public $debug = true;

 /**
  * Initializes the Class
  *
  * @param $email Array[optional] List of Emails to Validate
  * @param $sender String[optional] Email of validator
  *
  * @return SMTP_validateEmail Instance
  */
    public function __construct($emails = false, $sender = false)
    {
        if ($emails) {
            $this->setEmails($emails);
        }
        if ($sender) {
            $this->setSenderEmail($sender);
        }
    }

    public function _parseEmail($email)
    {
        $parts = explode('@', $email);
        $domain = array_pop($parts);
        $user = implode('@', $parts);

        return [$user, $domain];
    }

 /**
  * Set the Emails to validate
  *
  * @param $emails Array List of Emails
  */
    public function setEmails($emails)
    {
        foreach ($emails as $email) {
            list($user, $domain) = $this->_parseEmail($email);
            if (!isset($this->domains[$domain])) {
                $this->domains[$domain] = [];
            }
            $this->domains[$domain][] = $user;
        }
    }

 /**
  * Set the Email of the sender/validator
  *
  * @param $email String
  */
    public function setSenderEmail($email)
    {
        $parts = $this->_parseEmail($email);
        $this->from_user = $parts[0];
        $this->from_domain = $parts[1];
    }

 /**
  * Validate Email Addresses
  *
  * @param String $emails Emails to validate (recipient emails)
  * @param String $sender Sender's Email
  *
  * @return Array Associative List of Emails and their validation results
  */
    public function validate($emails = false, $sender = false)
    {
        $results = [];
        if (!function_exists('getmxrr')) {
            return [$emails[0] => true];
        }

        if ($emails) {
            $this->setEmails($emails);
        }
        if ($sender) {
            $this->setSenderEmail($sender);
        }

     // query the MTAs on each Domain
        foreach ($this->domains as $domain => $users) {
            $mxs = [];

         // retrieve SMTP Server via MX query on domain
            list($hosts, $mxweights) = $this->queryMX($domain);

         // retrieve MX priorities
            for ($n = 0; $n < count($hosts); ++$n) {
                $mxs[$hosts[$n]] = $mxweights[$n];
            }
            asort($mxs);

         // last fallback is the original domain
            array_push($mxs, $this->domain);

            $this->debug(print_r($mxs, 1));

            $timeout = $this->max_conn_time / count($hosts);

         // try each host
            while (list($host) = each($mxs)) {
                // connect to SMTP server
                $this->debug("try $host:$this->port\n");
                if ($this->sock = fsockopen($host, $this->port, $errno, $errstr, (float) $timeout)) {
                    stream_set_timeout($this->sock, $this->max_read_time);
                    break;
                }
            }

         // did we get a TCP socket
            if ($this->sock) {
                $reply = fread($this->sock, 2082);
                $this->debug("<<<\n$reply");

                preg_match('/^([0-9]{3}) /ims', $reply, $matches);
                $code = isset($matches[1]) ? $matches[1] : '';

                if ($code != '220') {
                    // MTA gave an error...
                    foreach ($users as $user) {
                           $results[$user . '@' . $domain] = false;
                    }
                    continue;
                }

             // say helo
                $this->send("HELO " . $this->from_domain);
             // tell of sender
                $this->send("MAIL FROM: <" . $this->from_user . '@' . $this->from_domain . ">");

             // ask for each recepient on this domain
                foreach ($users as $user) {
                 // ask of recepient
                    $reply = $this->send("RCPT TO: <" . $user . '@' . $domain . ">");

                  // get code and msg from response
                    preg_match('/^([0-9]{3}) /ims', $reply, $matches);
                    $code = isset($matches[1]) ? $matches[1] : '';

                    if ($code == '250') {
                        // you received 250 so the email address was accepted
                        $results[$user . '@' . $domain] = true;
                    } elseif ($code == '451' || $code == '452') {
                        // you received 451 so the email address was greylisted (or some temporary error occured on the MTA) - so assume is ok
                        $results[$user . '@' . $domain] = true;
                    } else {
                        $results[$user . '@' . $domain] = false;
                    }
                }

             // quit
                $this->send("quit");
             // close socket
                fclose($this->sock);
            }
        }

        return $results;
    }

    public function send($msg)
    {
        fwrite($this->sock, $msg . "\r\n");

        $reply = fread($this->sock, 2082);

        $this->debug(">>>\n$msg\n");
        $this->debug("<<<\n$reply");

        return $reply;
    }

 /**
  * Query DNS server for MX entries
  *
  * @return
  */
    public function queryMX($domain)
    {
        $hosts = [];
        $mxweights = [];
        if (function_exists('getmxrr')) {
            getmxrr($domain, $hosts, $mxweights);
        } else {
            $hosts[] = "TRUE";
            $mxweights[] = "TRUE";
        }

        return [$hosts, $mxweights];
    }

 /**
  * Simple function to replicate PHP 5 behaviour. http://php.net/microtime
  */
    public function microtime_float()
    {
        list($usec, $sec) = explode(" ", microtime());

        return ((float) $usec + (float) $sec);
    }

    public function debug($str)
    {
        if ($this->debug) {
            echo htmlentities($str);
        }
    }
}
