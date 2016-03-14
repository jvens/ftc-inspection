#! /bin/bash
awk -F',' '{ print "INSERT INTO team (team_number, team_name, division, robot_inspection_time, field_inspection_time, last_updated) VALUES ("$1",\""$2"\",\""$3"\",\""$4"\",\""$4"\", NOW());" }' teams.csv > teams.sql
