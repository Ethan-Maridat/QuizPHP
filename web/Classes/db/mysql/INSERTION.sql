-- INSERTIONS TABLE QUESTION AVEC ANSWER

-- TYPE QUESTION => RADIO

-- Question 1
INSERT INTO QUESTION (question_id, question_text, type, score)
VALUES (1, 'Quel âge a Minami ?', 'radio', 1);

INSERT INTO ANSWER (answer_id, answer_text, question_id, est_valide)
VALUES  (1, '16 ans', 1, TRUE),
        (2, '19 ans', 1, FALSE),
        (3, '14 ans', 1, FALSE),
        (4, '20 ans', 1, FALSE);

-- TYPE QUESTION => CHECKBOX

-- Question 2
INSERT INTO QUESTION (question_id, question_text, type, score)
VALUES (2, 'Qui sont les proches de Minami ?', 'checkbox', 1);

INSERT INTO ANSWER (answer_id, answer_text, question_id, est_valide)
VALUES  (5, 'Azumi', 2, TRUE),
        (6, 'Ayemi', 2, FALSE),
        (7, 'Narumi', 2, TRUE),
        (8, 'Shinsuke', 2, TRUE);

-- TYPE QUESTION => TEXT

-- Question 3
INSERT INTO QUESTION (question_id, question_text, type, score)
VALUES (3, 'La couleur préférée de Minami ?', 'text', 1);

INSERT INTO ANSWER (answer_id, answer_text, question_id, est_valide)
VALUES (9, 'violet', 3, TRUE);


-- INSERTIONS TABLE QUIZZ AVEC QUESTION_QUIZZ

-- Quizz 1

INSERT INTO QUIZZ (quizz_id, quizz_name, quizz_description, quizz_difficulte)
VALUES  (1, "Entraînement!", "Ceci est un quizz d'introduction", 1);

INSERT INTO QUESTION_QUIZZ (quizz_id, question_id)
VALUES  (1, 1),
        (1, 2),
        (1, 3);
