#!/usr/bin/env php
<?php

    require __DIR__ . "/vendor/autoload.php";
    
    initialize();
    
    // get CLI options and load Twitter profile from config file
    function initialize() {
        
        $config = parse_ini_file("/etc/pizza-party/config.ini", true);
        
        $shortopts = "p:";
        $longopts = ["noconfirm"];
        
        $params = getopt($shortopts, $longopts);
        
        // check if profile exists
        
        if (@isset($config[$params["p"]])) {
        
            if (isset($params["noconfirm"])) {
            
                print("WARNING: noconfirm switch set, ordering pizza. Money will be charged to your bank account.\n");
                
                orderPizza($config[$params["p"]], $params["p"]);
                
            }
            
            else {
            
                print("Waiting for five seconds. Press Ctrl-C to quit...\n");
                
                sleep(5);
                
                orderPizza($config[$params["p"]], $params["p"]);
            
            }
                
        }
        
        else {
        
            print("ERROR: no such profile\n");
        
        }
    
    }
    
    // send tweet to Dominos to place easy order
    function orderPizza($profile, $profile_name) {
        
        $twitter = new Twitter($profile["consumer_key"], $profile["consumer_secret"], $profile["access_token"], $profile["access_token_secret"]);
        
        $twitter->send("@Dominos #EasyOrder");
        
        print("Ordered pizza with profile " . $profile_name . ".");
    
    }
    
?>
