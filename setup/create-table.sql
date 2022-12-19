CREATE TABLE products(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    description TEXT(150) NOT NULL,
    price INT NOT NULL
);


CREATE TABLE reviews(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_product INT NOT NULL,
    id_user VARCHAR(50) NOT NULL,
    comment TEXT(300),
    rating SMALLINT NOT NULL,
    hidden BOOLEAN NOT NULL,

    CONSTRAINT fkey_product FOREIGN KEY (id_product) REFERENCES product (id),
    CONSTRAINT fkey_user FOREIGN KEY (id_user) REFERENCES user (username)
    
);

CREATE TABLE users(
    username VARCHAR(50) NOT NULL PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    password VARCHAR(100) NOT NULL,
    access_level SMALLINT NOT NULL
);



INSERT INTO products VALUES
(1, "Boloňské Špagety", "Tradiční špagety po italsku sypané kvalitním parmezánem", 100),
(2, "Svíčková na smetaně", "Tradiční český pokrm podávaný s houskovými knedlíky a brusinkami", 130),
(3, "Indická placka", "Velmi pikantní indická placka s omáčkou", 90),
(4, "Pizza quadro formagi", "Originální italská pizza se čtyřmi druhy sýra", 110),
(5, "Hrníček od medu", 'Jednoduchá odpověď na otázku: "Co bude k obědu?" ', 55),
(6, "Smažený řízek s brambory", "Zaručená jistota. Nejste si jistý jestli vám ostatní pokrmy budou chutnat? Pak je toto jasná volba", 90),
(7, "Smažený hermelín", "Pro spěchající strávníky", 45);


INSERT INTO users VALUES
("karel", "Karel Růžička", "$2y$10$XRPCzreEwRjQET4JIOfvluwdO2WsP5y7AJhz0AwF6GOj9yBtRDvce", 3), /* heslo: karel*/
("jirih", "Jiří Holub", "$2y$10$sQpYcl/VAwXrGPZZAnefM.fjLT6Nw.F1matDJy6rEGExCp1Zq2p1O)", 2), /* heslo: jirka*/
("stanek", "Stanislav Brada", "$2y$10$FHZ6lTMnnl5D173c4etLEOhUkwSjyDkEvHRt4hbdIfaxJaMcofOiK", 1), /*heslo standa*/
("irgor", "Igor Mladý", "$2y$10$KNlhBE9A6gzkRl8qy.kimOobDmpGrZ4UVfqrPsD9W.66shVcoJxQa", 1); /*heslo igo*/

INSERT INTO reviews VALUES
(NULL, 1, "stanek", "Nejlepší jídlo co jsem kdy jedl. Dám si ho znovu.", 10, 0),
(NULL, 1, "jirih", "Lehce přesolené", 7, 0),
(NULL, 1, "irgor", "V pohodě. Už jsem jedl lepší", 6, 0),
(NULL, 1, "karel", "Naprostá delikatesa", 8, 0),
(NULL, 2, "irgor", "Klasická česká svíčková. Na té se nedá nic zkazit", 8, 0),
(NULL, 2, "stanek", "Moc dobré", 7, 0),
(NULL, 3, "irgor", "Velmi velmi pálivé", 3, 0),
(NULL, 2, "stanek", "V indii mají placky daleko lepší", 4, 0);

