#! /bin/bash
awk -F',' '{ print "INSERT INTO team (team_number, team_name, division, last_updated) VALUES ("$1",\""$2"\",\""$3"\", NOW());" }' teams.csv > teams.sql
