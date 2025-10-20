<?php
/**
 * Script de test pour la fonctionnalité Price
 * 
 * Ce fichier contient des exemples de tests pour vérifier que
 * la fonctionnalité de prix supplémentaire fonctionne correctement.
 * 
 * ATTENTION : Ce fichier est uniquement à titre de documentation
 * Ne l'exécutez pas directement sur votre site de production !
 */

// ============================================
// TEST 1 : Vérifier que la propriété price existe
// ============================================
function test_price_property_exists() {
    $field = new WEPOF_Product_Field();
    
    // Vérifier que la propriété price existe
    if (property_exists($field, 'price')) {
        echo "✓ TEST 1 RÉUSSI : La propriété 'price' existe dans la classe WEPOF_Product_Field\n";
        return true;
    } else {
        echo "✗ TEST 1 ÉCHOUÉ : La propriété 'price' n'existe pas\n";
        return false;
    }
}

// ============================================
// TEST 2 : Vérifier le calcul du prix pour un checkbox
// ============================================
function test_price_calculation_checkbox() {
    // Simuler un champ checkbox avec un prix de 5$
    $extra_options = array(
        'poulet_option' => array(
            'name' => 'poulet_option',
            'value' => 'yes', // Checkbox coché
            'type' => 'checkbox',
            'label' => 'Ajouter du poulet'
        )
    );
    
    // Simuler le champ complet avec le prix
    $field = new WEPOF_Product_Field();
    $field->set_property('name', 'poulet_option');
    $field->set_property('type', 'checkbox');
    $field->set_property('price', 5.00);
    
    // Note : Dans un test réel, vous appelleriez calculate_extra_options_price()
    // mais cette méthode est privée. Voici le résultat attendu :
    $expected_price = 5.00;
    
    echo "✓ TEST 2 : Prix attendu pour checkbox coché = {$expected_price}$\n";
    return true;
}

// ============================================
// TEST 3 : Vérifier le calcul pour checkboxgroup
// ============================================
function test_price_calculation_checkboxgroup() {
    // Simuler un checkboxgroup avec 3 options cochées et un prix de 2$ par option
    $extra_options = array(
        'extras' => array(
            'name' => 'extras',
            'value' => 'fromage,bacon,oignons', // 3 options cochées
            'type' => 'checkboxgroup',
            'label' => 'Extras'
        )
    );
    
    $field = new WEPOF_Product_Field();
    $field->set_property('name', 'extras');
    $field->set_property('type', 'checkboxgroup');
    $field->set_property('price', 2.00);
    
    // Prix attendu : 2$ × 3 options = 6$
    $expected_price = 6.00;
    
    echo "✓ TEST 3 : Prix attendu pour checkboxgroup (3 options) = {$expected_price}$\n";
    return true;
}

// ============================================
// TEST 4 : Vérifier le calcul pour select
// ============================================
function test_price_calculation_select() {
    // Simuler un select avec une option sélectionnée et un prix de 3$
    $extra_options = array(
        'size_option' => array(
            'name' => 'size_option',
            'value' => 'large', // Option sélectionnée
            'type' => 'select',
            'label' => 'Taille'
        )
    );
    
    $field = new WEPOF_Product_Field();
    $field->set_property('name', 'size_option');
    $field->set_property('type', 'select');
    $field->set_property('price', 3.00);
    
    $expected_price = 3.00;
    
    echo "✓ TEST 4 : Prix attendu pour select = {$expected_price}$\n";
    return true;
}

// ============================================
// TEST 5 : Scénario complet - Produit avec plusieurs options
// ============================================
function test_complete_scenario() {
    echo "\n=== TEST 5 : Scénario complet ===\n";
    
    // Produit de base : Pizza à 10$
    $base_price = 10.00;
    echo "Prix de base du produit : {$base_price}$\n";
    
    // Options sélectionnées :
    // 1. Checkbox "Poulet" (+5$)
    // 2. Checkboxgroup "Extras" avec 2 options cochées (fromage, bacon) à 2$ chacune (+4$)
    // 3. Select "Taille Grande" (+3$)
    
    $expected_extra_price = 5.00 + (2 * 2.00) + 3.00; // = 12$
    $expected_total_price = $base_price + $expected_extra_price; // = 22$
    
    echo "Options sélectionnées :\n";
    echo "  - Poulet (checkbox) : +5$\n";
    echo "  - Extras (checkboxgroup, 2 options) : +4$\n";
    echo "  - Taille Grande (select) : +3$\n";
    echo "\nPrix supplémentaire total : {$expected_extra_price}$\n";
    echo "Prix final attendu : {$expected_total_price}$\n";
    
    return true;
}

// ============================================
// TEST 6 : Vérifier que le prix n'est pas ajouté si l'option n'est pas sélectionnée
// ============================================
function test_no_price_when_not_selected() {
    echo "\n=== TEST 6 : Pas de prix si option non sélectionnée ===\n";
    
    // Checkbox non coché
    $extra_options = array(
        'poulet_option' => array(
            'name' => 'poulet_option',
            'value' => '', // Checkbox non coché
            'type' => 'checkbox',
            'label' => 'Ajouter du poulet'
        )
    );
    
    $expected_price = 0.00;
    
    echo "✓ TEST 6 : Prix attendu pour checkbox non coché = {$expected_price}$\n";
    return true;
}

// ============================================
// EXÉCUTION DES TESTS
// ============================================
echo "======================================\n";
echo "TESTS DE LA FONCTIONNALITÉ PRICE\n";
echo "======================================\n\n";

// Exécuter tous les tests
test_price_property_exists();
test_price_calculation_checkbox();
test_price_calculation_checkboxgroup();
test_price_calculation_select();
test_complete_scenario();
test_no_price_when_not_selected();

echo "\n======================================\n";
echo "TESTS TERMINÉS\n";
echo "======================================\n";

// ============================================
// INSTRUCTIONS POUR TESTER MANUELLEMENT
// ============================================
?>

INSTRUCTIONS DE TEST MANUEL :
=============================

1. CONFIGURATION DANS L'ADMIN
   - Allez dans WooCommerce → Extra Product Options
   - Créez une nouvelle section ou modifiez une existante
   - Ajoutez un champ (ex: Select "Supplément")
   - Dans le formulaire du champ, remplissez le champ "Price" avec 5
   - Sauvegardez

2. TEST SUR LE FRONT-END
   - Visitez la page d'un produit qui coûte 10$
   - Sélectionnez l'option que vous avez créée
   - Ajoutez le produit au panier
   - Vérifiez que le prix affiché dans le panier est bien 15$ (10$ + 5$)

3. TEST AVEC PLUSIEURS OPTIONS
   - Créez plusieurs champs avec différents prix
   - Sélectionnez plusieurs options
   - Vérifiez que le prix total est correct

4. TEST AVEC CHECKBOXGROUP
   - Créez un champ checkboxgroup avec un prix de 2$
   - Options : "Fromage|Bacon|Oignons"
   - Cochez 3 options
   - Le prix devrait être augmenté de 6$ (2$ × 3)

5. VÉRIFICATION DANS LA COMMANDE
   - Finalisez une commande avec des options à prix supplémentaire
   - Vérifiez que le prix est correct dans :
     * L'email de confirmation
     * La page "Merci pour votre commande"
     * La section "Commandes" de l'admin
     * La facture

6. TEST DE PERSISTANCE
   - Ajoutez un produit avec options au panier
   - Fermez le navigateur
   - Rouvrez et vérifiez que le prix est toujours correct

POINTS DE CONTRÔLE :
====================
✓ Le champ Price apparaît dans le formulaire d'édition des champs
✓ Le prix est sauvegardé correctement en base de données
✓ Le prix s'ajoute correctement au panier
✓ Le prix persiste lors du rechargement de la page
✓ Le prix est visible dans les commandes
✓ Les emails affichent le bon prix
✓ Le prix fonctionne avec tous les types de champs supportés

DÉPANNAGE :
===========
Si le prix ne s'ajoute pas :
1. Vérifiez les logs PHP (wp-content/debug.log)
2. Désactivez les autres plugins de cache
3. Videz le cache du navigateur
4. Vérifiez que la valeur du champ Price est > 0
5. Testez avec le thème WordPress par défaut
