# 2. Database managment
Date: 2021-03-06

## Status

Accepted

## Context

We need to select a way to interact with a database. 

## Decision

We will use `symfony/orm-pack` without using the modeling. 

## Consequences

### Expected 

We expect better performance and more flexibility using a simple `Connection` rather than an `ORM`.

### Real
