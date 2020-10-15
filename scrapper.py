#!/usr/bin/python

import requests
import json
import threading

API_KEY = 'cebba78ab23504d003715baf10955b9e'


sql_string = ''

def get_genre_to_str():
    genre_req = requests.get('https://api.themoviedb.org/3/genre/movie/list?api_key=cebba78ab23504d003715baf10955b9e').content.decode()
    genres = json.loads(genre_req)

    genre_str = dict()

    for g in genres['genres']:
        genre_str[g['id']] = g['name']

    return genre_str

genres_to_str = get_genre_to_str()
known_person = set()
known_film = set()

def get_characters(film):
    credits_req = requests.get('https://api.themoviedb.org/3/movie/%d/credits?api_key=cebba78ab23504d003715baf10955b9e' % film['id']).content.decode()
    credits = json.loads(credits_req)

    persons = {'actors': [] }
    for person in credits['crew']:
        if person['job'] == 'Producer':
            producer_req = requests.get('https://api.themoviedb.org/3/person/%d?api_key=cebba78ab23504d003715baf10955b9e' % person['id']).content.decode()
            persons['producer'] = json.loads(producer_req)
            break

    for person in credits['cast']:
        person_details_req = requests.get('https://api.themoviedb.org/3/person/%d?api_key=cebba78ab23504d003715baf10955b9e' % person['id']).content.decode()
        persons['actors'].append(json.loads(person_details_req))



    return persons

def add_person(person):
    global sql_string

    if not person['id'] in known_person:
        known_person.add(person['id'])
        print("Getting person", person["name"])
        surname = person['name'].split(' ')[0]

        if len(person['name'].split(' ')) > 1:
            name = person['name'].split(' ')[1]
        else:
            name = ''

        date = None
        genre = ''
        biographie = None

        if person['birthday'] is None:
            date = 'NOW()'
        else:
            date = "DATE('%s')" % person['birthday']

        if person['gender'] == 0:
           genre = 'Homme'
        elif person['gender'] == 1:
            genre = 'Femme'
        else:
            genre = 'Autre'

        if person['biography'] is None:
            biographie = ''
        else:
            biographie = person['biography'].replace('"', "'")

        sql_string += "insert into PERSONNE (idPersonne, nom, prenom, sexe, dateNaissance, biographie) values(%d,\"%s\",\"%s\",'%s',%s,\"%s\");\n"\
                        % (person['id'], name, surname, genre, date, biographie)
    else:
        print("Personne deja présente.")

class Charger(threading.Thread):
    def __init__(self, begin, end):
        threading.Thread.__init__(self)
        self.begin = begin
        self.end = end

    def run(self):
        global sql_string

        for i in range(self.begin, self.end + 1):
            req = requests.get('https://api.themoviedb.org/3/discover/movie?api_key=cebba78ab23504d003715baf10955b9e&page=%i' % i).content.decode()
            films = json.loads(req)

            for f in films['results']:
                poster_path = "http://image.tmdb.org/t/p/w185" + f["poster_path"]
                print(i, f['id'])
                title = f['title'].replace('"', "'")
                overview = f['overview'].replace('"', "'")

                genre = 'inconnu'
                if len(f['genre_ids']) > 0:
                    genre = genres_to_str[f['genre_ids'][0]]

                if f['id'] not in known_film:
                    insert_film = "insert into FILM (idFilm, titreFilm, synopsis, dateRealisation, genre, posterPath) values(%d,\"%s\",\"%s\",DATE('%s'),'%s','%s');"\
                                  % (f['id'], title, overview, f['release_date'], genres_to_str[f['genre_ids'][0]], poster_path)
                    sql_string += "%s\n" % insert_film
                    known_film.add(f['id'])

                    characters = get_characters(f)

                    for c in characters['actors']:
                        add_person(c)
                        sql_string += "insert into JOUE values(%d,%d);\n" % (c['id'], f['id'])

                    if 'producer' in characters:
                        add_person(characters['producer'])
                        sql_string += "insert into REALISE values(%d,%d);\n" % (characters['producer']['id'], f['id'])
                else:
                    print("Film déjà rencontré")

workers = [Charger(1, 5), Charger(6, 10), Charger(11, 16), Charger(17, 23)]
#workers = [Charger(1, 2), Charger(3, 4) ]
for i in range(1, len(workers) + 1):
    workers[i - 1].start()

for i in range(1, len(workers) + 1):
    workers[i - 1].join()

with open("film_insert.sql", 'w') as f:
    f.write(sql_string)
    f.close()

