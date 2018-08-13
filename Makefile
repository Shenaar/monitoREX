setup:
	composer install --no-interaction
	php artisan migrate:refresh --seed

update:
	composer update --no-interaction
	php artisan config:cache
	php artisan cache:clear
	php artisan view:clear
	php artisan migrate

test:
	vendor/bin/phpunit
