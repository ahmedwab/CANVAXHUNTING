
/*
Table to store emails along with postal codes

Column EMAIL 
DATATYPE: varchar(255) NOT NULL
DESCRIPTION: Email of user who wants to be notified


column POSTALCODE
DATATYPE: varchar(3) NOT NULL
DESCRIPTION: first 3 characters of postal code that identifies user's address

*/


CREATE TABLE EMAILS (
    EMAIL varchar(255) NOT NULL,
    POSTALCODE varchar(3) NOT NULL,
    PRIMARY KEY (EMAIL)
);