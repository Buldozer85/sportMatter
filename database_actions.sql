CREATE VIEW players_latest_transfers AS
SELECT players.first_name, players.last_name, players.id, players.birthdate, players.country_id, players.team_id, players.created_at, players.updated_at, player_history.date_of_transfer FROM players
                                                                                                                                                                                                   INNER JOIN player_history ON players.id = player_history.player_id
ORDER BY date_of_transfer DESC;

CREATE FUNCTION `season_year_function`(season int) RETURNS varchar(20) DETERMINISTIC
BEGIN
    DECLARE year1 varchar(4);
    DECLARE year2 varchar(4);

    SELECT YEAR(yearStart) INTO year1 FROM seasons WHERE id = season;
    SELECT YEAR(yearEnd) INTO year2 FROM seasons WHERE id = season;

    IF(year1 = year2) THEN
        RETURN year1;
    ELSE
        RETURN CONCAT(year1, "/", year2);
    END IF;
END

CREATE TRIGGER player_switched_teams AFTER UPDATE ON players FOR EACH ROW
BEGIN
    IF OLD.team_id != NEW.team_id THEN
        INSERT INTO player_history (date_of_transfer, player_id, team_id, created_at, updated_at)
        VALUES(NOW(), OLD.id, OLD.team_id, NOW(), NOW());
    END IF;
END;

CREATE PROCEDURE Register (IN `first_name` varchar(255), IN `last_name` varchar(255), IN `email` varchar(255), IN `password` varchar(255), IN `access` varchar(255))
BEGIN
    INSERT INTO users (first_name, last_name, email, password, access) VALUES (first_name, last_name, email, password, access);
END
