COMPOSER_CONTAINER_NAME=prooph/composer:8.0
DOCKER_RUN_COMPOSER_COMMAND=docker run --rm -it --volume $(shell pwd):/app $(COMPOSER_CONTAINER_NAME)

.PHONY: nop
nop:
	@echo "Please pass a target you want to run"

.PHONY: install
install:
	$(DOCKER_RUN_COMPOSER_COMMAND) install

.PHONY: test
test:
	$(DOCKER_RUN_COMPOSER_COMMAND) test