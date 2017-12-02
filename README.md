# Purpose

This alternc plugin provide an api cli to manage some alternc command
* must be use from a root accout
* provide some commons actions to manage alternc account

# Requirement

You need :
* debian server (from Jessie)
* alternc >= 3.2
* [apt-transport-https](https://packages.debian.org/search?keywords=apt-transport-https) package to use https bintray service.


# Installation

## Stable package

You can download last package from :
* github : [release page](../../releases/latest)
* bintray : [ ![Bintray](https://api.bintray.com/packages/alternc/stable/alternc-cli/images/download.svg) ](https://bintray.com/alternc/stable/alternc-cli/_latestVersion)
* from bintray repository

### With Jessie and more recent

```shell
apt-get install apt-transport-https
echo "deb [trusted=yes] https://dl.bintray.com/alternc/stable stable main"  >> /etc/apt/sources.list.d/alternc.list
apt-get update
apt-get install alternc-cli
alternc.install
```

## Nightly package

You can get last package from bintray, it's follow git master branch

```shell
echo "deb [trusted=yes] https://dl.bintray.com/alternc/nightly stable main"  >> /etc/apt/sources.list.d/alternc.list
apt-get update
apt-get upgrade
apt-get install alternc-cli
```

# Configuration and Activation

Once alternc-cli installed , you could :
* run **alternc help**

# Packaging from source

To generate package we use [fpm tool](https://github.com/jordansissel/fpm)

```shell
apt-get install ruby ruby-dev rubygems build-essential
gem install --no-ri --no-rdoc fpm

git clone https://github.com/AlternC/alternc-cli
cd alternc-cli
make

```


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