<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;


class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'Utilisateur-Voir',
            'Utilisateur-Ajouter',
            'Utilisateur-Modifier',
            'Utilisateur-Supprimer',
            'Document-Voir',
            'Document-Ajouter',
            'Document-Modifier',
            'Document-Supprimer',
            'Structure-Voir',
            'Structure-Ajouter',
            'Structure-Modifier',
            'Structure-Supprimer',
            'Role-Voir',
            'Role-Ajouter',
            'Role-Modifier',
            'Role-Supprimer'
            
           
         ];
 
 
         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission]);
         }
    }
}
