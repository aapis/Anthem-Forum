#test table
CREATE TABLE `anthem`.`ant_test` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `subject` VARCHAR(45) NOT NULL,
  `body` VARCHAR(45) NOT NULL,
  `from` INT NOT NULL,
  PRIMARY KEY (`id`));

#forums table
CREATE TABLE `anthem`.`ant_forums` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `forum_name` VARCHAR(100) NOT NULL,
  `forum_status` INT NOT NULL,
  `forum_description` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`));
