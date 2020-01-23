#!/usr/bin/python3
# -*- coding: utf-8 -*-

"""
	----------------------------
	 Autor	 : CARDINAL Florian
	 Date	 : 03/12/2019
	 Program : serrure.py
	----------------------------
"""

from datetime import *
import mysql.connector, serial, time

print("Running...")
prop = [
	'03/12/2019',
	'ARDANOUY Baptiste',
	'serrure RS232',
	'0.0.1'
]

def settings(): # Propriété du port série
	global prop
	print("{}> Congif Serial Port_".format(prop[2]))

	ser = serial.Serial()
	ser.port = '/dev/ttyUSB0'
	ser.baudrate = 9600
	ser.bytesize = 8
	ser.parity = 'N'
	ser.stopbits = 1
	ser.timeout = 0
	ser.xonxoff = False
	ser.rtscts = False
	ser.dsrdtr = False
	ser.writeTimeout = 2
	ser.interByteTimeout = None

	print("{}> Serial Configured_".format(prop[2]))
	return ser

def bddConnect(): # Configuration de la connexion à la database
	return mysql.connector.connect(
		host = "127.0.0.1",
		database = "serrure",
		user = "root",
		passwd = "toor"
	)

def main(): # Programme principal
	global prop
	print("{}> Initialize ".format(prop[2]))
	ser = settings() # Paramètrage du port série
	bdd = bddConnect() # Connexion à la database

	cursor = bdd.cursor() # Initialisation du curseur

	ser.open()
	while(True):
		trame = ser.readline() # Récupération de la trame
		if(ser.isOpen() and trame): # Vérification présence de trame
			now = datetime.now() # Enregistrement du timestamp
			data = trame.decode('latin-1') # Décodage de la trame
			data = data.split(',')
			req = [ # Préparation de la requête de log
				"INSERT INTO story(time, value, dir, access) VALUES (%s, %s, %s, %s)",
				()
			]

			if('$code' in data): # Si il y a passage d'une carte RFID
				data[1] = data[1].encode('utf-8').hex() # Conversion du code RFID au format hexadecimal
				print("[DATA]: {}".format(data[1]))

				cursor.execute('SELECT idCard, value FROM card') # Récupération des cartes enregistrer sur la database
				fetch = cursor.fetchall() # Listing des données dans un array
				for x in fetch:
					if(data[1] in x): # Si il y a correspondance, on accepte
						passed = 1
					else: # Sinon on refuse le passage
						passed = 0

				req[1] = (now, data[1], data[2][0], passed) # Pré-requêtage des infos pour les logs

			elif('$button\n' in data): # Si il y a le bouton d'appuyer
				req[1] = (now, 'button', '0', 1)

			else: # Si il y a un autre évènement dit 'NON PREVU' ou 'INCONNU'
				req[1] = (now, 'uknown', '0', 0)

			cursor.execute(req[0], req[1]) # Envoi de la requête d'insertion des logs
			bdd.commit() # Application des requêtes

		time.sleep(1)

main()
