# What is this project for?

I have created this project for our internal workshops at Yahoo!7. I will demonstrate some common principles, patterns
and anti patterns.

# Intro

Refactoring is a difficult task, i thought it would be a good idea to go through some examples of how can you
refactor a monolythic script following some design principles like S.O.L.I.D and using some of the most popular
design patterns.

# Dependency Injection

Almost every class here uses dependency injection, as it is one of the most fundamental principles.

In most cases you want to avoid the "new" keyword as much as possible, so that your classes could work with
any implementation.

# Coding to contract

All the classes depend on interfaces. This way implementations can be swapped out at any time.

Contracts are easier to maintain and conform to when they are more explicit. Avoid associative arrays, dynamic data 
structures and magic methods. Avoid eval etc. They may be flexible tools, but make it harder to figure out what is
the contract, what is public, what is the meanind and structure od the data etc.

# Single Responsibility Principle

As you can see all the classes have very narrow responsibilities and do a very specific thing.
This specialization allows you to reuse them in different context, but at the same time 
provides a level of abstraction so that you can forget about the details and thing in simpler terms.

Each class should have a comment explaining it's puprose and responsibility. If you cant explain it in
a single sentence it is doing too much.

# Composition over inheritance

As you can see there is no inheritance in these examples. The only place where i use the "extends" keyword
is in the unit tests. In general you can have one or maybe two levels of abstract classes if you really
plan to reuse a lot of the code, but you may still be better off to use composition instead. Objects used
can be reused in any context without the need to extend any classes which makes it more flexible.

Composition also allows you for smaller classes and promotes Single Responsibility Principle.

# Open Closed Principle

Dependency injection is a good way to add functionality in the future. Depending on interfaces also promotes 
future extensions.

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
implementation of the functionality. Common examples of strategies are sorting algorithms, 
encryption, comparator and validation. In fact it is one of he most common patterns.

Examples:
- current provided by the power plant (via the grid)
- current provided by a diesel power generator
- current provided by a solar panel

# Installing dependencies

You will need APC and pecl_http extensions, on recent ubuntu you can try:

    sudo apt-get update
    sudo apt-get install libcurl3 php5-dev libcurl4-gnutls-dev libmagic-dev
    sudo pecl install pecl_http

# Running tests

Execute ant composer target to download all pre-requisites:

    ant setup

Then run phpunit tests by running:

    ant phpunit

# That is all

Visit me at http://artur.ejsmont.org/blog/
