
/*
Table to store emails along with postal codes

Column ID 
DATATYPE: INTEGER NOT NULL AUTO_INCREMENT
DESCRIPTION: unique ID of post


column LINK
DATATYPE: TEXT NOT NULL
DESCRIPTION: Embedded twitter link

column PROVINCE
DATATYPE: varchar(255) NOT NULL
DESCRIPTION: Province or territory name

column POSTALCODE
DATATYPE: varchar(3) NOT NULL
DESCRIPTION: first 3 characters of postal code that identifies post's address


*/

CREATE TABLE POSTS (
    POST_ID INTEGER NOT NULL AUTO_INCREMENT,
    LINK TEXT NOT NULL,
    EMBEDDED_LINK TEXT NOT NULL,
    DATE DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, 
    PRIMARY KEY (POST_ID)
);

CREATE TABLE POSTINFO (
    ID INTEGER NOT NULL,
    PROVINCE varchar(255),
    AGE INT,
    CITY varchar(255),
    POSTALCODE varchar(3),
    FOREIGN KEY (ID) REFERENCES POSTS(POST_ID)
);