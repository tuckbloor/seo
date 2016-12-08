<?php

    require_once('Class/Seo.php');

    $seo = new Seo('http://www.directtropicalfish.co.uk');
    $seo->getData();
    $seo->getTitle();
    $seo->checkForHtmlTables();
    $seo->checkForWelcome();
    $seo->getDensity();
    $seo->getMetaTags();

?>

<!DOCTYPE html>
<html>

    <head>
        <title>Title of the document</title>
        <style>
            .error { color:#d04544; background:#ffe9e9; }
            .success2 { background:#fbf6e3; }
            .box { width:407px; padding: 10px; border: solid 1px #cccccc;}

            .spam, .ignored, .target, .meta, .headers, .title, .speed, .errors, .compare, .results,  .tables {
                margin: 20px 0;
                height: auto;
                max-height: 600px;
                min-height: 100px;
                overflow-y: scroll;
                overflow-x: hidden;
                width: 100%;
                padding: 20px;
                border: solid 1px #ccc;
            }

            .wrapper {

                margin-left: auto;
                margin-right: auto;
                width: 980px;
            }
            .wrapper h2 {
                font-size: 15px;
                font-weight: bold;
            }
        </style>
    </head>

<body>

    <div class="wrapper">

        <h2>Speed Test</h2>
        <div class="speed">

            <?php if($seo->speed['total_time'] <= 1) { ?>

                <div class="alert_icons_block c_after">
                    <div class="box success2">Perfect Download Speed <?php echo $seo->speed['total_time']; ?> Seconds
                        <p><img src="/images/5star.png" alt="5 stars"/></p>
                    </div>
                </div>

                <?php $rating = 5;
            }

            elseif($seo->speed['total_time'] > 1 && $seo->speed['total_time'] <=2) { ?>

                <div class="alert_icons_block c_after">
                    <div class="box success2">Fast Download Speed <?php echo $seo->speed['total_time']; ?> Seconds
                        <p><img src="/images/4star.png" alt="4 stars" /></p>
                    </div>
                </div>

                <?php $rating = 4;

            }

            elseif($seo->speed['total_time'] >2 && $seo->speed['total_time'] <=3) { ?>

                <div class="alert_icons_block c_after">
                    <div class="box error">Slow Download Speed <?php echo $seo->speed['total_time']; ?> Seconds
                        <p><img src="/images/3star.png" alt="3 stars"/></p>
                    </div>
                </div>


                <?php $rating = 3;
            }

            elseif($seo->speed['total_time'] > 3 && $seo->speed['total_time'] <=4) { ?>

                <div class="alert_icons_block c_after">
                    <div class="box error">Slow Download Speed <?php echo $seo->speed['total_time']; ?> Seconds
                        <p><img src="/images/2star.png" alt="2 stars"/></p>
                    </div>
                </div>

                <?php $rating = 2;
            }


            elseif($seo->speed['total_time'] > 4 && $seo->speed['total_time'] <=5) { ?>

                <div class="alert_icons_block c_after">
                    <div class="box error">Slow Download Speed <?php echo $seo->speed['total_time']; ?> Seconds
                        <p><img src="/images/1star.png" alt="1 star"/></p>
                    </div>
                </div>

                <?php $rating = 1;
            }

            elseif($seo->speed['total_time'] > 5) { ?>

                <div class="alert_icons_block c_after">
                    <div class="box error">Slow Download Speed <?php echo $seo->speed['total_time']; ?> Seconds
                        <p><img src="/images/0star.png" alt="0 stars"/></p>
                    </div>
                </div>

                <?php $rating = 0;
            } ?>

        </div>

        <h2>Tables / CSS</h2>
        <div class="tables">

            <?php if($seo->tables_found  == 0) { ?>

            <div class="alert_icons_block c_after">
                <div class="box success2">This Page Is Styled With CSS And No Tables Are Used
                    <img src="/images/5star.png" alt="5 stars" />
                    <?php $rating = $rating +5; ?>
                </div>
            </div>

            <?php

            }

            else { ?>

                <div class="alert_icons_block c_after">
                    <div class="box error">You Are Using Table for Layouts
                        <p><img src="/images/0star.png" alt="0 stars" /></p>
                    </div>
                </div>

            <?php

            }

            if($seo->tables_found  !=0) { ?>

                <p>This Page Contains Tables</p>

            <?php } ?>

        </div>

        <h2>Title</h2>
        <div class="title">

            <?php
                $max_title = substr($seo->title, 0, 63);// this is for the comparison only gets 63 characteers

                if($seo->title_length > 63) { ?>

                    <div class="alert_icons_block c_after">
                        <div class="box error">Title To Long
                            <p><img src="/images/2star.png" alt="2 stars" /></p>
                        </div>
                    </div>

                    <?php $rating = $rating +2; ?>

                    <p>You Have Over 63 Characters In The Title ( <?php echo $seo->title_length; ?> ) Google looks at the first 63 only</p>
                    <p>Your Relevant Title Is <?php echo $max_title; ?> }}</p>
                    <p>Put Your Most Important Keywords first, second, third etc</p>

            <?php  }

            elseif($seo->title_length == 0) { ?>

                <div class="alert_icons_block c_after">
                    <div class="box error">Title Is Empty
                        <p><img src="/images/0star.png" alt="0 stars"/></p>
                    </div>
                </div>

                <?php $welcome .= "<p>Title is empty</p>";

            }

            elseif($seo->title_length <= 10) { ?>

                <div class="alert_icons_block c_after">
                    <div class="box error">Title To Short
                        <p><img src="/images/1star.png" alt="1 stars" /></p>
                        <?php $rating = $rating +1; ?>
                    </div>
                </div>

            <?php }

                elseif($seo->title_length >= 11 && $seo->title_length  <= 19) { ?>

                    <div class="alert_icons_block c_after">
                        <div class="box error">Title To Short
                            <p><img src="/images/2star.png" alt="2 stars" /></p>
                            <?php $rating = $rating +2; ?>
                        </div>
                    </div>

            <?php }


            elseif($seo->title_length >= 20 && $seo->title_length  <= 29) { ?>

                <div class="alert_icons_block c_after">
                    <div class="box error">Title To Short
                        <p><img src="/images/3star.png" alt="3 stars" /></p>
                        <?php $rating = $rating +3; ?>
                    </div>
                </div>


            <?php }

            elseif($seo->title_length >= 30 && $seo->title_length  <= 39) { ?>

                <div class="alert_icons_block c_after">
                    <div class="box error">Title To Short
                        <p><img src="/images/4star.png" alt="4 stars" /></p>
                        <?php $rating = $rating +4; ?>
                    </div>
                </div>

            <?php }

            elseif($seo->title_length >= 40 && $seo->title_length  <= 63) { ?>

                <div class="alert_icons_block c_after">
                    <div class="box success2">Perfect Title Length
                        <p><img src="/images/5star.png" alt="5 stars" /></p>
                        <?php $rating = $rating +5; ?>
                    </div>
                </div>

            <?php } ?>

            <p>Title <?php echo $seo->title; ?></p>
        </div>

        <h2>Meta Details</h2>
        <div class="meta">

            <?php

                foreach($seo->meta_tags as $key => $val) {

                    $key = strtolower($key);

                    if($key == 'robots') { ?>
                    <h3>You Have A <strong>Robots Meta Tag</strong> See Below, if it contains <strong>noindex</strong>
                        then your site will not be indexed, if it contains <strong>nofollow</strong>
                        then no linking pages will be indexed</h3>

            <?php } ?>

            <p><strong><?php echo $key; ?></strong>: <?php echo $val; ?></p>

            <?php } ?>
        </div>

        <?php $h1qty = 0; ?>

        <h2>Headers</h2>
        <div class="headers">

        <?php

            foreach($seo->h1 as $header) {

                $retvalh1 = $header->nodeValue;

                $h1qty++;

            }

            if($h1qty == 0) { ?>

                <div class="alert_icons_block c_after">
                    <div class="box error">No H1 Tags
                        <p> <img src="/images/0star.png" alt="0 star" /></p>
                    </div>
                </div>

            <?php } ?>

            <p>You have <?php echo $h1qty . ' ' .  'tags'; ?> </p>

            <?php if($h1qty == 1) { ?>

                <div class="alert_icons_block c_after">
                    <div class="box success2">Congratulations 1 &lt;h1&gt; tag
                        <p><img src="/images/5star.png" alt="5 star" /></p>
                        <?php $rating = $rating +5; ?>
                    </div>
                </div>

            <?php }


            if($h1qty > 1) { ?>

                <div class="alert_icons_block c_after">
                    <div class="box error">You Have More Than 1 H1 Tag
                        <p><img src="/images/1star.png" alt="1 star" /></p>
                        <?php $rating = $rating +1; ?>
                    </div>
                </div>

            <?php }

            foreach($seo->h1 as $header) {

                $retvalh1 = $header->nodeValue;

                    if (empty($retvalh1)) {

                        $retvalh1 = "this h1 contains an Image Or is empty this is a waste.";
                        $welcome .= "<p>Your H1 tag is empty or contains an image this is a waste</p>";
                        $h1_error = 1;

                    }

                $h1qty++;

            ?>

                <p><strong>Your H1 Tag:</strong> <?php echo $retvalh1; ?></p>

            <?php }

            $h2qty = 0;

            foreach($seo->h2 as $header) {

                $retval = $header->nodeValue;

                $h2qty++;

            ?>

            <p><strong>Your H2 Tag:</strong> <?php echo $retval; ?> </p>

            <?php }

            if($h2qty == 0) { ?>

                <div class="alert_icons_block c_after">
                    <div class="box error">No H2 Tags
                        <p><img src="/images/0star.png" alt="0 star" /></p>
                    </div>
                </div>

            <?php }

            else { ?>

            <p>You have <?php echo $h2qty . ' ' . '<h2> Tag(s)'; ?></p>

            <?php }


            if($h2qty >= 1) { ?>

                <div class="alert_icons_block c_after">
                    <div class="box success2">Congratulations You Have  &lt;h2&gt; tag
                        <p>      <img src="/images/5star.png" alt="5 star" />
                            <?php $rating = $rating +5; ?></p>
                    </div>
                </div>

            <?php } ?>


        </div>

        <h2>Anything Else We Found Wrong</h2>

        <div class="errors">

            <p><?php echo $seo->welcome; ?></p>

            <?php if(is_null($seo->welcome)) { ?>

            <div class="alert_icons_block c_after">
                <div class="box success2">Congratulations Nothing Else Was Found
                    <p><img src="/images/5star.png" alt="5 star" /></p>
                    <?php $rating = $rating +5; ?>
                </div>
            </div>

            <?php }

            else {  ?>

                <div class="alert_icons_block c_after">
                    <div class="box error">Some Easy To Fix Errors Detected
                        <p><img src="/images/0star.png" alt="0 star" /></p>
                    </div>
                </div>

            <?php } ?>
        </div>


        <h2>Ignored Words On The Page <?php echo $seo->count_ignored; ?></h2>

        <div class="ignored">
            <?php echo $seo->ignored; ?>
        </div>

        <h2>Spamming Words On The Page <?php echo $seo->count_spam; ?></h2>

        <div class="spam">

            <?php if($seo->count_spam == 0) { ?>

                <div class="alert_icons_block c_after">
                    <div class="box success2">Congratulations No Spamming Words
                        <p><img src="/images/5star.png" alt="5 stars" /></p>
                        <?php $rating = $rating +5; ?>
                    </div>
                </div>

            <?php }

            elseif($seo->count_spam == 1) { ?>

                <div class="alert_icons_block c_after">
                    <div class="box error">Spamming Words Detected
                        <p>  <img src="/images/4star.png" alt="4 stars" /></p>
                        <?php $rating = $rating +4; ?>
                    </div>
                </div>

            <?php }

            elseif($seo->count_spam == 2) { ?>

                <div class="alert_icons_block c_after">
                    <div class="box error">Spamming Words Detected
                        <p> <img src="/images/3star.png" alt="3 stars" /></p>
                        <?php $rating = $rating +3; ?>
                    </div>
                </div>

            <?php }

            elseif($seo->count_spam == 3) { ?>

                <div class="alert_icons_block c_after">
                    <div class="box error">Spamming Words Detected
                        <p><img src="/images/2star.png" alt="2 stars" /></p>
                        <?php $rating = $rating +2; ?>
                    </div>
                </div>

            <?php }

            elseif($seo->count_spam == 4) { ?>

                <div class="alert_icons_block c_after">
                    <div class="box error">Spamming Words Detected
                        <p><img src="/images/1star.png" alt="1 star" /></p>
                        <?php $rating = $rating +1; ?>
                    </div>
                </div>

            <?php }

            elseif($seo->count_spam >4) { ?>

                <div class="alert_icons_block c_after">
                    <div class="box error">Spamming Words Detected
                        <p><img src="/images/0star.png" alt="0 star" /></p>
                    </div>
                </div>

            <?php }

                echo $seo->spam;
            ?>


        </div>

        <h2>Targeted Words On The Page <?php echo $seo->count_correct; ?></h2>
        <div class="target">
            <h2><?php echo $seo->words; ?> Words on the page</h2>

            <?php if($seo->words < 100) { ?>

                <div class="alert_icons_block c_after">
                    <div class="box error">Not Enough Words In Your Content
                        <p> <p><img src="/images/0star.png" alt="0 stars" /></p>
                    </div>
                </div>

            <?php }

                elseif($seo->words >=100 && $seo->words < 200) { ?>

                    <div class="alert_icons_block c_after">
                        <div class="box error">Not Enough Words In Your Content
                            <p><img src="/images/2star.png" alt="2 stars" /></p>
                            <?php $rating = $rating +1; ?>
                        </div>
                    </div>

            <?php }

            elseif($seo->words >= 200 && $seo->words < 300) { ?>

                <div class="alert_icons_block c_after">
                    <div class="box error">Not Enough Words In Your Content
                        <p><img src="/images/3star.png" alt="3 stars" /></p>
                        <?php $rating = $rating +3; ?>
                    </div>
                </div>


            <?php }

            elseif($seo->words >= 300 && $seo->words <400) { ?>

                <div class="alert_icons_block c_after">
                    <div class="box error">Not Enough Words In Your Content
                        <p><img src="/images/4star.png" alt="4 stars" /></p>
                        <?php $rating = $rating +4; ?>
                    </div>
                </div>


            <?php }

            elseif($seo->words >=400 && $seo->words < 900) { ?>

                <div class="alert_icons_block c_after">
                    <div class="box success2">Word Count Is Perfect
                        <p><img src="/images/5star.png" alt="5 stars" /></p>
                        <?php $rating = $rating +5; ?>
                    </div>
                </div>

            <?php }

            elseif($seo->words > 1000) { ?>

                <div class="alert_icons_block c_after">
                    <div class="box error">To Many Words In Your Content
                        <p><img src="/images/3star.png" alt="3 star" /></p>
                        <?php $rating = $rating +5; ?>
                    </div>
                </div>

            <p>You Have over 1000 words on the site some of these will be ignored</p>

            <?php } ?>

            <h2>Targeted Keywords</h2>

            <?php if($seo->count_correct <= 5) { ?>

                <div class="alert_icons_block c_after">
                    <div class="box success2">Perfect Target Keywords
                        <p><img src="/images/5star.png" alt="5 stars" /></p>
                        <?php $rating = $rating +5; ?>
                    </div>
                </div>

            <?php }

            elseif($seo->count_correct == 6) { ?>

                <div class="alert_icons_block c_after">
                    <div class="box success2">Good Target Word Count
                        <p><img src="/images/4star.png" alt="4 stars" /></p>
                        <?php $rating = $rating +4; ?>
                    </div>
                </div>

            <?php }

            elseif($seo->count_correct == 7) { ?>

                <div class="alert_icons_block c_after">
                    <div class="box error">Keyword Target Incorrect
                        <p><img src="/images/3star.png" alt="3 stars" /></p>
                        <?php $rating = $rating +3; ?>
                    </div>
                </div>

            <?php }

            elseif($seo->count_correct == 8) { ?>

                <div class="alert_icons_block c_after">
                    <div class="box error">Keyword Target Incorrect
                        <p><img src="/images/2star.png" alt="2 stars" /></p>
                        <?php $rating = $rating +2; ?>
                    </div>
                </div>

            <?php }

            elseif($seo->count_correct == 9) { ?>

                <div class="alert_icons_block c_after">
                    <div class="box error">Keyword Target Incorrect
                        <p><img src="/images/1star.png" alt="1 stars" /></p>
                        <?php $rating = $rating +1; ?>
                    </div>
                </div>

            <?php }

            elseif($seo->count_correct >9) { ?>

                <div class="alert_icons_block c_after">
                    <div class="box error">Keyword Target Incorrect
                    <p><img src="/images/0star.png" alt="0 star" /></p></div>
                </div>

            <?php }

                echo  $seo->correct;
            ?>
        </div>

        <h2>Comparisons</h2>

        <div class="compare">

            <?php

                echo "<h2>Title To H1 Tag Comparison</h2>";

                if(!empty($seo->title) && !empty($retvalh1)) {

                    echo "<p>Your Title: $seo->title</p>";
                    echo "<p>Your Relevant Title: $max_title</p>";


                    if(isset($h1_error)) {
                        $retvalh1 =""; //h1 is image
                        echo "Your H1 tag contains an image";
                    }
                    else {
                        echo "<p>Your H1 Tag $retvalh1</p>";
                    }

                    $seo->title = strtolower($max_title);
                    $retvalh1 = strtolower($retvalh1);

                    similar_text($seo->title, $retvalh1, $percent);
                    echo '<p>H1 To Title Comparison: ' . number_format(($percent),2) . '%</p>';


                 if($percent > 80) { ?>

                    <div class="alert_icons_block c_after">
                        <div class="box success2">Perfect Target Keywords
                            <p><img src="/images/5star.png" alt="5 stars" /></p>
                            <?php $rating = $rating +5; ?>
                        </div>
                    </div>

                <?php }

                elseif($percent > 60 && $percent <80) { ?>

                    <div class="alert_icons_block c_after">
                        <div class="box success2">Good Keywords
                            <p><img src="/images/4star.png" alt="4 stars" /></p>
                            <?php $rating = $rating +4; ?>
                        </div>
                    </div>

                <?php }

                elseif($percent >40 && $percent < 60) { ?>

                    <div class="alert_icons_block c_after">
                        <div class="box error">Keyword Target Incorrect
                            <p><img src="/images/3star.png" alt="3 stars" /></p>
                            <?php $rating = $rating +3; ?>
                        </div>
                    </div>

                <?php }

                 elseif($percent >20 && $percent < 40) { ?>

                     <div class="alert_icons_block c_after">
                         <div class="box error">Keyword Target Incorrect
                             <p><img src="/images/2star.png" alt="2 stars" /></p>
                             <?php $rating = $rating +2; ?>
                         </div>
                     </div>

                <?php }

                elseif($percent >10 && $percent < 20) { ?>

                    <div class="alert_icons_block c_after">
                        <div class="box error">Keyword Target Incorrect
                            <p><img src="/images/1star.png" alt="1 stars" /></p>
                            <?php $rating = $rating +1; ?>
                        </div>
                    </div>

                <?php }

                else { ?>

                    <div class="alert_icons_block c_after">
                        <div class="box error">Keyword Target Incorrect
                            <p><img src="/images/0star.png" alt="0 stars" /></p>
                        </div>
                    </div>

                <?php }

            }

            else { ?>


                <div class="alert_icons_block c_after">
                    <div class="box error">Keyword Target Incorrect
                        <p><img src="/images/0star.png" alt="0 stars" /></p>
                    </div>
                </div>

                <?php } ?>

            <h2>Title And Targeted Keywords</h2>

                <?php
                    $seo->correct_density = strtolower($seo->correct_density);
                    $title = strtolower($max_title);
                    similar_text($title, $seo->correct_density, $percent);

                    echo '<p>Title To Targeted Keywords Comparison: ' . number_format(($percent),2) . '%</p>';


            if($percent > 80) { ?>

                <div class="alert_icons_block c_after">
                    <div class="box success2">Perfect Title To Keywords
                        <p><img src="/images/5star.png" alt="5 stars" /></p>
                        <?php $rating = $rating +5; ?>
                    </div>
                </div>

            <?php }

            elseif($percent > 60 && $percent <=80) { ?>

                <div class="alert_icons_block c_after">
                    <div class="box success2">Good Title To Targret Keyword
                        <p><img src="/images/4star.png" alt="4 stars" /></p>
                        <?php $rating = $rating +4; ?>
                    </div>
                </div>

            <?php }

            elseif($percent >40 && $percent <= 60) { ?>

                <div class="alert_icons_block c_after">
                    <div class="box error">Keyword Target Incorrect
                        <p><img src="/images/3star.png" alt="3 stars" /></p>
                        <?php $rating = $rating +3; ?>
                    </div>
                </div>

            <?php }
            elseif($percent >20 && $percent <= 40) { ?>

                <div class="alert_icons_block c_after">
                    <div class="box error">Keyword Target Incorrect
                        <p><img src="/images/2star.png" alt="2 stars" /></p>
                        <?php $rating = $rating +2; ?>
                    </div>
                </div>

            <?php }

            elseif($percent >10 && $percent <= 20) { ?>

                <div class="alert_icons_block c_after">
                    <div class="box error">Keyword Target Incorrect
                        <p><img src="/images/1star.png" alt="1 stars" /></p>
                        <?php $rating = $rating +1; ?>
                    </div>
                </div>

            <?php }

             else { ?>

                <div class="alert_icons_block c_after">
                    <div class="box error">Keyword Target Incorrect
                        <p><img src="/images/0star.png" alt="0 stars" /></p>
                    </div>
                </div>

             <?php } ?>

            <?php if($h1qty > 0) { ?>

            <h2>H1 And Targeted Keywords</h2>

            <?php
                similar_text($retvalh1, $seo->correct_density, $percent);
                echo '<p>H1 To Targeted Keywords Comparison: ' . number_format(($percent),2) . '%</p>';
            ?>

            <?php if($percent > 80) { ?>

                <div class="alert_icons_block c_after">
                    <div class="box success2">Perfect H1 To Keywords
                        <p><img src="/images/5star.png" alt="5 stars" />
                            <?php $rating = $rating +5; ?></p>
                    </div>
                </div>

            <?php }

            elseif($percent > 60 && $percent <=80) { ?>

                <div class="alert_icons_block c_after">
                    <div class="box success2">Good H1 To Targret Keyword
                        <p><img src="/images/4star.png" alt="4 stars" /></p>
                        <?php $rating = $rating +4; ?>
                    </div>
                </div>

            <?php }

            elseif($percent >40 && $percent <= 60) { ?>

                <div class="alert_icons_block c_after">
                    <div class="box error">Keyword Target Incorrect
                        <p><img src="/images/3star.png" alt="3 stars" />
                            <?php $rating = $rating +3; ?></p>
                    </div>
                </div>


            <?php }

            elseif($percent >20 && $percent <= 40) { ?>

                <div class="alert_icons_block c_after">
                    <div class="box error">Keyword Target Incorrect
                        <p><img src="/images/2star.png" alt="2 stars" /></p>
                        <?php $rating = $rating +2; ?>
                    </div>
                </div>

            <?php }

            elseif($percent >10 && $percent <= 20) { ?>

                <div class="alert_icons_block c_after">
                    <div class="box error">Keyword Target Incorrect
                        <p><img src="/images/1star.png" alt="1 stars" /></p>
                        <?php $rating = $rating +1; ?>
                    </div>
                </div>

            <?php }

             else { ?>

                <div class="alert_icons_block c_after">
                    <div class="box error">Keyword Target Incorrect
                        <p> <img src="/images/0star.png" alt="0 stars" /></p>
                    </div>
                </div>

            <?php }

             }
            else { ?>

                <div class="alert_icons_block c_after">
                    <div class="box error">
                        <h2>H1 To Targeted Keywords Comparison 0%</h2>
                        <img src="/images/0star.png" alt="0 stars" />
                    </div>
                </div>

            <?php } ?>

            <h2>URL To Targeted Keywords Comparison</h2>

            <?php

                echo '<p>' . $seo->url . '</p>';
                $seo->url = str_replace('-', ' ', $seo->url);
                $seo->url = str_replace('_', ' ', $seo->url);

                similar_text($seo->url, $seo->correct_density, $percent);
            ?>

            <?php if($percent > 90) { ?>

            <div class="alert_icons_block c_after">
                <div class="box success">Perfect WOW
                    <p><img src="/images/5star.png" alt="10 stars" /><img src="/images/5star.png" alt="10 stars" /></p>
                    <?php $rating = $rating +10; ?>
                </div>
            </div>


            <?php }

            elseif($percent > 80 && $percent <= 90) { ?>

                <div class="alert_icons_block c_after">
                    <div class="box success">Target Keywords Very Very Good
                        <p><img src="/images/5star.png" alt="9 stars" /> <img src="/images/4star.png" alt="9 stars" /></p>
                        <?php $rating = $rating +9; ?>
                    </div>
                </div>


            <?php }

            elseif($percent >70 && $percent <= 80) { ?>

                <div class="alert_icons_block c_after">
                    <div class="box success">Target Keywords Very Good
                        <p><img src="/images/5star.png" alt="8 stars" /><img src="/images/3star.png" alt="8 stars" /></p>
                        <?php $rating = $rating +9; ?>
                    </div>
                </div>

            <?php }

            elseif($percent >60 && $percent <= 70) { ?>

                <div class="alert_icons_block c_after">
                    <div class="box success">Target Keywords Good
                        <p><img src="/images/5star.png" alt="7 stars" /><img src="/images/2star.png" alt="7 stars" /></p>
                        <?php $rating = $rating +7; ?>
                    </div>
                </div>

            <?php }

            elseif($percent >50 && $percent <= 60) { ?>

                <div class="alert_icons_block c_after">
                    <div class="box success">Target Keywords OK
                        <p><img src="/images/5star.png" alt="6 stars" /><img src="/images/1star.png" alt="6 stars" /></p>
                        <?php $rating = $rating +6; ?>
                    </div>
                </div>

            <?php }

            elseif($percent >40 && $percent <= 50) { ?>

                <div class="alert_icons_block c_after">
                    <div class="box error">Target Keywords Incorrect
                        <p><img src="/images/5star.png" alt="5 stars" /><img src="/images/0star.png" alt="5 stars" /></p>
                        <?php $rating = $rating +5; ?>
                    </div>
                </div>

            <?php }

            elseif($percent >30 && $percent <= 40) { ?>

                <div class="alert_icons_block c_after">
                    <div class="box error">Target Keywords Incorrect
                        <p><img src="/images/4star.png" alt="4 stars" /><img src="/images/0star.png" alt="4 stars" /></p>
                        <?php $rating = $rating +4; ?>
                    </div>
                </div>


            <?php }

            elseif($percent >20 && $percent <= 30) { ?>

                <div class="alert_icons_block c_after">
                    <div class="box error">Target Keywords Incorrect
                        <p><img src="/images/3star.png" alt="3 stars" /><img src="/images/0star.png" alt="3 stars" /></p>
                        <?php $rating = $rating +3; ?></div>
                </div>


            <?php }

            elseif($percent >10 && $percent <= 20) { ?>

                <div class="alert_icons_block c_after">
                    <div class="box error">Target Keywords Incorrect
                        <p><img src="/images/2star.png" alt="2 stars" /><img src="/images/0star.png" alt="2 stars" /></p>
                        <?php $rating = $rating +2; ?>
                    </div>
                </div>

            <?php }

            elseif($percent >0 && $percent <= 10) { ?>

                <div class="alert_icons_block c_after">
                    <div class="box error">Target Keywords Incorrect
                        <p><img src="/images/1star.png" alt="1 star" /><img src="/images/0star.png" alt="1 stars" /></p>
                        <?php $rating = $rating +1; ?></div>
                </div>

            <?php }

            else { ?>
                <img src="/images/0star.png" alt="0 stars" />
            <?php

            }
                echo '<p>URL To Targeted Keywords Comparison: ' . number_format(($percent),2) . '%</p>';
            ?>

        </div>

        <h2>Results</h2>

        <div class="results">
            <?php echo "<p>This page scores <strong>" . number_format((($rating / 70) * 100),2) . "%</strong><p>"; ?>
        </div>
    </div>
</body>
</html>