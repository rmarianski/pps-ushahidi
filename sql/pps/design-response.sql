-- add a design_response column to the incident table

CREATE TABLE `design_response` (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
incident_id INT NOT NULL,
text VARCHAR(2048),
FOREIGN KEY (incident_id) REFERENCES incident(id)
);
