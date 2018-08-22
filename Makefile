setup:
	docker-compose build
	bin/composer install
	bin/npm install
	docker-compose up -d
	bin/artisan migrate:refresh --seed
