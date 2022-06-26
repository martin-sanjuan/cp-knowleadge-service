# 1. Database managment
Date: 2021-03-06

## Status

Accepted

## Context

We need to select a way to interact with a database. 

## Decision

We will use `doctrine-dbal` as an abstraction layer to handle database connections, and we will use it as a service through DI. 
We will use `doctrine-migration` to handle the database migrations. 

## Consequences

We expect better performance and more flexibility using a simple `DBAL` rather than an `ORM`.


