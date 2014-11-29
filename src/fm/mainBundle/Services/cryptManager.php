<?php
namespace fm\mainBundle\Services;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class cryptManager
{

	private $secret;
    private $expires;
    /**
     * @param string $secret
     */
    public function __construct($secret,$expires)
    {
        $this->secret = $secret;
        $this->expires = $expires;
    }
 
    public  function encrypt ($input) {
        $input = array("data" => $input,"expires" => time());
    	$input = serialize($input);
        $output = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($this->secret), $input, MCRYPT_MODE_CBC, md5(md5($this->secret))));
        return urlencode($output);
    }
 
    public  function decrypt ($input) {
        $output = @unserialize(rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($this->secret), base64_decode(urldecode($input)), MCRYPT_MODE_CBC, md5(md5($this->secret))), "\0"));
        if(!$output) throw new NotFoundHttpException("TOKEN NOT EXISTS");

        if(time()-$output['expires'] > $this->expires) throw new NotFoundHttpException("TOKEN EXPIRED");

        return $output['data'];
    }
}