USE blog;

CREATE TABLE contact (
    id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    author varchar(255) NOT NULL,
    message varchar(255) NOT NULL,
    screenshot varchar(255) NULL,
    contact_date DATETIME NOT NULL 
);  