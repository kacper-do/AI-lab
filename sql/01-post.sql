create table post
(
    id      integer not null
        constraint post_pk
            primary key autoincrement,
    subject text not null,
    content text not null
);

CREATE TABLE if not exists vehicles (
                          id INT AUTO_INCREMENT PRIMARY KEY,
                          make VARCHAR(255) NOT NULL,
                          type VARCHAR(255) NOT NULL
);