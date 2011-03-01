Fetchmailrc generator
=====================

A simple PHP script which generates a .fetchmailrc file from a DB, based on ISPMail setup.

For more information see the following blog posts:

* [http://ailoo.net/2011/03/fetchmail-sieve-on-ispmail-setup-update](http://ailoo.net/2011/03/fetchmail-sieve-on-ispmail-setup-update)
* [http://ailoo.net/2008/08/fetchmail-sieve-virtual-mail-debian-etch](http://ailoo.net/2008/08/fetchmail-sieve-virtual-mail-debian-etch)

Installation
------------

Copy <code>config.inc.php.dist</code> to <code>config.inc.php</code> and edit it to match your environment. Then, run <code>php /path/to/fetchmail.php</code>.