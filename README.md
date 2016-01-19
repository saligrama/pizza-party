# Pizza Party
Pizza Party is a small script written in PHP to order Dominos pizza from the command line via Twitter.

# Installation

Just clone the git repository and you will be good to go. 

    git clone http://github.com/saligrama/pizza-party

The PHP script `pizza-party` must be in the `pizza-party` folder to execute properly. Logistically, I am not sure if there is a workaround; you can put the folder in your `$PATH` for easy usage.

# Configuration

Thanks to Twitter requiring OAuth, you must create a Twitter application. Sign in with your Twitter account and head to http://apps.twitter.com. Click "Create new app" and use these options:

![Twitter options](https://i.imgur.com/uEBD71Z.png)

Once that's done, head over to the Permissions tab of your app and make sure that "Read and Write" is selected. Then, go to the Keys and Access tokens page. Click "Regenerate My Access Token and Secret." Make note of each hash. You will need to do this for every pizza profile you create.

Then, open a new file `/etc/pizza-party/config.ini`. Configuration for the script is done using this ini file in this manner:

```
   [cheese]
   description = "large cheese pizza"
   consumer_key = "CONSUMER_KEY_HASH_IN_QUOTES"
   consumer_key_secret = "CONSUMER_KEY_SECRET_HASH_IN_QUOTES"
   access_token = "ACCESS_TOKEN_HASH_IN_QUOTES"
   access_token_secret = "ACCESS_TOKEN_SECRET_HASH_IN_QUOTES"
```

Replace each hash value with the hashes on the Twitter app website.

# Examples

Use the -p switch to denote a profile. This switch is required.

For a large cheese pizza, corresponding to the above ini profile:

```
   % pizza-party -p "cheese"
   Waiting for five seconds. Press Ctrl-C to quit...
   Ordered large cheese pizza.
```

You can also use a noconfirm switch to skip the wait.

```
   % pizza-party -p "cheese" --noconfirm
   WARNING: noconfirm switch set, ordering pizza. Money will be charged to your bank account.
   Ordered large cheese pizza.
```

If you try to specify a profile that is not set in config.ini, or do not specify a profile at all, you will get an error.

```
   % pizza-party -p "jalapeno" --noconfirm
   ERROR: no such profile
```
