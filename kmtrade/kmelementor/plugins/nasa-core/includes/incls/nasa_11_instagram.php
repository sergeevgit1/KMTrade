<?php
class Nasa_Instagram_Feed {
    
    const INSTAGRAM_API = 'https://api.instagram.com/v1/users/self/media/recent/?access_token={{token}}&count={{count}}';
    protected $_token = '';
    protected $_count = 12;
    
    public function __construct($instance = array()) {
        $this->_token = isset($instance['token']) ? $instance['token'] : '';
        $this->_count = isset($instance['count']) && (int) $instance['count'] > 0 ? (int) $instance['count'] : 12;
    }
    
    function get_instagram(){
        if (!$this->_token) {
            return null;
        }
        
        $tokenArr = explode('.', $this->_token);
        if (!isset($tokenArr[0]) || !$tokenArr[0]) {
            return null;
        }
        
        $key = 'nasa_instagram_' . $tokenArr[0] . '_limit_' . $this->_count;
        $instagram = get_transient($key);
        if (!$instagram) {
            $url = str_replace(array('{{token}}', '{{count}}'), array($this->_token, $this->_count), self::INSTAGRAM_API);

            $args = array(
                'timeout' => 60,
                'sslverify' => false
            );
            $result = wp_remote_get($url, $args);
            if (!is_wp_error($result)) {
                $instagram = $result['body'];
                
                if ($instagram) {
                    set_transient($key, $instagram, apply_filters('nasa_instagram_cache_time', HOUR_IN_SECONDS));
                }
            }
        }
        
        $jsonData = false;
        if ($instagram) {
            $jsonData = json_decode($instagram);
        }

        return ($jsonData && isset($jsonData->data)) ? $jsonData->data : null;
    }
}
