<?php namespace Lpp\TwitterGateway;

/**
 *
 * @author lpp
 */
interface TwitterGatewayInterface
{
    /**
     * Search Tweets on Twitter 
     * @param array $parameters Parameters supported by Twitter REST Search API
     * 
	 * Parameters :
	 * - q
	 * - geocode
	 * - lang
	 * - locale
	 * - result_type (mixed|recent|popular)
	 * - count (1-100)
	 * - until (YYYY-MM-DD)
	 * - since_id
	 * - max_id
	 * - include_entities (0|1)
	 * - callback
     * @return array tweets
	 */
    public function getSearch($parameters = array());
}
