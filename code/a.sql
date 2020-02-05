 SELECT
        cheval_id,
        CASE
            WHEN use_only_last_5 = 1 THEN SUBSTRING(musique_calculated, 1, 10)
            ELSE SUBSTRING(musique_calculated, 1, 20)
        END as musique_calculated
        FROM (
            SELECT
                cheval_id,
                GROUP_CONCAT(CONCAT(num_place_arrivee_musique, musique_letter)  ORDER BY date_reunion DESC SEPARATOR "") as musique_calculated, -- TODO LImit if < 5
                CASE
                    WHEN MAX(nb_courses_last_6_month) < 5 THEN SUM(score_last_5_race) / 5
                    ELSE AVG(score)
                END as real_score,
                CASE
                    WHEN MAX(nb_courses_last_6_month) < 5 THEN 1
                    ELSE 0
                END as use_only_last_5,
                MIN(last_other_discipline) as min_last_other_discipline,
                MIN(only_other_discipline_last_6_month) as min_only_other_discipline_last_6_month
                FROM (
                    SELECT
                        @multiply_by := IF (c.cheval_id = @previous_cheval_id, (@multiply_by - 1), 6),
                        @only_other_discipline_last_6_month := IF (c.cheval_id = @previous_cheval_id, @only_other_discipline_last_6_month, 1),
                        @have_course_less_than_2_month := IF (c.cheval_id = @previous_cheval_id, @have_course_less_than_2_month, 0),
                        @last_other_discipline := IF (c.cheval_id = @previous_cheval_id, @last_other_discipline, 5),
                        @nb_courses_last_6_month := IF (c.cheval_id = @previous_cheval_id, @nb_courses_last_6_month, 0),
                        @previous_cheval_id := IF (@multiply_by = 6, cheval_id, @previous_cheval_id),
                        cheval_id,
                        num_place_arrivee,
                        IF (num_place_arrivee, IF(num_place_arrivee > 9, 0, num_place_arrivee), "D") as num_place_arrivee_musique,
                        musique_letter,
                        less_than_2_month,
                        IF (less_than_2_month = 1, @have_course_less_than_2_month := 1, 'no changes'),
                        less_than_6_month,
                        @nb_courses_last_6_month := IF (less_than_6_month = 1, @nb_courses_last_6_month + 1, @nb_courses_last_6_month),
                        same_discipline,
                        IF (same_discipline = 1 AND less_than_6_month = 1, @only_other_discipline_last_6_month := 0, 'no changes'),
                        IF (same_discipline = 0 AND @multiply_by > 0, @last_other_discipline := @last_other_discipline - 1, 'no changes'),
                        nb_points,
                        IF (@multiply_by > -5, IF(@multiply_by > 0, nb_points * @multiply_by, nb_points), null) as score,
                        IF (@multiply_by > 0, nb_points * @multiply_by, null) as score_last_5_race,
                        @only_other_discipline_last_6_month as only_other_discipline_last_6_month,
                        @have_course_less_than_2_month as have_course_less_than_2_month,
                        @last_other_discipline as last_other_discipline,
                        @nb_courses_last_6_month as nb_courses_last_6_month,
                        date_reunion,
                        num_partant
                        FROM (
                            SELECT p.cheval_id, p.num_partant,
                                CAST(p.num_place_arrivee AS UNSIGNED) AS num_place_arrivee,
                                CASE c.discipline
                                    WHEN 'Plat' THEN 'p'
                                    WHEN 'Haies' THEN 'h'
                                    WHEN 'Trot' THEN 't'
                                    WHEN 'Steeple Chase' THEN 's'
                                    WHEN 'Obstacle' THEN 'o'
                                    WHEN 'Attelé' THEN 'a'
                                    WHEN 'Cross' THEN 'c'
                                    WHEN 'Monté' THEN 'm'
                                END as musique_letter,
                                IF (c.discipline = @current_discipline, 1, 0) as same_discipline,
                                IF (date_reunion > STR_TO_DATE(@current_course_date, '%Y-%m-%d') - INTERVAL '2' MONTH, 1, 0) as less_than_2_month,
                                IF (date_reunion > STR_TO_DATE(@current_course_date, '%Y-%m-%d') - INTERVAL '6' MONTH, 1, 0) as less_than_6_month,
                                date_reunion,
                                CASE
                                    WHEN num_place_arrivee REGEXP '^[[:digit:]]+$' AND num_place_arrivee > 0 AND num_place_arrivee < 10 THEN num_place_arrivee
                                    ELSE 10
                                END as nb_points
                                FROM partant p
                                INNER JOIN course c ON (c.id = p.course_id)
                                INNER JOIN reunion r ON (r.id = c.reunion_id AND date_reunion < CURRENT_DATE)
                                WHERE cheval_id IN (
                                    SELECT cheval_id
                                    FROM partant p
                                    WHERE p.course_id = @course_id
                                )
                                AND p.course_id != @course_id
                                ORDER BY p.cheval_id, r.date_reunion DESC
                        ) c
            ) a
            WHERE have_course_less_than_2_month = 1 -- Works becase r.date_reunion DESC
            GROUP BY cheval_id
            ORDER BY real_score ASC
        ) q
        WHERE min_last_other_discipline > 0
        AND min_only_other_discipline_last_6_month = 0
        LIMIT 1
