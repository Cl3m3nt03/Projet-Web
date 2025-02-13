/* US 3 : créer un utilisateur lors de la première inscription */

INSERT INTO utilisateur ( email,mdp,pseudo,date_heure_inscription,)
VALUES("clement@gmail.com" ,  SHA2('mdpDeClement', 256),'Math',2023-10-20);

ALTER TABLE `utilisateur` ADD UNIQUE(`pseudo`);
ALTER TABLE `utilisateur` ADD UNIQUE(`email`);


/* US 4 :  modifier le mot de passe de l’utilisateur */

Update utilisateur
SET mdp= SHA2('Clement', 256)
WHERE id = 1;

--modifier le mot de passe de l’utilisateur


Update utilisateur
SET email='Clement'
WHERE id = 1;   

--US 5

SELECT 
    CASE 
        WHEN email = 'siwar@gmail.com' 
             AND mot_de_passe = SHA2('swiar', 256) 
             THEN 'Connexion réussie'
        ELSE 'Connexion échouée'
    END AS  statut_connexion,email,mot_de_passe
FROM utilisateur;

--REQUETE STORY 6

INSERT INTO jeu (id,nom) 
VALUES (1,'The Power Of Memory')


--US 7 


SELECT jeu.nom_jeu, utilisateur.pseudo, score.difficulte_partie, score.score_partie
FROM jeu
    , utilisateur 
    LEFT JOIN score ON score.id_joueur = utilisateur.id
WHERE jeu.nom_jeu
ORDER BY nom_jeu ASC, difficulte_partie, score.score_partie;

--US 8 


SELECT jeu.nom_jeu, utilisateur.pseudo, score.score_partie, score.difficulte_partie
FROM jeu
    , utilisateur 
    LEFT JOIN score ON score.id_joueur = utilisateur.id
    WHERE jeu.id = 1 AND utilisateur.id = 1 AND score.difficulte_partie = 1 
    ORDER BY nom_jeu, difficulte_partie, score_partie ;


--US 9

INSERT INTO score (id, id_joueur, id_jeu, score_partie, date_heure_partie, difficulte_partie) 
VALUES (1, 2,1, 1500, '2003-10-10', 2) 
ON DUPLICATE KEY UPDATE
     score_partie = VALUES(score_partie);

--US 10


INSERT INTO message (id_jeu,id_expediteur,message,date_heure_message)
VALUES (1,2, 'message ajouté avec succes!','2023-10-10'); 

--11

SELECT id_expediteur, utilisateur.pseudo, message, date_heure_message ,utilisateur.id,
CASE  
	WHEN utilisateur.id = message.id_expediteur THEN 'true'
	ELSE 'false'
END AS isSender
FROM message JOIN utilisateur ON message.id_expediteur = utilisateur.id
WHERE date_heure_message > NOW() - INTERVAL 1 DAY;



--12

SELECT `utilisateur`.`pseudo`, `score`.`score_partie`
FROM `utilisateur` 
    LEFT JOIN `score` ON `score`.`id_joueur` = `utilisateur`.`id`
WHERE pseudo LIKE '%n';

--16




--16

SELECT 
    u1.pseudo AS expediteur,
    u2.pseudo AS destinataire,
    messages_prives.id_utilisateur_1,
    messages_prives.id_utilisateur_2,
    messages_prives.date_heure_envoi,
    messages_prives.date_heure_lecture,
    messages_prives.est_lu,
    messages_prives.contenu,

    (SELECT COUNT() FROM score s1 WHERE s1.id_joueur = u1.id) AS nombre_partie_expediteur,

    (SELECT COUNT() FROM score s2 WHERE s2.id_joueur = u2.id) AS nombre_partie_destinataire,
 
    (SELECT jeu.nom_jeu 
     FROM score s1 
     JOIN jeu ON jeu.id = s1.id_jeu 
     WHERE s1.id_joueur = u1.id 
     GROUP BY s1.id_jeu 
     ORDER BY COUNT() DESC 
     LIMIT 1) AS jeu_plus_joue_expediteur,

    (SELECT jeu.nom_jeu 
     FROM score s2 
     JOIN jeu ON jeu.id = s2.id_jeu 
     WHERE s2.id_joueur = u2.id 
     GROUP BY s2.id_jeu 
     ORDER BY COUNT() DESC 
     LIMIT 1) AS jeu_plus_joue_destinataire

FROM 
    messages_prives
JOIN 
    utilisateur u1 ON messages_prives.id_utilisateur_1 = u1.id
JOIN 
    utilisateur u2 ON messages_prives.id_utilisateur_2 = u2.id
WHERE 
    (messages_prives.id_utilisateur_1, messages_prives.id_utilisateur_2) IN ((4, 5), (5, 4))
ORDER BY 
    messages_prives.date_heure_envoi ASC;



--US 17


SELECT 
    YEAR(score.date_heure_partie) AS annee,
    MONTH(score.date_heure_partie) AS mois,
    
    
    (SELECT utilisateur.pseudo 
     FROM score 
     JOIN utilisateur ON score.id_joueur = utilisateur.id
     WHERE YEAR(score.date_heure_partie) = 2024 
       AND MONTH(score.date_heure_partie) = mois
     ORDER BY score.score_partie DESC 
     LIMIT 1 OFFSET 0) AS top1,

    
    (SELECT utilisateur.pseudo 
     FROM score 
     JOIN utilisateur ON score.id_joueur = utilisateur.id
     WHERE YEAR(score.date_heure_partie) = 2024
       AND MONTH(score.date_heure_partie) = mois
     ORDER BY score.score_partie DESC 
     LIMIT 1 OFFSET 1) AS top2,

    
    (SELECT utilisateur.pseudo 
     FROM score 
     JOIN utilisateur ON score.id_joueur = utilisateur.id
     WHERE YEAR(score.date_heure_partie) = 2024 
       AND MONTH(score.date_heure_partie) = mois
     ORDER BY score.score_partie DESC 
     LIMIT 1 OFFSET 2) AS top3,

    
    COUNT(score.id) AS total_parties,
    
    jeu.nom_jeu AS jeu_le_plus_joue

FROM 
    score
JOIN 
    utilisateur ON score.id_joueur = utilisateur.id
JOIN 
    jeu ON score.id_jeu = jeu.id
WHERE 
    YEAR(score.date_heure_partie) = 2024
GROUP BY 
    annee, mois, jeu.nom_jeu
ORDER BY 
    annee, mois;
 

 -- US 18 
 
SELECT 
    YEAR(score.date_heure_partie) AS annee,
    MONTH(score.date_heure_partie) AS mois,
    
    
    COUNT(score.id) AS total_parties,
    
    jeu.nom_jeu AS jeu_le_plus_joue,
    
    AVG(score.score_partie)

FROM 
    score
JOIN 
    utilisateur ON score.id_joueur = utilisateur.id
JOIN 
    jeu ON score.id_jeu = jeu.id
WHERE 
    YEAR(score.date_heure_partie) = 2024
GROUP BY 
    annee, mois, jeu.nom_jeu
ORDER BY 
    annee, mois;
 


/*-----------------------------------------------------------------services------------------------------------------------------------*/ 




--Story 3:

INSERT INTO Utilisateur (id, email, mot_de_passe, pseudo, adresse_postale, code_postal, ville, pays, telephone_portable, telephone_fixe, date_inscription) VALUES
(1,'siwar@gmail.com', 'mdpDeSiwar', 'Xx_Siwar_du_95_xX', '10 rue de la Paix', '75000', 'Paris', 'France', '0612345678', '0145678901', NOW()),


--Story 5:

UPDATE Utilisateur
SET 
    email = 'siwar_new@gmail.com',           
    mot_de_passe = 'mdpDeSiwarNouveau',         
    pseudo = 'Xx_Siwar_du_95_xX_Nouveau',            
    adresse_postale = '15 rue des Fleurs',           
    code_postal = '75001',                          
    ville = 'Paris',                                
    pays = 'France',                                  
    telephone_portable = '0612345678',              
    telephone_fixe = '0145678901',                  
    date_inscription = NOW()                          
WHERE id = 1;    

INSERT INTO Service (id, id_utilisateur, nom_service, description_service, adresse_service, code_postal_service, ville_service, pays_service, date_heure_service, informations_complementaires, contenu_message, date_heure_envoi) VALUES
(1, 1, 'Service de nettoyage', 'Service de nettoyage résidentiel et commercial.', '123 rue de la Propreté', '75001', 'Paris', 'France', NOW(), 'Disponible 7j/7', 'Demande de renseignement sur le service', NOW());

--Story 6

INSERT INTO Service_Utilisateur (id, id_service, id_utilisateur, date_heure_inscription) VALUES
(1, 1, NOW()); 


--Story 7:

INSERT INTO message (id, id_expediteur, id_recepteur, contenu, date_heure_envoi) VALUES
(1, 1, 2, 'Salut ! Comment ça va ?', '2024-10-30 08:00:00');

--Story 8:

SELECT 
    message.id,
    message.id_expediteur,
    message.id_recepteur,
    message.contenu,
    message.date_heure_envoi
FROM 
    message
WHERE 
    1 IN (message.id_expediteur, message.id_recepteur)
ORDER BY 
    message.date_heure_envoi DESC;

--Story 9:

SELECT 
    message.id,
    message.id_expediteur,
    message.id_recepteur,
    message.contenu,
    message.date_heure_envoi
FROM 
    message
WHERE 
    (message.id_expediteur = 1 AND message.id_recepteur = 2)
    OR (message.id_expediteur = 2 AND message.id_recepteur = 1)
ORDER BY 
    message.date_heure_envoi DESC;


---Story 10


SELECT service.id, service.nom_service, service.description_service, service.adresse_service, 
       service.code_postal_service, service.ville_service, service.pays_service, service.date_heure_service
FROM service
LEFT JOIN service_utilisateur ON service.id = service_utilisateur.id_service 
    AND service_utilisateur.id_utilisateur = 1
WHERE service_utilisateur.id_utilisateur IS  NOT NULL 
  AND service.date_heure_service < NOW() 
  AND service.nom_service LIKE 'Service de nettoyage' 
  AND service.code_postal_service LIKE '75001'
  AND service.ville_service LIKE 'Paris' 
  AND service.pays_service LIKE 'France'
ORDER BY service.date_heure_service DESC, service.ville_service ASC;




---Story 11 






---Story 12

DELETE FROM service_utilisateur
WHERE id_service = 1;  

DELETE FROM service
WHERE id = 1;



----story 13

DELETE FROM service_utilisateur
WHERE id_service = 1  AND id_utilisateur = 2;


---story 14 on suprrime les message et l inscription et service et puis l utilisateur 

DELETE FROM messages
WHERE id_utilisateur = 1; 


DELETE FROM service_utilisateur
WHERE id_utilisateur = 1;


DELETE FROM services
WHERE id_createur = 1;  


DELETE FROM utilisateurs
WHERE id_utilisateur = 1;


--- story 15 

DELETE FROM messages
WHERE id_message = 12; 


--story 16 

SELECT 
    service.id AS id_service,
    service.nom_service,
    service.description_service,
    service.adresse_service,
    service.code_postal_service,
    service.ville_service,
    service.pays_service,
    service.date_heure_service,
    service.informations_complementaires,
    service.contenu_message,
    service.date_heure_envoi,
    utilisateur_propose.pseudo AS pseudo_propose,
    utilisateur_inscrit.email AS email_inscrit,
    utilisateur_inscrit.pseudo AS pseudo_inscrit,
    utilisateur_inscrit.adresse_postale,
    utilisateur_inscrit.code_postal,
    utilisateur_inscrit.ville,
    utilisateur_inscrit.pays,
    utilisateur_inscrit.telephone_portable,
    utilisateur_inscrit.telephone_fixe,
    COUNT(service_utilisateur.id) AS total_services_participes
FROM 
    service_utilisateur
JOIN 
    service ON service_utilisateur.id_service = service.id
JOIN 
    utilisateur AS utilisateur_propose ON service.id_utilisateur = utilisateur_propose.id
JOIN 
    utilisateur AS utilisateur_inscrit ON service_utilisateur.id_utilisateur = utilisateur_inscrit.id
WHERE 
    utilisateur_inscrit.id = 1
GROUP BY 
    service.id, service.nom_service, service.description_service, service.adresse_service, 
    service.code_postal_service, service.ville_service, service.pays_service, service.date_heure_service, 
    service.informations_complementaires, service.contenu_message, service.date_heure_envoi, 
    utilisateur_propose.pseudo, utilisateur_inscrit.email, utilisateur_inscrit.pseudo, utilisateur_inscrit.adresse_postale, 
    utilisateur_inscrit.code_postal, utilisateur_inscrit.ville, utilisateur_inscrit.pays, 
    utilisateur_inscrit.telephone_portable, utilisateur_inscrit.telephone_fixe
ORDER BY 
    service.date_heure_service DESC, 
    service.ville_service ASC;




----story 17


SELECT 
    service.*,
    utilisateur_propose.pseudo AS pseudo_utilisateur_propose,
    utilisateur_inscrit.id AS id_utilisateur_inscrit,
    utilisateur_inscrit.pseudo AS pseudo_utilisateur_inscrit,
    utilisateur_inscrit.email AS email_utilisateur_inscrit
FROM 
    service_utilisateur
JOIN 
    service ON service_utilisateur.id_service = service.id
JOIN 
    utilisateur AS utilisateur_propose ON service.id_utilisateur = utilisateur_propose.id
JOIN 
    utilisateur AS utilisateur_inscrit ON service_utilisateur.id = utilisateur_inscrit.id
WHERE 
    utilisateur_inscrit.id = 1
ORDER BY 
    service_utilisateur.date_heure_inscription ASC
LIMIT 1;




---STORY 18 