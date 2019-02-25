/* creation de la table utilisateurs */

CREATE TABLE `users` (
 username VARCHAR(128) NOT NULL PRIMARY KEY,
 email VARCHAR(128) NOT NULL,
 password VARCHAR(128) NOT NULL, /* mot de passe en clair */
 role INTEGER NOT NULL, /* 0: utilisateur normal, 1: administrateur */
 first_name VARCHAR(128),
 last_name VARCHAR(128)
);
/* création de la table messages */
CREATE TABLE `posts` (
 post_id INTEGER NOT NULL PRIMARY KEY,
 author_id VARCHAR(128) NOT NULL
 CONSTRAINT fk_author REFERENCES users(username),
 create_time INTEGER NOT NULL, /* UNIX timestamp */
 title VARCHAR(256) NOT NULL, /* titre du message */
 content TEXT, /* corps du message */
 status INTEGER NOT NULL /* 0: publié; 1: brouillon; 2: en attente; 2: accès interdit */
);
/* insertion de quelques données initiales */
INSERT INTO `users` VALUES ('admin', 'admin@example.com', 'demo', 1, 'Qiang', 'Xue');
INSERT INTO `users` VALUES ('demo', 'demo@example.com', 'demo', 0, 'Wei', 'Zhuo');
INSERT INTO `posts` VALUES (NULL, 'admin', 1175708482, 'first post', 'this is my first post', 0);