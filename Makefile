test:
	./vendor/bin/behat

create_database:
	php ./vendor/bin/doctrine orm:schema-tool:create

drop_database:
	php ./vendor/bin/doctrine orm:schema-tool:drop --force
