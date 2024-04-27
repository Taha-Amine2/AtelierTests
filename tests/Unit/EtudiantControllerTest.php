<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Etudiant;

class EtudiantControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_method()
    {
        Etudiant::create([
            'nom' => 'Nom1',
            'prenom' => 'Prenom1',
            'adresse' => 'Adresse1',
            'niveau' => 'Niveau1',
        ]);

        Etudiant::create([
            'nom' => 'Nom2',
            'prenom' => 'Prenom2',
            'adresse' => 'Adresse2',
            'niveau' => 'Niveau2',
        ]);

        $response = $this->getJson('/etudiants');

        $response->assertOk()
            ->assertJsonCount(2, 'etudiants');
    }

    public function test_store_method()
    {
        $response = $this->postJson('/etudiants', [
            'nom' => 'NouveauNom',
            'prenom' => 'NouveauPrenom',
            'adresse' => 'NouvelleAdresse',
            'niveau' => 'NouveauNiveau',
        ]);

        $response->assertStatus(201)
            ->assertJson([
                'etudiant' => [
                    'nom' => 'NouveauNom',
                    'prenom' => 'NouveauPrenom',
                    'adresse' => 'NouvelleAdresse',
                    'niveau' => 'NouveauNiveau',
                ]
            ]);

        $this->assertDatabaseHas('etudiants', [
            'nom' => 'NouveauNom',
            'prenom' => 'NouveauPrenom',
            'adresse' => 'NouvelleAdresse',
            'niveau' => 'NouveauNiveau',
        ]);
    }

    public function test_show_method()
    {
        $etudiant = Etudiant::create([
            'nom' => 'NomTest',
            'prenom' => 'PrenomTest',
            'adresse' => 'AdresseTest',
            'niveau' => 'NiveauTest',
        ]);

        $response = $this->getJson('/etudiants/' . $etudiant->id);

        $response->assertOk()
            ->assertJson([
                'etudiant' => [
                    'nom' => 'NomTest',
                    'prenom' => 'PrenomTest',
                    'adresse' => 'AdresseTest',
                    'Niveau' => 'NiveauTest',
                ]
            ]);
    }
    public function test_update_method()
{
    $etudiant = Etudiant::create([
        'nom' => 'NomInitial',
        'prenom' => 'PrenomInitial',
        'adresse' => 'AdresseInitial',
        'niveau' => 'NiveauInitial',
    ]);

    $response = $this->putJson('/etudiants/' . $etudiant->id, [
        'nom' => 'NomModifie',
        'prenom' => 'PrenomModifie',
        'adresse' => 'AdresseModifie',
        'niveau' => 'NiveauModifie',
    ]);

    $response->assertOk()
        ->assertJson([
            'etudiant' => [
                'nom' => 'NomModifie',
                'prenom' => 'PrenomModifie',
                'adresse' => 'AdresseModifie',
                'niveau' => 'NiveauModifie',
            ]
        ]);

    $this->assertDatabaseHas('etudiants', [
        'id' => $etudiant->id,
        'nom' => 'NomModifie',
        'prenom' => 'PrenomModifie',
        'adresse' => 'AdresseModifie',
        'niveau' => 'NiveauModifie',
    ]);
}

public function test_destroy_method()
{
    $etudiant = Etudiant::create([
        'nom' => 'NomASupprimer',
        'prenom' => 'PrenomASupprimer',
        'adresse' => 'AdresseASupprimer',
        'niveau' => 'NiveauASupprimer',
    ]);

    $response = $this->deleteJson('/etudiants/' . $etudiant->id);

    $response->assertNoContent();

    $this->assertDatabaseMissing('etudiants', ['id' => $etudiant->id]);
}

}
