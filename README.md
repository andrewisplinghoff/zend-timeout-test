# Zend Mail Timeout Test

This is a test case showing that the Zend Mailer fails when a timeout occurs during the SMTP session.

To run the test case:

1. Insert mail server config into file mailtest.php
2. Perform `composer install`
3. Run the test case: `php mailtest.php`

If the server has a timeout of 5 minutes (e.g. smtp.mandrillapp.com does have this timeout), the output will be the following:

```
Sending first mail...
Sleeping 5 minutes...
5 minutes passed.
Sleeping 10 more seconds...
Sending second mail...
Exception: object(Zend\Mail\Protocol\Exception\RuntimeException)#27 (7) {
  ["message":protected]=>
  string(48) "4.4.2 ip-10-75-138-252 Error: timeout exceeded
  ...
...
```

To run the test case with the proposed changes, add the following entry to the `composer.json`. 

```
"repositories": [
	{
		"type": "package",
		"package": {
			"name": "zendframework/zendframework",
			"version": "dev-master",
			"source": {
				"url": "https://github.com/VIISON/zf2.git",
				"type": "git",
				"reference": "master"
			},
			"autoload": {
				"classmap": [""]
			}
		}
	}
]
```

Delete the `composer.lock` as well as the `vendor` directory and run `composer install` again to switch the source of the Zend framework.

With the proposed changes in place, `php mailtest.php` succeeds:

```
Sending first mail...
Sleeping 5 minutes...
5 minutes passed.
Sleeping 10 more seconds...
Sending second mail...
Success!
```
