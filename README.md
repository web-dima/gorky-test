# gorky-test
Тестовое задание на должность php-программист

Проект в докере. Для его запуска используйте wsl

# Копирование .env
`cp .env.example .env && cp app/.env.example app/.env`

# Запуск докера
`make docker-up`

# Установка зависимостей
`make composer`

# Выполнение миграций
`make migrate-seed`

# остановка докера
`make docker-down`

Nginx раздает приложение по ссылке http://localhost