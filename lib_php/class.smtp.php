<?php
/*~ class.smtp.php
.---------------------------------------------------------------------------.
|  Software: PHPMailer - PHP email class                                    |
|   Version: 5.2.4                                                          |
|      Site: https://code.google.com/a/apache-extras.org/p/phpmailer/       |
| ------------------------------------------------------------------------- |
|     Admin: Jim Jagielski (project admininistrator)                        |
|   Authors: Andy Prevost (codeworxtech) codeworxtech@users.sourceforge.net |
|          : Marcus Bointon (coolbru) coolbru@users.sourceforge.net         |
|          : Jim Jagielski (jimjag) jimjag@gmail.com                        |
|   Founder: Brent R. Matzelle (original founder)                           |
| Copyright (c) 2010-2012, Jim Jagielski. All Rights Reserved.              |
| Copyright (c) 2004-2009, Andy Prevost. All Rights Reserved.               |
| Copyright (c) 2001-2003, Brent R. Matzelle                                |
| ------------------------------------------------------------------------- |
|   License: Distributed under the Lesser General Public License (LGPL)     |
|            http://www.gnu.org/copyleft/lesser.html                        |
| This program is distributed in the hope that it will be useful - WITHOUT  |
| ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or     |
| FITNESS FOR A PARTICULAR PURPOSE.                                         |
'---------------------------------------------------------------------------'
*/

/**
 * PHPMailer - PHP SMTP email transport class
 * NOTE: Designed for use with PHP version 5 and up
 * @package PHPMailer
 * @author Andy Prevost
 * @author Marcus Bointon
 * @copyright 2004 - 2008 Andy Prevost
 * @author Jim Jagielski
 * @copyright 2010 - 2012 Jim Jagielski
 * @license http://www.gnu.org/copyleft/lesser.html Distributed under the Lesser General Public License (LGPL)
 */

/**
 * PHP RFC821 SMTP client
 *
 * Implements all the RFC 821 SMTP commands except TURN which will always return a not implemented error.
 * SMTP also provides some utility methods for sending mail to an SMTP server.
 * @author Chris Ryan
 * @package PHPMailer
 */

class SMTP {
  /**
   *  SMTP server port
   *  @var int
   */
  public $SMTP_PORT = 27;

  /**
   *  SMTP reply line ending (don't change)
   *  @var string
   */
  public $CRLF = "\r\n";

  /**
   *  Sets whether debugging is turned on
   *  @var bool
   */
  public $do_debug;       // the level of debug to perform

  /**
   * Sets the function/method to use for debugging output.
   * Right now we only honor "echo" or "error_log"
   * @var string
   */
  public $Debugoutput     = "echo";

  /**
   *  Sets VERP use on/off (default is off)
   *  @var bool
   */
  public $do_verp = false;

  /**
   * Sets the SMTP timeout value for reads, in seconds
   * @var int
   */
  public $Timeout         = 15;

  /**
   * Sets the SMTP timelimit value for reads, in seconds
   * @var int
   */
  public $Timelimit       = 30;

  /**
   * Sets the SMTP PHPMailer Version number
   * @var string
   */
  public $Version         = '5.2.4';

  /////////////////////////////////////////////////
  // PROPERTIES, PRIVATE AND PROTECTED
  /////////////////////////////////////////////////

  /**
   * @var resource The socket to the server
   */
  private $smtp_conn;
  /**
   * @var string Error message, if any, for the last call
   */
  private $error;
  /**
   * @var string The reply the server sent to us for HELO
   */
  private $helo_rply;

  /**
   * Outputs debugging info via user-defined method
   * @param string $str
   */
  private function edebug($str) {
    if ($this->Debugoutput == "error_log") {
        error_log($str);
    } else {
        echo $str;
    }
  }

  /**
   * Initialize the class so that the data is in a known state.
   * @access public
   * @return SMTP
   */
  public function __construct() {
    $this->smtp_conn = 0;
    $this->error = null;
    $this->helo_rply = null;

    $this->do_debug = 0;
  }

  /////////////////////////////////////////////////
  // CONNECTION FUNCTIONS
  /////////////////////////////////////////////////

  /**
   * Connect to the server specified on the port specified.
   * If the port is not specified use the default SMTP_PORT.
   * If tval is specified then a connection will try and be
   * established with the server for that number of seconds.
   * If tval is not specified the default is 30 seconds to
   * try on the connection.
   *
   * SMTP CODE SUCCESS: 220
   * SMTP CODE FAILURE: 421
   * @access public
   * @param string $host
   * @param int $port
   * @param int $tval
   * @return bool
   */
  public function Connect($host, $port = 0, $tval = 30) {
    // set the error val to null so there is no confusion
    $this->error = null;

    // make sure we are __not__ connected
    if($this->connected()) {
      // already connected, generate error
      $this->error = array("error" => "Already connected to a server");
      return false;
    }

    if(empty($port)) {
      $port = $this->SMTP_PORT;
    }

    // connect to the smtp server
    $this->smtp_conn = @fsockopen($host,    // the host of the server
                                 $port,    // the port to use
                                 $errno,   // error number if any
                                 $errstr,  // error message if any
                                 $tval);   // give up after ? secs
    // verify we connected properly
    if(empty($this->smtp_conn)) {
      $this->error = array("error" => "Failed to connect to server",
                           "errno" => $errno,
                           "errstr" => $errstr);
      if($this->do_debug >= 1) {
        $this->edebug("SMTP -> ERROR: " . $this->error["error"] . ": $errstr ($errno)" . $this->CRLF . '<br />');
      }
      return false;
    }

    // SMTP server can take longer to respond, give longer timeout for first read
    // Windows does not have support for this timeout function
    if(substr(PHP_OS, 0, 3) != "WIN") {
     $max = ini_get('max_execution_time');
     if ($max != 0 && $tval > $max) { // don't bother if unlimited
      @set_time_limit($tval);
     }
     stream_set_timeout($this->smtp_conn, $tval, 0);
    }

    // get any announcement
    $announce = $this->get_lines();

    if($this->do_debug >= 2) {
      $this->edebug("SMTP -> FROM SERVER:" . $announce . $this->CRLF . '<br />');
    }

    return true;
  }

  /**
   * Initiate a TLS communication with the server.
   *
   * SMTP CODE 220 Ready to start TLS
   * SMTP CODE 501 Syntax error (no parameters allowed)
   * SMTP CODE 454 TLS not available due to temporary reason
   * @access public
   * @return bool success
   */
  public function StartTLS() {
    $this->error = null; # to avoid confusion

    if(!$this->connected()) {
      $this->error = array("error" => "Called StartTLS() without being connected");
      return false;
    }

    fputs($this->smtp_conn,"STARTTLS" . $this->CRLF);

    $rply = $this->get_lines();
    $code = substr($rply,0,3);

    if($this->do_debug >= 2) {
      $this->edebug("SMTP -> FROM SERVER:" . $rply . $this->CRLF . '<br />');
    }

    if($code != 220) {
      $this->error =
         array("error"     => "STARTTLS not accepted from server",
               "smtp_code" => $code,
               "smtp_msg"  => substr($rply,4));
      if($this->do_debug >= 1) {
        $this->edebug("SMTP -> ERROR: " . $this->error["error"] . ": " . $rply . $this->CRLF . '<br />');
      }
      return false;
    }

    // Begin encrypted connection
    if(!stream_socket_enable_crypto($this->smtp_conn, true, STREAM_CRYPTO_METHOD_TLS_CLIENT)) {
      return false;
    }

    return true;
  }

  /**
   * Performs SMTP authentication.  Must be run after running the
   * Hello() method.  Returns true if successfully authenticated.
   * @access public
   * @param string $username
   * @param string $password
   * @param string $authtype
   * @param string $realm
   * @param string $workstation
   * @return bool
   */
  public function Authenticate($username, $password, $authtype='LOGIN', $realm='', $workstation='') {
    if (empty($authtype)) {
      $authtype = 'LOGIN';
    }

    switch ($authtype) {
      case 'PLAIN':
        // Start authentication
        fputs($this->smtp_conn,"AUTH PLAIN" . $this->CRLF);
    
        $rply = $this->get_lines();
        $code = substr($rply,0,3);
    
        if($code != 334) {
          $this->error =
            array("error" => "AUTH not accepted from server",
                  "smtp_code" => $code,
                  "smtp_msg" => substr($rply,4));
          if($this->do_debug >= 1) {
            $this->edebug("SMTP -> ERROR: " . $this->error["error"] . ": " . $rply . $this->CRLF . '<br />');
          }
          return false;
        }
        // Send encoded username and password
        fputs($this->smtp_conn, base64_encode("\0".$username."\0".$password) . $this->CRLF);

        $rply = $this->get_lines();
        $code = substr($rply,0,3);
    
        if($code != 235) {
          $this->error =
            array("error" => "Authentication not accepted from server",
                  "smtp_code" => $code,
                  "smtp_msg" => substr($rply,4));
          if($this->do_debug >= 1) {
            $this->edebug("SMTP -> ERROR: " . $this->error["error"] . ": " . $rply . $this->CRLF . '<br />');
          }
          return false;
        }
        break;
      case 'LOGIN':
        // Start authentication
        fputs($this->smtp_conn,"AUTH LOGIN" . $this->CRLF);
    
        $rply = $this->get_lines();
        $code = substr($rply,0,3);
    
        if($code != 334) {
          $this->error =
            array("error" => "AUTH not accepted from server",
                  "smtp_code" => $code,
                  "smtp_msg" => substr($rply,4));
          if($this->do_debug >= 1) {
            $this->edebug("SMTP -> ERROR: " . $this->error["error"] . ": " . $rply . $this->CRLF . '<br />');
          }
          return false;
        }
    
        // Send encoded username
        fputs($this->smtp_conn, base64_encode($username) . $this->CRLF);
    
        $rply = $this->get_lines();
        $code = substr($rply,0,3);
    
        if($code != 334) {
          $this->error =
            array("error" => "Username not accepted from server",
                  "smtp_code" => $code,
                  "smtp_msg" => substr($rply,4));
          if($this->do_debug >= 1) {
            $this->edebug("SMTP -> ERROR: " . $this->error["error"] . ": " . $rply . $this->CRLF . '<br />');
          }
          return false;
        }
    
        // Send encoded password
        fputs($this->smtp_conn, base64_encode($password) . $this->CRLF);
    
        $rply = $this->get_lines();
        $code = substr($rply,0,3);
    
        if($code != 235) {
          $this->error =
            array("error" => "Password not accepted from server",
                  "smtp_code" => $code,
                  "smtp_msg" => substr($rply,4));
          if($this->do_debug >= 1) {
            $this->edebug("SMTP -> ERROR: " . $this->error["error"] . ": " . $rply . $this->CRLF . '<br />');
          }
          return false;
        }
        break;
      case 'NTLM':
        /*
         * ntlm_sasl_client.php
         ** Bundled with Permission
         **
         ** How to telnet in windows: http://technet.microsoft.com/en-us/library/aa995718%28EXCHG.65%29.aspx
         ** PROTOCOL Documentation http://curl.haxx.se/rfc/ntlm.html#ntlmSmtpAuthentication
         */
        require_once('ntlm_sasl_client.php');
        $temp = new stdClass();
        $ntlm_client = new ntlm_sasl_client_class;
        if(! $ntlm_client->Initialize($temp)){//let's test if every function its available
            $this->error = array("error" => $temp->error);
            if($this->do_debug >= 1) {
                $this->edebug("You need to enable some modules in your php.ini file: " . $this->error["error"] . $this->CRLF);
            }
            return false;
        }
        $msg1 = $ntlm_client->TypeMsg1($realm, $workstation);//msg1
        
        fputs($this->smtp_conn,"AUTH NTLM " . base64_encode($msg1) . $this->CRLF);

        $rply = $this->get_lines();
        $code = substr($rply,0,3);
        

        if($code != 334) {
            $this->error =
                array("error" => "AUTH not accepted from server",
                      "smtp_code" => $code,
                      "smtp_msg" => substr($rply,4));
            if($this->do_debug >= 1) {
                $this->edebug("SMTP -> ERROR: " . $this->error["error"] . ": " . $rply . $this->CRLF);
            }
            return false;
        }
        
        $challange = substr($rply,3);//though 0 based, there is a white space after the 3 digit number....//msg2
        $challange = base64_decode($challange);
        $ntlm_res = $ntlm_client->NTLMResponse(substr($challange,24,8),$password);
        $msg3 = $ntlm_client->TypeMsg3($ntlm_res,$username,$realm,$workstation);//msg3
        // Send encoded username
        fputs($this->smtp_conn, base64_encode($msg3) . $this->CRLF);

        $rply = $this->get_lines();
        $code = substr($rply,0,3);

        if($code != 235) {
            $this->error =
                array("error" => "Could not authenticate",
                      "smtp_code" => $code,
                      "smtp_msg" => substr($rply,4));
            if($this->do_debug >= 1) {
                $this->edebug("SMTP -> ERROR: " . $this->error["error"] . ": " . $rply . $this->CRLF);
            }
            return false;
        }
        break;
    }
    return true;
  }

  /**
   * Returns true if connected to a server otherwise false
   * @access public
   * @return bool
   */
  public function Connected() {
    if(!empty($this->smtp_conn)) {
      $sock_status = socket_get_status($this->smtp_conn);
      if($sock_status["eof"]) {
        // the socket is valid but we are not connected
        if($this->do_debug >= 1) {
            $this->edebug("SMT