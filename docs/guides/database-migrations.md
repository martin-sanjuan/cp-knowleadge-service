# Creating migrations

To create a new migration just run 

```
docker-compose exec php bin/console doctrine:migrations:generate
```

or inside the container just 

```
php bin/console doctrine:migrations:generate
```

A new file will be created on the `/migrations` folder. 


## Managing migrations 

The following commands are available to work with the migrations:

```
 doctrine:migrations:current                [current] Outputs the current version.
 doctrine:migrations:diff                   [diff] Generate a migration by comparing your current database to your mapping information.
 doctrine:migrations:dump-schema            [dump-schema] Dump the schema for your database to a migration.
 doctrine:migrations:execute                [execute] Execute a single migration version up or down manually.
 doctrine:migrations:generate               [generate] Generate a blank migration class.
 doctrine:migrations:latest                 [latest] Outputs the latest version number
 doctrine:migrations:migrate                [migrate] Execute a migration to a specified version or the latest available version.
 doctrine:migrations:rollup                 [rollup] Roll migrations up by deleting all tracked versions and inserting the one version that exists.
 doctrine:migrations:status                 [status] View the status of a set of migrations.
 doctrine:migrations:up-to-date             [up-to-date] Tells you if your schema is up-to-date.
 doctrine:migrations:version                [version] Manually add and delete migration versions from the version table.
 doctrine:migrations:sync-metadata-storage  [sync-metadata-storage] Ensures that the metadata storage is at the latest version.
 doctrine:migrations:list                   [list-migrations] Display a list of all available migrations and their status.
```

## Docs

You can find more information [here](https://symfony.com/doc/current/bundles/DoctrineMigrationsBundle/index.html) and [here](https://www.doctrine-project.org/projects/doctrine-migrations/en/current/reference/introduction.html#introduction)
