-- Suppression des tables si elles existent déjà
DROP TABLE IF EXISTS reponses_utilisateurs;
DROP TABLE IF EXISTS choix_reponse;
DROP TABLE IF EXISTS questions;
DROP TABLE IF EXISTS quizz;
DROP TABLE IF EXISTS utilisateurs;

-- Création de la table des utilisateurs
CREATE TABLE utilisateurs (
   utilisateur_id INTEGER PRIMARY KEY,
   pseudo TEXT NOT NULL,
   email TEXT NOT NULL UNIQUE,
   mot_de_passe TEXT NOT NULL
);

-- Création de la table des quizz
CREATE TABLE quizz (
   quizz_id INTEGER PRIMARY KEY,
   nom TEXT NOT NULL
);

-- Création de la table des questions
CREATE TABLE questions (
   question_id INTEGER PRIMARY KEY,
   quizz_id INTEGER,
   enonce TEXT NOT NULL,
   typeQuest TEXT NOT NULL,
   est_correct TEXT DEFAULT '',  -- Correction: spécifier une valeur par défaut valide
   FOREIGN KEY (quizz_id) REFERENCES quizz(quizz_id)
);

-- Création de la table des choix de réponse
CREATE TABLE choix_reponse (
   choix_id INTEGER PRIMARY KEY,
   question_id INTEGER,
   libelle TEXT NOT NULL,
   FOREIGN KEY (question_id) REFERENCES questions(question_id)
);

-- Création de la table des réponses des utilisateurs
CREATE TABLE reponses_utilisateurs (
   reponse_id INTEGER PRIMARY KEY,
   quizz_id INTEGER,
   utilisateur_id INTEGER,
   question_id INTEGER,
   choix_id INTEGER,
   FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs(utilisateur_id),
   FOREIGN KEY (question_id) REFERENCES questions(question_id),
   FOREIGN KEY (choix_id) REFERENCES choix_reponse(choix_id),
   FOREIGN KEY (quizz_id) REFERENCES quizz(quizz_id)
);


-- Jeu de données

-- Utilisateurs
INSERT INTO utilisateurs (utilisateur_id,pseudo, email, mot_de_passe) VALUES
(1,'test', 'alice@example.com', 'test'),
(2,'Bob', 'bob@example.com', 'bob');

-- Quizz
INSERT INTO quizz (quizz_id, nom) VALUES
(1, 'Quizz Mathématiques'),
(2, 'Quizz Histoire, Géographie');

-- Questions
INSERT INTO questions (question_id,quizz_id, enonce, typeQuest,est_correct) VALUES
(1,1, 'Combien font 2 + 2 ?', 'radio','4'),
(2,1, 'racine carré de 49', 'TextField','7'),
(3,2, 'En quelle année a eu lieu la Révolution française ?', 'radio','1789'),
(4,2, 'Quelle est la capitale de la France ?', 'radio','Paris'),
(5,2, 'Quelle est la capitale de l Allemagne ?', 'radio','Berlin'),  
(6,2, 'Quelle est la capitale de l Angleterre ?', 'TextField','Londres');

-- Choix de Réponses
INSERT INTO choix_reponse (choix_id,question_id, libelle) VALUES
(1,1, '20'),
(2,1, '3'),
(3,1, '4'),
(4,1, '10'),

(5,3, '1789'),
(6,3, '1788'),
(7,3, '1800'),
(8,3, '1786'),

(9,4, 'Paris'),
(10,4, 'Lyon'),
(11,4, 'Marseille'),
(12,4, 'Toulouse'),

(13,5, 'Berlin'),
(14,5, 'Munich'),
(15,5, 'Hambourg'),
(16,5, 'Francfort');
