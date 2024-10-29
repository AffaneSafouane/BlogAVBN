USE blog;

CREATE TABLE IF NOT EXISTS users (
    user_id int (11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    email varchar (255) NOT NULL UNIQUE,
    password varchar (255) NOT NULL,
    pseudo varchar (255) NOT NULL UNIQUE,
    age int (11) NOT NULL,
    sexe char(1) NOT NULL, 
    last_name varchar (255) NULL,
    first_name varchar (255) NULL,
    creation_date datetime NOT NULL
) 

-- john.doe@exemple.com / Azerty
-- jane.doe@exemple.com / Qwerty