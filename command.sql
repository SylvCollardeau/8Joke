USE 8joke;
Insert into user (username, password) values('admin', '$2y$10$RIoaBuACqBmKYtDQ4SuJVeIKcR6LXrTbv3iyA0lrz5qgocGJvfPXG');
Insert into post (auteur, titre, img, nb_like, id_user) values('test', 'Un chat qui secoue la tete', 'img/chat-shake.gif', 0, 1);
Insert into post (auteur, titre, img, nb_like, id_user) values('test', 'Un chat surpris', 'img/chat-surpris.jpg', 0, 1);

Select * from user;
Select * from post;
