# Amélioration de l'affichage des prix

## Description

Cette amélioration ajoute l'affichage automatique du prix des options directement sur la page produit, permettant aux clients de voir immédiatement le coût supplémentaire de chaque option.

## Fonctionnalités

### 1. Affichage du prix dans le titre du champ

Pour tous les types de champs (checkbox, input, textarea, etc.), si un prix est défini, il sera affiché entre parenthèses après le titre du champ.

**Exemple :**

```
Add Piment (1.00$)
```

### 2. Affichage du prix dans les options (select, radio, checkboxgroup)

Pour les champs avec plusieurs options (select, radio, checkboxgroup), le prix est affiché à côté de chaque option disponible.

**Exemples :**

**Select dropdown :**

```html
<select>
  <option>Option 1 (2.50$)</option>
  <option>Option 2 (2.50$)</option>
</select>
```

**Radio buttons :**

```
○ Small (2.50$)
○ Medium (2.50$)
○ Large (2.50$)
```

**Checkbox group :**

```
☐ Extra Cheese (1.50$)
☐ Extra Bacon (2.00$)
☐ Extra Tomato (0.75$)
```

## Modifications techniques

### Fichier modifié : `includes/utils/class-thwepof-utils-field.php`

#### 1. Fonction `get_title_html()` (ligne ~365)

**Ajout :**

```php
// Add price to title if available
$price = $field->get_property('price');
if(!empty($price) && is_numeric($price) && $price > 0){
    $currency_symbol = get_woocommerce_currency_symbol();
    $title_html .= ' <span class="thwepof-field-price">(' . $currency_symbol . number_format((float)$price, 2) . ')</span>';
}
```

Cette modification ajoute le prix entre parenthèses après le titre du champ pour tous les types de champs.

#### 2. Fonction `get_html_select()` (ligne ~554)

**Ajout :**

```php
// Add price to option text if available
if(!empty($price) && is_numeric($price) && $price > 0){
    $option_display .= ' (' . $currency_symbol . number_format((float)$price, 2) . ')';
}
```

Cette modification ajoute le prix à chaque option dans le menu déroulant select.

#### 3. Fonction `get_html_checkboxgroup()` (ligne ~595)

**Ajout :**

```php
// Add price to option text if available
if(!empty($price) && is_numeric($price) && $price > 0){
    $input_html .= ' <span class="thwepof-option-price">(' . $currency_symbol . number_format((float)$price, 2) . ')</span>';
}
```

Cette modification ajoute le prix à chaque checkbox dans un groupe de checkboxes.

#### 4. Fonction `get_html_radio()` (ligne ~639)

**Ajout :**

```php
// Add price to option text if available
if(!empty($price) && is_numeric($price) && $price > 0){
    $option_display .= ' <span class="thwepof-option-price">(' . $currency_symbol . number_format((float)$price, 2) . ')</span>';
}
```

Cette modification ajoute le prix à chaque bouton radio.

## Format d'affichage

- **Symbole de devise :** Utilise automatiquement le symbole de devise configuré dans WooCommerce
- **Format du prix :** Affiche toujours 2 décimales (ex: 1.00, 2.50, 10.99)
- **Style :** Le prix est affiché entre parenthèses pour une meilleure lisibilité
- **Classes CSS :**
  - `.thwepof-field-price` : pour le prix dans le titre
  - `.thwepof-option-price` : pour le prix dans les options

## Utilisation

1. Créez ou modifiez un champ d'option extra dans l'administration WooCommerce
2. Définissez un prix dans le champ "Price"
3. Le prix s'affichera automatiquement sur la page produit selon le type de champ :
   - **Checkbox simple :** Prix dans le titre uniquement
   - **Select/Radio/Checkboxgroup :** Prix dans chaque option

## Compatibilité

- Compatible avec tous les types de champs du plugin
- Utilise les fonctions WooCommerce natives pour le symbole de devise
- Respecte les paramètres de devise et de format de WooCommerce
- S'intègre avec le système de calcul de prix existant

## Classes CSS personnalisées

Vous pouvez personnaliser l'apparence des prix affichés en ajoutant du CSS dans votre thème :

```css
/* Style pour le prix dans le titre */
.thwepof-field-price {
  color: #008000;
  font-weight: bold;
  font-size: 0.9em;
}

/* Style pour le prix dans les options */
.thwepof-option-price {
  color: #008000;
  font-style: italic;
  font-size: 0.85em;
}
```

## Avantages

1. **Transparence totale :** Les clients voient immédiatement le coût de chaque option
2. **Meilleure expérience utilisateur :** Pas de surprise lors de l'ajout au panier
3. **Augmentation des conversions :** Les clients peuvent prendre des décisions éclairées
4. **Conformité :** Affichage clair des prix conformément aux réglementations commerciales

## Notes

- Si aucun prix n'est défini pour un champ, rien ne s'affiche (comportement par défaut)
- Si le prix est 0, rien ne s'affiche
- Le prix doit être un nombre valide et positif pour être affiché
- Le format d'affichage suit automatiquement les paramètres de WooCommerce
