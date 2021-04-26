<?php
namespace App\Traits;

use Keygen\Keygen;

trait ReferenceGenerator
{

    private function generateKey($length = 9)
    {
        // prefixes the key with a random integer between 1 - 9 (inclusive)
        return Keygen::numeric($length)->prefix(mt_rand(1, 9))
                ->prefix($this->refPrefix)
                ->generate(true);
    }

    public function generateReference($model = null)
    {
        $reference = $this->generateKey();
        
        
        $query = $model ? $model::whereReference($reference) : 
                self::whereReference($reference);
        
        // Ensure ID does not exist
        // Generate new one if ID already exists
        while ($query->count() > 0) {
            $reference = $this->generateKey();
        }

        return $reference;
    } 
}