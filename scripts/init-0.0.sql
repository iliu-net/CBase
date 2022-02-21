DROP TABLE IF EXISTS cbArtifact;
CREATE TABLE IF NOT EXISTS cbArtifact (
  id INT NOT NULL AUTO_INCREMENT,
  docName VARCHAR (64) NOT NULL DEFAULT "",
  notes TEXT NOT NULL DEFAULT "",
  fileExtension CHAR (16) NOT NULL DEFAULT "",
  category INT NOT NULL DEFAULT -1,
  PRIMARY KEY (id)
) DEFAULT CHARSET='utf8' COLLATE='utf8_general_ci' AUTO_INCREMENT=1;

DROP TABLE IF EXISTS cbCategory;
CREATE TABLE IF NOT EXISTS cbCategory (
  id INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(64) NOT NULL DEFAULT "",
  PRIMARY KEY (id)
) DEFAULT CHARSET='utf8' COLLATE='utf8_general_ci' AUTO_INCREMENT=1;

INSERT INTO cbCategory (id,name) VALUES (1,"identification");
INSERT INTO cbCategory (id,name) VALUES (2,"warranty");
INSERT INTO cbCategory (id,name) VALUES (3,"receipt");
