<?php namespace Lpp\Services\Validation;

class SearchTweetFormValidation extends AbstractLaravelValidator
{
    /**
     * Validation rules for searching Tweets
     * 
     * @var array
     */
    protected $rules = array(
        'q' => 'required|max:1000'
    );
       
}
