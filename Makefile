#!make

#######
# Usage example:
# $ make tests [additionalArgs="--verbose"]


# Include .env file vars
export HOST_USER=$(shell id -u):$(shell id -g)


# Run PHPUnit test suite
tests:
	docker-compose run web php ./vendor/bin/phpunit --no-coverage $(additionalArgs)

# PHP Static Analysis Tool (https://github.com/phpstan/phpstan). Check for errors and potential bugs.
run-phpstan:
	docker run --rm -v $$(pwd):/app phpstan/phpstan analyse /app/src --level 1
	docker run --rm -v $$(pwd):/app phpstan/phpstan analyse /app/tests --level 1

composer-install:
	docker-compose run web composer install

composer-validate:
	docker-compose run web composer validate

# .PHONY is a pseudo-target needed to re-trigger the commands execution
# otherwise en error would be raised.
.PHONY: tests
