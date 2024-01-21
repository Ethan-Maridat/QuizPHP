CREATE DATABASE IF NOT EXISTS QuizzPHP;
use QuizzPHP;

DROP TABLE IF EXISTS QUIZZ_TERMINE;
DROP TABLE IF EXISTS SCORE;
DROP TABLE IF EXISTS ANSWER;
DROP TABLE IF EXISTS QUESTION_QUIZZ;
DROP TABLE IF EXISTS QUESTION;
DROP TABLE IF EXISTS QUIZZ;
DROP TABLE IF EXISTS USER;

CREATE TABLE QUIZZ (
    quizz_id INT PRIMARY KEY,
    quizz_name VARCHAR(50),
    quizz_description TEXT,
    quizz_difficulte INT
);

CREATE TABLE QUESTION (
    question_id INT PRIMARY KEY,
    question_text TEXT,
    type VARCHAR(50),
    score INT
);

CREATE TABLE QUESTION_QUIZZ (
    quizz_id INT,
    question_id INT,
    PRIMARY KEY (quizz_id, question_id),
    FOREIGN KEY (quizz_id) REFERENCES QUIZZ(quizz_id),
    FOREIGN KEY (question_id) REFERENCES QUESTION(question_id)
);

CREATE TABLE ANSWER (
    answer_id INT PRIMARY KEY,
    answer_text TEXT,
    question_id INT,
    est_valide BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (question_id) REFERENCES QUESTION(question_id)
);

CREATE TABLE USER (
    pseudo VARCHAR(22) PRIMARY KEY,
    mdp VARCHAR(255)
);

CREATE TABLE QUIZZ_TERMINE (
    pseudo VARCHAR(22),
    quizz_id INT,
    score INT,
    PRIMARY KEY (pseudo, quizz_id),
    FOREIGN KEY (pseudo) REFERENCES USER(pseudo),
    FOREIGN KEY (quizz_id) REFERENCES QUIZZ(quizz_id)
);
