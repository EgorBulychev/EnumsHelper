all: php-cs-fixer test phpstan
test:
	docker-compose run --rm php-cli composer test
phpstan:
	docker-compose run --rm php-cli composer phpstan
php-cs-fixer:
	docker-compose run --rm php-cli composer php-cs-fixer
