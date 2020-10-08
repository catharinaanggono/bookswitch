drop database if exists bookswitch;
create database if not exists bookswitch;
use bookswitch;

create table if not exists User (
    UserID varchar(32) NOT NULL,
    Password varchar(64) NOT NULL,
    EmailAddress varchar(64) NOT NULL,
    Points BIGINT NOT NULL, 
    primary key(UserID)
);

create table if not exists Library (
    UserID varchar(32) NOT NULL,
    MyListings /* idk what datatype */ NOT NULL,
    Waitlist /* idk what datatype */ NOT NULL,
    Pending /* idk what datatype */ NOT NULL,
    primary key (UserID)
    /* foreign key (UserID) references User(UserID)*/
);

create table if not exists Book (
    Eisbn varchar(64) NOT NULL,
    Title varchar(64) NOT NULL,
    Author varchar(64) NOT NULL,
    CategoryID varchar(32) NOT NULL,
    StatusID varchar(32) NOT NULL,
    OwnedBy varchar(32) NOT NULL,
    Price BIGINT NOT NULL,
    /* details put here or anoter table? */
    primary key (Eisbn)
);

create table if not exists Status (
    StatusID varchar(32) NOT NULL,
    Status varchar(32) NOT NULL,
    primary key (StatusID)
    /*foreign key (statusID) references Book(StatusID)*/
);

create table if not exists Category (
    CategoryID varchar(32) NOT NULL,
    CategoryName varchar(32) NOT NULL,
    primary key (CategoryID)
    /*foreign key(CategoryID) references Book(CategoryID)*/
);

create table if not exists Details (
    Eisbn varchar(64) NOT NULL,
    Price BIGINT NOT NULL,
    Synopsis varchar(225) NOT NULL,
    Description varchar(255) NOT NULL,
    Pictures /* ?link? */
    No_copies INT NOT NULL,
    primary key (Eisbn)
    foreign key (Eisbn) references Book(Eisbn)
);