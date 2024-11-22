include .env

docker-up:
	chmod +x docker/php/$(ENV)/entrypoint.sh
	chown -R www-data app/storage
	docker compose -f docker-compose-$(ENV).yml up -d

docker-down:
	docker compose -f docker-compose-$(ENV).yml down

phpstan:
	docker exec -i $(PROJECT_NAME)-php vendor/bin/phpstan analyse -c phpstan.neon --memory-limit 4G

cs-fix:
	docker exec -i $(PROJECT_NAME)-php vendor/bin/phpcbf app -v

cs-check:
	docker exec -i $(PROJECT_NAME)-php vendor/bin/phpcs app

composer:
	docker exec -i $(PROJECT_NAME)-php composer install

migrate-seed:
	docker exec -i $(PROJECT_NAME)-php php artisan migrate
	docker exec -i $(PROJECT_NAME)-php php artisan db:seed
