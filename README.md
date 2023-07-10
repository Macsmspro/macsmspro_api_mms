# api_mms
Envoi de messages professionnels multimedia

`1- URL API`


L' API est appelée par l'url `"https://macsmspro.com/api/mms.php"` . Il autorise les requetes POST et requiert en body un token directement lié à votre compte grâce auquel les envois sont effectués.
Le token fournit les informations nécessaires à l'api pour reconnaitre le compte utilisateur lors d'une requête. Lorsque vous possédez un token et que vous en génerez un nouveau, cette action écrasse l'ancien token et le rend ainsi obsolète. Toutes requetes envoyées par ce dernier ne sera plus autorisé par l'api.


`2- CORPS DE LA REQUETE`


`Le Nom`
Il s'agit du nom que portera le message. Il a les propriétés de ne pas être NULL ou vide, et doit pas excéder plus de dix (10) caratères. Désigné dans le corps de la reqête par name.

`Le Message`
Il n'est rien d'autre que le contenu du message à envoyer. Reconnu dans le corps de la requête par la propriété message, il est requis et ne peut donc être `NULL` ou `vide`.

`Le téléphone`

Il représente le numéro de téléphone destinataire, il doit être suvi de son indicatif, ne doit contenir aucun espace et ne peut être `NULL` ou `vide`.
Ex: 44xxxxxxxx Désigné dans le corps de la reqête par telephone

`Les fichiers attachés`

Il s'agit de la liste des fichiers attachés au message MMS, de type array il contient les urls vers chaque ficher.

`Le token`
Il est question du token que vous avez généré pour votre compte, il est requis pour tout envoi vers API. Il est utilisé dans le corps de reqête sous le même nom.



`3- REPONSES DU SERVEUR`



Le serveur retourne deux catégories possible de réponse lors d'une rêquete. Nous avons les retours de type `ERROR` et les retours de type `SUCCESS`.
Les messages d'erreur
Les messages d'erreur sont sous le format:
`"error" : {
"message" : {
"nom de l'erreur" : "message d'erreur"
}
}`
OU
`"error" : {
"message" : "message d'erreur"
}
OU
"error" : {
"messages" : [
{
"nom_erreur" : "message d'erreur"
}
]
}`


`Quelques erreurs`

`
"error" : {
"message" : "Method Not Allowed"
}`
Cette erreur est retournée avec un code `405` lorsque la requete envoyée n'est pas de type `POST`
`"error" : {
"message" : "Crédit insuffisant"
}
Cette erreur est retournée avec un code 403 lorsque le compte utilisateur ne dispose pas d'assez de crédit pour effectuer l'opération.
"error" : {
"message" : "Mms non envoyé"
}`
Cette erreur est retournée avec un code `422`. Divers raisons peuvent être à la source de cet erreur,
Le numéro de destination que vous essayez d'atteindre ne peut pas recevoir ce message.
L'appareil que vous essayez d'atteindre n'a pas un signal suffisant.
L'appareil ne peut pas recevoir de MMS (par exemple, le numéro de téléphone appartient à une ligne fixe).
Le numéro de destination figure sur le registre national des numéros de téléphone exclus du pays par le réseau de destination.
Il y a un problème avec l'opérateur de téléphonie mobile du pays.
`"error" : {
"message" : {
"token" : "Le token est requis"
}
}
Cette erreur est retournée avec un code 422 lorsque la valeur du token est vide ou NULL
"error" : {
"message" : {
"token" : "token invalid"
}
}`
Cette erreur est retournée avec un code 401 lorsque la valeur du token envoyée ne correspond à aucun compte utilisateur du système.
`"error" : {
"messages" : [
{
"telephone" : "Le numéro de téléphone destinataire est requis"
}
]
}`
Cette erreur est retournée avec un code 422 lorsque la valeur du numero de telephone est vide ou NULL
`"error" : {
"messages" : [
{
"message" : "Le corps du message est requis"
}
]
}`
Cette erreur est retournée avec un code 422 lorsque la valeur du message est vide ou NULL
`"error" : {
"messages" : [
{
"name" : "Le nom est requis"
}
]
}`
Cette erreur est retournée avec un code `422` lorsque la valeur du nom est vide ou` NULL`
`"error" : {
"messages" : [
{
"name" : "Le nom ne peut pas excéder dix (10) caratères"
}
]
}`
Cette erreur est retournée avec un code 422 lorsque la valeur du nom dépasse les dix caractères
Plusieurs messages d'erreur peuvent se briquer comme suit
`"error" : {
"messages" : [
{
"name" : "Le nom est requis"
}, {
"telephone" : "Le numéro de téléphone destinataire est requis"
}, {
"message" : "Le corps du message est requis"
}
]
}`
Cette erreur est retournée avec un code `422` lorsque plusieurs données ne sont pas vérifiées à la fois `NULL`
Les messages de réussite
`"success" : {
"message" : "Mms envoyé au 44xxxxxxxx"
}`

Cette réponse est retournée avec un code` 200` lorsque le message a été envoyé sans aucun problème rencontré.



`La taille totale des fichiers doit être inférieure ou égale à 5 MB`

