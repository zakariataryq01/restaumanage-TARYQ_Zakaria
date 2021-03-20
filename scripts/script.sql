INSERT INTO taryq_restau_db.city (id, name, zipcode) VALUES (6, 'marrakech', 'code 1242');
INSERT INTO taryq_restau_db.city (id, name, zipcode) VALUES (15, 'Casablanca', 'code 716');
INSERT INTO taryq_restau_db.city (id, name, zipcode) VALUES (16, 'tanger', '7162');
INSERT INTO taryq_restau_db.city (id, name, zipcode) VALUES (17, 'rabat', '999');

INSERT INTO taryq_restau_db.user (id, usrname, password, city_id_id) VALUES (1, 'taryq', '1234', 6);
INSERT INTO taryq_restau_db.user (id, usrname, password, city_id_id) VALUES (2, 'hassan', '656', 6);
INSERT INTO taryq_restau_db.user (id, usrname, password, city_id_id) VALUES (3, 'fff', '8989', 6);

INSERT INTO taryq_restau_db.restaurant (id, name, description, create_at, city_id_id) VALUES (7, 'restaurant al saada', 'restaurant confortable', '2021-03-19 22:58:37', 6);
INSERT INTO taryq_restau_db.restaurant (id, name, description, create_at, city_id_id) VALUES (8, 'restaurant el bahja', 'description restaurant elbahja', '2021-03-19 23:40:21', 15);
INSERT INTO taryq_restau_db.restaurant (id, name, description, create_at, city_id_id) VALUES (9, 'restaurant taryq', 'description restaurant taryq', '2021-03-20 01:29:19', 6);
INSERT INTO taryq_restau_db.restaurant (id, name, description, create_at, city_id_id) VALUES (10, 'restaurant el alawi', 'description restaurant elaalawi', '2021-03-20 01:29:25', 17);
INSERT INTO taryq_restau_db.restaurant (id, name, description, create_at, city_id_id) VALUES (11, 'restaurant el amal', 'description restaurant elamal', '2021-03-20 01:29:32', 6);
INSERT INTO taryq_restau_db.restaurant (id, name, description, create_at, city_id_id) VALUES (12, 'restaurant ali', 'description restaurant ali', '2021-03-20 01:29:43', 16);
INSERT INTO taryq_restau_db.restaurant (id, name, description, create_at, city_id_id) VALUES (14, 'restaurant alborj', 'description restaurant elborj', '2021-03-20 14:32:57', 6);

INSERT INTO taryq_restau_db.review (id, message, rating, user_id_id, restaurant_id_id, create_at) VALUES (1, 'bon', 7, 1, 7, '2021-03-20 09:36:54');
INSERT INTO taryq_restau_db.review (id, message, rating, user_id_id, restaurant_id_id, create_at) VALUES (2, 'tres bien', 9, 2, 7, '2021-03-20 09:37:58');
INSERT INTO taryq_restau_db.review (id, message, rating, user_id_id, restaurant_id_id, create_at) VALUES (4, 'mauvais', 2, 3, 7, '2021-03-20 09:39:48');
INSERT INTO taryq_restau_db.review (id, message, rating, user_id_id, restaurant_id_id, create_at) VALUES (5, 'bien', 7, 1, 8, '2021-03-20 16:23:35');
INSERT INTO taryq_restau_db.review (id, message, rating, user_id_id, restaurant_id_id, create_at) VALUES (6, 'pas mal', 5, 2, 9, '2021-03-20 16:24:12');