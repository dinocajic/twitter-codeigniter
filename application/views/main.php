<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- Page content -->
<div class="w3-content" style="max-width:2000px;margin-top:46px;">

    <!-- The Getting Started Section -->
    <div class="w3-container w3-content w3-center w3-padding-64" style="max-width:800px" id="getting_started">
        <h2 class="w3-wide">Getting started with the Twitter API</h2>
        <p class="w3-opacity"><i>Installing the API</i></p>
        <p class="w3-justify">
            It's time to get over your fears. You're going to jump into this fully swinging. I'll guide you through it step by step for a Windows Install.
            We're going to do this in CodeIgniter (a PHP MVC framework).
        </p>
        <ul class="w3-left-align">
            <li>Download <a href="http://www.wampserver.com/en/" target="_blank">WAMP</a></li>
            <li>Install WAMP.</li>
            <li>Run WAMP and go to the folder C:/wamp64/www/</li>
            <li>Create a new directory: i.e. api</li>
            <li>Download <a href="https://codeigniter.com/" target="_blank">CodeIgniter</a> and extract the contents into the api folder</li>
            <li>Verify that it works. http://localhost/api</li>
            <li>Create a new directory in the api folder called assets</li>
            <li>Create a new directory in the assets folder called twitter</li>
            <li>Download and install <a href="https://getcomposer.org/" target="_blank">Composer</a></li>
            <li>Open CMD and cd into the assets/twitter folder (i.e. cd C:/wamp64/www/api/assets/twitter)</li>
            <li>Run the command: <pre>composer require abraham/twitteroauth</pre></li>
            <li>Verify that the twitter api is inside the twitter folder</li>
        </ul>
        <p class="w3-justify">
            The next steps are performed in your editor
        </p>
        <ul class="w3-left-align">
            <li>Open your project's root directory (i.e. the api folder)</li>
            <li>Go to application/controllers</li>
            <li>Rename the Welcome.php file to Main.php</li>
            <li>Open the Main.php file and rename the class to Main</li>
            <li>Open application/config/routes.php</li>
            <li>Change $route['default_controller'] = 'main';</li>
        </ul>
        <p class="w3-justify">
            That's it. Below we'll start writing some code.
        </p>
    </div>

    <!-- The Demo Section -->
    <div class="w3-black" id="demo">
        <div class="w3-container w3-content w3-padding-64" style="max-width:800px">
            <h2 class="w3-wide w3-center">Demo Code</h2>
            <p class="w3-opacity w3-center"><i>Write some code</i></p><br>
            <ul class="w3-left-align">
                <li>Copy the contents of your Main.php file</li>
                <li>Create a new file named Twitter.php in your application/controllers folder</li>
                <li>Paste the contents of Main.php into Twitter.php</li>
                <li>Change the class name from Main to Twitter</li>
                <li>Create a new model called Twitter_model.php in your application/models folder</li>
                <li>Paste the following code into it
                    <pre>
                        require "assets/vendor/autoload.php";
                        use Abraham\TwitterOAuth\TwitterOAuth;

                        /**
                         * Class Twitter_model
                         */
                        class Twitter_model extends CI_Model {

                            /** For establishing a connection to Twitter */
                            private $_consumer_key        = '';
                            private $_consumer_secret     = '';
                            private $_access_token        = '';
                            private $_access_token_secret = '';
                            private $_connection;
                            private $_content;

                            /**
                             * Twitter_model constructor.
                             *
                             * Establish a connection on instantiation
                             */
                            public function __construct() {
                                parent::__construct();

                                $this->establish_connection();
                            }

                            /**
                             * Connect to the Twitter API
                             */
                            public function establish_connection() {
                                $this->_connection = new TwitterOAuth($this->_consumer_key,
                                                                      $this->_consumer_secret,
                                                                      $this->_access_token,
                                                                      $this->_access_token_secret);
                                $this->_content = $this->_connection->get("account/verify_credentials");
                            }
                        }
                    </pre>
                </li>
                <li>Go to <a href="https://apps.twitter.com/app/new" target="_blank">apps.twiiter.com/app/new</a></li>
                <li>Enter the app's name, description and website. Also, click to agree to the developer agreement.</li>
                <li>Make sure the app name is unique.</li>
                <li>Click on the Keys and Access tokens tab.</li>
                <li>
                    Copy and paste the Consumer Key and Consumer Secret into the application
                    <pre>
                        class Twitter_model extends CI_Model {
                            /** For establishing a connection to Twitter */
                            private $_consumer_key        = 'aReallyLongCode';
                            private $_consumer_secret     = 'aReallyLongCode';
                            private $_access_token        = '';
                            private $_access_token_secret = '';
                            private $_connection;
                            private $_content;
                        }
                    </pre>
                </li>
                <li>Scroll to the bottom of the page and click on "Create my access token" button</li>
                <li>
                    Under the "Your Access Token" section, copy the "Access Token" and "Access Token Secret" and paste
                    them into your Twitter_model class.
                    <pre>
                        class Twitter_model extends CI_Model {
                            /** For establishing a connection to Twitter */
                            private $_consumer_key        = 'aReallyLongCode';
                            private $_consumer_secret     = 'aReallyLongCode';
                            private $_access_token        = 'aReallyLongCode';
                            private $_access_token_secret = 'aReallyLongCode';
                            private $_connection;
                            private $_content;
                        }
                    </pre>
                </li>
            </ul>
            <p class="w3-justify">
                Don't worry, I didn't forget about the Twitter controller. We'll get back to it shortly. We first have to
                finish off the Twitter_model. We're going to want to have the following functionality:
            </p>
            <ul class="w3-left-align">
                <li>Post a tweet to our Twitter account</li>
                <li>Get tweets from our time-line.</li>
                <li>Get some user's tweets.</li>
                <li>Search for tweets.</li>
                <li>Get details on users that re-tweeted our tweets.</li>
                <li>Get our account settings.</li>
                <li>Get user info by specifying the user's id.</li>
                <li>There are hundreds of opportunities. See them all on <a href="https://dev.twitter.com/rest/reference" target="_blank">Twitter's Documentation</a>.</li>
            </ul>
            <p class="w3-justify">
                I'll guide you through the first one: Posting a tweet to our Twitter account. We'll go to Twitter's documentation and see
                that POST statuses/update is an option that we can do. It states that we are required to pass a "status." The code is self-explanatory but let's walk through
                it so that you know how to create your own methods. The $_connection object contains a method called post.
                You pass an option (can be found in the <a href="https://dev.twitter.com/rest/reference" target="_blank">docs</a>) and the parameters (as an array). The parameters
                can be found on each individual option's page. In this instance, you can go to
                <a href="https://dev.twitter.com/rest/reference/post/statuses/update" target="_blank"> POST statuses/update</a> to see the available parameters. You'll see
                that "status" is a required argument. You specify the status update and that's that.
            </p>
            <pre>
                /**
                 * Post a status update to your Twitter account by providing a status update
                 *
                 * @param String $status_update
                 *
                 * @return array
                 */
                public function post_tweet($status_update) {
                    $status = $this->_connection->post(
                        "status/update",
                        [
                            "status" => $status_update
                        ]
                    );

                    return $status;
                }
            </pre>
            <p class="w3-justify">
                Let's take a look at the full class. You can see all of the different methods.
            </p>
            <pre>
                require "assets/vendor/autoload.php";
                use Abraham\TwitterOAuth\TwitterOAuth;

                /**
                 * Class Twitter_model
                 */
                class Twitter_model extends CI_Model {

                    /** For establishing a connection to Twitter */
                    private $_consumer_key        = 'yourReallyLongAPIcode';
                    private $_consumer_secret     = 'yourReallyLongAPIcode';
                    private $_access_token        = 'yourReallyLongAPIcode';
                    private $_access_token_secret = 'yourReallyLongAPIcode';
                    private $_connection;
                    private $_content;

                    /**
                     * Twitter_model constructor.
                     *
                     * Establish a connection on instantiation
                     */
                    public function __construct() {
                        parent::__construct();

                        $this->establish_connection();
                    }

                    /**
                     * Connect to the Twitter API
                     */
                    public function establish_connection() {
                        $this->_connection = new TwitterOAuth($this->_consumer_key,
                                                              $this->_consumer_secret,
                                                              $this->_access_token,
                                                              $this->_access_token_secret);
                        $this->_content = $this->_connection->get("account/verify_credentials");
                    }

                    /**
                     * Post a status update to your Twitter account by providing a status update
                     *
                     * @param String $status_update
                     *
                     * @return array
                     */
                    public function post_tweet($status_update) {
                        $status = $this->_connection->post(
                            "status/update",
                            [
                                "status" => $status_update
                            ]
                        );

                        return $status;
                    }

                    /**
                     * Retrieves a specified number of tweets with-or-without replies
                     *
                     * @param integer $num_of_tweets: Max 200
                     * @param boolean $exclude_replies
                     *
                     * @return array
                     */
                    public function get_tweets_from_timeline($num_of_tweets, $exclude_replies) {
                        $tweets = $this->_connection->get(
                            "statuses/home_timeline",
                            [
                                "count"           => $num_of_tweets,
                                "exclude_replies" => $exclude_replies
                            ]
                        );

                        return $tweets;
                    }

                    /**
                     * Returns a list of tweets for a specific username
                     *
                     * @param String $username
                     * @param integer $num_of_tweets: Max 200
                     *
                     * @return array
                     */
                    public function get_user_tweets($username, $num_of_tweets) {
                        $tweets = $this->_connection->get(
                            "statuses/user_timeline",
                            [
                                "screen_name" => $username,
                                "count"       => $num_of_tweets
                            ]
                        );

                        return $tweets;
                    }

                    /**
                     * Returns a list of tweets based on your search parameter
                     *
                     * @param String $query
                     *
                     * @return array
                     */
                    public function search_for_tweets($query) {
                        $tweets = $this->_connection->get(
                            "search/tweets",
                            [
                                "q" => $query
                            ]
                        );

                        return $tweets;
                    }

                    /**
                     * Returns a list of tweets where the user's tweets were re-tweeted
                     *
                     * @param integer $num_of_tweets: Max 200
                     *
                     * @return array
                     */
                    public function get_retweets_of_me($num_of_tweets) {
                        $tweets = $this->_connection->get(
                            "statuses/retweets_of_me",
                            [
                                "count" => $num_of_tweets
                            ]
                        );

                        return $tweets;
                    }

                    /**
                     * Returns your account settings
                     *
                     * @return array
                     */
                    public function get_account_settings() {
                        $settings = $this->_connection->get(
                            "account/settings"
                        );

                        return $settings;
                    }

                    /**
                     * Returns user details by specifying their user's id
                     *
                     * @param int $users_id
                     *
                     * @return array
                     */
                    public function get_user_info_by_id($users_id) {
                        $user_info = $this->_connection->get(
                            "users/lookup",
                            [
                                "user_id" => $users_id
                            ]
                        );

                        return $user_info;
                    }
                }
            </pre>
            <p class="w3-justify">
                Since we are doing this in CodeIgniter, let's go ahead and look at how to utilize this code.
            </p>
            <ul class="w3-left-align">
                <li>Open up your Twitter controller</li>
                <li>Load your Twitter_model</li>
                <li>Use your Twitter_model</li>
                <li>Test with var_dump()</li>
                <li>See the code below</li>
            </ul>
            <pre>
                defined('BASEPATH') OR exit('No direct script access allowed');

                class Twitter extends CI_Controller {

                    /**
                     * Homepage controller
                     */
                    public function index()
                    {
                        $this->load->model("twitter_model");
                        //$data['tweets'] = $this->twitter_model->get_tweets_from_timeline(1, false);
                        //$data['tweets'] = $this->twitter_model->search_for_tweets("dinocajic");
                        //$data['tweets'] = $this->twitter_model->get_account_settings();
                        //$data['tweets'] = $this->twitter_model->get_user_tweets("dinocajic", 2);
                        //$data['tweets'] = $this->twitter_model->get_retweets_of_me(10);
                        $data['tweets'] = $this->twitter_model->get_user_info_by_id(1313798149);

                        var_dump($data['tweets']);
                    }
                }
            </pre>
            <p class="w3-justify">
                If you wanted to pass the code to a specific view, i.e. twitter_view, continue reading.
            </p>
            <ul class="w3-left-align">
                <li>Create a new file named twitter.php in the application/views directory</li>
                <li>
                    Paste the following code between your php tags
                    <pre>
                        defined('BASEPATH') OR exit('No direct script access allowed');

                        var_dump($tweets);
                    </pre>
                </li>
                <li>Open your Twitter controller</li>
                <li>Load the view and pass the data to it.</li>
                <li>
                    Inside your index() method, add the following line of code
                    <pre>
                        $this->load->view('twitter', $data);
                    </pre>
                </li>
                <li>That's it. Go to http://localhost/api/index.php/twitter to see your page</li>
                <li>Grab all of the code from my <a href="" target="_blank">GitHub account</a>.</li>
            </ul>

            <p class="w3-center" style="padding-top: 50px;">
                <a href="<?php echo base_url(); ?>index.php/twitter">
                    <button>It's time to check out the demo</button>
                </a>
            </p>

        </div>
    </div>

    <!-- End Page Content -->
</div>


