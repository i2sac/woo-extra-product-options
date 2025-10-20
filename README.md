# Extra Product Options For WooCommerce - Modified Version

![WordPress](https://img.shields.io/badge/WordPress-Compatible-blue)
![WooCommerce](https://img.shields.io/badge/WooCommerce-Compatible-purple)
![PHP](https://img.shields.io/badge/PHP-5.6%2B-777BB4)
![License](https://img.shields.io/badge/License-GPLv2-red)

## 📋 Table des matières

- [À propos](#à-propos)
- [Crédits](#crédits)
- [Modifications apportées](#modifications-apportées)
- [Fonctionnalités](#fonctionnalités)
- [Installation](#installation)
- [Documentation](#documentation)
- [Support](#support)
- [Licence](#licence)

## 🎯 À propos

Cette version est une **modification personnalisée** du plugin **Extra Product Options For WooCommerce** développé par **ThemeHigh**. 

Le plugin original permet d'ajouter des options de produit personnalisées (product addons) avec 20 types de champs différents sur les pages produit WooCommerce.

Cette version modifiée ajoute des fonctionnalités supplémentaires de gestion des prix et d'affichage amélioré.

## 👏 Crédits

### Plugin Original

**Extra Product Options For WooCommerce**
- **Développeur:** [ThemeHigh](https://themehigh.com/)
- **Version originale:** 3.3.3
- **Site officiel:** https://www.themehigh.com/product/woocommerce-extra-product-options/
- **WordPress Plugin:** https://wordpress.org/plugins/woo-extra-product-options/
- **Licence:** GPLv2 or later

### Modifications

- **Auteur des modifications:** [i2sac](https://github.com/i2sac)
- **Repository GitHub:** https://github.com/i2sac
- **Date de modification:** Octobre 2025

---

## 🎨 Modifications apportées

Cette version modifiée inclut les améliorations suivantes par rapport à la version originale de ThemeHigh :

### 1. 💰 Système de prix pour les options personnalisées

**Fichiers modifiés:**
- `includes/model/fields/class-wepof-field.php`
- `admin/class-thwepof-admin-form-field.php`
- `public/class-thwepof-public.php`

**Fonctionnalités ajoutées:**
- Ajout d'un champ "Price" dans l'interface d'administration
- Gestion des prix pour les types de champs : Select, Radio, Checkbox, Checkboxgroup
- Calcul automatique du prix total dans le panier WooCommerce
- Persistance des prix à travers les sessions
- Affichage des prix supplémentaires dans le panier et la commande

**Comportement intelligent par type de champ:**
- **Checkbox simple:** Ajoute le prix si coché
- **Checkboxgroup:** Multiplie le prix par le nombre de cases cochées
- **Select/Radio:** Ajoute le prix si une option est sélectionnée

### 2. 🎨 Affichage des prix sur la page produit

**Fichier modifié:**
- `includes/utils/class-thwepof-utils-field.php`

**Fonctionnalités ajoutées:**
- Affichage automatique du prix entre parenthèses dans le titre du champ
- Affichage du prix à côté de chaque option (Select, Radio, Checkboxgroup)
- Format automatique avec symbole de devise WooCommerce
- Classes CSS personnalisables (`.thwepof-field-price`, `.thwepof-option-price`)

**Exemples d'affichage:**
```
Add Piment (1.00$)
☐ Extra Cheese (1.50$)
○ Small (2.50$)
```

### 3. 📄 Documentation complète

**Fichiers de documentation créés:**
- `MODIFICATIONS_PRICE.md` - Documentation technique détaillée
- `TESTS_PRICE.php` - Script de tests et procédures de validation
- `README_MODIFICATIONS.md` - Guide utilisateur
- `GUIDE_MIGRATION.md` - Instructions d'installation
- `EMPLACEMENTS_PRECIS.md` - Localisation exacte des modifications
- `CHANGELOG_CUSTOM.md` - Historique des changements
- `INDEX.md` - Navigation de la documentation
- `AMELIORATION_AFFICHAGE_PRIX.md` - Guide de l'affichage des prix

---

## 🚀 Fonctionnalités

### Fonctionnalités originales (ThemeHigh)

#### 20 types de champs personnalisés
1. Text
2. Hidden
3. Password
4. Number
5. Email
6. URL
7. Slider/Range
8. Telephone
9. Textarea
10. Select
11. Radio Button
12. Checkbox
13. Checkbox group
14. Date Picker
15. Color Picker
16. Heading
17. Paragraph
18. Switch
19. Separator
20. Time Picker

#### Autres fonctionnalités
- ✅ Regroupement des champs en sections personnalisées
- ✅ Règles d'affichage conditionnelles (Produits, Catégories, Tags)
- ✅ Styles CSS flexibles
- ✅ Affichage des valeurs sur les pages Panier, Commande, Détails
- ✅ Personnalisation du texte "Ajouter au panier"
- ✅ Compatible WPML
- ✅ Compatible avec la plupart des thèmes WordPress

### Nouvelles fonctionnalités (version modifiée)

- 💰 **Gestion complète des prix** pour les options de produit
- 🎨 **Affichage automatique** des prix sur la page produit
- 🔄 **Calcul intelligent** basé sur le type de champ
- 💾 **Persistance** des prix dans le panier et les commandes
- 📊 **Intégration native** avec WooCommerce
- 🎯 **Format automatique** selon les paramètres WooCommerce

---

## 📦 Installation

### Prérequis

- **WordPress:** 4.9 ou supérieur
- **WooCommerce:** 3.0 ou supérieur
- **PHP:** 5.6 ou supérieur
- **Serveur:** Apache ou Nginx

### Installation manuelle

1. **Télécharger** le plugin
   ```bash
   git clone https://github.com/i2sac/woo-extra-product-options.git
   ```

2. **Uploader** le dossier complet dans `/wp-content/plugins/`

3. **Activer** le plugin depuis le menu "Extensions" de WordPress

4. **Configurer** via WooCommerce → Extra Product Options

### Sauvegarde recommandée

⚠️ **Important:** Avant d'installer cette version modifiée, effectuez une sauvegarde complète de :
- Votre base de données WordPress
- Votre dossier `wp-content/plugins/`
- Vos paramètres WooCommerce

---

## 📚 Documentation

### Documentation des modifications

Consultez les fichiers de documentation suivants pour plus d'informations :

- **[MODIFICATIONS_PRICE.md](MODIFICATIONS_PRICE.md)** - Documentation technique complète
- **[README_MODIFICATIONS.md](README_MODIFICATIONS.md)** - Guide utilisateur
- **[GUIDE_MIGRATION.md](GUIDE_MIGRATION.md)** - Instructions d'installation pas à pas
- **[AMELIORATION_AFFICHAGE_PRIX.md](AMELIORATION_AFFICHAGE_PRIX.md)** - Guide de l'affichage des prix
- **[TESTS_PRICE.php](TESTS_PRICE.php)** - Procédures de test

### Documentation officielle ThemeHigh

- **Documentation complète:** https://www.themehigh.com/docs/category/extra-product-option-for-woocommerce/
- **FAQ:** Voir la section FAQ dans readme.txt
- **Tutoriels vidéo:** https://www.youtube.com/channel/UC-_uMXaC_21j1Y2_nGjTyvg/

---

## 🔧 Utilisation

### Ajouter un prix à un champ personnalisé

1. Allez dans **WooCommerce → Extra Product Options**
2. Créez ou modifiez un champ (Select, Radio, Checkbox, Checkboxgroup)
3. Dans l'onglet du champ, remplissez le champ **"Price"**
4. Enregistrez les modifications
5. Le prix s'affichera automatiquement sur la page produit

### Exemple pratique

**Configuration dans l'admin:**
```
Type de champ: Checkbox
Titre: Add Piment
Prix: 1.00
```

**Affichage sur la page produit:**
```
☐ Add Piment (1.00$)
```

**Résultat dans le panier:**
- Prix produit de base: 10.00$
- Option "Add Piment" sélectionnée: +1.00$
- **Total: 11.00$**

---

## 🎨 Personnalisation CSS

### Classes CSS disponibles

```css
/* Prix dans le titre du champ */
.thwepof-field-price {
    color: #008000;
    font-weight: bold;
    font-size: 0.9em;
}

/* Prix dans les options */
.thwepof-option-price {
    color: #008000;
    font-style: italic;
    font-size: 0.85em;
}
```

### Ajouter votre CSS personnalisé

Allez dans **Apparence → Personnaliser → CSS additionnel** et ajoutez vos styles.

---

## 🧪 Tests

Un fichier de test complet est fourni : **[TESTS_PRICE.php](TESTS_PRICE.php)**

### Tests recommandés

1. ✅ Test d'affichage des prix sur la page produit
2. ✅ Test d'ajout au panier avec options
3. ✅ Test de calcul des prix dans le panier
4. ✅ Test de persistance lors du checkout
5. ✅ Test de compatibilité avec différents thèmes
6. ✅ Test des différents types de champs (Select, Radio, Checkbox, Checkboxgroup)

Consultez le fichier **TESTS_PRICE.php** pour les procédures détaillées.

---

## 🤝 Support

### Pour les modifications personnalisées

- **GitHub Issues:** https://github.com/i2sac
- **Contact:** Via GitHub

### Pour le plugin original

- **Support ThemeHigh:** https://www.themehigh.com/docs/support/
- **Documentation:** https://www.themehigh.com/docs/category/extra-product-option-for-woocommerce/
- **Forum WordPress:** https://wordpress.org/support/plugin/woo-extra-product-options/

---

## 📝 Changelog

### Version modifiée (Octobre 2025)

#### Ajouté
- ✅ Système de prix pour les options personnalisées
- ✅ Affichage automatique des prix sur la page produit
- ✅ Calcul intelligent par type de champ
- ✅ Intégration WooCommerce native
- ✅ Documentation complète (8 fichiers)
- ✅ Script de tests

#### Modifié
- 📝 Auteur du plugin changé à "i2sac"
- 📝 URI de l'auteur pointant vers GitHub

### Version 3.3.3 (ThemeHigh - Original)
- Added WooCommerce 10.1 compatibility

Pour l'historique complet, consultez **[CHANGELOG_CUSTOM.md](CHANGELOG_CUSTOM.md)** et **changelog.txt**

---

## 📄 Licence

Ce plugin modifié conserve la même licence que l'original :

**GNU General Public License v2.0 or later**

```
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
```

Voir le fichier complet : http://www.gnu.org/licenses/gpl-2.0.html

---

## ⚠️ Avertissement

Cette version est une **modification personnalisée non officielle** du plugin Extra Product Options For WooCommerce de ThemeHigh. 

- ❌ **Non supporté officiellement** par ThemeHigh
- ❌ **Pas de mises à jour automatiques** via WordPress.org
- ✅ **Testé et fonctionnel** avec WooCommerce 10.1
- ✅ **Code open source** disponible pour révision

**Utilisez à vos propres risques** et assurez-vous de toujours effectuer des sauvegardes avant l'installation.

---

## 🌟 Remerciements

Un grand merci à l'équipe **ThemeHigh** pour avoir créé le plugin original "Extra Product Options For WooCommerce" qui a servi de base à ces modifications.

### Liens ThemeHigh

- 🌐 **Site Web:** https://themehigh.com/
- 🔌 **Plugin original:** https://wordpress.org/plugins/woo-extra-product-options/
- 📘 **Facebook:** https://www.facebook.com/ThemeHigh-319611541768603/
- 🐦 **Twitter:** https://twitter.com/themehigh/
- 💼 **LinkedIn:** https://www.linkedin.com/company/themehigh/
- 📺 **YouTube:** https://www.youtube.com/channel/UC-_uMXaC_21j1Y2_nGjTyvg/

### Version Premium

Si vous avez besoin de fonctionnalités avancées supplémentaires, consultez la **[version Premium de ThemeHigh](https://www.themehigh.com/product/woocommerce-extra-product-options/)** qui offre :

- 8 types de champs additionnels
- Validation personnalisée
- Formules de prix complexes
- Support prioritaire
- Et bien plus...

---

## 📞 Contact

### Pour les modifications

- **GitHub:** [@i2sac](https://github.com/i2sac)
- **Développeur:** i2sac

### Pour le plugin original

- **ThemeHigh:** https://themehigh.com/
- **Support:** https://www.themehigh.com/docs/support/

---

<div align="center">

**Fait avec ❤️ basé sur le travail de ThemeHigh**

*Ce projet n'est pas affilié à ou endorsé par ThemeHigh*

</div>
