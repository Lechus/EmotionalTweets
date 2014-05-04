<?php namespace Lpp\Analysis;

/**
 *
 * @author lpp
 */
interface AnalysisInterface
{
    
    /**
     * Send text for analysis
     * @param string $lang Language of text
     * @param string $text Text
     * @return string Description of emotion
     */
    public function analyse($text, $lang);
    
}
