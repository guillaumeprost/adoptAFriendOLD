hello:
	@echo "Hello! use other targets!"

init:
	php bin/console server:run
	mysql.server restart