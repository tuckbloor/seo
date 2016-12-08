<?php

    Class Seo
    {
        private $ch, $content, $table_tag, $data, $find_text, $pos;
        public $speed, $title, $tables, $tables_found, $h1, $h2, $welcome, $meta_tags, $title_length, $count_ignored,
               $count_spam, $count_correct, $spam, $words, $correct_density, $url;
        public $keywords = '';
        public $ignored  = '';
        public $correct  = '';

        public function __construct($url)
        {
            //the URL that is passed remove trailing slash
            $this->url = rtrim($url, '/');

            //get the html of the passed URL
            $this->content = file_get_contents($url);
        }


        //a function that uses curl to get the download speed h1 and h2 tags
        public function getData()
        {
            //set a user agent
            $userAgent = 'Googlebot/2.1 (http://www.googlebot.com/bot.html)';
            $this->ch = curl_init($this->url);//initialise the crawler
            curl_setopt($this->ch, CURLOPT_HEADER, 0); //header information is not needed so dont return it
            curl_setopt($this->ch, CURLOPT_USERAGENT, $userAgent); //set the user agent
            curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($this->ch, CURLOPT_CONNECTTIMEOUT, 2);
            curl_setopt($this->ch, CURLOPT_TIMEOUT, 60);

            set_time_limit(60);

            $html = curl_exec($this->ch);

            //get he curl information so we can get the download speed
            $this->speed = curl_getinfo($this->ch);

            //get H1 and h2 tags
            $this->getHtags($html);

        }


        public function getHtags($html)
        {
            $dom = new DOMDocument();//create and DomDocument
            $dom->loadHTML($html);//get the html that was got from the curl
            $this->h1 = $dom->getElementsByTagName("h1");//get all of the H1 tags
            $this->h2 = $dom->getElementsByTagName("h2");//get all of the h2 tags;
        }

        public function getTitle()
        {
            preg_match("/<title>(.+)<\/title>/", $this->content, $matches);//get everything between the title tags
            $this->title = $matches[1];//set the title
            $this->title_length = strlen($this->title);//get the title length

            return;
        }

        public function checkForHtmlTables()
        {
            $this->table_tag = "<table";//a variable for finding table tags not closed because of possible attributes

            //find out if the content contains the table tag
            if (strpos($this->content, $this->table_tag) !== false) {
                $this->tables_found = 1;//tables found
            } else {
                $this->tables_found = 0;//no tables found
            }

            return;
        }

        public function checkForWelcome()
        {
            $this->data = strtolower($this->content);//the content is now all lowercase
            $this->find_text   = "welcome to"; //check if the content contains welcome to
            $this->pos = strpos($this->data, $this->find_text);//find the position of welcome to in the data

            if ($this->pos === false) {
                $this->welcome = null; //welcome to phrase not found
            } else {

                //welcome to found on the site
                $this->welcome = "We Found the phrase Welcome To On This Page, This Is A Common Mistake Phrases,
                                  Like Welcome To My Website Are Not Advised, Google Expects The Most Important Words To
                                   Be At The Top Of The Page And The Most Important Words Will Be The First 50 Words";
            }

            return;
        }

        public function getDensity()
        {
            $str = $this->content;
            $str = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "", $str);//remove content between script tags
            $str = strip_tags($str);//remove tags
            $str = strtolower($str);// content is lower case


            //array of prepositions to be removed
            $prepositions = ['a','nbsp','&nbsp;', 'an', 'as', 'at', 'before', 'but', 'by', 'for', 'from','is','in',
                                  'into', 'like','of', 'off','on', 'onto', 'per', 'since', 'than', 'the', 'this',
                                  'that','to','up', 'via', 'with', 'aboard', 'about', 'above', 'across', 'after',
                                  'against', 'along', 'amid', 'among', 'anti', 'around', 'before', 'behind', 'below',
                                  'beneath', 'beside', 'besides', 'between', 'beyond', 'concerning', 'considering',
                                  'despite', 'down', 'during', 'except', 'excepting', 'excluding', 'following',
                                  'inside', 'minus', 'near', 'opposite', 'outside', 'over', 'past', 'plus', 'regarding',
                                  'round', 'save', 'since', 'through', 'toward', 'towards', 'under', 'underneath',
                                  'unlike', 'until', 'upon', 'versus', 'within', 'without', 'and', 'are', 'so', 'a'];

            //array of pronouns to be removed
            $pronouns = ['all', 'another', 'any', 'anybody', 'anyone', 'anything', 'both', 'each', 'other', 'either',
                         'everybody', 'everyone', 'everything', 'few', 'he', 'her', 'hers', 'herself', 'him', 'himself',
                         'his', 'i', 'it', 'its', 'itself', 'little', 'many', 'me', 'mine', 'more', 'most', 'much',
                         'my', 'myself', 'neither', 'no', 'one', 'nobody', 'none', 'nothing', 'one', 'one another',
                         'other', 'others', 'our', 'ours', 'ourselves', 'several', 'she', 'some', 'somebody', 'someone',
                         'something', 'that', 'their', 'theirs', 'them', 'themselves', 'these', 'they', 'this', 'those',
                         'us', 'we', 'what', 'whatever', 'which', 'whichever', 'who', 'whoever', 'whom', 'whomever',
                         'whose', 'you', 'your', 'yours', 'yourself', 'yourselves', 'am', 'nbsp'];


            //array of characters to be removed
            $chars = ['!', '@','£','$', '%', '^', '&', '*', '?', ',', '_'];

            //replace all prepositions s passed for occurrences
            foreach($prepositions as $word) {
                $str = preg_replace("/\s". $word ."\s/", " ", $str);
            }

            //replace all pronouns s passed for occurrences
            foreach($pronouns as $word) {
                $str = preg_replace("/\s". $word ."\s/", " ", $str);
            }

            //replace all chars s passed for occurrences
            foreach($chars as $word) {
                $str = preg_replace("/\s". $word ."\s/", " ", $str);
            }


            //remove items but dont add whitespace
            $str = str_replace('e-', '', $str);
            $str = str_replace('-', ' ', $str);
            $str = str_replace('nbsp', '', $str);
            $str = str_replace('lsquo', ' ', $str);
            $str = str_replace('rsquo', ' ', $str);
            $str = str_replace(';s', ' ', $str);


            //get the meta tags
            $tags = $this->getMetaTags();

            //set the description
            if(empty($tags['description'])) {
                $description = '';
            }
            else {
                $description = $tags['description'];
            }


            $str = $str . ' ' . $this->title . ' ' . $description;//add title and description to word count and density

            //all words are now lowercase and in numerical associate array
            $this->words = str_word_count(strtolower($str),1);
            $word_count = array_count_values($this->words);//count the words

            //set variables for numerical values
            $this->count_ignored = 0;
            $this->count_spam = 0;
            $this->count_correct  = 0;
            $this->correct_density = '';

            //loop through the word count array
            foreach ($word_count as $key=>$val) {

                //work out the density
                $density = ($val/count($this->words))*100;

                //all of the words on the page
                if ($density > 0) {
                    $this->keywords .= "$key - COUNT: $val, DENSITY: ".number_format($density,2)."%<br/>\n";
                }


                //ignored words on the page
                if ($density < 2){

                    $this->ignored .= "$key - COUNT: $val, DENSITY: ".number_format($density,2)."%<br/>\n";
                    $this->count_ignored++;

                }

                //spamming words if over 7%
                if ($density > 7){

                    $this->spam .= "$key - COUNT: $val, DENSITY: ".number_format($density,2)."%<br/>\n";
                    $this->count_spam++;

                }

                //between and 2% and 7% believed to be the correct keyword density
                if ($density >= 2 && $density <= 7){

                    $this->correct .= "$key - COUNT: $val, DENSITY: ".number_format($density,2)."%<br/>\n";
                    $this->correct_density .= "$key ";
                    $this->count_correct++;

                }

            }

        }

        public function getMetaTags()
        {
            $this->meta_tags = get_meta_tags($this->url);//get the meta tags from the passed url

            return $this->meta_tags;
        }

    }