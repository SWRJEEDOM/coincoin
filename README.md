# Template de plugin pour Jeedom

Ce "template de plugin" sert de base à la réalisation de plugins pour **Jeedom**.

La documentation générale relative à la conception de plugin est consultable [ici](https://doc.jeedom.com/fr_FR/dev/). Dans le détail :   
* [Utilisation du template de plugin](https://doc.jeedom.com/fr_FR/dev/plugin_template) : Le template de plugin est une base de plugin pour Jeedom qui doit être adaptée avec l'id de votre plugin et à laquelle il suffit d'ajouter vos propres fonctions. 
* [Fichier info.json](https://doc.jeedom.com/fr_FR/dev/structure_info_json) : Intégré depuis la version 3.0 de Jeedom, le fichier **info.json** est obligatoire pour le bon fonctionnement des plugins et leur bon déploiement sur le Market Jeedom.
* [Icône du plugin](https://doc.jeedom.com/fr_FR/dev/Icone_de_plugin) : Afin de pouvoir être publié sur le Market Jeedom, tout plugin doit disposer d’une icône. Attention à ne pas utiliser le même code couleur que les icônes des plugins Jeedom officiels.
* [Widget du plugin](https://doc.jeedom.com/fr_FR/dev/widget_plugin) : Présentation des différentes manières d'inclure des widgets personnalisés au plugin.
* [Documentation du plugin](https://doc.jeedom.com/fr_FR/dev/documentation_plugin) : Présentation de la mise en place d'une documentation car un bon plugin n'est rien sans documentation adéquate.
* [Publication du plugin](https://doc.jeedom.com/fr_FR/dev/publication_plugin) : Description des pré-requis indispensables à la publication du plugin.


1) Description
Plugin permettant de récupérer les cours de bourse d’une action ou d’un indice mais également le taux de change entre deux devises (y compris crypto-monnaie comme le bitcoin) ainsi que les matières premières. Toutes les données sont généralement disponibles en temps réel mais la fréquence d’actualisation dépend du service utilisé.

2) Installation
Afin d’utiliser le plugin, vous devez le télécharger, l’installer et l’activer comme tout plugin Jeedom.

3) Configuration du plugin
Il n’y a aucune configuration à effectuer au niveau du plugin, les clés API se configure sur les équipements en fonction du service sélectionné.

4) Configuration d’un équipement
Après avoir créé un nouvel équipement, les options habituelles sont disponibles. Vous pourrez également renseigner la fréquence d’actualisation des informations.

Ensuite vous devez sélectionner le service à utiliser pour cet équipement parmi la liste proposé. Une description de chaque service est disponible dans la page de configuration. Vous y trouverez également le lien pour créer un nouveau compte si vous n’en avez pas encore ou si vous désirez en créer un nouveau.

Il faudra ensuite renseigner la clé API correspondante au service.

Tip Faite attention à ne pas demander une actualisation trop fréquente si cela n’est pas nécessaire en tenant compte du nombre d’équipement que vous créez afin de ne pas dépasser la limite imposée par le service.

Vous devez ensuite choisir le type d’informations souhaitée:

Cotation boursière: le cours d’une action ou d’un indice (selon le service sélectionné)
Taux de change entre 2 devises (y compris crypto-monnaie)
4.1) Cotation boursière & indice boursier
Pour ce type d’information, vous devez renseigner le symbole de l’action ou de l’indice. Le plugin offre une fonction de recherche dynamique, commencez simplement à taper le nom d’une entreprise (minimum 3 caractères) ou le symbole voulu et une liste de possibilités sera proposée. Vous n’avez plus qu’à choisir parmi celles-ci.

Configuration symbole

4.2) Taux de change
Pour ce type d’information, vous devez choisir la devise d’origine et de destination. Le plugin offre une fonction de recherche dynamique, commencez simplement à taper le nom d’une devise ou son code et une liste des devise correspondante sera proposée. Vous n’avez plus qu’à choisir parmi celles-ci.

Configuration devise

4.3) Matière première
Pour ce type d’information, vous devez renseigner le symbole de la matière première. Le plugin offre une fonction de recherche dynamique, commencez simplement à taper le nom d’une matière première (minimum 3 caractères) ou le symbole voulu et une liste de possibilités sera proposée. Vous n’avez plus qu’à choisir parmi celles-ci.

5) Les commandes disponibles
Vous trouverez ci-dessous un aperçu des commandes les plus importantes disponibles par type d’information.

5.1) Cotation boursière
Ouverture: prix à l’ouverture
Fermeture précédente: prix à la fermeture précédente
Max: maximum atteint depuis l’ouverture
Min: minimum atteint depuis l’ouverture
Prix: prix actuel
Volume: Volume d’action
Evolution: Evolution depuis l’ouverture
5.2) Taux de change
Taux de change
Offre: le prix de l’offre
Demande: le prix de la demande
5.3) Matière première
Prix
Devise
Unité
Date
6) Changelog
Voir le changelog

7) Support
Si malgré cette documentation et après voir lu les sujets en rapport avec le plugin sur community vous ne trouvez pas de réponse à votre question, n’hésitez pas à créer un nouveau sujet en n’oubliant pas de mettre le tag du plugin (plugin-stockexchange).
