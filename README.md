# CANVAXHUNTING
Notification System for Canadian vaccines using postal code as input. Moreover, allowing users to find relevant vaccine posts that pertain to their own postal code.

##Website

Website can be found here:
http://canvaxsearch.dreamhosters.com
## Front End

No front end design was developed.
## Database (SQL)

These are the two required database tables for the notification system.

```
CREATE TABLE EMAILS (
    EMAIL varchar(255) NOT NULL,
    POSTALCODE varchar(3) NOT NULL,
    PRIMARY KEY (EMAIL)
);
```
```
CREATE TABLE POSTS (
    ID INTEGER NOT NULL AUTO_INCREMENT,
    LINK TEXT NOT NULL,
    PROVINCE varchar(255) NOT NULL,
    POSTALCODE varchar(3) NOT NULL,
    PRIMARY KEY (ID)
);
```


## Usage

From a Developer perspective, they can upload a post to the posts table while notifying people with the same address about that post:


First, lets allow for a user to input their postal code and email:

<img src="images/find-info.png"  title="Subscribe">

Thus, an email will be added to the emails table
<img src="images/email-database.png"  title="EMAILS">

From a developer's perspective, we'll take this post as an example:

<img src="images/tweet.png"  title="Tweet">

The developer could then upload the post with an embedded link and info through the following:

<img src="images/add-email.png"  title="Tweet">

Once completed, the following will happen:

The posts table will add the given information
<img src="images/posts-database.png"  title="POSTS">

An email will be sent to the user:
<img src="images/email.png"  title="email">


Another functionality that could happen is the user searching for relevant posts using the following:

<img src="images/get-post1.png"  title="ALLPOSTS">

<img src="images/get-post2.png"  title="ALLPOSTS">








## Contributing
Any contribution is welcome

