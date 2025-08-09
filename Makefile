build:
	docker compose build --no-cache
up:
	docker compose up -d
stop:
	docker compose stop
ps:
	docker compose ps
down:
	docker compose down
app:
	docker compose exec app bash