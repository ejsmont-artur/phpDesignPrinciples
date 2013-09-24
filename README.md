# What is this project for?

I have created this project for our internal workshops at Yahoo!7. I will demonstrate some common principles, patterns
and anti patterns.

# Intro

Refactoring is a difficult task, i thought it would be a good idea to go through some examples of how can you
refactor a monolythic script following some design principles like S.O.L.I.D and using some of the most popular
design patterns.

# Dependency Injection

Almost every class here uses dependency injection as it is one of the most fundamental principles.

# Coding to contract

All the classes depend on interfaces. This way implementations can be swapped out at any time.

# Desing Patterns and electricity ;)

I had this idea recently that some of the design patterns translate nicely into the way our power supplies work.

## Proxy

Proxy pattern preserves the same interface and adds functionality without clients knowing it. Clients
do not interact with the target directly just via the proxy.

Examples: 
- extensions cord (length of the cord is the feature)
- power board with circuit breaker (safety is the feature)
- UPS power supply ()

## Adapter

Adapter translates interface of existing implementation to the interface that our clients need.
Usually it has very little code and simply translates between interfaces.

Examples: 
- 220V to 110V converting adapter (changes electric parameters)
- 220V to USB adapter (changes voltage and the plug type)
- travelers plug (converts plug type only)

## Strategy

Strategy is similar to adapter but it usually does the actual work. Strategy is just an alternative
implementation of the functionality, with often examples of sorting, encryption and validation as examples
of strategy pattern. In fact it is one of he most common patterns.

Examples:
- current provided by the power plant (via the grid)
- current provided by a diesel power generator
- current provided by a solar panel

# Running tests

Execute ant composer target to download all pre-requisites:

    ant setup

Then run phpunit tests by running:

    ant phpunit

# That is all

Visit me at http://artur.ejsmont.org/blog/
