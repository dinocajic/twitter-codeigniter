<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="w3-content" style="max-width:2000px;margin-top:46px;">
    <div class="w3-container w3-content w3-left-align w3-padding-64" style="max-width:800px">

        <h2 class="w3-wide w3-center">Profile</h2>
        <figure class="snip1559">
            <div class="profile-image"><img src="<?php echo $user_info[0]->profile_image_url; ?>" alt="profile-sample2" /></div>
            <figcaption>
                <h3><?php echo $user_info[0]->name; ?></h3>
                <h5>@<?php echo $user_info[0]->screen_name; ?></h5>
                <p><?php echo $user_info[0]->description; ?></p>
                <div class="icons">
                    <a href="https://twitter.com/<?php echo $user_info[0]->screen_name; ?>" target="_blank"> <i class="ion-social-twitter"></i></a>
                    <a href="<?php echo $user_info[0]->url; ?>" target="_blank"> <i class="ion-social-rss"></i></a>
                </div>
            </figcaption>
        </figure>
        <figure class="snip1559" style="box-shadow: none !important;">
            <figcaption>
                <h3>STATS</h3>
                <h5>@<?php echo $user_info[0]->screen_name; ?></h5>
                <p>Tweets: <?php echo $user_info[0]->statuses_count; ?></p>
                <p>Followers: <?php echo $user_info[0]->followers_count; ?></p>
                <p>Friends: <?php echo $user_info[0]->friends_count; ?></p>
                <p>Location: <?php echo $user_info[0]->location; ?></p>
            </figcaption>
        </figure>
    </div>

    <div class="w3-container w3-content w3-left-align w3-padding-64" style="max-width:800px">
        <h2 class="w3-wide w3-center">Latest Tweet</h2>
        <figure class="snip1360">
            <img src="<?php echo $user_info[0]->profile_banner_url; ?>" alt="sample88" />
            <figcaption>
                <h2><?php echo date("M d, Y", strtotime($user_info[0]->status->created_at)); ?></h2>
                <p><?php echo $user_info[0]->status->text; ?> </p><a href="https://twitter.com/<?php echo $user_info[0]->screen_name; ?>" class="read-more">View All Tweets</a>
            </figcaption>
        </figure>
    </div>

    <div class="w3-container w3-content w3-left-align w3-padding-64" style="max-width:800px">
        <h2 class="w3-wide w3-center">Re-Tweets</h2>
        <?php
        foreach($retweets_of_me as $retweet) {
            ?>
            <figure class="snip1360">
                <figcaption>
                    <h2><?php echo date("M d, Y", strtotime($retweet->created_at)); ?></h2>
                    <p><?php echo $retweet->text; ?></p>
                    <a href="https://twitter.com/<?php echo $retweet->user->screen_name; ?>/status/<?php echo $retweet->id; ?>" target="_blank">
                        View Tweet
                    </a>
                </figcaption>
            </figure>
            <?php
        }
        ?>
    </div>
</div>