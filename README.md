# Spotify Clone

Le projet **Spotify Clone** est une application web inspirée de la plateforme de streaming musical Spotify. Il permet aux utilisateurs de parcourir, écouter et gérer des chansons, tout en offrant une interface intuitive et moderne. Ce projet utilise PHP avec une architecture MVC (Modèle-Vue-Contrôleur) et est configuré avec PostgreSQL pour la gestion des données.

## Objectifs du Projet

- **Expérience Utilisateur** : Offrir une interface fluide et accessible permettant aux utilisateurs d'interagir facilement avec la plateforme.
- **Gestion des Utilisateurs** : Permettre aux invités, utilisateurs enregistrés, artistes et administrateurs d'accéder à des fonctionnalités adaptées à leurs rôles.
- **Structure Professionnelle** : Implémenter une architecture MVC pour garantir une organisation claire du code, avec autoloading et configuration via .htaccess.

## Fonctionnalités Principales

### 1. Gestion des Utilisateurs
- **Invités** : Parcourir les chansons et consulter les playlists publiques.
- **Utilisateurs enregistrés** : Créer, modifier et supprimer des playlists, gérer une liste de chansons aimées, suivre les playlists d'autres utilisateurs.
- **Artistes** : Téléverser des chansons, organiser des playlists et gérer leur catalogue musical.
- **Administrateurs** : Gérer les utilisateurs (bannir ou débloquer) et superviser les chansons et playlists.

### 2. Gestion des Playlists
- Création et gestion des playlists avec une option de visibilité publique ou privée.

### 3. Authentification et Sécurité
- Système d'inscription et de connexion, avec contrôle d'accès basé sur les rôles.

### 4. Streaming Musical
- Écoute de chansons via un lecteur intégré.

## Architecture Technique

### 1. Architecture MVC
- **Modèle** : Gestion des données, interaction avec PostgreSQL.
- **Vue** : Affichage des données et interface utilisateur.
- **Contrôleur** : Logique métier et gestion des interactions entre le modèle et la vue.


## Base de Données

Le projet utilise **PostgreSQL** comme SGBD pour gérer les informations des utilisateurs, chansons, playlists, etc. Nous utilisons des requêtes préparées pour la sécurité et les performances.

## Fonctionnalités Bonus

- **Utilisation de PostgreSQL** : Profitez des fonctionnalités avancées de PostgreSQL, comme les index GiST et JSONB, pour des requêtes optimisées et la gestion de données complexes.

## Installation

1. Clonez ce dépôt :
   ```bash
   git clone https://github.com/Safaa-Ettalhi/Spotify_clone
