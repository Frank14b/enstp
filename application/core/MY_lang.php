
<?php

class MY_lang extends CI_lang
{
    public function __construct()
    {
        
        global $URI, $CFG, $IN;

        $config = &$CFG->config;

        $index_page = $config['index_page'];
        $lang_ignore = $config['lang_ignore'];
        $default_abbr = $config['language_abbr'];
        $lang_uri_abbr = $config['lang_uri_abbr'];

        $uri_abbr = $URI->segment(1);

        if(! isset($_SESSION)){
            session_start();
        }

        $_SESSION['abbr_lang'] = $uri_abbr;

        $URI->uri_string = preg_replace("|^\/?|", '/', $URI->uri_string);

        if ($lang_ignore) {

            if (isset($lang_uri_abbr[$uri_abbr])) {
                $IN->set_cookie('user_lang', $uri_abbr, $config['sess_expliration']);
            } else {
                $lang_abbr = $IN->cookie($config['cookie_prefix'] . 'user_lang');
            }

            if (strlen($uri_abbr == 2)) {
                $index_page .= empty($index_page) ? '' : '/';

                $URI->uri_string = preg_replace("|^\/?$uri_abbr\/?|", '', $URI->uri_string);

                //header('Locaion:' . $config['base_url'] . $index_page . $URI->uri_string);
                //die();
            }
        } else {

            $lang_abbr = $uri_abbr;
        }

        if (isset($lang_uri_abbr[$lang_abbr])) {

            //echo $uri_abbr;
            //die();

            //$URI->_reindex_segment(array_shift($URI->segments));
            //$URI->uri_string = preg_replace("|^\/?$uri_abbr\/?|", '', $URI->uri_string);

            $config['language'] = $lang_uri_abbr[$lang_abbr];
            $config['language_abbr'] = $lang_abbr;

            if (!$lang_ignore) {
                $index_page .= empty($index_page) ? $lang_abbr : "/$lang_abbr";

                $config['index_page'] = $index_page;
            }
            
            $IN->set_cookie('user_lang', $lang_abbr, $config['sess_expiration']);
        } else {
            if (!$lang_ignore) {
                
                $lang_browser = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

                if (isset($lang_uri_abbr[$lang_browser])) {
                    $index_page .= empty($index_page) ? $lang_browser : "/$lang_browser";
                } else {
                    $index_page .= empty($index_page) ? $lang_abbr : "/$lang_abbr";
                }

                if (strlen($lang_abbr == 2)) {
                    $URI->uri_string = preg_replace("|^\/?$uri_abbr\/?|", '', $URI->uri_string);
                }

                //header('Location:' . $config['base_url'] . $index_page . $URI->uri_string);
                //die();
            }
            $IN->set_cookie('user_lang', $lang_abbr, $config['sess_expiration']);
        }
        log_message('debug', "Language_Identifier Class Initialized");
    }
}

function t($line)
{
    global $LANG;
    return ($t = $LANG->LINE($line)) ? $t : $line;
}