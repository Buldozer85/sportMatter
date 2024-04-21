create or replace table countries
(
    id         bigint unsigned auto_increment
        primary key,
    name       varchar(255) not null,
    short_name varchar(255) not null,
    created_at timestamp    null,
    updated_at timestamp    null
)
    collate = utf8mb4_unicode_ci;

create or replace table failed_jobs
(
    id         bigint unsigned auto_increment
        primary key,
    uuid       varchar(255)                          not null,
    connection text                                  not null,
    queue      text                                  not null,
    payload    longtext                              not null,
    exception  longtext                              not null,
    failed_at  timestamp default current_timestamp() not null,
    constraint failed_jobs_uuid_unique
        unique (uuid)
)
    collate = utf8mb4_unicode_ci;

create or replace table migrations
(
    id        int unsigned auto_increment
        primary key,
    migration varchar(255) not null,
    batch     int          not null
)
    collate = utf8mb4_unicode_ci;

create or replace table personal_access_tokens
(
    id             bigint unsigned auto_increment
        primary key,
    tokenable_type varchar(255)    not null,
    tokenable_id   bigint unsigned not null,
    name           varchar(255)    not null,
    token          varchar(64)     not null,
    abilities      text            null,
    last_used_at   timestamp       null,
    expires_at     timestamp       null,
    created_at     timestamp       null,
    updated_at     timestamp       null,
    constraint personal_access_tokens_token_unique
        unique (token)
)
    collate = utf8mb4_unicode_ci;

create or replace index personal_access_tokens_tokenable_type_tokenable_id_index
    on personal_access_tokens (tokenable_type, tokenable_id);

create or replace table sports
(
    id   bigint unsigned auto_increment
        primary key,
    name varchar(255) not null
)
    collate = utf8mb4_unicode_ci;

create or replace table leagues
(
    id          bigint unsigned auto_increment
        primary key,
    association varchar(255)    not null,
    country_id  bigint unsigned not null,
    name        varchar(255)    not null,
    sport_id    bigint unsigned not null,
    created_at  timestamp       null,
    updated_at  timestamp       null,
    constraint leagues_country_id_foreign
        foreign key (country_id) references countries (id),
    constraint leagues_sport_id_foreign
        foreign key (sport_id) references sports (id)
)
    collate = utf8mb4_unicode_ci;

create or replace table referees
(
    id         bigint unsigned auto_increment
        primary key,
    first_name varchar(255)    not null,
    last_name  varchar(255)    not null,
    sport_id   bigint unsigned not null,
    created_at timestamp       null,
    updated_at timestamp       null,
    constraint referees_sport_id_foreign
        foreign key (sport_id) references sports (id)
)
    collate = utf8mb4_unicode_ci;

create or replace table seasons
(
    id         bigint unsigned auto_increment
        primary key,
    yearStart  datetime             not null,
    yearEnd    datetime             not null,
    league_id  bigint unsigned      not null,
    created_at timestamp            null,
    updated_at timestamp            null,
    is_active  tinyint(1) default 0 not null,
    constraint seasons_league_id_foreign
        foreign key (league_id) references leagues (id)
)
    collate = utf8mb4_unicode_ci;

create or replace table stadiums
(
    id         bigint unsigned auto_increment
        primary key,
    capacity   int          not null,
    name       varchar(255) not null,
    created_at timestamp    null,
    updated_at timestamp    null
)
    collate = utf8mb4_unicode_ci;

create or replace table teams
(
    id         bigint unsigned auto_increment
        primary key,
    name       varchar(255)    not null,
    short_name varchar(10)     not null,
    league_id  bigint unsigned not null,
    stadium_id bigint unsigned not null,
    created_at timestamp       null,
    updated_at timestamp       null,
    constraint teams_league_id_foreign
        foreign key (league_id) references leagues (id),
    constraint teams_stadium_id_foreign
        foreign key (stadium_id) references stadiums (id)
)
    collate = utf8mb4_unicode_ci;

create or replace table players
(
    id         bigint unsigned auto_increment
        primary key,
    first_name varchar(255)    not null,
    last_name  varchar(255)    not null,
    birthdate  datetime        not null,
    country_id bigint unsigned not null,
    team_id    bigint unsigned not null,
    created_at timestamp       null,
    updated_at timestamp       null,
    constraint players_country_id_foreign
        foreign key (country_id) references countries (id),
    constraint players_team_id_foreign
        foreign key (team_id) references teams (id)
)
    collate = utf8mb4_unicode_ci;

create or replace table player_history
(
    id               bigint unsigned auto_increment
        primary key,
    date_of_transfer datetime        not null,
    player_id        bigint unsigned not null,
    team_id          bigint unsigned not null,
    created_at       timestamp       null,
    updated_at       timestamp       null,
    constraint player_history_player_id_foreign
        foreign key (player_id) references players (id),
    constraint player_history_team_id_foreign
        foreign key (team_id) references teams (id)
)
    collate = utf8mb4_unicode_ci;

create or replace definer = root@`%` trigger player_switched_teams
    after update
    on players
    for each row
BEGIN
    IF OLD.team_id != NEW.team_id THEN
        INSERT INTO player_history (date_of_transfer, player_id, team_id, created_at, updated_at)
        VALUES(NOW(), OLD.id, OLD.team_id, NOW(), NOW());
    END IF;
END;

create or replace table season_has_teams
(
    id         bigint unsigned auto_increment
        primary key,
    points     int default 0   not null,
    season_id  bigint unsigned not null,
    team_id    bigint unsigned not null,
    created_at timestamp       null,
    updated_at timestamp       null,
    constraint season_has_teams_season_id_foreign
        foreign key (season_id) references seasons (id),
    constraint season_has_teams_team_id_foreign
        foreign key (team_id) references teams (id)
)
    collate = utf8mb4_unicode_ci;

create or replace index season_has_teams_points_index
    on season_has_teams (points);

create or replace table users
(
    id         bigint unsigned auto_increment
        primary key,
    first_name varchar(255)                                                   not null,
    last_name  varchar(255)                                                   not null,
    email      varchar(255)                                                   not null,
    password   varchar(255)                                                   not null,
    access     enum ('user', 'editor', 'administrator', 'superadministrator') not null,
    created_at timestamp                                                      null,
    updated_at timestamp                                                      null,
    constraint users_email_unique
        unique (email)
)
    collate = utf8mb4_unicode_ci;

create or replace table matches
(
    id            bigint unsigned auto_increment
        primary key,
    date_of_match datetime                     not null,
    lap           int                          not null,
    parameters    longtext collate utf8mb4_bin not null
        check (json_valid(`parameters`)),
    supervisor_id bigint unsigned              not null,
    away_team_id  bigint unsigned              not null,
    home_team_id  bigint unsigned              not null,
    league_id     bigint unsigned              not null,
    created_at    timestamp                    null,
    updated_at    timestamp                    null,
    season_id     bigint unsigned              not null,
    constraint matches_away_team_id_foreign
        foreign key (away_team_id) references teams (id),
    constraint matches_home_team_id_foreign
        foreign key (home_team_id) references teams (id),
    constraint matches_league_id_foreign
        foreign key (league_id) references leagues (id),
    constraint matches_season_id_foreign
        foreign key (season_id) references seasons (id),
    constraint matches_supervisor_id_foreign
        foreign key (supervisor_id) references users (id)
)
    collate = utf8mb4_unicode_ci;

create or replace table favorite_matches
(
    id         bigint unsigned auto_increment
        primary key,
    match_id   bigint unsigned not null,
    user_id    bigint unsigned not null,
    created_at timestamp       null,
    updated_at timestamp       null,
    constraint favorite_matches_match_id_foreign
        foreign key (match_id) references matches (id),
    constraint favorite_matches_user_id_foreign
        foreign key (user_id) references users (id)
)
    collate = utf8mb4_unicode_ci;

create or replace table match_has_referees
(
    id         bigint unsigned auto_increment
        primary key,
    id_match   bigint unsigned not null,
    id_referee bigint unsigned not null,
    created_at timestamp       null,
    updated_at timestamp       null,
    constraint match_has_referees_id_match_foreign
        foreign key (id_match) references matches (id),
    constraint match_has_referees_id_referee_foreign
        foreign key (id_referee) references referees (id)
)
    collate = utf8mb4_unicode_ci;

create or replace index matches_date_of_match_index
    on matches (date_of_match);

create or replace fulltext index users_first_name_last_name_fulltext
    on users (first_name, last_name);

create or replace definer = root@`%` view players_latest_transfers as
select `sport_matter`.`players`.`first_name`              AS `first_name`,
       `sport_matter`.`players`.`last_name`               AS `last_name`,
       `sport_matter`.`players`.`id`                      AS `id`,
       `sport_matter`.`players`.`birthdate`               AS `birthdate`,
       `sport_matter`.`players`.`country_id`              AS `country_id`,
       `sport_matter`.`players`.`team_id`                 AS `team_id`,
       `sport_matter`.`players`.`created_at`              AS `created_at`,
       `sport_matter`.`players`.`updated_at`              AS `updated_at`,
       `sport_matter`.`player_history`.`date_of_transfer` AS `date_of_transfer`
from (`sport_matter`.`players` join `sport_matter`.`player_history`
      on (`sport_matter`.`players`.`id` = `sport_matter`.`player_history`.`player_id`))
order by `sport_matter`.`player_history`.`date_of_transfer` desc;

create or replace
    definer = root@`%` procedure Register(IN first_name varchar(255), IN last_name varchar(255), IN email varchar(255),
                                          IN password varchar(255), IN access varchar(255))
BEGIN
    INSERT INTO users (first_name, last_name, email, password, access) VALUES (first_name, last_name, email, password, access);
END
;

create or replace
    definer = root@`%` function season_year_function(season int) returns varchar(20) deterministic
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
;

