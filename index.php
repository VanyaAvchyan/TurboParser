<?php
include __DIR__.'/autoloader.php';

class JsonFactory {
    /** @var json $json */
    private $json;
    /**
     * 
     * @param string $jsonStr Json string
     */
    public function __construct($jsonStr) {
        try {
            $this->json = $this->json_decode_nice($jsonStr);
        } catch (Exception $e) {
            echo $e->getMessage(); exit;
        }
    }
    /**
     * Wrapper for  json_decode, to be a little more lenient (more like Javascript)
     * 
     * @param string $json Json string
     * @return json Json data
     * @throws Exception
     */
    private function json_decode_nice($json)
    {
        $jsonString = $json;
        $json = str_replace(array("\n","\r"), "", $json); 
        $json = preg_replace('/([{,]+)(\s*)([^"]+?)\s*:/','$1"$3":', $json);
        $json = preg_replace('/(,)\s*}$/','}', $json);
        $json = json_decode($json);
        if(json_last_error())
            throw new Exception('Not valid json : '.json_last_error_msg().'<br>'.$jsonString);
        return $json;
    }
    /**
     * 
     * @return type
     */
    function getResult()
    {
        $json = $this->json->job;
        $process = key($json);
        $res = false;
        switch ($process)
        {
            case 'text' : $res = (new TextFactory())->process($json->text, $json->methods); break;
            default     : $res = "Processing '{$process}' does not exist !";
        }
        return $res;
    }
}
$dat_json = 
'{
    "job" : {
        "text": "aaa[.,/!@#$%&*()]bbb",
        "methods": [
            "stripTags", "removeSpaces", "replaceSpacesToEol", "htmlspecialchars", "removeSymbols", "toNumber"
        ]
    }
}';
$factory = new JsonFactory($dat_json);
echo $factory->getResult();
?>