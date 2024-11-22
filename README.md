# Purpose

This alternc plugin provide an api cli to manage some alternc action
* must be use from a root accout
* provide some commons actions to manage alternc account

# Prototype

The cli should to follow this format : ```AlternC <alternc_option> <ressource> <action> <ressource|action_option>```

Cli is executed with current POSIX user
AlternC option are :
* the option* ```--su account``` should be present to change user account

This cli is not directly an AlternC wrapper, purpose, in first time, is to rationalize console logic. And wrap these commmands with introspection or hardcoded code

* Ressources could be set in /usr/lib/alternc/panel/class/m_*.php or other transversal structure :
  * as an AlternC object we can think to account, ftp, mail, ...,
  * as Transversal elements as services (bind, apache, opendkim, ...) or generic (admin, ...)
* Action could be split in two part, common and specific action
  * as common actions we have add, update, delete, list, rebuild,
  * as specific actions we have print, search, fix
* Options are free and should be related to action and/or ressource


Actually cli could be defined with develop as this :
```
alternc
    help
    whoami

    admin
        search
        print

    opendkim
        check
        fix
    permission
        fix
        check
    mail
        fix
        add
        update
        list
    account
        add
        update
        list
    ftp
        add
        update
        delete
        list
    domain
        add
        update
        list
    sympa
        add
        update
        list
    mailman
        add
        update
        list
    dns
        rebuild
```


# Requirement

You need :
* debian server (from Buster)
* alternc >= 3.5


# Installation

## Stable and Nightly package

You can download last package from :
* github : [release page](../../releases/latest)
* debina.alternc.org

## Configuration and Activation

Once alternc-cli installed , you could :
* run **alternc help**


# ROADMAP

* [ ] Create an AlternC account
* [ ] Create an mysql database with its account
* [ ] Create a ftp account
* [ ] Create a domain
* [ ] Add a subdomain
* [ ] Modify/Delete a mysql account
* [ ] Delete a mysql database
* [ ] Modify/Delete a ftp account
* [ ] Modify/Delete a domain
* [ ] Modify/Delete a subdomain