DROP TABLE bibliotheque;
CREATE TABLE bibliotheque (id INTEGER PRIMARY KEY AUTOINCREMENT, titre varchar(100) NOT NULL, annee varchar(100) NOT NULL, auteur varchar(10) NOT NULL, resume varchar(200) NOT NULL);
INSERT INTO bibliotheque (titre, annee, auteur, resume) VALUES ('Bouts de bois de dieu', '02-02-1994', 'Ousmane SEMBENE', 'Traite injustice');
INSERT INTO bibliotheque (titre, annee, auteur, resume) VALUES ('Soleil des independance', '22-07-168', 'Amadou KOUROUMA', 'independance des pays africains');
INSERT INTO bibliotheque (titre, annee, auteur, resume) VALUES ('Une vie de boy', '02-02-1978', 'Ferdinand OYONO', 'Egalite');
INSERT INTO bibliotheque (titre, annee, auteur, resume) VALUES ('Ville cruelle', '31-11-4004', 'Eza BOTO', 'Emancipation des jeunes');
