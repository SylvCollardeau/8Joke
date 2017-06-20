USE 8joke;
Insert into user (username, password) values('test', '$2y$10$RIoaBuACqBmKYtDQ4SuJVeIKcR6LXrTbv3iyA0lrz5qgocGJvfPXG');
Insert into post (auteur, titre, img_path, nb_like) values('test', 'Un chat rayé', 'img/chat-raye.jpg', 0);
Insert into post (auteur, titre, img_path, nb_like) values('test', 'Un chat surpris', 'img/chat-surpris.jpg', 0);

Select * from user;
Select * from post;
