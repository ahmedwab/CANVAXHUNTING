
/*
Table to store email accounts for administrators


column EMAIL
DATATYPE: varchar(255) NOT NULL
DESCRIPTION: Administrator Email

column PASWWORD
DATATYPE: VARBINARY NOT NULL
DESCRIPTION: Administrator's password

column DATE

DATATYPE: TIMESTAMP NOT NULL
DESCRIPTION: Date account was created



*/

CREATE TABLE POSTS (
    EMAIL varchar(255) NOT NULL,
    PASSWORD VARBINARY NOT NULL,
    DATE DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, 
    PRIMARY KEY (EMAIL)
);