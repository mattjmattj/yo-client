# 
# Makefile for mattjmattj/yo-client
# 
# Licence: BSD-2-Clause
# Author: Matthias Jouan

SHELL=/bin/bash

SOURCES 		:= $(shell find src -name '*.php')
TESTS 			:= $(shell find tests -name '*.php')
BUILDDIR		:= build
BUILDDIRTREE	:= $(foreach file,$(SOURCES) $(TESTS),$(BUILDDIR)/$(dir $(file)))

LINTER			:= php -l
PHPCS			:= vendor/bin/phpcs
PHPCSOPTIONS	:= --standard=PSR2
PHPUNIT			:= vendor/bin/phpunit
PHPUNITOPTIONS	:= --coverage-clover=coverage.clover

PIPEFAIL		:= set -o pipefail;

LINTED			:= $(patsubst %.php,$(BUILDDIR)/%.lint,$(SOURCES) $(TESTS))
PHPCSED			:= $(patsubst %.php,$(BUILDDIR)/%.phpcs,$(SOURCES) $(TESTS))

all: lint phpcs phpunit

# lint

$(BUILDDIR)/%.lint: %.php
	@echo "Checking syntax for $<"
	@$(PIPEFAIL) $(LINTER) $< | tee $@

lint: prepare-build $(LINTED)

# phpcs

$(BUILDDIR)/%.phpcs: %.php
	@echo "Checking coding standards for $<"
	@$(PIPEFAIL) $(PHPCS) $(PHPCSOPTIONS) $< | tee $@

phpcs: prepare-build $(PHPCSED)
	

#phpunit	
$(BUILDDIR)/phpunit.log:
	@echo "Running phpunit tests"
	@$(PIPEFAIL) $(PHPUNIT) $(PHPUNITOPTIONS) | tee $@
	
phpunit: $(BUILDDIR)/phpunit.log
	
prepare-build:
	@mkdir -p $(BUILDDIRTREE)
	
clean:
	rm -rf $(BUILDDIR)

.PHONY: all lint phpcs phpunit prepare-build clean