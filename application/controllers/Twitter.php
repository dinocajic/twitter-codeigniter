<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Twitter extends CI_Controller {

    /**
     * Twitter controller
     */
    public function index()
    {
        $header['additional_headers'] = $this->load->view('twitter/headers', null,    true);
        $data['header']               = $this->load->view('partials/header', $header, true);

        $this->load->model("twitter_model");

        //$twitter['timeline_tweets']   = $this->twitter_model->get_tweets_from_timeline(1, false);
        //$twitter['search_for_tweets'] = $this->twitter_model->search_for_tweets("dinocajic");
        //$twitter['account_settings']  = $this->twitter_model->get_account_settings();
        //$twitter['get_user_tweets']   = $this->twitter_model->get_user_tweets("dinocajic", 2);
        $twitter['retweets_of_me']    = $this->twitter_model->get_retweets_of_me(10);
        $twitter['user_info']         = $this->twitter_model->get_user_info_by_id(1313798149);

        $data['content'] = $this->load->view('twitter/twitter', $twitter, true);
        $data['footer']  = $this->load->view('partials/footer', null,     true);

        $this->load->view('layout', $data);
    }
}
