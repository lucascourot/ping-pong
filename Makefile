.PHONY: test phpspec install

test: phpspec

phpspec: vendor
	php vendor/bin/phpspec run

install: vendor

vendor: composer.phar composer.json
	php composer.phar install

composer.phar:
	wget https://raw.githubusercontent.com/composer/getcomposer.org/1b137f8bf6db3e79a38a5bc45324414a6b1f9df2/web/installer -O - -q | php -- --quiet
