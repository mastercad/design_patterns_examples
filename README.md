# Design Patterns Example

1. [Event sourcing](#event-sourcing)<br>
   1. [simple](#events-sourcing-simple)<br>
   2. [symfony framework](#event-sourcing-symfony-framework)<br>
   3. [symfony framework with message bus](#event-sourcing-symfony-framework-with-message-bus)<br>
2. [CQRS](#cqrs)<br>
3. [DDD](#ddd)<br>
4. [Event sourcing + Message Bus + CQRS + DDD with Symfony Framework](#event-sourcing-message-bus-cqrs-dd-with-symfony-framework)


## Event Sourcing <a name="event-sourcing"></a>
### simple <a name="event-sourcing-simple"></a>
Here I would just like to use a simple example to show how event sourcing is generally thought of and works.

Neither a framework nor additional services or technologies are intentionally used in order to keep the focus clearly on the actual logic of the pattern.

#### Usage

Edit Main.php and add there command calls to manipulate accounts or show there balance. Example is already provided.

## symfony framework <a name="event-sourcing-symfony-framework"></a>
Here the simple example was expanded to include the use of Symfony as a framework and a nosql database was used instead of the file system.

Symfony deleted the event handler and replaced it with listeners that handle the various events.

Here it is possible to catch the events with more specific listener and thus respond to more specific needs per event.

#### Usage

build container with

`docker compose up --build`

execute composer install

`docker compose exec php composer install`

run commands, for example:

`docker compose exec php bin/console app:deposit --account="#63452" --amount="5623"`

or show account balance:

`docker compose exec php bin/console app:show-account-balance --account="#63452"`

available commands are:

```sh
app:charge-back          Transfers an amount back to an account
app:deposit              Deposits an amount into an account
app:pay-off              Add a short description for your command
app:show-account-balance Show account balance
```

## symfony framework with message bus <a name="event-sourcing-symfony-framework-with-message-bus"></a>
Here the Symfony framework example has been expanded to include the message bus. This means that events are no longer processed within the application, but are handled externally via a message bus. This enables events to be scaled and handled decentrally, regardless of the current application.

## CQRS

## DDD

## Event Sourcing with Message Bus, CQRS, DDD with Symfony Framework
