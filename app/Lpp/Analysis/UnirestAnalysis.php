<?php namespace Lpp\Analysis;

use Unirest;
use Config;

class UnirestAnalysis implements AnalysisInterface
{

    /**
     * {@inheritdoc}
     */
    public function analyse($text, $lang)
    {
        $emotion = '';

        if (!is_null($text)) {
            $response = Unirest::post(
                            "https://sentimentalsentimentanalysis.p.mashape.com/sentiment/current/classify_text/", array(
                        "X-Mashape-Authorization" => Config::get('packages/mashape/unirest-php/config.PRODUCTION_KEY')
                            ), array(
                        "lang" => $lang,
                        "text" => urlencode($text),
                        "exclude" => "",
                        "detectlang" => "0"
                            )
            );
            $emotion = $this->processResponse($response);
        }

        return $emotion;
    }

    /**
     * 
     * @param object(Unirest\HttpResponse) $response
     * @return string Emotion
     */
    protected function processResponse($response)
    {
        if (!(isset($response->body->error) && is_object($response->body->error))) {

            //dd($response->body->sent);
            return $this->emotions($response->body->sent);
        }
        return 'unknown';
    }

    /**
     * Get human readable emotional status of tweet
     * @param float $sent
     * @return string Status
     */
    protected function emotions($sent)
    {
        $emotion = 'unknown';
        switch ($sent):
            case -1: $emotion = 'Sad';
                break;
            case 0: $emotion = 'Indifferent';
                break;
            case 1: $emotion = 'Happy';
                break;
        endswitch;

        return $emotion;
    }

}
