<?php

namespace AppBundle\Twig;

class AppExtension extends \Twig_Extension {

    public function getFilters() {
        return array(
            // Contacts START
            new \Twig_SimpleFilter('get_social_name', array($this, 'getSocialName')),
            new \Twig_SimpleFilter('get_phone_number', array($this, 'getPhoneNumber')),
            // Contacts END
            new \Twig_SimpleFilter('count_approved_comments', array($this, 'countApprovedComments')),
        );
    }

    // Contacts Functionality START
    public function getSocialName($string) {

        $socialName = array();
        $socialMatches = array(
            'facebook.com' => array('name' => 'Facebook', 'fa-icon' => 'ti-facebook'),
            'instagram.com' => array('name' => 'Instagram', 'fa-icon' => 'ti-instagram'),
            'twitter.com' => array('name' => 'Twitter', 'fa-icon' => 'ti-twitter-alt'),
            'linkedin.com' => array('name' => 'Linkedin', 'fa-icon' => 'ti-linkedin'),
            'youtube.com' => array('name' => 'YouTube', 'fa-icon' => 'ti-youtube'),
            'plus.google.com' => array('name' => 'Google Plus', 'fa-icon' => 'ti-google'),
            'reddit.com' => array('name' => 'Reddit', 'fa-icon' => 'ti-reddit'),
            'snapchat' => array('name' => 'Snapchat', 'fa-icon' => 'fa fa-snapchat-ghost'),
            'vk.com' => array('name' => 'VK', 'fa-icon' => 'fa fa-vk'),
            'ok.ru' => array('name' => 'OK', 'fa-icon' => 'fa fa-odnoklassniki'),
            'slack.com' => array('name' => 'Slack', 'fa-icon' => 'fa fa-slack')
        );

        foreach($socialMatches as $name => $social){


            $match = preg_match('/'.$name.'/', $string);

            if($match == 1){

                $socialName = $socialMatches[$name];

            }

        }

        if(empty($socialName)){
            $socialName['name'] = $string;
            $socialName['fa-icon'] = $string;
        }

        return $socialName;

    }

    public function getPhoneNumber($string){

        $phone = $string;
        $phone = '+'.preg_replace('/[^0-9]/', '', $phone);

        return $phone;

    }
    // Contacts Functionality END

    public function countApprovedComments($comments){

        $count = 0;

        foreach($comments as $comment){
            if($comment->getIsApproved()){
                $count++;
            }
        }

        return $count;

    }

    public function getName() {
        return 'app_extension';
    }

}
