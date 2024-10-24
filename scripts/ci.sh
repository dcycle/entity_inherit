#!/bin/bash
#
# Run tests, meant to be run on CirlceCI.
#
set -e

echo '=> Run fast tests.'
./scripts/test.sh

echo '=> Deploy a Drupal 11 environment.'
./scripts/deploy.sh 11

echo '=> End-to-end tests on D11.'
./scripts/end-to-end-tests.sh

echo '=> Tests on Drupal 11 environment.'
./scripts/test-running-environment.sh

echo '=> Destroy the Drupal 11 environment.'
./scripts/destroy.sh

echo '=> Deploy a Drupal 10 environment.'
./scripts/deploy.sh 10

echo '=> End-to-end tests on D10.'
./scripts/end-to-end-tests.sh

echo '=> Tests on Drupal 10 environment.'
./scripts/test-running-environment.sh

echo '=> Destroy the Drupal 10 environment.'
./scripts/destroy.sh
