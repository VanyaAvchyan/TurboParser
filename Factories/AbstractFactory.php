<?php
abstract class AbstractFactory
{
    /**
     * Main Process.
     * Processes the text using the specified methods in variable $list
     *
     * @param string $text
     * @param array $list List of methods
     */
    public function process($text, $methods)
    {
        foreach($methods as $method)
        {
            $text = $this->$method($text);
        }
        return $text;
    }
}