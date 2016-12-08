## mailgun-webmail

Simple and powerful webmail to manage mailgun mails

## Insall

Just download it from github repo, then add your own DB and mailgun config in ```/app/config.php```

```
define('DB_HOST','localhost');
define('DB_NAME','some db');
define('DB_USER','root');
define('DB_PASS','');
define('PUBKEY','pubkey-12345678'); //Your public key from mailgun
define('KEY','key-12345678'); //Your private key from mailgun
```


## License

This sofware is under [MIT LICENCE](https://opensource.org/licenses/MIT)

Thanks for [MailGun](https://mailgun.com)
