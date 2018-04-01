<?php
class TextFactory extends AbstractFactory
{
    /**
     * Strip Tags
     *
     * @param string $text
     * @return string
     */
    public function stripTags($text)
    {
        $text = strip_tags($text);
        return $text;
    }
    /**
     * Remove Spaces
     * 
     * @param string $text
     * @return string
     */
    public function removeSpaces($text)
    {
        $text = preg_replace('/\s+/', '', $text);
        return $text;
    }

    /**
     * Replace Spaces To Eol
     * 
     * @param string $text
     * @return string
     */
    public function replaceSpacesToEol($text)
    {
        $text = preg_replace('/\s+/', PHP_EOL, $text);
        return $text;
    }

    /**
     * Convert special characters to HTML entities
     * 
     * @param string $text
     * @return string
     */
    public function htmlspecialchars($text)
    {
        $text = htmlspecialchars($text, ENT_QUOTES);
        return $text;
    }

    /**
     * Remove Symbols 
     * 
     * @param string $text
     * @return string
     */
    public function removeSymbols($text)
    {
        $text = preg_replace('/[^\p{L}\p{N}\s]/u', '', $text);
        return $text;
    }

    /**
     * String To Number
     * 
     * @param string $text
     * @return string
     */
    public function toNumber($text)
    {
        $filteredNumbers = array_filter(preg_split("/\D+/", $text));
        $firstOccurence = reset($filteredNumbers);
        return $firstOccurence*1;
    }

}
?>