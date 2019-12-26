<?php class zz_af_oboobs_fix extends Plugin {
        private $host;
        function about() {
                return array(1.0,
                        "change oboobs so it shows the best quality version of the photo without opening the page",
                        "swack");
        }
        function init($host) {
                $this->host = $host;
                $host->add_hook($host::HOOK_ARTICLE_FILTER, $this);
        }
        function hook_article_filter($article) {
                // removes redundant http
                if(strpos($article["link"], "oboobs.ru") !== FALSE)
                {
                        $subject = $article["content"];
                        $pattern = '~(?:<a.href.*?.jpg">)(<img src=.*?)(?:_preview)(\/.*?.jpg">)(?:.*)~';
                        $replace = '\1\2';
                        $article["content"] = preg_replace($pattern,$replace,$subject);
                }
                return $article;
        }
        function api_version() {
                return 2;
        }
}

