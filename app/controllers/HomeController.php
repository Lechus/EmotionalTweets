<?php use Lpp\Services\Validation\SearchTweetFormValidation;

use \Lpp\Tweet;

class HomeController extends BaseController
{

    /**
     * @var \Lpp\Services\Validation
     */
    protected $validator;

    public function __construct(SearchTweetFormValidation $validator)
    {
        $this->validator = $validator;
    }

    public function searchTweets()
    {

        $tweets = null;
        $search = Input::get('q');

        if ($this->validator->with(Input::all())->passes()) {

            $twitterGateway = App::make('Lpp\TwitterGateway\TwitterGatewayInterface');

            //Returns a array collection of the most recent Tweets by search terms or hash tags
            $receivedTweets = $twitterGateway->getSearch(array('q' => $search, 'count' => 2, 'result_type' => 'recent'));

            //add sentimental status to tweets using Anylsis provider
            $analyser = App::make('Lpp\Analysis\AnalyseInterface');

            $tweetModel = new Tweet();
            $tweets = $tweetModel->analyse($receivedTweets, $analyser);

            return View::make('searchtweets', array('tweets' => $tweets, 'q' => $search));
        } else {
            return View::make('searchtweets', array('tweets' => $tweets, 'q' => $search))->withErrors($this->validator->errors());
        }
    }

    public function showSearchForm()
    {
        //Returns a collection of the most recent Tweets by search terms or hash tags
        $search = '';
        $tweets = null;
        return View::make('searchtweets', array('tweets' => $tweets, 'q' => $search));
    }

}
