




ALTER TABLE bibliotheque CHANGE responsable_id responsable_id CHAR(36) NOT NULL
COMMENT '(DC2Type:guid)';
ALTER TABLE social_media ADD lien VARCHAR(50) NOT NULL, CHANGE nom nom VARCHAR(2
55) NOT NULL, CHANGE url url VARCHAR(255) NOT NULL;
ALTER TABLE tutelle ADD created DATETIME DEFAULT NULL;

ALTER TABLE user DROP locked,
 DROP expired, 
 DROP expires_at,
 DROP credentials_expired,
 DROP credentials_expire_at, 
 CHANGE username username VARCHAR(180) NOT NULL,
 CHANGE username_canonical username_canonical VARCHAR(180) NOT NULL,
 CHANGE email email VARCHAR(180) NOT NULL, 
 CHANGE email_canonical email_canonical VARCHAR(180) NOT NULL, 
 CHANGE salt salt VARCHAR(255) DEFAULT NULL, 
 CHANGE confirmation_token confirmation_token VARCHAR(180) DEFAULT NULL;
CREATE UNIQUE INDEX UNIQ_8D93D649C05FB297 ON user (confirmation_token);
