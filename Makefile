SHELL:=/bin/bash
.ONESHELL:

bash:
	@if [[ ! -f /.dockerenv ]] ; then
		echo 'Connecting to minicli docker instance...'
		docker exec -ti -u dev minicli bash
	else
		echo 'You are already inside the docker bash.'
	fi

csfix:
	@if [[ -f /.dockerenv ]]; then
		cd /srv/minicli && vendor/bin/php-cs-fixer fix
	else
		docker exec -ti -u dev minicli sh \
			-c "cd /srv/minicli && vendor/bin/php-cs-fixer fix"
	fi

# make tests ARGS="--filter AppTest"
tests:
	@if [[ -f /.dockerenv ]]; then
		cd /srv/minicli && vendor/bin/phpunit $(ARGS) --coverage-html coverage;
	else
		docker exec -ti -u dev minicli sh \
			-c "cd /srv/minicli && vendor/bin/phpunit $(ARGS) --coverage-html coverage"
	fi

# make composer ARGS="require phpunit/phpunit"
composer:
	@if [[ -f /.dockerenv ]]; then
		cd /srv/minicli && composer $(ARGS)
	else
		docker exec -ti -u dev minicli sh \
			-c "cd /srv/minicli && composer $(ARGS)"
	fi

.PHONY: bash csfix tests composer