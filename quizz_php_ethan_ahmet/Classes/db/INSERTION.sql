-- INSERTIONS TABLE QUESTION AVEC ANSWER

-- TYPE QUESTION => RADIO

-- Question 1
INSERT INTO QUESTION (question_id, question_text, type, score)
VALUES (1,'année de début de la premiere guerre mondiale ?', 'radio', 1),
        (3,'année de fin de la premiere guerre mondiale ?', 'radio', 1);
        

INSERT INTO ANSWER (answer_id, answer_text, question_id, est_valide)
VALUES  (1, '1914', 1, TRUE),
        (2, '1918', 1, FALSE),
        (3, '1916', 1, FALSE),
        (4, '1913', 1, FALSE),

        (10, '1918', 3, TRUE),
        (11, '1914', 3, FALSE),
        (12, '1916', 3, FALSE),
        (13, '1913', 3, FALSE);


-- TYPE QUESTION => CHECKBOX

-- Question 2
INSERT INTO QUESTION (question_id, question_text, type, score)
VALUES (2, 'les matieres enseigner au but', 'checkbox', 1);

INSERT INTO ANSWER (answer_id, answer_text, question_id, est_valide)
VALUES  (5, 'Francais', 2, FALSE),
        (6, 'Maths', 2, TRUE),
        (7, 'Web', 2, TRUE),
        (8, 'Sport', 2, FALSE);


-- INSERTIONS TABLE QUIZZ AVEC QUESTION_QUIZZ

-- Quizz 1

INSERT INTO QUIZZ (quizz_id, quizz_name, quizz_description, quizz_difficulte)
VALUES  (1,'Histoire Géo', 'Quizz sur l''histoire et la géographie', 1),
        (2,'IUT', 'Quizz sur le but', 1);

INSERT INTO QUESTION_QUIZZ (quizz_id, question_id)
VALUES  (1, 1),
        (1, 3),
        (2, 2);

insert into USER(pseudo, mdp) values ('Testeur', 'Testeur');        