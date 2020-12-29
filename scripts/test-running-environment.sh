#!/bin/bash
#
# Run some checks on a running environment
#
set -e

echo " => Making sure all modules are installed"
docker-compose exec -T drupal /bin/bash -c 'drush en -y entity_inherit_verbose'

echo " => Running self-tests"
docker-compose exec -T drupal /bin/bash -c 'drush ev "entity_inherit()->dev()->liveTest()"'

echo " => Uninstalling entity_inherit_verbose"
docker-compose exec -T drupal /bin/bash -c 'drush pmu -y entity_inherit_verbose'

echo " => Uninstalling entity_inherit"
docker-compose exec -T drupal /bin/bash -c 'drush pmu -y entity_inherit'

echo " => Done running self-tests. All EntityInherit modules should be uninstalled."
echo " =>"
