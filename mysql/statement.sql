-- Using MySQL

CREATE DATABASE yap;
USE yap;

CREATE TABLE accounts
(
    userid SMALLINT NOT NULL,
    username varchar(24),
    userpassword varchar(50),
    profilepicture varchar(50),
    welcomemessage varchar(50), -- messages displayed in the banner of user yap page
    about varchar(500), -- 500 word aboutme text
    subscriptions varchar(2000), -- other people that users subscribe to
    subscribers varchar(2000), -- people who subscribe to user

    PRIMARY KEY(userid)
);

CREATE TABLE posts
(
    postid SMALLINT AUTO_INCREMENT NOT NULL,
    userid SMALLINT NOT NULL,
    content varchar(2000),
    images varchar(260),
    likecount SMALLINT,
    timecreated DATETIME,
    
    PRIMARY KEY(postid),
    FOREIGN KEY(userid) REFERENCES accounts(userid)
);

CREATE TABLE comments
(
    commentid SMALLINT AUTO_INCREMENT NOT NULL,
    postid SMALLINT NOT NULL,
    userid SMALLINT NOT NULL,
    content varchar(2000),
    likecount SMALLINT,
    timecreated DATETIME,
    
    PRIMARY KEY(commentid),
    FOREIGN KEY(postid) REFERENCES posts(postid),
    FOREIGN KEY(userid) REFERENCES accounts(userid)
);

CREATE TABLE replies
(
    replyid SMALLINT AUTO_INCREMENT NOT NULL,
    commentid SMALLINT NOT NULL,
    userid SMALLINT NOT NULL,
    content varchar(2000),
    likecount SMALLINT,
    timecreated DATETIME,
    
    PRIMARY KEY(replyid),
    FOREIGN KEY(commentid) REFERENCES comments(commentid),
    FOREIGN KEY(userid) REFERENCES accounts(userid)
);